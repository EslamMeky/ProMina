@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Picture') }}</div>

                <div class="card-body">
                    <span> Create picture</span>
                    <form action="{{route('savePhoto')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.error')
                        <div class="form-group">

                            <label for="name">Name picture</label>
                            <input type="text" name="name" value="{{old('name_picture')}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label for="desc">My Albums</label>
                            <select class="form-control" name="album">
                                <option value="">Select Your Album</option>
                                @foreach($albums as $value => $album)
{{--                                    <option value="{{ $album->id }}" {{ old('album') == $value ? 'selected' : '' }}>{{ $album->name }}</option>--}}
                                    <option value="{{ $album->id }}" >{{ $album->name }}</option>

                                @endforeach
                            </select>
                            @error('album')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="path[]"  class="custom-file" multiple>
                            @error('path') <span class="text-danger">{{$message}}</span>@enderror
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

                    <div class="album py-5 bg-light">
                        <div class="container">
                            <div class="row">
                                @if(isset($pictures) && $pictures->count() > 0)
                                    @foreach($pictures as $picture)
                                        <div class="col-md-4 mb-4">

                                            <div class="card">
                                                <div class="btn-group" role="group" aria-label="Basic example">

                                                    <a href="{{route('move',$picture->id)}}"  class="btn btn-outline-dark btn-min-width box-shadow-3 mr-1 mb-1">
                                                        <i class="bi bi-arrow-left-right">move</i>
                                                    </a>

                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title font-bold text-lg">{{$picture->albums->name}}</h5>
                                                    <p class="card-text text-muted">{{$picture->created_at->diffForHumans()}}</p>
                                                    <img src="{{$picture->Pathphoto}}" class="card-img-top" style="height: 208px; width: 255px;" alt="{{$picture->name_photo}}">
                                                    <p class="card-text text-gray-800">{{$picture->name_photo}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="pagination">
                                        {!! $pictures->links() !!}
                                    </div>
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong>Not available photos</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>



@endsection
