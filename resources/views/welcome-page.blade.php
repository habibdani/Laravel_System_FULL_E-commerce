
@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-default') @endcomponent
    @component('components.endUserOrDropShip') @endcomponent
    @component('components.partners2') @endcomponent
@endsection
