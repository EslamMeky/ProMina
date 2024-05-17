@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Album') }}</div>

                <div class="card-body">
                    <span> Edit Album</span>
                    <form action="{{route('updateAlbum',$album->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="id" value="{{$album->id}}" type="hidden">
                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.error')
                        <div class="form-group">
                            <div class="text-center">
                                <img
                                    src="{{$album -> image}}"
                                    class="rounded-circle w-25 height-25" alt="Album Of Photo">
                            </div>
                            <label for="name">Name Album</label>
                            <input type="text" name="name" value="{{$album->name}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" name="desc"  >{{$album->desc}}</textarea>
                            @error('desc') <span class="text-danger">{{$message}}</span>@enderror
                        </div>


                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image"  class="custom-file">
                            @error('image') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i>edit
                        </button>
                        </div>



                    </div>
                </form>



        </div>
    </div>


</div>


@endsection
