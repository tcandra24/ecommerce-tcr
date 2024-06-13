<section class="card mb-4">
    <div class="card-body">
        <div class="invoice">
            <h4 class="mt-0 mb-0 font-weight-bold text-dark">Hello {{ $invoice->customer->name }}</h4>
            <p>Your Invoice is {{ $invoice->invoice }}</p>
            <h4 class="mt-0 mb-0 font-weight-bold text-dark">{{ $title }}</h4>
            <header class="clearfix">
                <div class="row">
                    <div class="col-sm-12 text-start mt-3 mb-3">
                        <div class="ib">
                            <img src="{{ asset('assets/admin/img/logo.png') }}" width="180" height="60"
                                alt="Ecommerce TCR" />
                        </div>
                    </div>
                </div>
            </header>
            <h4 class="mt-0 mb-0 font-weight-bold text-dark">Order Details</h4>
            <table class="table table-responsive-md invoice-items">
                <thead>
                    <tr class="text-dark">
                        <th id="cell-item" class="font-weight-semibold">Item</th>
                        <th id="cell-qty" class="text-center font-weight-semibold">Quantity</th>
                        <th id="cell-total" class="text-center font-weight-semibold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->orders as $order)
                        <tr>
                            <td class="font-weight-semibold text-dark">{{ $order->product->title }}</td>
                            <td class="text-center">{{ $order->qty }}</td>
                            <td class="text-end">Rp. {{ moneyFormat($order->total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="invoice-summary">
                <div class="row justify-content-end">
                    <div class="col-sm-6">
                        <table class="table h6 text-dark">
                            <tbody>
                                <tr class="b-top-0">
                                    <td>Subtotal</td>
                                    <td colspan="2" class="text-end">Rp. {{ moneyFormat($grandTotal) }}</td>
                                </tr>
                                <tr class="h4">
                                    <td>Grand Total</td>
                                    <td colspan="2" class="text-end">Rp. {{ moneyFormat($grandTotal) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
