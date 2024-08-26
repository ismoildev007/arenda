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
                        <h5 class="m-b-10">Obyekt</h5>
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
{{--                            <div class=" col-12 row align-items-center">--}}
{{--                                <div id="selectContainer" class="hidden">--}}
{{--                                    <label class="form-label">Hisob uchun shablon <span class="text-danger">*</span></label>--}}
{{--                                    <select id="temp-contract-checkSelect" class="form-control select2-hidden-accessible"--}}
{{--                                            data-select2-selector="icon" tabindex="-1" aria-hidden="true"--}}
{{--                                            onchange="tempContractCheckSelect()">--}}
{{--                                        <option value="">Hisob</option>--}}
{{--                                        <option value="temp-contract-check">Yangi shablon qo'shish</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="feather-plus me-2"></i>
                                    <span>Create</span>
                                </button>
                                <ul class="dropdown-menu" id="temp-contract-checkSelect">
                                    <li><a class="dropdown-item" href="{{ route('buildings.create') }}">Create Building</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addSectionModal0{{ $building->id }}">Create Section</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" role="option" onclick="tempContractCheckSelect('temp-contract-check');">Create Floor</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="openRoomModal({{ $building->id }})">Create Room</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>

            <script>
                function tempContractCheckSelect(value) {
                    if(value === 'temp-contract-check') {
                        const tempContractCheckSelectOffcanvas = document.getElementById('tempContractCheckSelectOffcanvas');
                        tempContractCheckSelectOffcanvas.style.visibility = "visible";
                        tempContractCheckSelectOffcanvas.classList.add('show');
                    }
                }

                function openRoomModal(buildingId) {
                    // Bu yerda modalni topamiz
                    const roomModal = document.getElementById('addRoomModal' + buildingId);

                    if (roomModal) {
                        // Building ID-ni yashirin inputga uzatamiz
                        const buildingIdInput = roomModal.querySelector('input[name="building_id"]');
                        if (buildingIdInput) {
                            buildingIdInput.value = buildingId;
                        }

                        // Modalni ko'rsatamiz
                        const bsRoomModal = new bootstrap.Modal(roomModal);
                        bsRoomModal.show();
                    }
                }

            </script>
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
                                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $building->name }} </a>
                                    </div>
                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $building->rooms->sum('size') }}</h6>
                                            <p class="fs-12 text-muted mb-0">Umumiy hajmi m<sup>2</sup></p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $building->sections->count() }}</h6>
                                            <p class="fs-12 text-muted mb-0">Seksiyalar soni</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $building->rooms->count() }}</h6>
                                            <p class="fs-12 text-muted mb-0">Umumiy xonalar soni</p>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-4">
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Joylashuv</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $building->region->name }}, {{ $building->district->name }}</a>
                                    </li>
                                    @foreach($building->employees as $email)
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
                                    <form class="btn-group w-50" action="{{ route('buildings.destroy', $building->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                            <i class="feather-trash-2 me-2"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                    <a href="{{ route('buildings.edit', $building->id) }}" class="w-50 btn btn-primary">
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
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#billingTab" role="tab">Billing</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#activityTab" role="tab">Section</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Notifications</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#connectionTab" role="tab">Connection</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#securityTab" role="tab">Security</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                    <div class="profile-details mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Building Details:</h5>
                                            <a href="{{ route('buildings.edit', $building->id) }}" class="btn btn-sm btn-light-brand">Edit Building</a>
                                        </div>

                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Obyekt etaji:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->floor }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Region:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->region->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">District:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->district->name }}</div>
                                        </div>

                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Clients:</h5>
                                        </div>
                                        @if($building->contracts->isNotEmpty())
                                            @foreach($building->contracts as $contract)
                                                @if($contract->client)
                                                    <div class="row g-0 mb-4">
                                                        <div class="col-sm-6 text-muted">Client Name:</div>
                                                        <div class="col-sm-6 fw-semibold">{{ $contract->client->first_name }} {{ $contract->client->last_name }}</div>
                                                    </div>
                                                    @if($contract->client->pinfl !== null)
                                                        <div class="row g-0 mb-4">
                                                            <div class="col-sm-6 text-muted">Jismoniy shaxs PINFL:</div>
                                                            <div class="col-sm-6 fw-semibold">{{ $contract->client->pinfl }}</div>
                                                        </div>
                                                        <hr/>
                                                    @endif
                                                    @if($contract->client->inn !== null)
                                                        <div class="row g-0 mb-4">
                                                            <div class="col-sm-6 text-muted">Yuridik shaxs INN:</div>
                                                            <div class="col-sm-6 fw-semibold">{{ $contract->client->inn }}</div>
                                                        </div>
                                                        <div class="row g-0 mb-4">
                                                            <div class="col-sm-6 text-muted">Company:</div>
                                                            <div class="col-sm-6 fw-semibold">{{ $contract->client->company_name }}</div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="alert alert-info">
                                                <strong>No clients found for this building.</strong>
                                            </div>
                                        @endif


                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Rooms:</h5>
                                        </div>
                                        @foreach($building->rooms as $room)
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Room Number:</div>
                                                <div class="col-sm-6 fw-semibold">{{ $room->number }}</div>
                                            </div>
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Size:</div>
                                                <div class="col-sm-6 fw-semibold">{{ $room->size }} sqm</div>
                                            </div>
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Price per sqm:</div>
                                                <div class="col-sm-6 fw-semibold">${{ $room->price_per_sqm }}</div>
                                            </div>

                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <h5 class="fw-bold mb-0">Contracts:</h5>
                                            </div>
                                            @foreach($room->contracts as $contract)
                                                <div class="row g-0 mb-4">
                                                    <div class="col-sm-6 text-muted">Contract Number:</div>
                                                    <div class="col-sm-6 fw-semibold">{{ $contract->contract_number }}</div>
                                                </div>

                                                <div class="row g-0 mb-4">
                                                    <div class="col-sm-6 text-muted">Client:</div>
                                                    <div class="col-sm-6 fw-semibold">{{ $contract->client->first_name }} {{ $contract->client->last_name }}</div>
                                                </div>

                                                <div class="row g-0 mb-4">
                                                    <div class="col-sm-6 text-muted">Room:</div>
                                                    <div class="col-sm-6 fw-semibold">{{ $contract->room->number }}</div>
                                                </div>

                                                <div class="row g-0 mb-4">
                                                    <div class="col-sm-6 text-muted">Start Date:</div>
                                                    <div class="col-sm-6 fw-semibold">{{ $contract->start_date->format('d M, Y') }}</div>
                                                </div>

                                                <div class="row g-0 mb-4">
                                                    <div class="col-sm-6 text-muted">End Date:</div>
                                                    <div class="col-sm-6 fw-semibold">{{ $contract->end_date->format('d M, Y') }}</div>
                                                </div>
                                            @endforeach
                                        @endforeach


                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Employees:</h5>
                                        </div>
                                        @foreach($building->employees as $employee)
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Employee Name:</div>
                                                <div class="col-sm-6 fw-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                                            </div>
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Email:</div>
                                                <div class="col-sm-6 fw-semibold">{{ $employee->email }}</div>
                                            </div>
                                            <div class="row g-0 mb-4">
                                                <div class="col-sm-6 text-muted">Role:</div>
                                                <div class="col-sm-6 fw-semibold">{{ ucfirst($employee->role) }}</div>
                                            </div>
                                        @endforeach
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
                                    <div class="project-section">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Projects Details:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-12 col-md-6">
                                                <div class="border border-dashed border-gray-5 rounded mb-4 md-lg-0">
                                                    <div class="p-4">
                                                        <div class="d-sm-flex align-items-center">
                                                            <div class="wd-50 ht-50 p-2 bg-gray-200 rounded-2">
                                                                <img src="/assets/images/brand/github.png" class="img-fluid" alt="">
                                                            </div>
                                                            <div class="ms-0 mt-4 ms-sm-3 mt-sm-0">
                                                                <a href="javascript:void(0);" class="d-block">Mailbox Platform Github</a>
                                                                <div class="fs-12 d-block text-muted">Development</div>
                                                            </div>
                                                        </div>
                                                        <div class="my-4 text-muted text-truncate-2-line">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias dolorem necessitatibus temporibus nemo commodi eaque dignissimos itaque unde hic, sed rerum doloribus possimus minima nobis porro facilis voluptatum atque asperiores perspiciatis saepe laboriosam rem cupiditate libero sit.</div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="img-group lh-0 ms-3">
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Janette Dalton">
                                                                    <img src="/assets/images/avatar/2.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Michael Ksen">
                                                                    <img src="/assets/images/avatar/3.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Socrates Itumay">
                                                                    <img src="/assets/images/avatar/4.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="/assets/images/avatar/5.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="/assets/images/avatar/6.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-text avatar-sm bg-soft-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Explorer More">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                            </div>
                                                            <div class="badge bg-soft-primary text-primary">Inprogress</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 border-top border-top-dashed border-gray-5 d-flex justify-content-between gap-2">
                                                        <div class="w-75 d-none d-md-block">
                                                            <small class="fs-11 fw-medium text-uppercase text-muted d-flex align-items-center justify-content-between">
                                                                <span>Progress</span>
                                                                <span>80%</span>
                                                            </small>
                                                            <div class="progress mt-1 ht-3">
                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div>
                                                            </div>
                                                        </div>
                                                        <span class="mx-2 text-gray-400 d-none d-md-block">|</span>
                                                        <a href="javascript:void(0);" class="fs-12 fw-bold">View &rarr;</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-12 col-md-6">
                                                <div class="border border-dashed border-gray-5 rounded">
                                                    <div class="p-4">
                                                        <div class="d-sm-flex align-items-center">
                                                            <div class="wd-50 ht-50 p-2 bg-gray-200 rounded-2">
                                                                <img src="/assets/images/brand/figma.png" class="img-fluid" alt="">
                                                            </div>
                                                            <div class="ms-0 mt-4 ms-sm-3 mt-sm-0">
                                                                <a href="javascript:void(0);" class="d-block">Chatting Platform Figme</a>
                                                                <div class="fs-12 text-muted">Design</div>
                                                            </div>
                                                        </div>
                                                        <div class="my-4 text-muted text-truncate-2-line">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias dolorem necessitatibus temporibus nemo commodi eaque dignissimos itaque unde hic, sed rerum doloribus possimus minima nobis porro facilis voluptatum atque asperiores perspiciatis saepe laboriosam rem cupiditate libero sit.</div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="img-group lh-0 ms-3">
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Janette Dalton">
                                                                    <img src="/assets/images/avatar/2.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Michael Ksen">
                                                                    <img src="/assets/images/avatar/3.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Socrates Itumay">
                                                                    <img src="/assets/images/avatar/4.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="/assets/images/avatar/5.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="/assets/images/avatar/6.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-text avatar-sm bg-soft-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Explorer More">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                            </div>
                                                            <div class="badge bg-soft-success text-success">Completed</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 border-top border-top-dashed border-gray-5 d-flex justify-content-between gap-2">
                                                        <div class="w-75 d-none d-md-block">
                                                            <small class="fs-10 fw-medium text-uppercase text-muted d-flex align-items-center justify-content-between">
                                                                <span>progress</span>
                                                                <span>100%</span>
                                                            </small>
                                                            <div class="progress mt-1 ht-3">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                                            </div>
                                                        </div>
                                                        <span class="mx-2 text-gray-400 d-none d-md-block">|</span>
                                                        <a href="javascript:void(0);" class="fs-12 fw-bold">View &rarr;</a>
                                                    </div>
                                                </div>
                                            </div>
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
                                    <hr class="mt-2">
                                    <div class="payment-history">
                                        <div class="mb-4 px-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Billing History:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Alls History</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                <tr class="border-top">
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0);">#258963</a></td>
                                                    <td>02 NOV, 2022</td>
                                                    <td>$350</td>
                                                    <td><span class="badge bg-soft-success text-success">Completed</span></td>
                                                    <td class="hstack justify-content-end gap-4 text-end">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sent Mail">
                                                            <i class="feather feather-send fs-12"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Invoice Details">
                                                            <i class="feather feather-eye fs-12"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options">
                                                            <i class="feather feather-more-vertical fs-12"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);">#987456</a></td>
                                                    <td>05 DEC, 2022</td>
                                                    <td>$590</td>
                                                    <td><span class="badge bg-soft-warning text-warning">Pendign</span></td>
                                                    <td class="hstack justify-content-end gap-4 text-end">
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Sent Mail">
                                                            <i class="feather feather-send fs-12"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Invoice Details">
                                                            <i class="feather feather-eye fs-12"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options">
                                                            <i class="feather feather-more-vertical fs-12"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="activityTab" role="tabpanel">
                                    <div class="logs-history mb-0 mt-2">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Section</h5>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"  data-bs-toggle="modal" data-bs-target="#addSectionModal0{{ $building->id }}">
                                                <span>Seksiya qo'shish</span>
                                                <span class="avatar-text avatar-md">
                                                            <i class="feather feather-plus me-3"></i>
                                                        </span>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-dark text-center border-top">
                                                <tr>
                                                    <th class="text-start ps-4">Building</th>
                                                    <th>Seksiya nomi</th>
                                                    <th>Qavati</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @foreach($building->sections as $section)
                                                    <tr>
                                                        <td class="fw-medium text-dark text-start ps-4">{{ $section->building->name }}</td>
                                                        <td>{{ $section->name }}</td>
                                                        <td>{{ $section->floor }}</td>
                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="javascript:void(0)" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSectionModal{{ $section->id }}">
                                                                    <span>Etaj qo'shish</span>
                                                                    <span class="avatar-text avatar-md"><i class="feather feather-plus me-3"></i></span>
                                                                </a>
                                                                <a href="{{ route('sections.show', $section->id) }}" class="avatar-text avatar-md">
                                                                    <i class="feather-eye"></i>
                                                                </a>

                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                        <i class="feather feather-more-horizontal"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('sections.edit', $section->id) }}">
                                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form class="dropdown-item" action="{{ route('sections.destroy', $section->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" style="background: none; border: none; padding: 0;" onclick="return confirm('Ushbu bo\'limni o‘chirishni xohlaysizmi?')">
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="connectionTab" role="tabpanel">
                                    <div class="development-connections p-4 pb-0">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold">Developement Connections:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/google-drive.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Google Drive: Cloud Storage & File Sharing</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">Google's powerful search capabilities are embedded in Drive and offer speed, reliability, and collaboration. And features like Drive search chips help your team ...</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchGDrive"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchGDrive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-4" id="securityTab" role="tabpanel">
                                    <div class="p-4 mb-4 border border-dashed border-gray-3 rounded-1">
                                        <h6 class="fw-bolder"><a href="javascript:void(0);">Two-factor Authentication</a></h6>
                                        <div class="fs-12 text-muted text-truncate-3-line mt-2 mb-4">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</div>
                                        <div class="form-check form-switch form-switch-sm">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="2faVerification">Enable 2FA Verification</label>
                                            <input class="form-check-input c-pointer" type="checkbox" id="2faVerification" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
    <x-modals.floor-modal :building="$building"></x-modals.floor-modal>
    <x-modals.room-modal :building="$building"></x-modals.room-modal>

