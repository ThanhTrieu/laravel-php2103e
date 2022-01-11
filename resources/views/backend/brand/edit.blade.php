{{-- ke thua layout view --}}
@extends('backend.layout')

@section('title', 'Admin - Edit Brands')
{{-- xu ly cho components page heading --}}
@section('pageHeading', 'Edit Brands')
@php
$buttonReport = false;
@endphp
{{-- het xu ly cho components page heading --}}

@section('content')
    <div class="row">
        <div class="col">
 
            <a class="btn btn-primary" href="{{ route('admin.brands') }}">List Brands</a>

            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('errorBrand'))
                <div class="alert alert-danger my-3">
                    {{ session('errorBrand') }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.handle.edit.brand',['id' => $info->id]) }}" class="p-3 border my-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input value="{{ $info->name }}" type="text" class="form-control" name="name" />
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control" />
                    <div class="my-3">
                        <img src="{{ asset('storage/images/'.$info->logo) }}" width="10%" height="10%" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="8">{!! $info->description !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary"> submit</button>
            </form>
        </div>
    </div>
@endsection