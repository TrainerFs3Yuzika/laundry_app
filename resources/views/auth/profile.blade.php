@extends('components.app')
@section('title', 'Profil | Laundry App')
@section('content')

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Profile
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Profile Picture" class="rounded-full" src="{{ auth()->user()->profile_photo_url }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="text-gray-600">
                            {{ auth()->user()->role }}
                        </div>
                    </div>
                </div>
                <div class="p-5 border-t border-gray-200">
                    <a id="link-personal-info" class="flex items-center text-theme-1 font-medium cursor-pointer active">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i> Personal Information
                    </a>
                    <a id="link-change-password" class="flex items-center mt-5 cursor-pointer">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->

        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <!-- BEGIN: Personal Information -->
            <div id="personal-information" class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Personal Information
                    </h2>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="border border-gray-200 rounded-md p-5">
                                    <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img id="preview-image" class="rounded-md" alt="Profile Picture"
                                            src="{{ auth()->user()->profile_photo_url }}">
                                        <div id="remove-photo" title="Remove this profile photo?"
                                            class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 cursor-pointer">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="button w-full bg-theme-1 text-white">Change
                                            Photo</button>
                                        <input type="file" id="profile-photo-input" name="profile_photo"
                                            class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-8">
                                <div>
                                    <label>Display Name</label>
                                    <input type="text" name="name" class="input w-full border mt-2"
                                        placeholder="Username" value="{{ old('name', auth()->user()->name) }}">

                                </div>
                                <div class="mt-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="input w-full border mt-2"
                                        placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                </div>
                                <div class="mt-3">
                                    <label>Phone Number (WhatsApp)</label>
                                    <input type="text" name="phone" class="input w-full border mt-2"
                                        placeholder="Phone Number" value="{{ old('phone', auth()->user()->phone) }}">
                                </div>
                                <div class="mt-3">
                                    <label>Address</label>
                                    <textarea name="address" class="input w-full border mt-2" placeholder="Address">{{ old('address', auth()->user()->address) }}</textarea>
                                </div>
                                <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: Personal Information -->

            <!-- BEGIN: Change Password -->
            <div id="change-password" class="intro-y box lg:mt-5 hidden">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Change Password
                    </h2>
                </div>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    <div class="p-5">
                        <div>
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="input w-full border mt-2"
                                placeholder="Current Password">
                        </div>
                        <div class="mt-3">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="input w-full border mt-2"
                                placeholder="New Password">
                        </div>
                        <div class="mt-3">
                            <label>Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="input w-full border mt-2"
                                placeholder="Confirm New Password">
                        </div>
                        <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                    </div>
                </form>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>

@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profilePhotoInput = document.getElementById('profile-photo-input');
            const previewImage = document.getElementById('preview-image');
            const removePhotoButton = document.getElementById('remove-photo');
            const defaultPhotoUrl = "{{ auth()->user()->profile_photo_url }}";
            const personalInfo = document.getElementById('personal-information');
            const changePassword = document.getElementById('change-password');
            const linkPersonalInfo = document.getElementById('link-personal-info');
            const linkChangePassword = document.getElementById('link-change-password');

            profilePhotoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        Swal.fire({
                            icon: 'success',
                            title: 'Photo Updated',
                            text: 'Profile photo has been updated successfully!',
                        });
                    }
                    reader.readAsDataURL(file);
                }
            });

            removePhotoButton.addEventListener('click', function() {
                previewImage.src = defaultPhotoUrl;
                profilePhotoInput.value = '';
                Swal.fire({
                    icon: 'warning',
                    title: 'Photo Removed',
                    text: 'Profile photo has been removed.',
                });
            });

            linkPersonalInfo.addEventListener('click', function() {
                personalInfo.classList.remove('hidden');
                changePassword.classList.add('hidden');
                linkPersonalInfo.classList.add('active');
                linkChangePassword.classList.remove('active');
            });

            linkChangePassword.addEventListener('click', function() {
                changePassword.classList.remove('hidden');
                personalInfo.classList.add('hidden');
                linkChangePassword.classList.add('active');
                linkPersonalInfo.classList.remove('active');
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $errors->first() }}',
                });
            @endif

            const links = document.querySelectorAll('#link-personal-info, #link-change-password');

            links.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove "active" class from all links
                    links.forEach(l => l.classList.remove('text-theme-1', 'font-medium'));

                    // Add "active" class to the clicked link
                    this.classList.add('text-theme-1', 'font-medium');
                });
            });
        });
    </script>
@endpush
