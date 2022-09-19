@extends('layouts.main')

@section('content')
    @include('layouts.message')
    <div class="row">
        <form action="{{ route('notes.store') }}" method="post" class="col-md-12 ml-20px shadow p-4"
            enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <input type="text" name="title" placeholder="Type Title" class="form-control inline-block mb-2 shadow">
                <input type="file" name="image" class="form-control my-2">
            </div>
            <div class="col-md-6">
                <textarea name="des" id="" placeholder="Enter Your Plan" cols="30" rows="5"
                    class="form-control"></textarea>
            </div>
            <div class="col-md-6 mt-2">
                <select name="status" id="status" class="form-control">
                    <option value="">-->Select<--< /option>
                    <option value="active">Active</option>
                    <option value="pending">Penting</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="col-md-6 mt-2">
                <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>

        </form>
    </div>
    <hr>
    <div class="">
        <div class="row">
            <div class="col-md-12 d-flex ">
                @foreach ($notes as $note)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ Storage::url($note->image) }}" class="card-img-top" height="100px" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $note->title }}</h5>
                            <p class="card-text">{{ $note->des }}</p>
                            <p class="card-text">{{ $note->status }}</p>
                            <div>
                                <a class="btn btn-success btn-sm" href="{{ route('notes.edit', $note->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm ml-2" type="button"  data-toggle="modal" data-target="#deleteModal{{$note->id}}"
                                    href="#deleteModal{{$note->id}}">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{$note->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$note->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal{{ $note->id }}Label">Are you sure ?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Note - <mark>{{ $note->title }}</mark> will be deleted permanently. Are you sure to delete ?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
