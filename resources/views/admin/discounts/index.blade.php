@extends('components.app')
@section('title', 'Discounts | Laundry App')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Discounts
    </h2>
    <a href="{{ route('discounts.create') }}" class="button text-white bg-theme-1 shadow-md mr-2">Add New Discount</a>
</div>

<div class="intro-y box p-5 mt-5">
    <table class="table">
        <thead>
            <tr>
                <th class="border-b-2">Code</th>
                <th class="border-b-2">Percentage</th>
                <th class="border-b-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td class="border-b">{{ $discount->code }}</td>
                    <td class="border-b">{{ $discount->percentage }}%</td>
                    <td class="border-b">
                        <a href="{{ route('discounts.edit', $discount->id) }}" class="button text-white bg-theme-1 shadow-md mr-2">Edit</a>
                        <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button bg-theme-6 text-white">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
