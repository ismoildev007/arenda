@extends('layouts.client')

@section('content')
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main style="margin-left: 0;" class="nxl-container">
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
                    <div style="margin-bottom:50px;" class="col-xxl-4 col-xl-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="mb-4 text-center">
                                    <!-- resources/views/profile.blade.php -->
                                    <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                        <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3" onclick="document.getElementById('imageUpload').click();">
                                            <img src="{{ asset('storage/avatars/' . auth()->guard('client')->user()->image ) }}" alt="" class="img-fluid">
                                        </div>
                                        <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle" style="top: 76%; right: 10px">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                    </div>

                                    <!-- Hidden file input -->
                                    <form id="uploadForm" method="POST" enctype="multipart/form-data" action="{{ route('profile.uploadAvatar') }}" style="display:none;">
                                        @csrf
                                        <input type="file" id="imageUpload" name="avatar" accept="image/*" onchange="uploadImage()">
                                    </form>
                                    <script>
                                    function uploadImage() {
                                        var form = document.getElementById('uploadForm');
                                        var input = document.getElementById('imageUpload');
                                        
                                        if (input.files && input.files[0]) {
                                            // Optionally, you can display a preview before uploading
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                document.querySelector('.avatar-image img').src = e.target.result;
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                            
                                            // Submit the form for upload
                                            form.submit();
                                        }
                                    }
                                    </script>
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
                                                {{--Umumiy narx ({{ $interval->days }} kun --}}
                                                @if($contract->room !== null)
                                                    {{ $contract->room->size }} m<sup>2</sup>
                                                @elseif($contract->floor !== null)
                                                    {{ $contract->floor->size }} m<sup>2</sup>
                                                @elseif($contract->section !== null)
                                                    {{ $contract->section->size }} m<sup>2</sup>
                                                @else
                                                    N/A
                                                @endif
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
                                <!-- <div class="d-flex gap-3 justify-content-center pt-4">
                                    <form class="btn-group w-50" action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
                                            <i class="feather-trash-2 me-2"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                    <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary w-50">
                                        <i class="feather-edit me-2"></i>
                                        <span>Edit</span>
                                    </a>
                                </div> -->
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
                    <div style="padding-bottom:50px;" class="col-xxl-8 col-xl-6">
                        <div class="card border-top-0">
                            <div class="card-header p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#billingTab" role="tab">Room</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#activityTab" role="tab">Activity</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Notifications</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#connectionTab" role="tab">Connection</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">

                                    <div class="col-lg-12">
                                        <div class="card border-top-0">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                         <th>Contract Number</th>
                                                        <th>Section</th>
                                                        <th>Floor</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Discount %</th>
                                                        <th>Payment Status</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contracts as $contract)
                                                    
                                                        <tr>
                                                            <td>{{ $contract->contract_number }}</td>
                                                            <td>{{ $contract->section ? $contract->section->name : 'N/A' }}</td>
                                                            <td>{{ $contract->floor ? $contract->floor->number : 'N/A' }}</td>
                                                            <td>{{ $contract->start_date }}</td>
                                                            <td>{{ $contract->end_date }}</td>
                                                            <td>{{ number_format($contract->discount) }} %</td>
                                                            <td>
                                                            @if ($contract->payment_status == 'paid')
                                                                <p style="color:green;"><b>{{ $contract->payment_status }}</b></p>
                                                            @else 
                                                                <p style="color:red;"><b>{{ $contract->payment_status }}</b></p>
                                                            @endif
                                                            </td>
                                                            <td>
                                                            @if ($contract->status == 'active')
                                                                <p style="color:green;"><b>{{ $contract->status }}</b></p>
                                                            @else 
                                                                <p style="color:red;"><b>{{ $contract->status }}</b></p>
                                                            @endif
                                                            </td>
                                                            <td>
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <a href="{{ route('client.contract.show', ['id' => $contract->id]) }}" class="avatar-text avatar-md">
                                                                        <i class="feather-eye"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
                                   
                                </div>
                                <div class="tab-pane fade" id="billingTab" role="tabpanel">
                                    
                                    <div class="profile-details mb-5 m-4">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Room Details:</h5>
                                        </div>
