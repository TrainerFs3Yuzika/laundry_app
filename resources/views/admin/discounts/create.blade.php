@extends('components.app')
@section('title', 'Add Discount | Laundry App')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add Discount
    </h2>
</div>

<div class="intro-y box p-5 mt-5">
    <form action="{{ route('discounts.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-6">
                <label for="code" class="form-label">Code</label>
                <input type="text" id="code" name="code" class="input w-full border mt-2" required>
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label for="percentage" class="form-label">Percentage</label>
                <input type="number" id="percentage" name="percentage" class="input w-full border mt-2" required>
            </div>
            <div class="col-span-12 sm:col-span-6">
                <button type="submit" class="button w-full bg-theme-1 text-white mt-3">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection
