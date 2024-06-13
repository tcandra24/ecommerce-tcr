<div class="invoice">
    <header class="clearfix">
        <div class="row">
            <div class="col-sm-6 mt-3">
                <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
                <h4 class="h4 m-0 text-dark font-weight-bold">{{ $invoice->invoice }}</h4>
            </div>
            <div class="col-sm-6 text-end mt-3 mb-3">
                <address class="ib me-3">
                    Ruko Rich Palace
                    <br>
                    Jl. Mayjen Sungkono No.149-151 Blok H10
                    <br>
                    Dukuh Pakis, Kec. Dukuhpakis
                    <br />
                    Surabaya, Jawa Timur 60189
                    <br />
                    Phone: 0852-6000-081
                </address>
                <div class="ib">
                    <img src="{{ asset('assets/admin/img/logo.png') }}" width="180" height="60"
                        alt="Ecommerce TCR" />
                </div>
            </div>
        </div>
    </header>
    <div class="bill-info">
        <div class="row">
            <div class="col-md-6">
                <div class="bill-to">
                    <p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
                    <address>
                        {{ $invoice->customer->name }}
                        <br />
                        {{ $invoice->customer->address }}
                        <br />
                        Phone: {{ $invoice->customer->phone }}
                    </address>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bill-data text-end">
                    <p class="mb-0">
                        <span class="text-dark">Invoice Date:</span>
                        <span
                            class="value">{{ \Carbon\Carbon::parse($invoice->created_at)->locale('id')->format('d/m/Y') }}</span>
                        <br>
                        <span
                            class="value">{{ \Carbon\Carbon::parse($invoice->created_at)->locale('id')->format('H:m:s') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-responsive-md invoice-items">
        <thead>
            <tr class="text-dark">
                <th id="cell-id" class="font-weight-semibold">#</th>
                <th id="cell-item" class="font-weight-semibold">Item</th>
                <th id="cell-price" class="text-center font-weight-semibold">Price</th>
                <th id="cell-qty" class="text-center font-weight-semibold">Quantity</th>
                <th id="cell-total" class="text-center font-weight-semibold">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->orders as $order)
                <tr>
                    <td>{{ $order->product->sku }}</td>
                    <td class="font-weight-semibold text-dark">{{ $order->product->title }}</td>
                    <td class="text-end">Rp. {{ moneyFormat($order->price) }}</td>
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
