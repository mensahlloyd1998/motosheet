@extends('layouts.luno_layout')

@section('page_title')
   Vehicle Details
@endsection

@section('breadcrumb')
   @if(env('ENABLE_BREADCRUMB') == true)
    <div class="col">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-secondary" href="{{ route('cars.index') }}">Vehicles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
        </ol>
    </div>
   @endif
@endsection

@section('page_details')
    <x-page-details 
        title="Vehicle Details"
        description="Key analytics and insights for the vehicle listing"
    />
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom">
            <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row">
                <img src="{{ asset('/img/profile_av.png') }}" alt="" class="rounded-4">
                <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center">
                <h4 class="mb-1 fw-light">{{$car->make}} {{$car->model}} {{$car->trim}}<a href="#" class="fa fa-pencil-square-o fs-6 ms-2" data-bs-toggle="offcanvas" data-bs-target="#edit_profile" title="Edit Profile"></a></h4>
                <p>Added on {{ $car->created_at->format('M d, Y') }} &#8226; 
                    <span class="text-capitalize {{ $car->status == 'active'? 'text-success': 'text-warning' }}">
                        {{ $car->status }}
                    </span> 
                    &#8226; 
                    <span>
                        {{ $car->user->country->currency_code }} {{ $car->price }}
                    </span>
                </p>
                <!-- <span class="text-muted">It is a long established fact that a reader will be distracted by the readable<br> content of a page when looking at its layout.</span> -->
                <div class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
                    <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Year Model</small>
                        <div class="fs-6 text-capitalize">{{ $car->year }}</div>
                    </div>
                    <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Condition</small>
                        <div class="fs-6 text-capitalize">{{ str_replace('_', ' ', $car->condition) }}</div>
                    </div>
                    <div class="card py-2 px-3 me-2 mt-2">
                        <small class="text-muted">Mileage</small>
                        <div class="fs-6 ">{{ $car->mileage }} mi</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <ul class="nav nav-tabs tab-card border-bottom-0 pt-2 fs-6 justify-content-center justify-content-md-start" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#profile_post" role="tab"><span>Statistics</span></a></li>
            <!-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#profile_groups" role="tab"><i class="fa fa-address-card-o"></i><span class="d-none d-sm-inline-block ms-2">Groups</span></a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#profile_project" role="tab"><i class="fa fa-list-alt"></i><span class="d-none d-sm-inline-block ms-2">Projects</span></a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#profile_campaigns" role="tab" id="tab_profile_campaigns"><i class="fa fa-area-chart"></i><span class="d-none d-md-inline-block ms-2">Campaigns</span></a></li>
            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#profile_activity" role="tab"><i class="fa fa-font"></i><span class="d-none d-md-inline-block ms-2">Activity</span></a></li> -->
            </ul>
        </div>

        <div class="tab-content mt-5">


            <div class="tab-pane fade show active" id="profile_post" role="tabpanel">
                <div class="row-title mb-2">
                  <h5>Statistics</h5>
                </div>
                <div class="row g-3">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                <h6 class="card-title mb-0">Listing Performance</h6>
                                <p class="mb-0">Track how your car listing is performing over time, including total views and offers received.</p>
                                </div>
                                <!-- widgest: Card more action icon -->
                                <div class="dropdown morphing scale-left">
                                <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                <ul class="dropdown-menu shadow border-0 p-2">
                                    <li><a class="dropdown-item" href="#">File Info</a></li>
                                    <li><a class="dropdown-item" href="#">Copy to</a></li>
                                    <li><a class="dropdown-item" href="#">Move to</a></li>
                                    <li><a class="dropdown-item" href="#">Rename</a></li>
                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <!-- <div class="d-flex flex-row flex-wrap">
                                    <div class="card py-2 px-3 me-2 mt-2">
                                        <small class="text-uppercase text-muted"><i class="fa fa-square me-1 chart-text-color1"></i>Impressions</small>
                                        <div><span class="fs-4 fw-bold">4.2M</span> <span class="text-success fa fa-level-up">43%</span></div>
                                        <div class="text-muted small">5.0M Total Target</div>
                                    </div>
                                    <div class="card py-2 px-3 me-2 mt-2">
                                        <small class="text-uppercase text-muted"><i class="fa fa-square me-1 chart-text-color5"></i>Data Transfered</small>
                                        <div><span class="fs-4 fw-bold">8.3M</span> <span class="text-danger fa fa-level-down">17%</span></div>
                                        <div class="text-muted small">10.0M Total Target</div>
                                    </div>
                                    <div class="card py-2 px-3 me-2 mt-2">
                                        <small class="text-muted text-uppercase">Delevered</small>
                                        <div><span class="fs-4 fw-bold">87%</span></div>
                                        <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%;"></div>
                                        </div>
                                    </div>
                                    <div class="card py-2 px-3 me-2 mt-2">
                                        <small class="text-muted text-uppercase">Transfered</small>
                                        <div><span class="fs-4 fw-bold">77%</span></div>
                                        <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar chart-color5" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div id="apex_c_5"></div>
                            </div>
                        </div> <!-- .card end -->
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>

@endsection

@section('scripts')

    <!-- Plugin Js -->
    <script src="{{ asset('/js/bundle/apexcharts.bundle.js') }}"></script>
    <script>
        const offersData = @json($offersData);
        const viewsData  = @json($viewsData);
        const monthLabels = @json($monthLabels);

        var apexwc9 = {
            series: [
                {
                    name: "Offers & Inquiries",
                    data: offersData
                },
                {
                    name: "Page Views / Visits",
                    data: viewsData
                }
            ],
            chart: {
                height: 320,
                type: 'line',
                toolbar: { show: false },
                zoom: { enabled: false },
            },
            colors: ['var(--chart-color1)', 'var(--chart-color5)'],
            dataLabels: { enabled: false },
            stroke: {
                width: [2, 2],
                curve: 'smooth',
                dashArray: [10, 0]
            },
            markers: {
                size: 0,
                hover: { sizeOffset: 6 }
            },
            xaxis: {
                categories: monthLabels
            }
        };

        new ApexCharts(document.querySelector("#apex_c_5"), apexwc9).render();
    </script>


@endsection