@extends('layouts.email')

@section('title')
    Invoice {{ $invoice->invoice }}
@endsection

@section('main')
    <x-email-invoice-template :invoice="$invoice" :grandTotal="$grandTotal" :title="$title" />
@endsection
