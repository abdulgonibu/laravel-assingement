<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\AddNot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Stringable;

class AddNotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = AddNot::orderBy('updated_at',  'desc')->paginate(10);
        $searched = request()->s;
        if (!empty($searched)) {
            $notes->where('title', 'like', '%' . $searched . '%');
        }
        return view('layouts.home', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $note = new AddNot();
        $note->title = $request->title;
        $note->des = $request->des;
        $note->slug = Str::of($request->title)->slug();
        $note->status = $request->status;
        $note->save();

        // Note image
        $file = $request->file('image');
        $image_name = Str::of($request->title)->slug() . '-' . time() . '.' . $file->extension();
        $note->image = $file->storePubliclyAs('public/notes', $image_name);
        $note->save();
        //Process the slug again and save
        $note->slug = $note->slug . '_' . $note->id;
        $note->save();

        session()->flash('success', 'Note Create Successfully');
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddNot  $addNot
     * @return \Illuminate\Http\Response
     */
    public function show(AddNot $addNot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddNot  $addNot
     * @return \Illuminate\Http\Response
     */
    public function edit(string|int $id_or_slug)
    {
        $note = $this->getTaskByIdOrSlug($id_or_slug);
        // if no task found, then  error message that task not found.
        if (!$note) {
            session()->flash('error', 'Sorry, Task not found !');
            return redirect()->route('/');
        }
        return view('layouts.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddNot  $addNot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string|int $id_or_slug)
    {
        $note = $this->getTaskByIdOrSlug($id_or_slug);

        // if no task found, then session error message that task not found.
        if (!$note) {
            session()->flash('error', 'Sorry, Note not found !');
            return redirect()->route('index');
        }

        $note->title = $request->title;
        $note->slug = Str::of($request->title)->slug() . '-' . $note->id;
        $note->des = $request->des;
        $note->status = $request->status;

        // Task image
        if ($request->image) {
            // Delete old image.
            // Check if image exists
            if ($note->image) {
                Storage::delete($note->image);
            }

            // Create new image and link
            $file = $request->file('image');
            $image_name = Str::of($request->title)->slug() . '-' . time() . '.' . $file->extension();
            $note->image = $file->storePubliclyAs('public/notes', $image_name);
        }
        $note->save();

        // Redirect with flash
        session()->flash('success', 'Note has been updated successfully !');
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddNot  $addNot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_or_slug)
    {
        // Find first
        $note = $this->getTaskByIdOrSlug($id_or_slug);

        // if no task found, then session error message that task not found.
        if (!$note) {
            session()->flash('error', 'Sorry, Task not found !');
            return redirect()->route('index');
        }

        // Check if any image, then delete
        if ($note->image) {
            Storage::delete($note->image);
        }

        // Delete from Task table
        $note->delete();

        // session success and redirect
        session()->flash('success', 'Note has been deleted successfully !');
        return redirect()->route('index');
    }


    public function getTaskByIdOrSlug(string|int $id_or_slug)
    {
        if (is_numeric($id_or_slug)) {
            return AddNot::find($id_or_slug);
        } else {
            return AddNot::where('slug', $id_or_slug)->first();
        }
    }
}
