@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Album') }}</div>

                <div class="card-body">
                    <span> Create Album</span>
                    <form action="{{route('addAlbum')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.error')
                        <div class="form-group">
                            <label for="name">Name Album</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" name="desc" {{old('desc')}}></textarea>
                            @error('desc') <span class="text-danger">{{$message}}</span>@enderror
                        </div>


                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image"  class="custom-file">
                            @error('image') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i>save
                        </button>
                        </div>



                    </div>
                </form>



        </div>
    </div>



        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @if(isset($albums)&& $albums->count() > 0)
                        @foreach($albums as $album)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="btn-group" role="group"  aria-label="Basic example">
                                        <a href="{{ route('editAlbum', $album->id) }}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                            <i class="bi bi-pencil-square">edit</i>
                                        </a>


                                        <a href="{{route('deleteAll',$album->id)}}"  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                            <i class="bi bi-trash-fill">Pictures</i>
                                        </a>

                                        <a href="{{route('delete',$album->id)}}"  class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                            <i class="bi bi-trash-fill">Album</i>
                                        </a>



                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title font-bold text-lg">{{$album->users->name }}</h5>

                                        <p class="card-text text-muted">{{$album->created_at->diffForHumans()}}</p>
                                        <p class="card-text text-gray-800">{{$album->name}}</p>

                                      <a href="{{route('index.picture',$album->id)}}" class="link-dark" style="text-decoration: none;">  <img src="{{$album->image}}" class="card-img-top" style="height: 208px; width: 255px;" alt="Not found Photo">
                                        <p class="card-text text-gray-800">{{$album->desc}}</p></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>Not available photos</strong>
                            </div>
                        </div>
                    @endif
                        <div class="pagination">
                            {!! $albums->links() !!}
                        </div>
                </div>
            </div>
        </div>

@endsection
