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
                        <h5 class="m-b-10">Contract</h5>
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
                            <a href="{{ route('contracts.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Shartnoma yaratish</span>
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
                                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $contract->client->first_name ?? 'N/A' }} {{ $contract->client->last_name ?? 'N/A' }} </a>
                                        <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block">
                                            @if($contract->client->pinfl !== null)
                                                {{ $contract->client->pinfl }}
                                            @elseif($contract->client->inn !== null)
                                                {{ $contract->client->inn }}
                                            @else
                                                N/A
                                            @endif
                                        </a>
                                    </div>

                                    

                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">
                                                @if($contract->room !== null)
                                                    {{ number_format($contract->room->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                @elseif($contract->floor !== null)
                                                    {{ number_format($contract->floor->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                @elseif($contract->section !== null)
                                                    {{ number_format($contract->section->price_per_sqm, 0, '.', ',') . ' so\'m' }}
                                                @else
                                                    N/A
                                                @endif
                                            </h6>
                                            <p class="fs-12 text-muted mb-0">1 m<sup>2</sup></p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">
                                                {{ $contract->discount ? number_format($contract->discount, 0, '.', ',') . ' %' : 'N/A' }}
                                            </h6>
                                            <p class="fs-12 text-muted mb-0">Chegirma %</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">
                                                {{ $contract->total_amount ? number_format($contract->total_amount, 0, '.', ',') . ' so\'m' : 'N/A' }}
                                            </h6>
                                            <p class="fs-12 text-muted mb-0">
                                                Umumiy narx ({{ $interval->days }} kun 
                                                @if($contract->room !== null)
                                                    {{ $contract->room->size }} m {!! '<sup>2</sup>' !!}
                                                @elseif($contract->floor !== null)
                                                    {{ $contract->floor->size }} m {!! '<sup>2</sup>' !!}
                                                @elseif($contract->section !== null)
                                                    {{ $contract->section->size }} m {!! '<sup>2</sup>' !!}
                                                @else
                                                    N/A
                                                @endif)
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <ul class="list-unstyled mb-4">
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-map-pin"></i>Location</span>
                                        <a href="javascript:void(0);" class="float-end"> {{ $contract->client->region ? $contract->client->region->name : 'N/A' }}, {{ $contract->client->district ? $contract->client->district->name : 'N/A' }}</a>
                                    </li>
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-home"></i>Filial</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $contract->building ? $contract->building->name : 'N/A' }}</a>
                                    </li>
                                    <li class="hstack justify-content-between mb-4">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-clock"></i>Boshlanish sanasi</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $contract->start_date }}</a>
                                    </li>
                                    <li class="hstack justify-content-between mb-0">
                                        <span class="text-muted fw-medium hstack gap-3"><i class="feather-clock"></i>Tugash sanasi</span>
                                        <a href="javascript:void(0);" class="float-end">{{ $contract->end_date }}</a>
                                    </li>
                                </ul>
                                <div class="d-flex gap-3 justify-content-center pt-4">
                                    <!-- Delete Button -->
                                    <form class="btn-group w-50" action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                            <i class="feather-trash-2 me-2"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                    <!-- Edit Button -->
                                    <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary w-50">
                                        <i class="feather-edit me-2"></i>
                                        <span>Edit</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!--
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Social</h5>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25,25">
                                        <i class="feather feather-more-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-lock me-3"></i>
                                                <span>Only Me</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-globe me-3"></i>
                                                <span>Everyone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-users me-3"></i>
                                                <span>Anonymous</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-user-check me-3"></i>
                                                <span>People I Follow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-eye me-3"></i>
                                                <span>People Follow Me</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-settings me-3"></i>
                                                <span>Custom Selections Ever</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-text bg-gray-100">
                                        <i class="feather feather-facebook"></i>
                                    </div>
                                    <span class="mx-2 text-gray-300">/</span>
                                    <a href="https://www.facebook.com/wrapcoders" target="_blank" class="text-truncate-1-line">https://www.facebook.com/<span class="text-muted">wrapcoders</span></a>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-text bg-gray-100">
                                        <i class="feather feather-twitter"></i>
                                    </div>
                                    <span class="mx-2 text-gray-300">/</span>
                                    <a href="https://www.twitter.com/wrapcoders" target="_blank" class="text-truncate-1-line">https://www.twitter.com/<span class="text-muted">wrapcoders</span></a>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-text bg-gray-100">
                                        <i class="feather feather-github"></i>
                                    </div>
                                    <span class="mx-2 text-gray-300">/</span>
                                    <a href="https://www.github.com/wrapcoders" target="_blank" class="text-truncate-1-line">https://www.github.com/<span class="text-muted">wrapcoders</span></a>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-text bg-gray-100">
                                        <i class="feather feather-linkedin"></i>
                                    </div>
                                    <span class="mx-2 text-gray-300">/</span>
                                    <a href="https://www.linkedin.com/wrapcoders" target="_blank" class="text-truncate-1-line">https://www.linkedin.com/<span class="text-muted">wrapcoders</span></a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-text bg-gray-100">
                                        <i class="feather feather-youtube"></i>
                                    </div>
                                    <span class="mx-2 text-gray-300">/</span>
                                    <a href="https://www.youtube.com/wrapcoders" target="_blank" class="text-truncate-1-line">https://www.youtube.com/<span class="text-muted">wrapcoders</span></a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="ladda-button zoom-out" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Refresh Now">
                                <span>Refresh</span>
                                <span class="spinner"></span>
                            </a>
                        </div>
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h2 class="card-title">Suggestions</h2>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown" data-bs-offset="25,25">
                                        <i class="feather feather-more-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-lock me-3"></i>
                                                <span>Only Me</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-globe me-3"></i>
                                                <span>Everyone</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-users me-3"></i>
                                                <span>Anonymous</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-user-check me-3"></i>
                                                <span>People I Follow</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-eye me-3"></i>
                                                <span>People Follow Me</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                <i class="feather feather-settings me-3"></i>
                                                <span>Custom Selections Ever</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-image flex-shrink-0 me-3">
                                        <img src="/assets/images/avatar/1.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="fs-13 mb-1">Alexandra Della</h5>
                                            <p class="fs-12 text-muted mb-0">Frontend Developer</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md"><i class="feather feather-user-plus align-middle"></i></a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="bg-warning text-white avatar-text">B</div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="fs-13 mb-1">Bryan Waters</h5>
                                            <p class="fs-12 text-muted mb-0">UI/UX Designer</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md"><i class="feather feather-user-plus align-middle"></i></a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-image flex-shrink-0 me-3">
                                        <img src="/assets/images/avatar/2.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="fs-13 mb-1">Curtis Green</h5>
                                            <p class="fs-12 text-muted mb-0">Backend Developer</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md"><i class="feather feather-user-plus align-middle"></i></a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="bg-danger text-white avatar-text">E</div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="fs-13 mb-1">Edward Andrade</h5>
                                            <p class="fs-12 text-muted mb-0">Fullstack Designer</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md"><i class="feather feather-user-plus align-middle"></i></a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-image flex-shrink-0 me-3">
                                        <img src="/assets/images/avatar/3.png" class="img-fluid" alt="">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                            <h5 class="fs-13 mb-1">Marianne Audrey</h5>
                                            <p class="fs-12 text-muted mb-0">Fullstack Developer</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md"><i class="feather feather-user-plus align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="ladda-button zoom-out" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Refresh Now">
                                <span>Refresh</span>
                                <span class="spinner"></span>
                            </a>
                        </div>
                         -->
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
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#billingTab" role="tab">Billing <span class="text-danger"> (cooming soon)  </span></a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Notifications <span class="text-danger"> (cooming soon)  </span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">

                                    <div class="profile-details mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Contract Details:</h5>
                                            <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-sm btn-light-brand">Edit Contract</a>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Shartnoma raqam:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $contract->contract_number ?? 'N/A' }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Xona:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->room ? $contract->room->number . ' - xona' : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Xona hajmi:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {!! $contract->room ? $contract->room->size . ' - m <sup>2</sup>' : 'N/A' !!}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Client:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->client ? $contract->client->first_name . ' ' . $contract->client->last_name : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Boshlanish sanasi:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->start_date ? $contract->start_date->format('d M, Y') : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Tugash sanasi:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->end_date ? $contract->end_date->format('d M, Y') : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Chegirma %:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->discount !== null ? number_format($contract->discount, 2) . ' %' : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Umumiy narx:</div>
                                            <div class="col-sm-6 fw-semibold">
                                                {{ $contract->total_amount !== null ? number_format($contract->total_amount, 0, '.', ',') . ' so\'m' : 'N/A' }}
                                            </div>
                                        </div>
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
                                    <div class="subscription-plan px-4 pt-4">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Subscription & Plan:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">4 days remaining</a>
                                        </div>
                                        <div class="p-4 mb-4 d-xxl-flex d-xl-block d-md-flex align-items-center justify-content-between gap-4 border border-dashed border-gray-5 rounded-1">
                                            <div>
                                                <div class="fs-14 fw-bold text-dark mb-1">Your current plan is <a href="javascript:void(0);" class="badge bg-primary text-white ms-2">Team Plan</a></div>
                                                <div class="fs-12 text-muted">A simple start for everyone</div>
                                            </div>
                                            <div class="my-3 my-xxl-0 my-md-3 my-md-0">
                                                <div class="fs-20 text-dark"><span class="fw-bold">$29.99</span> / <em class="fs-11 fw-medium">Month</em></div>
                                                <div class="fs-12 text-muted mt-1">Billed Monthly / Next payment on 12/10/2023 for <strong class="text-dark">$62.48</strong></div>
                                            </div>
                                            <div class="hstack gap-3">
                                                <a href="javascript:void(0);" class="text-danger">Cancel Plan</a>
                                                <a href="javascript:void(0);" class="btn btn-light-brand">Update Plan</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-4 col-xl-12 col-lg-4">
                                                <a href="javascript:void(0);" class="p-4 mb-4 d-block bg-soft-100 border border-dashed border-gray-5 rounded-1">
                                                    <h6 class="fs-13 fw-bold">BASIC</h6>
                                                    <p class="fs-12 fw-normal text-muted">Starter plan for individuals.</p>
                                                    <p class="fs-12 fw-normal text-muted text-truncate-2-line">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod ipsa id corrupti modi, impedit exercitationem harum voluptates reiciendis.</p>
                                                    <div class="mt-4"><span class="fs-16 fw-bold text-dark">$12.99</span> / <em class="fs-11 fw-medium">Month</em></div>
                                                </a>
                                            </div>
                                            <div class="col-xxl-4 col-xl-12 col-lg-4">
                                                <a href="javascript:void(0);" class="p-4 mb-4 d-block bg-soft-200 border border-dashed border-gray-5 rounded-1 position-relative">
                                                    <h6 class="fs-13 fw-bold">TEAM</h6>
                                                    <p class="fs-12 fw-normal text-muted">Collaborate up to 10 people.</p>
                                                    <p class="fs-12 fw-normal text-muted text-truncate-2-line">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod ipsa id corrupti modi, impedit exercitationem harum voluptates reiciendis.</p>
                                                    <div class="mt-4"><span class="fs-16 fw-bold text-dark">$29.99</span> / <em class="fs-11 fw-medium">Month</em></div>
                                                    <div class="position-absolute top-0 start-50 translate-middle">
                                                        <i class="feather-check fs-12 bg-primary text-white p-1 rounded-circle"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-xxl-4 col-xl-12 col-lg-4">
                                                <a href="javascript:void(0);" class="p-4 mb-4 d-block bg-soft-100 border border-dashed border-gray-5 rounded-1">
                                                    <h6 class="fs-13 fw-bold">ENTERPRISE</h6>
                                                    <p class="fs-12 fw-normal text-muted">For bigger businesses.</p>
                                                    <p class="fs-12 fw-normal text-muted text-truncate-2-line">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod ipsa id corrupti modi, impedit exercitationem harum voluptates reiciendis.</p>
                                                    <div class="mt-4"><span class="fs-16 fw-bold text-dark">$49.99</span> / <em class="fs-11 fw-medium">Month</em></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="payment-methord px-4">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Payment Methords:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Add Methord</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-12 col-lg-6">
                                                <div class="px-4 py-2 mb-4 d-sm-flex justify-content-between border border-dashed border-gray-3 rounded-1 position-relative">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="wd-100">
                                                            <img src="/assets/images/payment/mastercard.svg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="ms-0 ms-sm-3">
                                                            <div class="text-dark fw-bold mb-2">Alexandra Della</div>
                                                            <div class="mb-0 text-truncate-1-line">5155 **** **** ****</div>
                                                            <small class="fs-10 fw-medium text-uppercase text-muted text-truncate-1-line">Card expires at 12/24</small>
                                                        </div>
                                                    </div>
                                                    <div class="hstack gap-3 mt-3 mt-sm-0">
                                                        <a href="javascript:void(0);" class="text-danger">Delete</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Edit</a>
                                                    </div>
                                                    <div class="position-absolute top-50 start-0 translate-middle">
                                                        <i class="feather-check fs-12 bg-primary text-white p-1 rounded-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-12 col-lg-6">
                                                <div class="px-4 py-2 mb-4 d-sm-flex justify-content-between border border-dashed border-gray-3 rounded-1">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="wd-100">
                                                            <img src="/assets/images/payment/visa.svg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="ms-0 ms-sm-3">
                                                            <div class="text-dark fw-bold mb-2">Alexandra Della</div>
                                                            <div class="mb-0 text-truncate-1-line">4236 **** **** ****</div>
                                                            <small class="fs-10 fw-medium text-uppercase text-muted text-truncate-1-line">Card expires at 11/23</small>
                                                        </div>
                                                    </div>
                                                    <div class="hstack gap-3 mt-3 mt-sm-0">
                                                        <a href="javascript:void(0);" class="text-danger">Delete</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-12 col-lg-6">
                                                <div class="px-4 py-2 mb-4 d-sm-flex justify-content-between border border-dashed border-gray-3 rounded-1">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="wd-100">
                                                            <img src="/assets/images/payment/american-express.svg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="ms-0 ms-sm-3">
                                                            <div class="text-dark fw-bold mb-2">Alexandra Della</div>
                                                            <div class="mb-0 text-truncate-1-line">3437 **** **** ****</div>
                                                            <small class="fs-10 fw-medium text-uppercase text-muted text-truncate-1-line">Card expires at 11/24</small>
                                                        </div>
                                                    </div>
                                                    <div class="hstack gap-3 mt-3 mt-sm-0">
                                                        <a href="javascript:void(0);" class="text-danger">Delete</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-12 col-lg-6">
                                                <div class="px-4 py-2 mb-4 d-sm-flex justify-content-between border border-dashed border-gray-3 rounded-1">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="wd-100">
                                                            <img src="/assets/images/payment/discover.svg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="ms-0 ms-sm-3">
                                                            <div class="text-dark fw-bold mb-2">Alexandra Della</div>
                                                            <div class="mb-0 text-truncate-1-line">6011 **** **** ****</div>
                                                            <small class="fs-10 fw-medium text-uppercase text-muted text-truncate-1-line">Card expires at 11/25</small>
                                                        </div>
                                                    </div>
                                                    <div class="hstack gap-3 mt-3 mt-sm-0">
                                                        <a href="javascript:void(0);" class="text-danger">Delete</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <tr>
                                                    <td><a href="javascript:void(0);">#456321</a></td>
                                                    <td>31 NOV, 2022</td>
                                                    <td>$450</td>
                                                    <td><span class="badge bg-soft-danger text-danger">Reject</span></td>
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
                                                    <td><a href="javascript:void(0);">#357951</a></td>
                                                    <td>03 JAN, 2023</td>
                                                    <td>$250</td>
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
                                                    <td><a href="javascript:void(0);">#357951</a></td>
                                                    <td>03 JAN, 2023</td>
                                                    <td>$250</td>
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="notificationsTab" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="wd-250 text-end">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Successful payments</div>
                                                    <small class="fs-12 text-muted">Receive a notification for every successful payment.</small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail" selected>Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Customer payment dispute</div>
                                                    <small class="fs-12 text-muted">Receive a notification if a payment is disputed by a customer and for dispute purposes. </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off" selected>Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Refund alerts</div>
                                                    <small class="fs-12 text-muted">Receive a notification if a payment is stated as risk by the Finance Department. </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell" selected>Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Invoice payments</div>
                                                    <small class="fs-12 text-muted">Receive a notification if a customer sends an incorrect amount to pay their invoice. </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail" selected>Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Rating reminders</div>
                                                    <small class="fs-12 text-muted">Send an email reminding me to rate an item a week after purchase </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off" selected>Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Item update notifications</div>
                                                    <small class="fs-12 text-muted">Send an email when an item I've purchased is updated </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone" selected>SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Item comment notifications</div>
                                                    <small class="fs-12 text-muted">Send me an email when someone comments on one of my items </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone" selected>SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Team comment notifications</div>
                                                    <small class="fs-12 text-muted">Send me an email when someone comments on one of my team items </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail" selected>Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Item review notifications</div>
                                                    <small class="fs-12 text-muted">Send me an email when my items are approved or rejected </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off" selected>Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Buyer review notifications</div>
                                                    <small class="fs-12 text-muted">Send me an email when someone leaves a review with their rating </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone" selected>SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Expiring support notifications</div>
                                                    <small class="fs-12 text-muted">Send me emails showing my soon to expire support entitlements </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell">Push</option>
                                                            <option value="Email" data-icon="feather-mail" selected>Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-dark">Daily summary emails</div>
                                                    <small class="fs-12 text-muted">Send me a daily summary of all items approved or rejected </small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-group select-wd-lg">
                                                        <select class="form-control" data-select2-selector="icon">
                                                            <option value="SMS" data-icon="feather-smartphone">SMS</option>
                                                            <option value="Push" data-icon="feather-bell" selected>Push</option>
                                                            <option value="Email" data-icon="feather-mail">Email</option>
                                                            <option value="Repeat" data-icon="feather-repeat">Repeat</option>
                                                            <option value="Deactivate" data-icon="feather-bell-off">Deactivate</option>
                                                            <option value="SMS+Push" data-icon="feather-smartphone">SMS + Push</option>
                                                            <option value="Email+Push" data-icon="feather-mail">Email + Push</option>
                                                            <option value="SMS+Email" data-icon="feather-smartphone">SMS + Email</option>
                                                            <option value="SMS+Push+Email" data-icon="feather-smartphone">SMS + Push + Email</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="notify-activity-section">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Account Activity</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <div class="px-4">
                                            <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                                <div class="hstack me-4">
                                                    <div class="avatar-text">
                                                        <i class="feather-message-square"></i>
                                                    </div>
                                                    <div class="ms-4">
                                                        <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Someone comments on one of my items</a>
                                                        <div class="fs-12 text-muted text-truncate-1-line">If someone comments on one of your items, it's important to respond in a timely and appropriate manner.</div>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch form-switch-sm">
                                                    <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchComment"></label>
                                                    <input class="form-check-input c-pointer" type="checkbox" id="formSwitchComment">
                                                </div>
                                            </div>
                                            <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                                <div class="hstack me-4">
                                                    <div class="avatar-text">
                                                        <i class="feather-briefcase"></i>
                                                    </div>
                                                    <div class="ms-4">
                                                        <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Someone replies to my job posting</a>
                                                        <div class="fs-12 text-muted text-truncate-1-line">Great! It's always exciting to hear from someone who's interested in a job posting you've put out.</div>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch form-switch-sm">
                                                    <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchReplie"></label>
                                                    <input class="form-check-input c-pointer" type="checkbox" id="formSwitchReplie">
                                                </div>
                                            </div>
                                            <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                                <div class="hstack me-4">
                                                    <div class="avatar-text">
                                                        <i class="feather-briefcase"></i>
                                                    </div>
                                                    <div class="ms-4">
                                                        <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Someone mentions or follows me</a>
                                                        <div class="fs-12 text-muted text-truncate-1-line">If you received a notification that someone mentioned or followed you, take a moment to read it and understand what it means.</div>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch form-switch-sm">
                                                    <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchFollow"></label>
                                                    <input class="form-check-input c-pointer" type="checkbox" id="formSwitchFollow">
                                                </div>
                                            </div>
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
