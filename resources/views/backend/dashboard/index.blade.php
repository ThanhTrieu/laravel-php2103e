{{-- ke thua layout view --}}
@extends('backend.layout')

{{-- xu ly cho components page heading --}}
@section('pageHeading', 'Dashboard')
@php
$buttonReport = true;
@endphp
{{-- het xu ly cho components page heading --}}

@section('content')
    <div class="row">
        <div class="col">
            <p> This is dashboard content</p>
        </div>
    </div>
@endsection