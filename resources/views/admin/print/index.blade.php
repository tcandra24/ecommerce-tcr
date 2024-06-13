@extends('layouts.print')

@section('title')
    Print {{ $invoice->invoice }}
@endsection

@section('styles')
    {{--  --}}
@endsection

@section('scripts')
    {{--  --}}
@endsection

@section('main')
    <x-receipt-template :invoice="$invoice" :grandTotal="$grandTotal" />
@endsection
