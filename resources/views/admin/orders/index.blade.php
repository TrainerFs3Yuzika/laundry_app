@extends('components.app')
@section('title', 'Orders')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Orders
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="intro-y box mt-5">
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
    </div>
@endsection
