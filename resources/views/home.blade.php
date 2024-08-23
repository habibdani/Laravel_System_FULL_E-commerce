@extends('layouts.app')

@section('title', 'Home')

@section('header')
    @include('layouts.header', ['type' => 'navbar'])
@endsection

@section('content')
    <h1>Welcome to the Home Page</h1>
    <p>This is the content of the home page.</p>
@endsection
