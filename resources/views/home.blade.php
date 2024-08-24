{{-- @extends('layouts.app')

@section('title', 'Home')

@section('header')
    @include('layouts.header', ['type' => 'navbar'])
@endsection

@section('content')
    <h1>Welcome to the Home Page</h1>
    <p>This is the content of the home page.</p>
@endsection --}}

{{-- ================================================================================================================= --}}
{{-- @extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Why Choose Section -->
    <section class="bg-gray-100 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Why should you choose Andal Prima?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <h3 class="font-bold">Complete and accurate product information</h3>
                <p>We provide complete and accurate product information, including descriptions, specifications and usage guides for every item we sell.</p>
            </div>
            <div>
                <h3 class="font-bold">Delivery on time, according to schedule</h3>
                <p>Timely delivery according to the agreed schedule is our priority, ensuring your order arrives without delay.</p>
            </div>
            <div>
                <h3 class="font-bold">Competitive prices and quality</h3>
                <p>We offer competitive prices with the best quality, so you get maximum value for every purchase.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-white p-6 rounded-lg shadow-lg mt-8">
        <h2 class="text-2xl font-bold mb-4">Consult your needs now</h2>
        <p>Get the best offer from us, contact us and we will immediately serve what you need.</p>
        <a href="mailto:team@andalprima.co.id" class="mt-4 inline-block bg-red-600 text-white px-4 py-2 rounded">Contact Us</a>
    </section>

    <!-- Partners Section -->
    <section class="mt-8">
        <h2 class="text-xl font-bold mb-4">Our Partner Products:</h2>
        <div class="flex space-x-4">
            <img src="path_to_partner_logo" alt="Dynamix">
            <img src="path_to_partner_logo" alt="Penguin">
            <img src="path_to_partner_logo" alt="Semen Andalas">
            <img src="path_to_partner_logo" alt="Alderon">
            <img src="path_to_partner_logo" alt="Power">
            <img src="path_to_partner_logo" alt="Pralon">
        </div>
    </section>
</div>
@endsection --}}

{{-- ================================================================================================================== --}}

@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent
@endsection