{{--    Sectin qo'shish uchun modal --}}
        <div class="modal fade" id="addSectionModal0{{ $building->id }}" tabindex="-1" aria-labelledby="addSectionModalLabel0{{ $building->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSectionModalLabel0{{ $building->id }}">Section qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="building_id" value="{{ $building->id }}">
                            <div class="mb-3">
                                <label for="floor" class="form-label">Qavat</label>
                                <input type="number" class="form-control" id="floor" name="floor" min="1" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nomi</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Rasmlar (ixtiyoriy)</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                                <button type="submit" class="btn btn-primary">Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
{{--    Etaj qo'shish uchun modal --}}
    @foreach($building->sections as $section)
        <div class="modal fade" id="addSectionModal{{ $section->id }}" tabindex="-1" aria-labelledby="addSectionModalLabel{{ $section->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSectionModalLabel{{ $section->id }}">Etaj qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('floors.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Hidden Section ID -->
                            <input type="hidden" name="section_id" value="{{ $section->id }}">
                            <input type="hidden" name="building_id" value="{{ $section->building->id }}">

                            <!-- Floor Number -->
                            <div class="row mb-4 align-items-center">
                                <div class="col-lg-4">
                                    <label for="number" class="fw-semibold">Qavat tanglang:</label>
                                </div>
                                <div class="col-lg-8">
                                    <select name="number" id="number_{{ $section->id }}" class="form-select max-select" required>
                                        <option class="text-black" value="" disabled selected>Qavatni tanlang</option>
                                        @for ($i = 1; $i <= $section->floor; $i++)
                                            <option class="text-black" value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="row align-items-center mb-4">
                                <div class="col-lg-4">
                                    <label for="images" class="fw-semibold">Rasmlar</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="file" name="images[]" id="images_{{ $section->id }}" class="form-control" multiple>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        $(document).ready(function() {
            $('.max-select').select2({
                theme: 'bootstrap-5',
                placeholder: 'Tanlang...',
                allowClear: true
            });

            @foreach($building->sections as $section)
            // Update the floor select when a section is selected
            $('#section_id_{{ $section->id }}').on('change', function() {
                let selectedSectionId = $(this).val();
                let sectionData = @json($building->sections);

                let selectedSection = sectionData.find(section => section.id == selectedSectionId);
                let floorSelect = $('#number_{{ $section->id }}');

                floorSelect.empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                if (selectedSection) {
                    for (let i = 1; i <= selectedSection.floor; i++) {
                        floorSelect.append('<option value="' + i + '">' + i + '</option>');
                    }
                }
            });
            @endforeach
        });
    </script>
@endsection
