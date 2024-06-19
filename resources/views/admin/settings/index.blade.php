@extends('components.app')
@section('title', 'Settings')
@section('content')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Settings
                </h2>
            </div>
            <div class="p-5">

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-3">
                        <label>Website Title</label>
                        <input type="text" name="website_title" class="input w-full border mt-2" value="{{ old('website_title', $settings->website_title) }}" placeholder="Website Title">
                    </div>
                    <div class="mt-3">
                        <label>Website Description</label>
                        <textarea name="website_description" class="input w-full border mt-2" placeholder="Website Description">{{ old('website_description', $settings->website_description) }}</textarea>
                    </div>
                    <div class="mt-3">
                        <label>Timezone</label>
                        <select name="timezone" class="input w-full border mt-2">
                            @foreach (timezone_identifiers_list() as $timezone)
                                <option value="{{ $timezone }}" {{ old('timezone', $settings->timezone) == $timezone ? 'selected' : '' }}>{{ $timezone }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>Language</label>
                        <select name="language" class="input w-full border mt-2">
                            <option value="en" {{ old('language', $settings->language) == 'en' ? 'selected' : '' }}>English</option>
                            <option value="id" {{ old('language', $settings->language) == 'id' ? 'selected' : '' }}>Indonesian</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>Logo</label>
                        <input type="file" name="logo" class="input w-full border mt-2">
                        @if ($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="mt-2">
                        @endif
                    </div>
                    <div class="mt-3">
                        <label>Favicon</label>
                        <input type="file" name="favicon" class="input w-full border mt-2">
                        @if ($settings->favicon)
                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Favicon" class="mt-2">
                        @endif
                    </div>
                    <div class="mt-3">
                        <label>Tax Information</label>
                        <input type="text" name="tax" class="input w-full border mt-2" value="{{ old('tax', $settings->tax) }}" placeholder="Tax Information">
                    </div>
                    <button type="submit" class="button bg-theme-1 text-white mt-4">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
     @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        showConfirmButton: true,
                        timer: 1500
                    });
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ $error }}',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    @endforeach
                @endif
    </script>
@endpush
