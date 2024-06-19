@extends('components.app')
@section('title', 'Order History | Laundry App')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Invoice Layout
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        @php
        $user = auth()->user();
        @endphp

        @if($user->role == 'admin')
            <a href="{{ route('admin.orders.invoice-download', $order->id) }}" class="button text-white bg-theme-1 shadow-md mr-2">Print PDF</a>
        @elseif($user->role == 'customer')
            <a href="{{ route('customer.orders.invoice-download', $order->id) }}" class="button text-white bg-theme-1 shadow-md mr-2">Print PDF</a>
        @endif
    </div>
</div>
<!-- BEGIN: Invoice -->
<div class="intro-y box overflow-hidden mt-5">
    <div class="border-b border-gray-200 text-center sm:text-left">
        <div class="px-5 py-10 sm:px-20 sm:py-20">
            <div class="text-theme-1 font-semibold text-3xl">INVOICE</div>
            <div class="mt-2"> Order # <span class="font-medium">{{ $order->id }}</span> </div>
            <div class="mt-1">{{ $order->created_at->format('d M Y') }}</div>
        </div>
        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
            <div class="">
                <div class="text-base text-gray-600">Client Details</div>
                <div class="text-lg font-medium text-theme-1 mt-2">
                    {{ $order->user->name }}
                </div>
                <div class="mt-1">{{ $order->user->email }}</div>
                <div class="mt-1">{{ $order->user->phone }}</div>
                <div class="mt-1">{{ $order->user->address }}</div>
            </div>
        </div>
    </div>
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap">DESCRIPTION</th>
                        <th class="border-b-2 text-right whitespace-no-wrap">QTY</th>
                        <th class="border-b-2 text-right whitespace-no-wrap">PRICE</th>
                        <th class="border-b-2 text-right whitespace-no-wrap">TAX</th>
                        <th class="border-b-2 text-right whitespace-no-wrap">STATUS</th>
                        <th class="border-b-2 text-right whitespace-no-wrap">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $item->service->name_service }}</div>
                        </td>
                        <td class="text-right border-b w-32">{{ $item->quantity }} Kg</td>
                        <td class="text-right border-b w-32"> {{ formatRupiah($item->price) }}</td>
                        <td class="text-right border-b w-32">{{ $order->tax_rate }}%</td>
                        <td class="text-right border-b w-32">{{ $order->status }}</td>
                        <td class="text-right border-b w-32 font-medium"> {{ formatRupiah($item->price * $item->quantity) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right border-b w-32">Discount</td>
                        <td colspan="2" class="text-right border-b w-32 font-medium">{{ formatRupiah($order->discount_amount) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right border-b w-32">Tax Amount</td>
                        <td colspan="2" class="text-right border-b w-32 font-medium">{{ formatRupiah($order->tax_amount) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right border-b w-32">Total</td>
                        <td colspan="2" class="text-right border-b w-32 font-medium">{{ formatRupiah($order->total_price) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
        <div class="text-center sm:text-left mt-10 sm:mt-0">
            <div class="text-lg text-theme-1 font-medium mt-2">{{ $setting->website_title }}</div>
        </div>
        <div class="text-center sm:text-right sm:ml-auto">
            <div class="text-base text-gray-600">Total Amount</div>
            <div class="text-xl text-theme-1 font-medium mt-2">{{ formatRupiah($order->total_price) }}</div>
            <div class="mt-1 tetx-xs">Taxes included</div>
        </div>
    </div>
</div>
<!-- END: Invoice -->
@endsection
