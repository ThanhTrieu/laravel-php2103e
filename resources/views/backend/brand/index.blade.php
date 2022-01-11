{{-- ke thua layout view --}}
@extends('backend.layout')

@section('title', 'Admin - Brands')
{{-- xu ly cho components page heading --}}
@section('pageHeading', 'Brands')
@php
$buttonReport = false;
@endphp
{{-- het xu ly cho components page heading --}}

@section('content')
    <div class="row">
        <div class="col">
            <p> This is brands page !</p>
            <a class="btn btn-primary" href="{{ route('admin.add.brand') }}"> Add Brand</a>

            @if (session('successBrand'))
                <div class="alert alert-success my-3">
                    {{ session('successBrand') }}
                </div>
            @endif

            <table class="table table-hover my-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nane</th>
                        <th>Logo</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="5%" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $key => $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <img src="{{ asset('storage/images/'.$item->logo) }}" width="50%" />
                            </td>
                            <td>{!! $item->description !!}</td>
                            <td>{{ $item->status == 1 ? 'Active' : 'Deactive' }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('admin.edit.brand',['slug'=>$item->slug, 'id' => $item->id]) }}"> Edit</a>
                            </td>
                            <td>
                                <button id="{{ $item->id }}"" class="btn btn-danger js-deleteBrand"> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Phan trang --}}
            {{ $brands->links() }}
        </div>
    </div>
@endsection
@push('javascripts')
{{-- link js o day --}}
<script src="{{ asset('backend/js/brand.js') }}"></script>
@endpush