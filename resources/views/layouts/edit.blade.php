@extends('layouts.main')

@section('content')
    @include('layouts.message')
    <div class="row">
        <div>
            <a href="{{ route('index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('notes.update', $note->id) }}" method="post" class="col-md-12 ml-20px shadow p-4"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-md-6">
                <input type="text" name="title" placeholder="Type Title" value="{{ $note->title }}"
                    class="form-control inline-block mb-2 shadow">
                @if ($note->image)
                    <p>Old Image</p>
                    <img src="{{ Storage::url($note->image) }}" alt="" srcset="" width="50" />
                @endif
                <input type="file" name="image" class="form-control my-2">
            </div>
            <div class="col-md-6">
                <textarea name="des" id="" placeholder="Enter Your Plan" cols="30" rows="5"
                    class="form-control">{{ $note->des }}</textarea>
            </div>
            <div class="col-md-6 mt-2">
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $note->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $note->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="done" {{ $note->status === 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <div class="col-md-6 mt-2">
                <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>

        </form>
    </div>
@endsection
