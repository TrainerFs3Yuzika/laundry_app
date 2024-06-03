@extends('components.app')
@section('title', 'Users | Laundry App')

@section('content')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            List of Users
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="text-center">
                <a href="javascript:;" data-toggle="modal" data-target="#addUserModal"
                    class="button inline-block bg-theme-1 text-white">Add New User</a>
            </div>
        </div>

        <!-- modal add user -->
        <div class="modal" id="addUserModal">
            <div class="modal__content">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">New User</h2>
                </div>
                <form id="add-user-form">
                    @csrf
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12">
                            <label>Username</label>
                            <input type="text" id="name" name="name" class="input w-full border mt-2 flex-1"
                                placeholder="Username">
                        </div>
                        <div class="col-span-12">
                            <label>Email</label>
                            <input type="email" id="email" name="email" class="input w-full border mt-2 flex-1"
                                placeholder="Email">
                        </div>
                        <div class="col-span-12">
                            <label>Role</label>
                            <select name="role" id="role" class="input w-full border mt-2 flex-1">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="col-span-12">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="input w-full border mt-2 flex-1"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" data-dismiss="modal"
                            class="button w-32 border text-gray-700 mr-1">Cancel</button>
                        <button type="submit" id="create-user" class="button w-32 bg-theme-1 text-white">Create
                            User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal edit user -->
    <div class="modal" id="editUserModal">
        <div class="modal__content">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">Edit User</h2>
            </div>
            <form id="edit-user-form">
                @csrf
                {{-- @method('PUT') --}}
                <input type="hidden" id="edit-id" name="id">
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Username</label>
                        <input type="text" id="edit-name" name="edit-name" class="input w-full border mt-2 flex-1"
                            placeholder="Username">
                    </div>
                    <div class="col-span-12">
                        <label>Email</label>
                        <input type="email" id="edit-email" name="edit-email" class="input w-full border mt-2 flex-1"
                            placeholder="Email">
                    </div>
                    <div class="col-span-12">
                        <label>Role</label>
                        <select name="edit-role" id="edit-role" class="input w-full border mt-2 flex-1">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label>New Password</label>
                        <input type="password" id="edit-password" name="edit-password" class="input w-full border mt-2 flex-1"
                            placeholder="Password">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal"
                        class="button w-32 border text-gray-700 mr-1">Cancel</button>
                    <button type="submit" id="update-user-button" class="button w-32 bg-theme-1 text-white">Update
                        User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- BEGIN: Datatable -->
    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table class="table table-report table-report--bordered display datatable w-full">
            <thead>
                <tr>
                    <th class="border-b-2 whitespace-no-wrap">USERNAME</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">EMAIL</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ROLE</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                    <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap">{{ $user->name }}</div>
                        </td>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap text-center">{{ $user->email }}</div>
                        </td>
                        <td class="border-b">
                            <div class="flex items center justify-center text-theme-1">
                                @if ($user->role == 'admin')
                                    <i data-feather="user" class="w-4 h-5 mr-2"></i> Admin
                                @else
                                    <i data-feather="user" class="w-4 h-5 mr-2"></i> User
                                @endif
                            </div>
                        </td>
                        <td class="w-40 border-b">
                            <div class="flex items-center sm:justify-center text-theme-9">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active
                            </div>
                        </td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a class="flex items-center mr-3 edit-btn" data-id="{{ $user->id }}"
                                    href="javascript:;">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <a class="flex items-center text-theme-6 delete-btn" data-id="{{ $user->id }}"
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
                $('#create-user').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.users.store') }}',
                        data: $('#add-user-form').serialize(),
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
                    var userId = $(this).data('id');
                    console.log(userId);
                    $.ajax({
                        type: 'GET',
                        url: '/users/edit/' + userId,
                        success: function(response) {
                            $('#edit-name').val(response.user.name);
                            $('#edit-email').val(response.user.email);
                            $('#edit-id').val(response.user.id);
                            $('#edit-role').val(response.user.role);
                            $('#edit-password').val(response.user.password);
                            $('#editUserModal').modal('show');
                        },

                        error: function(xhr, status, error) {
                            console.error('Error fetching user data: ' + error);
                        }
                    });
                });

                $('#update-user-button').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'PUT',
                        url: '/users/update/' + $('#edit-id').val(),
                        data: $('#edit-user-form').serialize(),
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
                            .email) {
                            swal.fire({
                                title: "Error!",
                                text: response.responseJSON.errors.email[0],
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
                    var userId = $(this).data('id');
                    console.log(userId);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Once deleted, you will not be able to recover this user!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: '/users/' + userId,
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
