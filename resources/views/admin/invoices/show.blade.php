@extends('layouts.admin')

@section('title')
    Invoices {{ $invoice->invoice }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/select2/js/select2.js') }}"></script>
    <script>
        (function($) {

            'use strict';

            $('select[name="paymentStatus"]').select2({
                minimumResultsForSearch: -1,
                templateResult: formatPaymentStatus,
                templateSelection: formatPaymentStatus,
                theme: 'bootstrap'
            });

            function formatPaymentStatus(status) {
                if (!status.id) {
                    return status.text;
                }

                var $status = $(
                    '<span class="ecommerce-status ' + status.id + '">' + status.text + '</span>'
                );

                return $status;
            };

        }(jQuery));
    </script>
@endsection

@section('main')
    <form class="order-details action-buttons-fixed" method="post" data-select2-id="12">
        <div class="row" data-select2-id="11">
            <div class="col-xl-4 mb-4 mb-xl-0" data-select2-id="10">
                <div class="card card-modern">
                    <div class="card-header">
                        <h2 class="card-title">General</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col mb-3">
                                <label>Status Payment</label>
                                <select class="form-control form-control-modern" name="paymentStatus" required>
                                    <option value="pending" {{ $invoice->payment_status === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="completed"
                                        {{ $invoice->payment_status === 'success' ? 'selected' : '' }}>Success
                                    </option>
                                    <option value="cancelled"
                                        {{ $invoice->payment_status === 'expired' ? 'selected' : '' }}>Expired
                                    </option>
                                    <option value="failed" {{ $invoice->payment_status === 'failed' ? 'selected' : '' }}>
                                        Failed
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col mb-3">
                                <label>Status Order</label>
                                <select class="form-control form-control-modern" name="orderStatus" required>
                                    <option value="waiting_payment"
                                        {{ $invoice->order_status === 'waiting_payment' ? 'selected' : '' }}>
                                        Waiting Payment
                                    </option>
                                    <option value="waiting_confirmation"
                                        {{ $invoice->order_status === 'waiting_confirmation ' ? 'selected' : '' }}>
                                        Waiting Confirmation
                                    </option>
                                    <option value="process" {{ $invoice->order_status === 'process' ? 'selected' : '' }}>
                                        Process
                                    </option>
                                    <option value="sent" {{ $invoice->order_status === 'sent' ? 'selected' : '' }}>
                                        Sent
                                    </option>
                                    <option value="arrive" {{ $invoice->order_status === 'arrive' ? 'selected' : '' }}>
                                        Arrive
                                    </option>
                                    <option value="complain" {{ $invoice->order_status === 'complain' ? 'selected' : '' }}>
                                        Complain
                                    </option>
                                    <option value="done" {{ $invoice->order_status === 'done' ? 'selected' : '' }}>
                                        Done
                                    </option>
                                    <option value="canceled" {{ $invoice->order_status === 'canceled' ? 'selected' : '' }}>
                                        Canceled
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col mb-3">
                                <label>Date Created</label>
                                <div class="date-time-field">
                                    <div class="date">
                                        <input type="text" class="form-control form-control-modern" name="orderDate"
                                            value="{{ \Carbon\Carbon::parse($invoice->created_at)->locale('id')->format('d-m-Y') }}"
                                            disabled data-plugin-datepicker
                                            data-plugin-options='{"orientation": "bottom", "format": "dd-mm-YYYY"}' />
                                    </div>
                                    <div class="time">
                                        <span class="px-2">@</span>
                                        <input type="text" class="form-control form-control-modern text-center"
                                            name="orderTimeHour"
                                            value="{{ \Carbon\Carbon::parse($invoice->created_at)->locale('id')->format('H') }}"
                                            disabled />
                                        <span class="px-2">:</span>
                                        <input type="text" class="form-control form-control-modern text-center"
                                            name="orderTimeMin"
                                            value="{{ \Carbon\Carbon::parse($invoice->created_at)->locale('id')->format('m') }}"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col mb-3">
                                <label>Customer</label>
                                <select class="form-control form-control-modern" name="orderCustomer" disabled
                                    data-plugin-selectTwo>
                                    <option value="{{ $invoice->customer->id }}" selected>
                                        {{ $invoice->customer->name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card card-modern">
                    <div class="card-header">
                        <h2 class="card-title">Addresses</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
                                <h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">CUSTOMER</h3>
                                <ul class="list list-unstyled list-item-bottom-space-0">
                                    <li>{{ $invoice->address }}</li>
                                    <li>{{ $invoice->city->name }}</li>
                                    <li>{{ $invoice->province->name }}</li>
                                </ul>
                                <strong class="d-block text-color-dark">Email address:</strong>
                                <a href="mailto:{{ $invoice->customer->email }}">{{ $invoice->customer->email }}</a>
                                <strong class="d-block text-color-dark mt-3">Phone:</strong>
                                <a href="tel:{{ $invoice->phone }}" class="text-color-dark">{{ $invoice->phone }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-modern">
                    <div class="card-header">
                        <h2 class="card-title">Products</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-ecommerce-simple table-ecommerce-simple-border-bottom table-borderless table-striped mb-0"
                                style="min-width: 380px;">
                                <thead>
                                    <tr>
                                        <th width="60%">Name</th>
                                        <th width="10%" class="text-end">Cost</th>
                                        <th width="12%" class="text-end">Qty</th>
                                        <th width="18%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice->orders as $order)
                                        <tr>
                                            <td>
                                                <strong>
                                                    {{ $order->product->title }}
                                                </strong>
                                            </td>
                                            <td class="text-end">Rp. {{ moneyFormat($order->price) }}</td>
                                            <td class="text-end">{{ $order->qty }}</td>
                                            <td class="text-end">Rp.
                                                {{ moneyFormat($order->qty * $order->price) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-end flex-column flex-lg-row my-3">
                            <div class="col-auto">
                                <h3 class="font-weight-bold text-color-dark text-4 mb-3">Grand Total</h3>
                                <span class="d-flex align-items-center justify-content-lg-end">
                                    <strong class="text-color-dark text-5">Rp.
                                        {{ moneyFormat($invoice->grand_total) }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row action-buttons">
            <div class="col-12 col-md-auto">
                <button type="submit"
                    class="submit-button btn btn-primary btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1"
                    data-loading-text="Loading...">
                    <i class="bx bx-save text-4 me-2"></i> Save Order
                </button>
            </div>
            <div class="col-12 col-md-auto px-md-0 mt-3 mt-md-0">
                <a href="/admin/invoices"
                    class="cancel-button btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Cancel</a>
            </div>
            <div class="col-12 col-md-auto ms-md-auto mt-3 mt-md-0 ms-auto">
                <a href="#"
                    class="delete-button btn btn-danger btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1">
                    <i class="bx bx-trash text-4 me-2"></i> Delete Order
                </a>
            </div>
        </div>
    </form>
@endsection
