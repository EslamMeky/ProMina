@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Move TO Album') }}</div>

                <div class="card-body">
                    <form action="{{route('update',$picture->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            @include('alerts.success')
                            @include('alerts.error')
{{--                            <label for="name">Name picture</label>--}}
{{--                            <input type="text" name="id" value="{{$picture->id}}" class="form-control">--}}
{{--                            @error('id') <span class="text-danger">{{$message}}</span>@enderror--}}

                            <label for="desc">My Albums</label>
                            <select class="form-control" name="album">
                                <option value="">Move To</option>
                                @foreach($albums as $value => $album)
{{--                                    <option value="{{ $category->id }}" {{ old('album') == $value ? 'selected' : '' }}>{{ $category->name }}</option>--}}
                                    <option value="{{ $album->id }}" >{{ $album->name }}</option>

                                @endforeach
                            </select>
                            @error('album')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i>Move To
                            </button>
                        </div>
                    </form>
                </div>

        </div>
    </div>



        </div>



@endsection
