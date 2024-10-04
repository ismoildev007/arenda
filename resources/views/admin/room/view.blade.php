@extends('layouts.layout')

@section('content')
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Room</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">View</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand successAlertMessage">
                                <i class="feather-star"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand">
                                <i class="feather-eye me-2"></i>
                                <span>Follow</span>
                            </a>
                            <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Room</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="mb-4 text-center">
                                    <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                        <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3">
                                            <img src="/assets/images/avatar/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle" style="top: 76%; right: 10px">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $room->size }}</h6>
                                            <p class="fs-12 text-muted mb-0">Umumiy hajmi m<sup>2</sup></p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $room->number }}</h6>
                                            <p class="fs-12 text-muted mb-0">xona raqami</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Location</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $room->building->region->name }} {{ $room->building->district->name }}</a>
                                    </li>

                                </ul>
                                <div class="d-flex gap-2 text-center pt-4">
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="w-50 d-inline-block" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light-brand w-100" style="border: none; background: none; padding: 13px;">
                                            <i class="feather-trash-2 me-2"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                    <a href="{{ route('rooms.edit', $room->id)}}" class="w-50 btn btn-primary">
                                        <i class="feather-edit me-2"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-xxl-8 col-xl-6">
                        <div class="card border-top-0">
                            <div class="card-header p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#billingTab" role="tab">Contracts</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#activityTab" role="tab">Activity  <span class="text-danger"> (cooming soon)  </span></a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Notifications  <span class="text-danger"> (cooming soon)  </span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                    
                                    <div class="profile-details mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Room Information:</h5>
                                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-light-brand">Edit Room</a>
                                        </div>

                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Building:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->building->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Section:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->section->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Floor:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->floor->number }} - qavat</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Room Number:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->number }} - xona</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Size:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->size }} m <sup>2</sup></div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Price:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->price_per_sqm }} so'm / 1 m <sup>2</sup></div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Status:</div>
                                            <div class="col-sm-6 fw-semibold">{{ ucfirst($room->status) }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Type:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $room->type }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Total amount:</div>
                                            <div class="col-sm-6 fw-semibold">per month - {{ $room->size * $room->price_per_sqm }}</div>
                                        </div>

                                        <hr style="border: 2px solid #dc3545 !important;">

                                        @if ($room->images)
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 fw-semibold">
                                                    @foreach ($room->images as $image)
                                                        <div class="card border-0 shadow-sm mb-2" style="max-width: 150px;">
                                                            <div class="card-body p-2">
                                                                <img src="{{ asset('storage/' . $image) }}" alt="Room Image" class="img-thumbnail" style="max-width: 100%; height: auto;">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Images:</div>
                                                <div class="col-sm-6 fw-semibold">
                                                    <p>No images available</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-warning-message profile-overview-alert" role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-triangle fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 text-truncate-1-line">Your profile has not been updated yet!!!</p>
                                            <p class="fs-10 fw-medium text-uppercase text-truncate-1-line">Last Update: <strong>26 Dec, 2023</strong></p>
                                            <a href="javascript:void(0);" class="btn btn-sm bg-soft-warning text-warning d-inline-block">Update Now</a>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="billingTab" role="tabpanel">
                                    <div class="alert alert-dismissible m-4 p-4 d-flex alert-soft-teal-message" role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-octagon fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 text-truncate-1-line">We need your attention!</p>
                                            <p class="fs-12 fw-medium text-truncate-1-line">Your payment was declined. To start using tools, please <strong>Add Payment Method</strong></p>
                                            <a href="javascript:void(0);" class="btn btn-sm bg-soft-teal text-teal d-inline-block">Add Payment Method</a>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="payment-history">
                                        <div class="mb-4 px-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Contract History:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Alls History</a>
                                        </div>
                                            
                                            @forelse($room->contracts as $contract)
                                                @php
                                                    $isExpired = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($contract->end_date));
                                                    $status = $isExpired ? 'noactive' : $contract->status;
                                                    $badgeClass = $isExpired ? 'bg-soft-danger text-danger' : 'bg-soft-success text-success';
                                                @endphp

                                                <div class="subscription-plan px-4 pt-4">
                                                    <div class="p-4 mb-4 d-xxl-flex d-xl-block d-md-flex align-items-center justify-content-between gap-4 border border-dashed border-gray-5 rounded-1">
                                                        <div>
                                                            <!-- Contract Number and Status -->
                                                            <div class="fs-14 fw-bold text-dark mb-1">
                                                                {{$contract->contract_number}}
                                                                <a href="javascript:void(0);" class="badge {{ $badgeClass }} text-white ms-2">{{ $status }}</a>
                                                            </div>
                                                            
                                                            <!-- Contract Info -->
                                                            <div class="contract-info fs-12 text-muted">
                                                                <div class="contract-section">
                                                                    <strong>Section:</strong> {{$contract->section->name ?? 'N/A'}}
                                                                </div>
                                                                @if($contract->floor)
                                                                    <div class="contract-floor">
                                                                        <strong>Floor:</strong> {{$contract->floor->number}}-qavat
                                                                    </div>
                                                                @endif
                                                                @if($contract->room)
                                                                    <div class="contract-room">
                                                                        <strong>Room:</strong> {{$contract->room->number}}-xona
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Pricing and Payment Info -->
                                                        <div class="my-3 my-xxl-0 my-md-3 my-md-0">
                                                            <div class="fs-20 text-dark">
                                                                <span class="fw-bold">
                                                                    @if($contract->room !== null)
                                                                        {{ number_format($contract->room->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                                    @elseif($contract->floor !== null)
                                                                        {{ number_format($contract->floor->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                                    @elseif($contract->section !== null)
                                                                        {{ number_format($contract->section->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </span> / <em class="fs-11 fw-medium">Month (1 m<sup>2</sup>)</em>
                                                            </div>
                                                            <div class="fs-12 text-muted mt-1">
                                                                Billed Monthly {{ \Carbon\Carbon::parse($contract->start_date)->addMonth()->format('d/m/Y') }} for {{ \Carbon\Carbon::parse($contract->end_date)->addMonth()->format('d/m/Y') }}
                                                                <strong class="text-dark">{{ $contract->total_amount }} USD</strong>
                                                            </div>
                                                        </div>

                                                        <!-- Contract Actions -->
                                                        <div class="hstack gap-3">
                                                            <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-light-brand">Show contract</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted">No contracts available for this room.</p>
                                            @endforelse

                                    </div>


                                </div>
                                <div class="tab-pane fade" id="activityTab" role="tabpanel">
                                    <div class="table-responsive text-center">
                                         <h3> Activity </h3><span class="text-danger"> (cooming soon)  </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="notificationsTab" role="tabpanel">
                                    <div class="table-responsive text-center">
                                         <h3> Notification </h3><span class="text-danger"> (cooming soon)  </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
        <!-- [ Footer ] start -->
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <div class="d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
                <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
            </div>
        </footer>
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
@endsection