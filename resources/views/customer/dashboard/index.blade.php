@extends('components.app')
@section('title', 'Dashboard | Laundry App')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Welcome <span class="text-xl font-bold text-theme-1">{{ auth()->user()->name }}</span>
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y mb-3">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                                            title="33% Higher than last month"> 33%
                                            <i data-feather="chevron-up" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalServices }}</div>
                                <div class="text-base text-gray-600 mt-1">Service Items</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer"
                                            title="2% Lower than last month"> 2%
                                            <i data-feather="chevron-down" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalOrders }}</div>
                                <div class="text-base text-gray-600 mt-1">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tracking Order --}}
                <div class="intro-y box p-5 mt-5">
                    <div class="flex items-center mb-4">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Tracking Order
                        </h2>
                    </div>
                    <form id="tracking-form" class="grid grid-cols-12 gap-6 mt-5">
                        @csrf
                        <div class="col-span-12 sm:col-span-8 xl:col-span-10">
                            <input type="text" name="tracking_number" class="input w-full border"
                                placeholder="Enter Tracking Number" required>
                        </div>
                        <div class="col-span-12 sm:col-span-4 xl:col-span-2">
                            <button type="submit" class="button w-full bg-theme-1 text-white">
                                Track
                            </button>
                        </div>
                    </form>
                </div>
                <div id="order-details" class="intro-y box p-5 mt-4" style="display:none;">
                    <h2 class="text-lg font-medium truncate mr-5 mb-4">
                        Order Tracking Details
                    </h2>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Order ID:</div>
                                <div id="order-id"></div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Tracking Number:</div>
                                <div id="tracking-number"></div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Customer Detail:</div>
                                <div id="customer-name"></div>
                                <div id="customer-email"></div>
                                <div id="customer-phone"></div>
                                <div id="customer-address"></div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Service Detail:</div>
                                <div id="service-name"></div>
                                <div id="service-quantity-price"></div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Status Order:</div>
                                <div class="flex">
                                    <div id="order-status"></div> &nbsp; --- &nbsp;
                                    <div id="order-updated-at" class="text-gray-600 text-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <div class="box mt-2">
                                <div class="font-medium">Total Price:</div>
                                <div id="total-price"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
     @if (session('success'))
                   $.toast({
                    text: "{{ session('success') }}" ,
                    bgColor: '#41B06E',
                    textColor: 'white',
                    allowToastClose: true,
                    hideAfter: 5000,
                    stack: 5,
                    textAlign: 'left',
                    position: 'top-right',
                });
                @endif

        $(document).ready(function() {
            $('#tracking-form').on('submit', function(e) {
                e.preventDefault();

                let trackingNumber = $('input[name="tracking_number"]').val();

                $.ajax({
                    url: '{{ route('customer.trackOrder') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        tracking_number: trackingNumber
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#order-details').show();
                            $('#order-id').text('ORD - ' + response.order.id);
                            $('#tracking-number').text(response.order.tracking_number);
                            $('#customer-name').text('Name : ' + response.order.user.name);
                            $('#customer-email').text('Email : ' + response.order.user.email);
                            $('#customer-phone').text(response.order.user.phone);
                            $('#customer-address').text(response.order.user.address);
                            $('#order-status').text(response.order.status_order);
                            $('#order-updated-at').text(formatTime(response.order.updated_at));
                            $('#total-price').text(formatRupiah(response.order.total_price));

                            // Detail layanan
                            if (response.order.items.length > 0) {
                                let item = response.order.items[0];
                                $('#service-name').text(item.service.name_service);
                                $('#service-quantity-price').text(item.quantity + ' Kg x ' +
                                    formatRupiah(item.price));
                            }

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                                confirmButtonText: 'Close',
                            });
                            $('#order-details').hide();
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while tracking the order.',
                            confirmButtonText: 'Close',
                        });
                        $('#order-details').hide();
                    }
                });
            });
        });

        function formatRupiah(amount, prefix = 'Rp') {
            // Handle negative numbers
            const isNegative = amount < 0;
            const absoluteAmount = Math.abs(amount).toString();

            let [integerPart, decimalPart] = absoluteAmount.split('.');
            let formattedInteger = integerPart.length < 4 ? integerPart : integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Re-add the decimal part if it exists
            if (decimalPart !== undefined) {
                formattedInteger += ',' + decimalPart;
            }

            // Add the prefix and handle negative numbers
            return `${isNegative ? '-' : ''}${prefix} ${formattedInteger}`;
        }

        function formatTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');
            return `${hours}:${minutes}:${seconds}`;
        }
    </script>
@endpush
