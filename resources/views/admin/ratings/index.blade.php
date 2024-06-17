@extends('components.app')
@section('title', 'Ratings & Reviews | Admin')
@section('content')

    <div class="grid grid-cols-12 gap-6">

        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Settings
                    </h2>
                </div>
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">ORDER ID</th>
                                <th class="border-b-2 whitespace-no-wrap">NAME CUSTOMER</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">RATING</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">REVIEW</th>
                                {{-- <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ratings as $rating)
                                <tr>
                                    <td class="border-b">
                                        <div class="font-medium whitespace-no-wrap">Order #{{ $rating->id }}</div>
                                    </td>
                                    <td class="border-b">
                                        <div class="font-medium whitespace-no-wrap">{{ $rating->user->name }}</div>
                                    </td>
                                    <td class="border-b">
                                        <div class="font-medium whitespace-no-wrap text-center flex items-center justify-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gold" class="bi bi-star-fill mr-1" viewBox="0 0 16 16">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="lightgray" class="bi bi-star-fill mr-1" viewBox="0 0 16 16">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>
                                    <td class="border-b">
                                        <div class="font-medium whitespace-no-wrap">{{ $rating->review }}</div>
                                    </td>
                                    {{-- <td class="border-b">
                                        <div class="flex sm:justify-center items-center">
                                            <a href="{{ route('admin.ratings.edit', $rating->id) }}" class="flex items-center text-theme-9 mr-3">
                                                <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.ratings.destroy', $rating->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="flex items-center text-theme-6">
                                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>

@endsection
