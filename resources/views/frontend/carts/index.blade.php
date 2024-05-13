@extends('frontend.layouts.layout')
@section('title', __('Mon Panier') )

@section('main-content')

    @fragment("panier_fragment")
        @include('frontend.carts.panier_fragment')
    @endfragment

    <div class="text-center mb-5">
        <a href="{{ route('index')}}" class="btn btn-warning btn-lg"> Continuer mes achats </a>
    </div>

@endsection
