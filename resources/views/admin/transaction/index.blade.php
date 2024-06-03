@extends('admin.components.app')
@section('title', 'Transaction | Laundry App')

@section('content')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            List of Transaction
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="text-center">
                <a href="javascript:;" data-toggle="modal" data-target="#addCategoryModal"
                    class="button inline-block bg-theme-1 text-white">Add New Category</a>
            </div>
        </div>

        <!-- modal add category -->
        <div class="modal" id="addCategoryModal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">New Category</h2>
                </div>
                <form id="add-category-form">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12">
                            <label>Category Name</label>
                            <input type="text" id="name_category" name="name_category" class="input w-full border mt-2 flex-1"
                                placeholder="Category Name">
                        </div>
                        <div class="col-span-12">
                            <label>Description</label>
                            <input type="text" id="description" name="description" class="input w-full border mt-2 flex-1"
                                placeholder="Description">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" data-dismiss="modal"
                            class="button w-32 border text-gray-700 mr-1">Cancel</button>
                        <button type="submit" id="create-category" class="button w-32 bg-theme-1 text-white">Create
                            Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal edit category -->
    <div class="modal" id="editCategoryModal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Edit Category</h2>
            </div>
            <form id="edit-category-form">
                @csrf
                {{-- @method('PUT') --}}
                <input type="hidden" id="edit-id" name="id">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Category Name</label>
                        <input type="text" id="edit-name" name="edit-name" class="input w-full border mt-2 flex-1"
                            placeholder="Category Name">
                    </div>
                    <div class="col-span-12">
                        <label>Description</label>
                        <input type="text" id="edit-description" name="edit-description" class="input w-full border mt-2 flex-1"
                            placeholder="Description">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal"
                        class="button w-32 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" id="update-category-button" class="button w-32 bg-theme-1 text-white">Update
                        Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">NO</th>
                    <th class="border-b-2 whitespace-no-wrap">CATEGORY NAME</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">DESCRIPTION</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>

                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap"></div>
                        </td>

                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap"></div>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap text-center"></div>
                        </td>
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
            </tbody>
        </table>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('#create-category').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('categories.store') }}',
                        data: $('#add-category-form').serialize(),
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
                    var categoryId = $(this).data('id');
                    console.log(categoryId);
                    $.ajax({
                        type: 'GET',
                        url: '/categories/edit/' + categoryId,
                        success: function(response) {
                            $('#edit-name').val(response.category.name);
                            $('#edit-description').val(response.category.description);
                            $('#edit-id').val(response.category.id);
                            $('#editCategoryModal').modal('show');
                        },

                        error: function(xhr, status, error) {
                            console.error('Error fetching category data: ' + error);
                        }
                    });
                });

                $('#update-category-button').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'PUT',
                        url: '/categories/update/' + $('#edit-id').val(),
                        data: $('#edit-category-form').serialize(),
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
                        if (response.responseJSON.errors && response.responseJSON.errors
                            .name) {
                            swal.fire({
                                title: "Error!",
                                text: response.responseJSON.errors.name[0],
                                icon: "error",
                                button: "OK",
                            });
                        } else if (response.responseJSON.errors) {
                            const firstErrorKey = Object.keys(response.responseJSON.errors)[0];
                            swal.fire({
                                title: "Error!",
                                text: response.responseJSON.errors[firstErrorKey][0],
                                icon: "error",
                                button: "OK",
                            });
                            }
                        }
                    });
                });

                $('.delete-btn').click(function(e) {
                    e.preventDefault();
                    var categoryId = $(this).data('id');
                    console.log(categoryId);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once deleted, you will not be able to recover this category!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/categories/' + categoryId,
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
