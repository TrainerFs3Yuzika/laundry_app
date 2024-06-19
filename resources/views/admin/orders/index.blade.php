@extends('components.app')
@section('title', 'Orders')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Orders
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <form id="filter-form" method="GET" action="{{ route('admin.orders') }}">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-4">
                    <label for="user_id" class="form-label">User</label>
                    <select id="user_id" name="user_id" class="input w-full border mt-2">
                        <option value="">All Customer</option>
                        @foreach($users as $user)
                        @if($user->role == 'customer')
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="start_date" class="form-label">Date</label>
                    <input type="date" id="start_date" name="start_date" class="input w-full border mt-2" value="{{ request('start_date') }}">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="status_order" class="form-label">Status Order</label>
                    <select id="status_order" name="status_order" class="input w-full border mt-2">
                        <option value="">All Status</option>
                        <option value="process" {{ request('status_order') == 'process' ? 'selected' : '' }}>Process</option>
                        <option value="delivered" {{ request('status_order') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="completed" {{ request('status_order') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="min_price" class="form-label">Min Price</label>
                    <input type="number" id="min_price" name="min_price" class="input w-full border mt-2" value="{{ request('min_price') }}">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="max_price" class="form-label">Max Price</label>
                    <input type="number" id="max_price" name="max_price" class="input w-full border mt-2" value="{{ request('max_price') }}">
                </div>
                <div class="col-span-12 sm:col-span-4 flex items-end">
                    <button type="submit" class="button w-full bg-theme-1 text-white">Filter</button>
                </div>
            </div>
        </form>
    </div>

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
                                    {{ ucfirst($order->status) }}
                                </div>
                            @elseif ($order->status == 'pending')
                                <div
                                    class="py-2 px-2 rounded-full text-xs bg-theme-11 text-white cursor-pointer font-medium">
                                    {{ ucfirst($order->status) }}
                                </div>
                            @else
                                <div
                                    class="py-2 px-2 rounded-full text-xs bg-theme-6 text-white cursor-pointer font-medium">
                                    {{ ucfirst($order->status) }}
                                </div>
                            @endif
                        </td>
                        <td class="border-b">
                            <div class="flex sm:justify-center items-center">
                                @if ($order->status == 'paid')
                                    @if ($order->status_order == 'Process')
                                        <button class="button bg-theme-11 text-white update-status-btn" data-id="{{ $order->id }}" data-status="delivered">Delivered</button>
                                    @elseif ($order->status_order == 'delivered')
                                        <button class="button bg-green-600 text-white update-status-btn" data-id="{{ $order->id }}" data-status="completed">Completed</button>
                                    @elseif ($order->status_order == 'completed')
                                    <button class="button bg-theme-1 text-white" onclick="window.location='{{ route('admin.orders.invoice', $order->id) }}'">Invoice</button>

                                    @endif
                                @else
                                    <span class="text-gray-600">Payment not Completed</span>
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
        $(document).ready(function() {

            $('.update-status-btn').on('click', function() {
                let button = $(this);
                let orderId = button.data('id');
                let status = button.data('status');

                $.ajax({
                    url: '{{ route("admin.orders.updateStatus", "") }}/' + orderId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message || 'Order status updated successfully',
                                confirmButtonText: 'Close',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message || 'Failed to update order status',
                                confirmButtonText: 'Close',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while updating the order status',
                            confirmButtonText: 'Close',
                        });
                    }
                });
            });
        });

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
