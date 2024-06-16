@extends('components.app')
@section('title', 'Orders')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Orders
        </h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- <div class="intro-y box mt-5">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 whitespace-nowrap">#</th>
                        <th class="border-b-2 whitespace-nowrap">Customer</th>
                        <th class="border-b-2 whitespace-nowrap">Total Price</th>
                        <th class="border-b-2 whitespace-nowrap">Status</th>
                        <th class="border-b-2 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="border-b">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border-b">
                                {{ $order->user->name }}
                            </td>
                            <td class="border-b">
                                {{ formatRupiah($order->total_price) }}
                            </td>
                            <td class="border-b">
                                {{ ucfirst($order->status) }}
                            </td>
                            <td class="border-b">
                                <div class="flex justify-center items-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" id="status" class="input box mt-1">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <button type="submit" class="button bg-theme-1 text-white mt-3">Update Status</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">ORDER ID</th>
                    <th class="border-b-2 whitespace-no-wrap">CUSTOMER NAME</th>
                    <th class="border-b-2 whitespace-no-wrap">SERVICE NAME</th>
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
                            <div class="font-medium whitespace-no-wrap"> {{ $order->user->name }}</div>
                        </td>
                        <td class="border-b">
                            @foreach ($order->items as $item)
                                <div class="font-medium whitespace-no-wrap">{{ $item->service->name_service }}</div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $item->quantity }} kg x
                                    {{ formatRupiah($item->price) }}</div>
                            @endforeach
                        </td>
                        <td class="text-center border-b">
                            @if ($order->status == 'paid')
                                <div
                                    class="py-2 px-2 rounded-full text-xs bg-green-600 text-white cursor-pointer font-medium">
                                    {{ ucfirst($order->status) }}</div>
                            @elseif ($order->status == 'pending')
                                <div
                                    class="py-2 px-2 rounded-full text-xs bg-theme-11 text-white cursor-pointer font-medium">
                                    {{ ucfirst($order->status) }}</div>
                            @else
                                <div
                                    class="py-2 px-2 rounded-full text-xs bg-theme-6 text-white cursor-pointer font-medium">
                                    {{ ucfirst($order->status) }}</div>
                            @endif
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a class="flex items-center mr-3 edit-btn" data-id=""
                                    href="javascript:;">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-theme-6 delete-btn" data-id=""
                                    href="javascript:;">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
