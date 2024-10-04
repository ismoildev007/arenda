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
                        <h5 class="m-b-10">Section</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(1);">Home</a></li>
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
                            <a href="{{ route('sections.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Section</span>
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
                                    <div class="mb-4">
                                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $section->name }} </a>
                                    </div>
                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $section->size }}</h6>
                                            <p class="fs-12 text-muted mb-0">Umumiy hajmi m<sup>2</sup></p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $section->floor }}</h6>
                                            <p class="fs-12 text-muted mb-0">Qavatlar soni</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $section->mode_of_operation }}</h6>
                                            <p class="fs-12 text-muted mb-0">Hizmat ko'rsatish mumkin bo'lgan kunlar</p>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Joylashuv</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $section->building->region->name }}, {{ $section->building->district->name }}</a>
                                    </li>
                                    @foreach($section->building->employees as $email)
                                        <li class="hstack justify-content-between mb-4">
                                            <span class="text-muted fw-medium hstack gap-3"><i class="feather-user"></i>Lavozim</span>
                                            <a href="javascript:void(0);" class="float-end">@if($email->role === 'manager') Manager @endif</a>
                                        </li>
                                        <li class="hstack justify-content-between mb-0">
                                            <span class="text-muted fw-medium hstack gap-3"><i class="feather-mail"></i>Email</span>
                                            <a href="javascript:void(0);" class="float-end">{{ $email->email }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="d-flex gap-2 text-center pt-4">
                                    <form class="btn-group w-50" action="{{ route('sections.destroy', $section->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                            <i class="feather-trash-2 me-2"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                    <a href="{{ route('sections.edit', $section->id) }}" class="w-50 btn btn-primary">
                                        <i class="feather-edit me-2"></i>
                                        <span>Edit</span>
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
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Qavatlar</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#connectionTab" role="tab">Xonalar</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#securityTab" role="tab">Security <span class="text-danger"> (cooming soon)  </span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                    <div class="section-details mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Section Details:</h5>
                                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-light-brand">Edit Section</a>
                                        </div>

                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Section Name:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Address:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->address }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Section Type:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->section_type }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Construction:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->construction }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Size:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->size }} sqm</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Founded Date:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->founded_date }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Safety:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->safety }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Mode of Operation:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->mode_of_operation }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Set:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->set }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Floor:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->floor }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Number of Rooms:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->number_of_rooms }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Lift:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->lift ? 'Yes' : 'No' }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Parking:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->parking ? 'Yes' : 'No' }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Price per sqm:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $section->price_per_sqm }} USD</div>
                                        </div>
                                        
                                        @if($section->images && is_array($section->images) && count($section->images) > 0)
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Images:</div>
                                                <div class="col-sm-6 fw-semibold">
                                                    @foreach($section->images as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Section Image" class="img-fluid mb-2">
                                                    @endforeach
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
                                    <div class="mb-4 px-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Contract History:</h5>
                                        <a href="{{ route('contracts.index') }}" class="btn btn-sm btn-light-brand">All History</a>
                                    </div>

                                    @php
                                        // Section uchun shartnomalarni olish
                                        $sectionContracts = $section->contracts;

                                        // Sectionga tegishli barcha floors uchun shartnomalarni olish
                                        $floorContracts = $section->floors->flatMap(function($floor) {
                                            return $floor->contracts;
                                        });

                                        // Section va uning floors va ularga tegishli room'lardan olingan shartnomalarni birlashtirib, takrorlanmaydigan shartnomalar ro'yxatini olish
                                        $allContracts = $sectionContracts->merge($floorContracts)->unique('id');
                                    @endphp

                                    @if($allContracts->isEmpty())
                                        <p>No contracts found for this section.</p>
                                    @else
                                        @foreach($allContracts as $contract)
                                            @php
                                                // Shartnoma muddati tugashini tekshirish
                                                $isExpired = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($contract->end_date));
                                                $status = $isExpired ? 'noactive' : $contract->status;
                                                $badgeClass = $isExpired ? 'bg-soft-danger text-danger' : 'bg-soft-success text-success';
                                            @endphp

                                            <div class="subscription-plan px-4 pt-4">
                                                <div class="p-4 mb-4 d-xxl-flex d-xl-block d-md-flex align-items-center justify-content-between gap-4 border border-dashed border-gray-5 rounded-1">
                                                    <div>
                                                        <!-- Shartnoma raqami va holati -->
                                                        <div class="fs-14 fw-bold text-dark mb-1">
                                                            {{$contract->contract_number}}
                                                            <a href="javascript:void(0);" class="badge {{ $badgeClass }} text-white ms-2">{{ $status }}</a>
                                                        </div>
                                                        
                                                        <!-- Shartnoma ma'lumotlari -->
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

                                                    <!-- Narx va to'lov ma'lumotlari -->
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
                                                        </div>
                                                    </div>

                                                    <!-- Shartnoma harakatlari -->
                                                    <div class="hstack gap-3">
                                                        <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-light-brand">Show contract</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div id="notificationsTab" class="tab-pane fade" role="tabpanel">
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
                                    <div class="subscription-plan px-4 pt-4">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Floors:</h5>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Nomer</th>
                                                <th>Building nomi</th>
                                                <th>Seksiya</th>
                                                <th>Qavat</th>
                                                <th>Hajmi (1 m <sup>2</sup>)</th>
                                                <th>Narxi (1 m <sup>2</sup>)</th>
                                                <th>Harakatlar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           @if($section->floors->isNotEmpty())
                                            @foreach($section->floors as $floor)
                                                <tr>
                                                    <td>{{ $floor->number }}</td>
                                                    <td>{{ $floor->building->name }}</td>
                                                    <td>{{ $floor->section->name }}</td>
                                                    <td>{{ $floor->number }}- qavat</td>
                                                    <td>{{ $floor->size }} m <sup>2</sup></td>
                                                    <td>{{ $floor->price_per_sqm }}</td>
                                                    <td>
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{ route('floors.show', $floor->id) }}" class="avatar-text avatar-md">
                                                                <i class="feather-eye"></i>
                                                            </a>

                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('floors.edit', $floor->id) }}">
                                                                            <i class="feather feather-edit-3 me-3"></i>
                                                                            <span>Edit</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form class="dropdown-item" action="{{ route('floors.destroy', $floor->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                                                                <i class="feather feather-trash-2 me-3"></i>
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                             @else
                                                <div class="alert alert-info">
                                                    <strong>No rooms found for this section.</strong>
                                                </div>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="securityTab" class="tab-pane fade" role="tabpanel">
                                    <div class="text-center">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#securityTab" role="tab">Security <span class="text-danger"> (cooming soon)  </span></a>
                                    </div>
                                </div>
                                <div id="connectionTab" class="tab-pane fade" role="tabpanel">
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
                                    <div class="subscription-plan px-4 pt-4">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Rooms:</h5>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Nomer</th>
                                                <th>Building nomi</th>
                                                <th>Seksiya</th>
                                                <th>Qavat</th>
                                                <th>Hajmi (1 m <sup>2</sup>)</th>
                                                <th>Narxi (1 m <sup>2</sup>)</th>
                                                <th>Harakatlar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($section->rooms->isNotEmpty())
                                            @foreach($section->rooms as $room)
                                                <tr>
                                                    <td>{{ $room->number }}</td>
                                                    <td>{{ $room->building->name }}</td>
                                                    <td>{{ $room->section->name }}</td>
                                                    <td>{{ $room->floor->number }}- qavat</td>
                                                    <td>{{ $room->size }} m <sup>2</sup></td>
                                                    <td>{{ $room->price_per_sqm }}</td>
                                                    <td>
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{ route('rooms.show', $room->id) }}" class="avatar-text avatar-md">
                                                                <i class="feather-eye"></i>
                                                            </a>

                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('rooms.edit', $room->id) }}">
                                                                            <i class="feather feather-edit-3 me-3"></i>
                                                                            <span>Edit</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form class="dropdown-item" action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                                                                <i class="feather feather-trash-2 me-3"></i>
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                             @else
                                                <div class="alert alert-info">
                                                    <strong>No rooms found for this section.</strong>
                                                </div>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>

@endsection
