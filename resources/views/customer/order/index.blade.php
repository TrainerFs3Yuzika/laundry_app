@extends('components.app')
@section('title', 'Pesan | Laundry App')

@section('content')
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showCancelButton: true,
            cancelButtonText: 'Close',
            confirmButtonText: 'Proceed to Payment',
            buttonsStyling: true,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('customer.orders.history')}}';
            }
        });
    });
    </script>

@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    });
</script>
@endif
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Point of Sale
        </h2>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->
        <div class="intro-y col-span-12 lg:col-span-7">
            <div class="lg:flex intro-y">
                <div class="relative text-gray-700">
                    <input type="text" class="input input--lg w-full lg:w-64 box pr-10 placeholder-theme-13"
                        placeholder="Search item...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
                <select class="input input--lg box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
                    <option>Sort By</option>
                    <option>A to Z</option>
                    <option>Z to A</option>
                    <option>Lowest Price</option>
                    <option>Highest Price</option>
                </select>
            </div>
            <div class="grid grid-cols-12 gap-5 mt-5">
                @foreach ($services as $service)
                    <div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
                        <div class="font-medium text-base">{{ $service->name_service }}</div>
                        <div class="text-theme-3"> <strong>{{ formatRupiah($service->price) }}</strong></div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->
        <div class="col-span-12 lg:col-span-5">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <div class="pos__tabs nav-tabs justify-center flex">
                        <a data-toggle="tab" data-target="#ticket" href="javascript:;"
                            class="flex-1 py-2 rounded-md text-center active">Ticket</a>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-content__pane active" id="ticket">
                    <div id="ticket-items" class="pos__ticket box p-2 mt-5">
                        <!-- Items will be dynamically added here -->
                    </div>
                    <div class="box flex p-5 mt-5">
                        <div class="w-full relative text-gray-700">
                            <input type="text" class="input input--lg w-full bg-gray-200 pr-10 placeholder-theme-13"
                                placeholder="Use coupon code...">
                            <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                        </div>
                        <button class="button text-white bg-theme-1 ml-2">Apply</button>
                    </div>
                    <div class="box p-5 mt-5">
                        <div class="flex">
                            <div class="mr-auto">Subtotal</div>
                            <div id="subtotal">Rp -</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Discount</div>
                            <div class="text-theme-6">-</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Tax</div>
                            <div id="tax-rate" data-tax-rate="0.10">10%</div>
                            <!-- Add a data attribute to store the tax rate -->
                        </div>
                        <div class="flex mt-4 pt-4 border-t border-gray-200">
                            <div class="mr-auto font-medium text-base">Charge</div>
                            <div id="total-charge" class="font-medium text-base">Rp -</div>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <button class="button w-32 border border-gray-400 text-gray-600" id="clear-items">Clear
                            Items</button>
                        <button class="button w-32 text-white bg-theme-1 shadow-md ml-auto"
                            id="charge-items">Charge</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Ticket -->

    </div>
    <!-- BEGIN: Add Item Modal -->
    <div class="modal" id="add-item-modal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto" id="item-name">
                    <!-- Item Name will be set by JavaScript -->
                </h2>
                <div id="item-price" class="text-theme-3">
                    <!-- Item Price will be set by JavaScript -->
                </div>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12">
                    <label>Quantity (kg)</label>
                    <div class="flex mt-2 flex-1">
                        <button type="button" class="button w-12 border bg-gray-200 text-gray-600 mr-1"
                            id="decrease-qty">-</button>
                        <input type="text" class="input w-full border text-center" id="item-qty" value="1">
                        <button type="button" class="button w-12 border bg-gray-200 text-gray-600 ml-1"
                            id="increase-qty">+</button>
                    </div>
                </div>
                {{-- <div class="col-span-12">
                    <label>Notes</label>
                    <textarea class="input w-full border mt-2 flex-1" id="item-notes" placeholder="Item notes"></textarea>
                </div> --}}
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-1 text-white" id="add-item-button">Add Item</button>
            </div>
        </div>
    </div>
    <!-- END: Add Item Modal -->
    <!-- BEGIN: Checkout Modal -->
    <div class="modal" id="checkout-modal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Checkout</h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12" id="checkout-items">
                        <!-- Items will be dynamically added here -->
                    </div>
                    <div class="col-span-12">
                        <h3 class="font-medium text-base">Customer Details</h3>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>   
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                    </div>
                    <div class="col-span-12 flex">
                        <div class="mr-auto">Total</div>
                        <div id="checkout-total">Rp 0</div>
                    </div>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" data-dismiss="modal" class="button w-32 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-32 bg-theme-1 text-white" id="confirm-checkout">Confirm</button>
            </div>
        </div>
    </div>

    <div class="modal" id="payment-alert-modal">
        <div class="modal__content">
            <div class="px-5 py-5 sm:py-3">
                <h2 class="font-medium text-base mr-auto">Pesanan Berhasil</h2>
                <p>Terima kasih telah memesan. Silakan bayar menggunakan tombol di bawah ini.</p>
                <button type="button" id="pay-button" class="button w-32 bg-theme-1 text-white">Bayar</button>
            </div>
        </div>
    </div>
    <!-- END: Checkout Modal -->
    <!-- Hidden Form for Submitting Order -->
    <form id="order-form" action="{{ route('customer.orders.store') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="cart" id="order-cart">
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection

