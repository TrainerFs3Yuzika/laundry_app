@extends('components.app')
@section('title' , 'Dashboard | Laundry App')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    General Report
                </h2>
                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $orders_paid }}</div>
                            <div class="text-base text-gray-600 mt-1">Paid Transaction</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$orders}}</div>
                            <div class="text-base text-gray-600 mt-1">Total Orders</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$services}}</div>
                            <div class="text-base text-gray-600 mt-1">Total Products</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$customers}}</div>
                            <div class="text-base text-gray-600 mt-1">Total Customer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        <!-- BEGIN: Sales Report -->
        <div class="col-span-12 lg:col-span-8 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Sales Report
                </h2>
                <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                </div>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div class="flex flex-col xl:flex-row xl:items-center">
                    <div class="flex">
                        <div>
                            <div class="text-theme-20 text-lg xl:text-xl font-bold">{{formatRupiah($total_income)}}</div>
                            <div class="text-gray-600">Today</div>
                        </div>
                        <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6"></div>
                        <div>
                            <div class="text-green-600 text-lg xl:text-xl font-medium">{{formatRupiah($total_income_month)}}</div>
                            <div class="text-gray-600">This Month</div>
                        </div>
                    </div>

                </div>
                <div class="report-chart">
                    <div id="report-line-chart2"></div>
                </div>
            </div>
        </div>
        <div class="col-span-12 xl:col-span-4 mt-6">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Weekly Best Sellers
                </h2>
            </div>
            <div class="mt-5">
                @foreach($weekly_best_sellers as $seller)
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">{{ $seller->name_service }}</div>
                                <div class="text-gray-600 text-xs">{{ $seller->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">{{ $seller->total_sales }} Sales</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    @if (session('success'))
        $.toast({
            text: "{{ session('success') }}" ,
            bgColor: '#41B06E',
            textColor: 'white',
            allowToastClose: true,
            hideAfter: 5000,
            stack: 5,
            textAlign: 'left',
            position: 'top-right',
        });
    @endif

    // Render the sales chart using ApexCharts
    var options = {
        chart: {
            type: 'line',
            height: 350
        },
        series: [{
            name: 'Sales',
            data: @json($sales_data->pluck('total_sales')->map(function($value) { return $value / 100000; }))
        }],
        xaxis: {
            categories: @json($sales_data->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('d M'); }))
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return new Intl.NumberFormat().format(value * 100000); // Multiply back to original scale for display
                }
            },
            title: {
                text: 'Sales (in hundreds of thousands)'
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return new Intl.NumberFormat().format(value * 100000); // Multiply back to original scale for display
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#report-line-chart2"), options);
    chart.render();
</script>
@endpush
