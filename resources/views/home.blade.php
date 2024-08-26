
@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-default') @endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent
@endsection
