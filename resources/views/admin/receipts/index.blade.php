@extends('layouts.admin')

@section('title')
    Receipt {{ $invoice->invoice }}
@endsection

@section('styles')
    {{--  --}}
@endsection

@section('scripts')
    <script>
        // $('#print-button').on('click', function() {
        //     $('#print-area').print()
        // })
    </script>
@endsection

@section('main')
    <section class="card">
        <div class="card-body">
            <x-receipt-template :invoice="$invoice" :grandTotal="$grandTotal" />
            <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                <a href="/admin/print/{{ $invoice->invoice }}" target="_blank" class="btn btn-primary ms-3">
                    <i class="fas fa-print"></i>
                    Print
                </a>
            </div>
        </div>
    </section>
@endsection
