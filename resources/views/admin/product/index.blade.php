@extends('admin.components.app')
@section('title', 'Products | Laundry App')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            List of Products
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="text-center">
                <a href="javascript:;" data-toggle="modal" data-target="#addproductsModal"
                    class="button inline-block bg-theme-1 text-white">Add New Product</a>
            </div>
        </div>

        <!-- modal add products -->
        <div class="modal" id="addproductsModal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">New Product</h2>
                </div>
                <form id="add-products-form">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12">
                            <label>Name Product</label>
                            <input type="text" id="name_product" name="name_product" class="input w-full border mt-2 flex-1"
                                placeholder="Products Name">
                        </div>
                        <div class="col-span-12">
                            <label>Price</label>
                            <div class="relative mt-2">
                                <input type="text" id="price" name="price" class="input pr-12 w-full border col-span-4" placeholder="Price">
                                <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">/Kg</div>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label>Description</label>
                            <input type="text" id="description" name="description" class="input w-full border mt-2 flex-1"
                                placeholder="Description">

                        </div>

                        <div class="col-span-12">
                            <label>Category</label>
                            <select name="category_id" id="category_id" class="input w-full border mt-2 flex-1">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-span-12">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="input w-full border mt-2 flex-1"
                                placeholder="Image">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" data-dismiss="modal"
                            class="button w-32 border text-gray-700 mr-1">Cancel</button>
                        <button type="submit" id="create-products" class="button w-32 bg-theme-1 text-white">Create
                            Products</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal edit products -->
    <div class="modal" id="editproductsModal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Edit Product</h2>
            </div>
            <form id="edit-products-form">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id" name="id">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Product Name</label>
                        <input type="text" id="edit-name" name="name_product" class="input w-full border mt-2 flex-1"
                            placeholder="Product Name">
                    </div>
                    <div class="col-span-12">
                        <label>Price</label>
                        <input type="text" id="edit-price" name="price" class="input w-full border mt-2 flex-1"
                            placeholder="Price">
                    </div>
                    <div class="col-span-12">
                        <label>Description</label>
                        <input type="text" id="edit-description" name="description" class="input w-full border mt-2 flex-1"
                            placeholder="Description">
                    </div>
                    <div class="col-span-12">
                        <label>Category</label>
                        <select name="category" id="edit-category" class="input w-full border mt-2 flex-1">
                            <option value="kilat">Kilat</option>
                            <option value="reguler">Reguler</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label>Image</label>
                        <input type="file" id="edit-image" name="image" class="input w-full border mt-2 flex-1"
                            placeholder="Image">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal"
                        class="button w-32 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" id="update-products-button" class="button w-32 bg-theme-1 text-white">Update
                        Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2  text-center whitespace-no-wrap">IMAGE</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">NAME</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">DESCRIPTION</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">PRICE</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="border-b">
                        <div class="font-medium whitespace-no-wrap">
                            <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name_product }}" width="100">
                        </div>
                    </td>

                    <td class="border-b">
                        <a href="" class="font-medium whitespace-no-wrap">{{ $product->name_product }}</a>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $product->category->name_category }}</div>
                    </td>
                    <td class="border-b">
                        <div class="font-medium whitespace-no-wrap text-center">{{ $product->description }}</div>
                    </td>
                    <td class="border-b">
                        <div class="font-medium whitespace-no-wrap text-center">Rp{{ $product->price }}</div>
                    </td>
                    <td class="border-b">
                        <div class="flex items center justify-center {{ $product->status == 'active' ? 'text-theme-9' : 'text-theme-6' }}">
                            <i data-feather="{{ $product->status == 'active' ? 'check-square' : 'x-square' }}"
                                class="w-4 h-4 mr-2"></i> {{ $product->status }} </div>
                    </td>
                    <td class="border-b w-5">
                        <div class="flex sm:justify-center items-center">
                            <a class="flex items-center mr-3 edit-btn" data-id="{{ $product->id }}"
                                href="javascript:;">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>
                            <a class="flex items-center text-theme-6 delete-btn" data-id="{{ $product->id }}"
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

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#create-products').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#add-products-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('products.store') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            if (response.responseJSON.errors) {
                                const firstErrorKey = Object.keys(response.responseJSON.errors)[0];
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.responseJSON.errors[firstErrorKey][0],
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

                $('.edit-btn').click(function() {
                    var productId = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/products/' + productId + '/edit',
                        success: function(response) {
                            $('#edit-name').val(response.product.name_product);
                            $('#edit-price').val(response.product.price);
                            $('#edit-description').val(response.product.description);
                            $('#edit-category').val(response.product.category_id); // Ensure category_id is used
                            $('#edit-id').val(response.product.id);
                            $('#editproductsModal').modal('show');
                        },

                        error: function(xhr, status, error) {
                            console.error('Error fetching product data: ' + error);
                        }
                    });
                });

                $('#update-products-button').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#edit-products-form')[0]);

                    $.ajax({
                        type: 'POST',
                        url: '/products/' + $('#edit-id').val(),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            if (response.responseJSON.errors) {
                                const firstErrorKey = Object.keys(response.responseJSON.errors)[0];
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.responseJSON.errors[firstErrorKey][0],
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });

                $('.delete-btn').click(function(e) {
                    e.preventDefault();
                    var productId = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once deleted, you will not be able to recover this product!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/products/' + productId,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.success,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                },
                                error: function(response) {
                                    if (response.responseJSON.error) {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: response.responseJSON.error,
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
