{{-- ke thua layout view --}}
@extends('backend.layout')

@section('title', 'Admin - Roles')
{{-- xu ly cho components page heading --}}
@section('pageHeading', 'Roles')
@php
$buttonReport = false;
@endphp
{{-- het xu ly cho components page heading --}}

@section('content')
    <div class="row">
        <div class="col">
            <p> Add Roles</p>
            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('statusAddOk'))
                <div class="alert alert-success my-3">
                    {{ session('statusAddOk') }}
                </div>
            @endif

            @if(session('statusAddFail'))
                <div class="alert alert-danger my-3">
                    {{ session('statusAddFail') }}
                </div>
            @endif

            <form class="p-3 border my-3" method="post" action="{{ route('admin.add.role') }}">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="nameRole" />
                </div>
                <div class="form-group">
                    <label>Display name</label>
                    <input type="text" class="form-control" name="displayNameRole" />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="8" class="form-control" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"> Add </button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <p> List roles</p>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Display</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{!! $role->description !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- phan trang --}}
            {{ $roles->links() }}
        </div>
    </div>
@endsection