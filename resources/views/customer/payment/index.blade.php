@extends('components.app')
@section('title' | 'Payment | Laundry App')
@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto mb-3">
       Payment
    </h2>
</div>
<div class="intro-y box col-span-12 lg:col-span-6">
    <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200">
        <h2 class="font-medium text-base mr-auto mt-4">
           Detail Order
        </h2>
    </div>
    <div class="p-5">
        <div class="tab-content">
            <div class="tab-content__pane active" id="latest-tasks-new">
                <div class="flex items-center">
                    <div class="border-l-2 border-theme-1 pl-4">
                        <a href="#" class="font-medium">Payment for Order #{{ $order->id }}</a>
                        @foreach($order->items as $item)
                            <div class="text-gray-600"> {{ $item->service->name_service }} ({{ $item->quantity }} kg x {{ formatRupiah($item->price) }})</div>
                        @endforeach
                        <div class="text-gray-600">Total Amount: {{ formatRupiah($order->total_price) }}</div>
                    </div>
                    <button class="button ml-auto mr-1 mx-2 bg-theme-1 text-white" id="pay-button">Pay Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    Swal.fire(
                        'Payment Success!',
                        'Your payment was successful.',
                        'success'
                    ).then(function() {
                        window.location.href = '/customer/orders/history';
                    });
                },
                onPending: function(result) {
                    Swal.fire(
                        'Waiting for Payment',
                        'Your payment is pending.',
                        'info'
                    );
                    console.log(result);
                },
                onError: function(result) {
                    Swal.fire(
                        'Payment Failed',
                        'Your payment has failed.',
                        'error'
                    );
                    console.log(result);
                },
                onClose: function() {
                    Swal.fire(
                        'Payment Interrupted',
                        'You closed the popup without finishing the payment.',
                        'warning'
                    );
                }
            });
        });
    </script>
@endsection

