@extends('layouts.backend')

@section('content-template')
    <main role="main" id="backend_content">
        @livewire('pages.backend.customers.customer-single', ['customer_id' => $customer->id])
    </main>
@endsection
