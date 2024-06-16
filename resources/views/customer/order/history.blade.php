@extends('components.app')
@section('title', 'Order History | Laundry App')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Order History
        </h2>
    </div>
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full" id="dataTable">
            <thead>
                <tr>
                    <th class="border-b-2 text-center whitespace-no-wrap">ORDER ID</th>
                    <th class="border-b-2 whitespace-no-wrap">SERVICE NAME</th>
                    <th class="border-b-2 whitespace-no-wrap">TOTAL PAYMENT</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                    
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
                        <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $item->quantity }} kg x {{ formatRupiah($item->price) }}</div>
                        @endforeach
                    </td>
                    <td class="font-medium text-sm "><strong>{{ formatRupiah($order->total_price) }}</strong></td>
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
                            <a href="{{route('customer.orders.invoice', $order->id)}}"> <button class="button w-20 mr-1 mx-2  bg-theme-1 text-white">Invoice</button></a>
                            @if($order->status != 'paid')
                            <a href="{{route('customer.payment', $order->id)}}"> <button class="button w-20 mr-1 mx-2  bg-theme-6 text-white">Pay</button></a>
                            @else
                            <button class="button w-20 mr-1 mx-2 bg-green-600 text-white">Paid</button>
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('script')
    <script>
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
