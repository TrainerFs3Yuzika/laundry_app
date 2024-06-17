@extends('components.app')
@section('title', 'Services | Laundry App')

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            List of services
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="text-center">
                <a href="javascript:;" data-toggle="modal" data-target="#addservicesModal"
                    class="button inline-block bg-theme-1 text-white">Add New Service</a>
            </div>
        </div>

        <!-- modal add services -->
        <div class="modal" id="addservicesModal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">New Service</h2>
                </div>
                <form id="add-services-form">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12">
                            <label>Name service</label>
                            <input type="text" id="name_service" name="name_service"
                                class="input w-full border mt-2 flex-1" placeholder="Service Name">
                        </div>
                        <div class="col-span-12">
                            <label>Price</label>
                            <div class="relative mt-2">
                                <input type="text" id="price" name="price"
                                    class="input pr-12 w-full border col-span-4" placeholder="Price">
                                <div
                                    class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                    /Kg</div>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label>Description</label>
                            <div id="description-wrapper">
                                <div class="flex items-center">
                                    <input type="text" id="description" name="description[]"
                                        class="input w-full border mt-2 flex-1" placeholder="Description">

                                </div>
                            </div>
                            <button type="button" id="add-description" class="button bg-theme-1 text-white mt-2">Add
                                More</button>
                        </div>
                        <div class="col-span-12">
                            <div class="mt-3">
                                <label>Active Status</label>
                                <div class="mt-2">
                                    <input type="hidden" name="status" value="inactive">
                                    <input type="checkbox" name="status" value="active" class="input input--switch border">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" data-dismiss="modal"
                            class="button w-32 border text-gray-700 mr-1">Cancel</button>
                        <button type="submit" id="create-services" class="button w-32 bg-theme-1 text-white">Create
                            Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal edit services -->
    <div class="modal" id="editservicesModal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Edit service</h2>
            </div>
            <form id="edit-services-form">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-id" name="id">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Service Name</label>
                        <input type="text" id="edit-name" name="name_service" class="input w-full border mt-2 flex-1"
                            placeholder="service Name">
                    </div>
                    <div class="col-span-12">
                        <label>Price</label>
                        {{-- <input type="text" id="edit-price" name="price" class="input pr-12 w-full border col-span-4"
                            placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                            /Kg</div> --}}
                            <div class="relative mt-2">
                                <input type="text" id="edit-price" name="price"
                                    class="input pr-12 w-full border col-span-4" placeholder="Price">
                                <div
                                    class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
                                    /Kg</div>
                            </div>
                    </div>
                    <div class="col-span-12">
                        <label>Description</label>
                        <div id="edit-description-wrapper">
                            <div class="flex items-center">
                                <input type="text" id="edit-description" name="description[]"
                                    class="input w-full border mt-2 flex-1" placeholder="Description">
                            </div>
                        </div>
                        <button type="button" id="add-edit-description" class="button bg-theme-1 text-white mt-2">Add
                            More</button>
                    </div>
                    <div class="col-span-12">
                        <div class="mt-3">
                            <label>Active Status</label>
                            <div class="mt-2">
                                <input type="hidden" name="status" value="inactive">
                                <input type="checkbox" name="status" value="active" class="input input--switch border"
                                    checked>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal"
                        class="button w-32 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" id="update-services-button" class="button w-32 bg-theme-1 text-white">Update
                        Service</button>
                </div>
            </form>
        </div>
    </div>

    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 text-center whitespace-no-wrap">NAME</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">DESCRIPTION</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">PRICE</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td class="border-b">
                            <a href=""
                                class="font-medium whitespace-no-wrap text-center">{{ $service->name_service }}</a>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap ">
                                @foreach ($service->description as $desc)
                                    <div class="flex font-medium whitespace-no-wrap">
                                        <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $desc }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap text-center text-theme-1">
                                <strong>{{ formatRupiah($service->price)}}/Kg</strong></div>
                        </td>
                        <td class="w-40 border-b">

                            @if ($service->status == 'active')
                                <div class="flex sm:justify-center items-center text-theme-9">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active
                                </div>
                            @else
                                <div class="flex sm:justify-center items-center text-theme-6">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i>Inactive
                                </div>
                            @endif
                        </td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a class="flex items-center mr-3 edit-btn" data-id="{{ $service->id }}"
                                    href="javascript:;">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-theme-6 delete-btn" data-id="{{ $service->id }}"
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
                function toggleRemoveButton() {
                    // Handle add service form
                    const addDescriptionInputs = $('#description-wrapper .flex');
                    if (addDescriptionInputs.length > 1) {
                        $('#description-wrapper .remove-description').show();
                    } else {
                        $('#description-wrapper .remove-description').hide();
                    }

                    // Handle edit service form
                    const editDescriptionInputs = $('#edit-description-wrapper .flex');
                    if (editDescriptionInputs.length > 1) {
                        $('#edit-description-wrapper .remove-description').show();
                    } else {
                        $('#edit-description-wrapper .remove-description').hide();
                    }
                }

                $('#create-services').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#add-services-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('services.store') }}',
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
                    var serviceId = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '/services/' + serviceId + '/edit',
                        success: function(response) {
                            $('#edit-name').val(response.service.name_service);
                            $('#edit-price').val(response.service.price);
                            let descriptionHTML = '';
                            response.service.description.forEach((desc) => {
                                descriptionHTML += `
                                    <div class="flex items-center">
                                        <input type="text" name="description[]" class="input w-full border mt-2 flex-1" value="${desc}">
                                        <button type="button" class="button bg-theme-6 text-white ml-2 mt-2 remove-description">X</button>
                                    </div>`;
                            });
                            $('#edit-description-wrapper').html(descriptionHTML);
                            if (response.service.status == 'active') {
                                $('input[name="status"]').prop('checked', true);
                            } else {
                                $('input[name="status"]').prop('checked', false);
                            }
                            $('#edit-id').val(response.service.id);
                            $('#editservicesModal').modal('show');
                            toggleRemoveButton();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching service data: ' + error);
                        }
                    });
                });

                $('#update-services-button').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#edit-services-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/services/' + $('#edit-id').val(),
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
                    var serviceId = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once deleted, you will not be able to recover this service!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/services/' + serviceId,
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

                // Add more description inputs
                $('#add-description').click(function() {
                    $('#description-wrapper').append(
                        `<div class="flex items-center">
                            <input type="text" name="description[]" class="input w-full border mt-2 flex-1" placeholder="Description">
                            <button type="button" class="button bg-theme-6 text-white ml-2 mt-2 remove-description">X</button>
                        </div>`
                    );
                    toggleRemoveButton();
                });

                $('#add-edit-description').click(function() {
                    $('#edit-description-wrapper').append(
                        `<div class="flex items-center">
                            <input type="text" name="description[]" class="input w-full border mt-2 flex-1" placeholder="Description">
                            <button type="button" class="button bg-theme-6 text-white ml-2 mt-2 remove-description">X</button>
                        </div>`
                    );
                    toggleRemoveButton();
                });

                $(document).on('click', '.remove-description', function() {
                    $(this).closest('.flex').remove();
                    toggleRemoveButton();
                });

                toggleRemoveButton(); // Initial call to set the correct state
            });
        </script>
    @endpush
@endsection