<style>
    .btn-link {
        color: #007bff; /* Adjust the color to match your theme */
        font-size: 16px; /* Adjust the font size if needed */
    }

    .btn-link:hover {
        color: #0056b3; /* Darker color on hover for better visibility */
        text-decoration: underline; /* Add underline on hover for emphasis */
    }
</style>

                                         @foreach($contracts as $contract)
                                            <div class="card mb-4">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">Contract Number: {{ $contract->contract_number ?? 'N/A' }}</h6>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#contract-{{ $contract->id }}">
                                                        Details
                                                    </button>
                                                </div>
                                                <div id="contract-{{ $contract->id }}" class="collapse">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6>Room Details</h6>
                                                                <ul class="list-unstyled">
                                                                    <li class="mt-5"><strong>Room:</strong> {{ $contract->room ? $contract->room->number . ' - Xona' : 'N/A' }}</li>
                                                                    <li class="mt-5"><strong>Room Size:</strong> {!! $contract->room ? $contract->room->size . ' m<sup>2</sup>' : 'N/A' !!}</li>
                                                                    <li class="mt-5"><strong>Client:</strong> {{ $contract->client ? $contract->client->first_name . ' ' . $contract->client->last_name : 'N/A' }}</li>
                                                                    <li class="mt-5"><strong>Start Date:</strong> {{ $contract->start_date ? $contract->start_date->format('d M, Y') : 'N/A' }}</li>
                                                                    <li class="mt-5"><strong>End Date:</strong> {{ $contract->end_date ? $contract->end_date->format('d M, Y') : 'N/A' }}</li>
                                                                    <li class="mt-5"><strong>Discount %:</strong> {{ $contract->discount !== null ? number_format($contract->discount, 2) . ' %' : 'N/A' }}</li>
                                                                    <li class="mt-5"><strong>Total Amount:</strong> {{ $contract->total_amount !== null ? number_format($contract->total_amount, 0, '.', ',') . ' so\'m' : 'N/A' }}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <h6>Room Image</h6>
                                                                @if(isset($contract->room->images))
                                                                    @foreach ($contract->room->images as $image)
                                                                    <img src="{{ $image ? asset('storage/' . $image) : asset('/assets/images/default-room.png') }}" class="img-fluid mt-2" alt="Room Image">
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="activityTab" role="tabpanel">
                                    <div class="recent-activity p-4 pb-0">
                                        <div class="mb-4 pb-2 d-flex justify-content-between">
                                            <h5 class="fw-bold">Recent Activity:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <ul class="list-unstyled activity-feed">
                                            <li class="d-flex justify-content-between feed-item feed-item-success">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">Reynante placed new order <span class="date">[April 19, 2023]</span></span>
                                                    <span class="text">New order placed <a href="javascript:void(0);" class="fw-bold text-primary">#456987</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-info">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">5+ friends join this group <span class="date">[April 20, 2023]</span></span>
                                                    <span class="text">Joined the group <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux"</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-secondary">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">Socrates send you friend request <span class="date">[April 21, 2023]</span></span>
                                                    <span class="text">New friend request <a href="javascript:void(0);" class="badge bg-soft-success text-success ms-1">Conform</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-warning">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">Reynante make deposit $565 USD <span class="date">[April 22, 2023]</span></span>
                                                    <span class="text">Make deposit <a href="javascript:void(0);" class="fw-bold text-primary">$565 USD</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-primary">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">New event are coming soon <span class="date">[April 23, 2023]</span></span>
                                                    <span class="text">Attending the event <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux Event"</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-info">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">5+ friends join this group <span class="date">[April 20, 2023]</span></span>
                                                    <span class="text">Joined the group <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux"</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-danger">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">New meeting joining are pending <span class="date">[April 23, 2023]</span></span>
                                                    <span class="text">Duralux meeting <a href="javascript:void(0);" class="badge bg-soft-warning text-warning ms-1">Join</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-info">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">5+ friends join this group <span class="date">[April 20, 2023]</span></span>
                                                    <span class="text">Joined the group <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux"</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-secondary">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">Socrates send you friend request <span class="date">[April 21, 2023]</span></span>
                                                    <span class="text">New friend request <a href="javascript:void(0);" class="badge bg-soft-success text-success ms-1">Conform</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-warning">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">Reynante make deposit $565 USD <span class="date">[April 22, 2023]</span></span>
                                                    <span class="text">Make deposit <a href="javascript:void(0);" class="fw-bold text-primary">$565 USD</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between feed-item feed-item-primary">
                                                <div>
                                                    <span class="text-truncate-1-line lead_date">New event are coming soon <span class="date">[April 23, 2023]</span></span>
                                                    <span class="text">Attending the event <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux Event"</a></span>
                                                </div>
                                                <div class="ms-3 d-flex gap-2 align-items-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Make Read"><i class="feather feather-check fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="More Options"><i class="feather feather-more-vertical"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="javascript:void(0);" class="d-flex align-items-center text-muted">
                                            <i class="feather feather-more-horizontal fs-12"></i>
                                            <span class="fs-10 text-uppercase ms-2 text-truncate-1-line">Load More</span>
                                        </a>
                                    </div>
                                    <hr>
                                    <div class="logs-history mb-0">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Logs History</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-dark text-center border-top">
                                                <tr>
                                                    <th class="text-start ps-4">Browser</th>
                                                    <th>IP</th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Chrome on Window</td>
                                                    <td><span class="text-muted">192.149.122.128</span></td>
                                                    <td>
                                                        <span class="text-muted"> <span class="d-none d-sm-inline-block">11:34 PM</span></span>
                                                    </td>
                                                    <td><i class="feather feather-check-circle text-success"></i></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Mozilla on Window</td>
                                                    <td><span class="text-muted">186.188.154.225</span></td>
                                                    <td>
                                                        <span class="text-muted">Nov 20, 2023 <span class="d-none d-sm-inline-block">10:34 PM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Chrome on iMac</td>
                                                    <td><span class="text-muted">192.149.122.128</span></td>
                                                    <td>
                                                        <span class="text-muted">Oct 23, 2023 <span class="d-none d-sm-inline-block">04:16 PM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Mozilla on Window</td>
                                                    <td><span class="text-muted">186.188.154.225</span></td>
                                                    <td>
                                                        <span class="text-muted">Nov 20, 2023 <span class="d-none d-sm-inline-block">10:34 PM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Chrome on Window</td>
                                                    <td><span class="text-muted">192.149.122.128</span></td>
                                                    <td>
                                                        <span class="text-muted">Oct 23, 2023 <span class="d-none d-sm-inline-block">04:16 PM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Chrome on iMac</td>
                                                    <td><span class="text-muted">192.149.122.128</span></td>
                                                    <td>
                                                        <span class="text-muted">Oct 15, 2023 <span class="d-none d-sm-inline-block">11:41 PM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Mozilla on Window</td>
                                                    <td><span class="text-muted">186.188.154.225</span></td>
                                                    <td>
                                                        <span class="text-muted">Oct 13, 2023 <span class="d-none d-sm-inline-block">05:43 AM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium text-dark text-start ps-4">Chrome on iMac</td>
                                                    <td><span class="text-muted">192.149.122.128</span></td>
                                                    <td>
                                                        <span class="text-muted">Oct 03, 2023 <span class="d-none d-sm-inline-block">04:12 AM</span></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"><i class="feather feather-x text-danger"></i></a>
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
                                        <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/dropbox.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Dropbox: Cloud Storage & File Sharing</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">Dropbox brings everything—traditional files, cloud content, and web shortcuts—together in one place. ... Save and access your files from any device, and share ...</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchDropbox"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchDropbox" checked>
                                            </div>
                                        </div>
                                        <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/github.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">GitHub: Where the world builds software</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">GitHub is where over 83 million developers shape the future of software, together. Contribute to the open source community, manage your Git repositories, ...</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchGitHub"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchGitHub" checked>
                                            </div>
                                        </div>
                                        <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/gitlab.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">GitLab: The One DevOps Platform</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">GitLab helps you automate the builds, integration, and verification of your code. With SAST, DAST, code quality analysis, plus pipelines that enable ...</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchGitLab"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchGitLab">
                                            </div>
                                        </div>
                                        <div class="hstack justify-content-between p-4 mb-3 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/shopify.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">Shopify: Ecommerce Developers Platform</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">Try Shopify free and start a business or grow an existing one. Get more than ecommerce software with tools to manage every part of your business.</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchShopify"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchShopify" checked>
                                            </div>
                                        </div>
                                        <div class="hstack justify-content-between p-4 border border-dashed border-gray-3 rounded-1">
                                            <div class="hstack me-4">
                                                <div class="wd-40">
                                                    <img src="/assets/images/brand/whatsapp.png" class="img-fluid" alt="">
                                                </div>
                                                <div class="ms-4">
                                                    <a href="javascript:void(0);" class="fw-bold mb-1 text-truncate-1-line">WhatsApp: WhatsApp from Facebook is a FREE messaging and video calling app</a>
                                                    <div class="fs-12 text-muted text-truncate-1-line">Reliable messaging. With WhatsApp, you'll get fast, simple, secure messaging and calling for free*, available on phones all ...</div>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch form-switch-sm">
                                                <label class="form-check-label fw-500 text-dark c-pointer" for="formSwitchWhatsApp"></label>
                                                <input class="form-check-input c-pointer" type="checkbox" id="formSwitchWhatsApp">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

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
                                    <div class="p-4 mb-4 border border-dashed border-gray-3 rounded-1">
                                        <h6 class="fw-bolder"><a href="javascript:void(0);">Secondary Verification</a></h6>
                                        <div class="fs-12 text-muted text-truncate-3-line mt-2 mb-4">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</div>
                                        <div class="form-check form-switch form-switch-sm">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="secondaryVerification">Set up secondary method</label>
                                            <input class="form-check-input c-pointer" type="checkbox" id="secondaryVerification" checked>
                                        </div>
                                    </div>
                                    <div class="p-4 mb-4 border border-dashed border-gray-3 rounded-1">
                                        <h6 class="fw-bolder"><a href="javascript:void(0);">Backup Codes</a></h6>
                                        <div class="fs-12 text-muted text-truncate-3-line mt-4 mb-4">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</div>
                                        <div class="form-check form-switch form-switch-sm">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="generateBackup">Generate backup codes</label>
                                            <input class="form-check-input c-pointer" type="checkbox" id="generateBackup">
                                        </div>
                                    </div>
                                    <div class="p-4 border border-dashed border-gray-3 rounded-1">
                                        <h6 class="fw-bolder"><a href="javascript:void(0);">Login Verification</a></h6>
                                        <div class="fs-12 text-muted text-truncate-3-line mt-2 mb-4">Login verification is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</div>
                                        <div class="form-check form-switch form-switch-sm">
                                            <label class="form-check-label fw-500 text-dark c-pointer" for="loginVerification">Enable Login Verification</label>
                                            <input class="form-check-input c-pointer" type="checkbox" id="loginVerification" checked>
                                        </div>
                                    </div>
                                    <hr class="my-5">
                                    <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-danger-message" role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-triangle text-danger fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-0 text-truncate-1-line">You Are Delete or Deactivating Your Account</p>
                                            <p class="text-truncate-3-line mt-2 mb-4">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.</p>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger d-inline-block">Learn more</a>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <h6 class="fw-bold">Delete Account</h6>
                                            <p class="fs-11 text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account:</p>
                                            <div class="my-4 py-2">
                                                <input type="password" class="form-control" placeholder="Enter your password">
                                                <div class="mt-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="acDeleteDeactive">
                                                        <label class="custom-control-label c-pointer" for="acDeleteDeactive">I confirm my account deletations or deactivation.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-sm-flex gap-2">
                                                <a href="javascript:void(0);" class="btn btn-danger" data-action-target="#acSecctingsActionMessage">Delete Account</a>
                                                <a href="javascript:void(0);" class="btn btn-warning mt-2 mt-sm-0 successAlertMessage">Deactiveted Account</a>
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
