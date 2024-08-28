
@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-default') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.maps') @endcomponent
</div>
@endsection