@push('script')
    <script>
        let cart = [];

        document.querySelectorAll('.box.cursor-pointer').forEach(item => {
            item.addEventListener('click', () => {
                const itemName = item.querySelector('.font-medium').innerText;
                const itemPrice = item.querySelector('.text-theme-3 strong').innerText.replace('Rp ', '')
                    .replace('.', '');

                document.getElementById('item-name').innerText = itemName;
                document.getElementById('item-price').innerText = itemPrice;
                document.getElementById('item-qty').value = 1;
                // document.getElementById('item-notes').value = '';

                $('#add-item-modal').modal('show');
            });
        });

        document.getElementById('decrease-qty').addEventListener('click', () => {
            const qtyInput = document.getElementById('item-qty');
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
            }
        });

        document.getElementById('increase-qty').addEventListener('click', () => {
            const qtyInput = document.getElementById('item-qty');
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        document.getElementById('add-item-button').addEventListener('click', () => {
            const itemName = document.getElementById('item-name').innerText;
            const itemPrice = parseInt(document.getElementById('item-price').innerText.replace('Rp', '').replace(
                '.', ''));
            const itemQty = parseInt(document.getElementById('item-qty').value);
            // const itemNotes = document.getElementById('item-notes').value;

            const item = {
                id: cart.length + 1,
                name: itemName,
                price: itemPrice,
                qty: itemQty,
                // notes: itemNotes
            };

            cart.push(item);

            $('#add-item-modal').modal('hide');
            updateCart();
        });

        function updateCart() {
            const ticketItems = document.getElementById('ticket-items');
            ticketItems.innerHTML = '';

            let subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.qty;
                subtotal += itemTotal;
                ticketItems.innerHTML += `
                    <div class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md" data-id="${item.id}">
                        <div class="pos__ticket__item-name truncate mr-1">${item.name}</div>
                        <div class="text-gray-600">x ${item.qty}kg</div>
                        <i data-feather="edit" class="w-4 h-4 text-gray-600 ml-2 edit-item" data-id="${item.id}"></i>
                        <div class="ml-auto">${formatRupiah(itemTotal)}</div>
                        <i data-feather="trash" class="w-4 h-4 text-gray-600 ml-2 delete-item" data-id="${item.id}"></i>
                    </div>
                `;
                feather.replace();
            });


            const taxRateElement = document.getElementById('tax-rate');
            const taxRate = parseFloat(taxRateElement.getAttribute('data-tax-rate')); // Convert to float

            const tax = subtotal * taxRate;
            const totalCharge = Math.round(subtotal + tax);

            document.getElementById('subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('total-charge').innerText = formatRupiah(totalCharge);

            document.querySelectorAll('.edit-item').forEach(editButton => {
                editButton.addEventListener('click', event => {
                    const itemId = event.target.getAttribute('data-id');
                    const item = cart.find(i => i.id == itemId);

                    document.getElementById('item-name').innerText = item.name;
                    document.getElementById('item-price').innerText = `Rp ${item.price}`;
                    document.getElementById('item-qty').value = item.qty;
                    // document.getElementById('item-notes').value = item.notes;

                    $('#add-item-modal').modal('show');
                    cart = cart.filter(i => i.id != itemId);
                });
            });

            document.querySelectorAll('.delete-item').forEach(deleteButton => {
                deleteButton.addEventListener('click', event => {
                    const itemId = event.target.getAttribute('data-id');
                    cart = cart.filter(i => i.id != itemId);
                    updateCart();
                });
            });
        }

        document.getElementById('clear-items').addEventListener('click', () => {
            cart = [];
            updateCart();
        });

        document.getElementById('charge-items').addEventListener('click', () => {
            if (cart.length === 0) {
              // Show alert using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please add items to the cart first!',
                });

                return;
            }

            // Show checkout modal
            $('#checkout-modal').modal('show');

            const checkoutItems = document.getElementById('checkout-items');
            checkoutItems.innerHTML = '';

            cart.forEach(item => {
                checkoutItems.innerHTML += `
                    <div class="flex items-center p-3 bg-gray-200 rounded-md mb-2">
                        <div class="mr-auto">${item.name} x ${item.qty}kg</div>
                        <div class="font-medium">${formatRupiah(item.price * item.qty)}</div>
                    </div>
                `;
            });

            // Get the tax rate from the view
            const taxRateElement = document.getElementById('tax-rate');
            const taxRate = parseFloat(taxRateElement.getAttribute('data-tax-rate')); // Convert to float

            const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
            const tax = subtotal * taxRate;
            const total = Math.round(subtotal + tax);
            document.getElementById('checkout-total').innerText = formatRupiah(total);
        });

        document.getElementById('confirm-checkout').addEventListener('click', () => {
            const orderData = JSON.stringify(cart);
            document.getElementById('order-cart').value = orderData;
            document.getElementById('order-form').submit();
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
