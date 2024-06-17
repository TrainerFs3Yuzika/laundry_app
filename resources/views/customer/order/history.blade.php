@extends('components.app')
@section('title', 'Order History | Laundry App')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Order History
        </h2>
    </div>

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'Close',
            });
        });
    </script>
    @endif

    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full" id="dataTable">
            <thead>
                <tr>
                    <th class="border-b-2 text-center whitespace-no-wrap">ORDER ID</th>
                    <th class="border-b-2 whitespace-no-wrap">SERVICE NAME</th>
                    <th class="border-b-2 whitespace-no-wrap">TRACKING NUMBER</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">STATUS PAYMENT</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="border-b">
                        <div class="font-medium">Order #{{ $order->id }}</div>
                        <div class="text-gray-600 text-xs">{{ $order->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="border-b">
                        @foreach ($order->items as $item)
                        <div class="font-medium whitespace-no-wrap">{{ $item->service->name_service }}</div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $item->quantity }} kg x {{ formatRupiah($item->price) }} = <strong>{{ formatRupiah($order->total_price) }}</strong></div>
                        @endforeach
                    </td>
                    <td class="border-b">
                        <div class="font-medium">{{ $order->tracking_number ?? 'Not available' }}</div>
                    </td>
                    <td class="text-center border-b">
                        @if($order->status == 'paid')
                        <div class="py-2 px-2 rounded-full text-xs bg-green-600 text-white cursor-pointer font-medium">{{ ucfirst($order->status) }}</div>
                        @elseif($order->status == 'pending')
                        <div class="py-2 px-2 rounded-full text-xs bg-theme-11 text-white cursor-pointer font-medium">{{ ucfirst($order->status) }}</div>
                        @else
                        <div class="py-2 px-2 rounded-full text-xs bg-theme-6 text-white cursor-pointer font-medium">{{ ucfirst($order->status) }}</div>
                        @endif
                    </td>
                    <td class="border-b w-5">
                        <div class="flex sm:justify-center items-center">
                            <a href="{{route('customer.orders.invoice', $order->id)}}"> <button class="button w-20 mr-1 mx-2 bg-theme-1 text-white">Invoice</button></a>
                            @if($order->status != 'paid')
                            <a href="{{route('customer.payment', $order->id)}}"> <button class="button w-20 mr-1 mx-2 bg-theme-6 text-white">Pay</button></a>
                            @elseif($order->status == 'paid')
                            <a href="javascript:;" data-id="{{ $order->id }}" class="rate-button"> <button class="button w-20 mr-1 mx-2 bg-theme-12 text-grey-600">Rate</button></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($orders as $order)
    @if($order->status == 'paid' && $order->status_order == 'completed' && is_null($order->rating))
    <!-- Rating Modal -->
    <div class="modal" id="rating-modal-{{ $order->id }}">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Rate Order #{{ $order->id }}</h2>
            </div>
            <form action="{{ route('customer.orders.updateRating', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="input w-full border mt-2 flex-1" required>
                            <option value="" disabled selected>Select your rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" class="input w-full border mt-2 flex-1" rows="3" placeholder="Write your review (optional)"></textarea>
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal" class="button w-32 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" class="button w-32 bg-theme-1 text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endforeach
@endsection

@push('script')
    <script>
       $(document).ready(function(){
    $('.rate-button').on('click', function() {
        let orderId = $(this).data('id');
        let order = @json($orders);

        let selectedOrder = order.find(o => o.id == orderId);

        // Check if the order is completed and has a rating
        if(selectedOrder.status_order != 'completed') {
            Swal.fire({
                icon: 'warning',
                title: 'Not Completed',
                text: 'You can only rate orders that are completed.',
                confirmButtonText: 'Close'
            });
        } else if(selectedOrder.rating !== null) { // Check if the order already has a rating
            Swal.fire({
                icon: 'info',
                title: 'Already Rated',
                text: 'You have already submitted a rating for this order.',
                confirmButtonText: 'Close'
            });
        } else {
            $('#rating-modal-' + orderId).modal('show');
        }
    });
});

        @if($orders->where('status_order', 'completed')->whereNull('rating')->count() > 0)
            @foreach ($orders as $order)
                @if($order->status_order == 'completed' && is_null($order->rating))
                    $(document).ready(function(){
                        $('#rating-modal-{{ $order->id }}').modal('show');
                    });
                @endif
            @endforeach
        @endif

        //alert ketika rating sudah diisi sebelumnya


        function formatRupiah(angka, prefix = 'Rp') {
            var numberString = angka.toString().replace(/[^,\d]/g, ''),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    </script>
@endpush
