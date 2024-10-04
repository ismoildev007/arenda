@extends('layouts.layout')

@section('content')
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
<style>
.table-responsive {
    overflow-x: visible !important;
    -webkit-overflow-scrolling: touch;
}


</style>
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Obyekt</h5>
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
                                    <li><a class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#sectionOffcanvas">Create Section</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#floorOffcanvas">Create Floor</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#roomOffcanvas">Create Room</a></li>
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
                                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> {{ $building->name  }} </a>
                                    </div>
                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">{{ $building->size }}</h6>
{{--                                            <h6 class="fs-15 fw-bolder">{{ $building->rooms->sum('size') }}</h6>--}}
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
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#billingTab" role="tab">Clients</a>   
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#activityTab" role="tab">Sections</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#notificationsTab" role="tab">Floors</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link" data-bs-toggle="tab" data-bs-target="#connectionTab" role="tab">Rooms</a>
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
                                            <div class="col-sm-6 text-muted">Obyekt nomi:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Obyekt egasi ism familiaysi:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->first_name }} {{ $building->last_name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Region:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->region->name }}</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">District:</div>
                                            <div class="col-sm-6 fw-semibold">{{ $building->district->name }}</div>
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
                                            <h5 class="fw-bold mb-0">Clients:</h5>
                                            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-light-brand">Alls History</a>
                                        </div>

                                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item flex-fill border-top" role="presentation">
                                                <a href="javascript:void(0);" class="nav-link active" id="physical-persons-tab" data-bs-toggle="tab" data-bs-target="#physical-persons-content" role="tab">Jismoniy shaxslar</a>
                                            </li>
                                            <li class="nav-item flex-fill border-top" role="presentation">
                                                <a href="javascript:void(0);" class="nav-link" id="legal-persons-tab" data-bs-toggle="tab" data-bs-target="#legal-persons-content" role="tab">Yuridik shaxslar</a>
                                            </li>
                                            <li class="nav-item flex-fill border-top" role="presentation">
                                                <a href="javascript:void(0);" class="nav-link" id="all-clients-tab" data-bs-toggle="tab" data-bs-target="#all-clients-content" role="tab">Barchasi</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content mt-3" id="myTabContent">
                                            <div class="tab-pane fade show active" id="physical-persons-content" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr class="border-top">
                                                                <th>ID</th>
                                                                <th>Client Name</th>
                                                                <th>PINFL</th>
                                                                <th>Company</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($building->contracts as $contract)
                                                                @if($contract->client && $contract->client->pinfl !== null)
                                                                    <tr class="client-row" data-type="physical">
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $contract->client->first_name }} {{ $contract->client->last_name }}</td>
                                                                        <td>{{ $contract->client->pinfl }}</td>
                                                                        <td>
                                                                            @if($contract->client->company_name !== null)
                                                                                {{ $contract->client->company_name }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="legal-persons-content" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr class="border-top">
                                                                <th>ID</th>
                                                                <th>Client Name</th>
                                                                <th>INN</th>
                                                                <th>Company</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($building->contracts as $contract)
                                                                @if($contract->client && $contract->client->pinfl === null)
                                                                    <tr class="client-row" data-type="legal">
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $contract->client->first_name }} {{ $contract->client->last_name }}</td>
                                                                        <td>
                                                                            @if($contract->client->inn !== null)
                                                                                {{ $contract->client->inn }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($contract->client->company_name !== null)
                                                                                {{ $contract->client->company_name }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="all-clients-content" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr class="border-top">
                                                                <th>ID</th>
                                                                <th>Client Name</th>
                                                                <th>PINFL</th>
                                                                <th>INN</th>
                                                                <th>Company</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($building->contracts as $contract)
                                                                @if($contract->client)
                                                                    <tr class="client-row" data-type="{{ $contract->client->pinfl ? 'physical' : 'legal' }}">
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $contract->client->first_name }} {{ $contract->client->last_name }}</td>
                                                                        <td>
                                                                            @if($contract->client->pinfl !== null)
                                                                                {{ $contract->client->pinfl }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($contract->client->inn !== null)
                                                                                {{ $contract->client->inn }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($contract->client->company_name !== null)
                                                                                {{ $contract->client->company_name }}
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="activityTab" role="tabpanel">
                                    <div class="logs-history mb-0 mt-2">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Section</h5>
                                            <a href="javascript:void(0)" class="brn btn-primary d-flex align-items-center px-2 py-1  border" data-bs-toggle="offcanvas" data-bs-target="#sectionOffcanvas">
                                                 
                                               <i class="feather feather-plus "></i>
                                               <span>Add section</span>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-dark text-center border-top">
                                                <tr>
                                                    <th class="text-start ps-4">Building</th>
                                                    <th>Section name</th>
                                                    <th>Floor</th>
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
                                                            <div class="hstack gap-2 justify-content-center">
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
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i class="feather feather-clock me-3"></i>
                                                                                <span>Remind</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li>
                                                                            <form class="dropdown-item" action="{{ route('sections.destroy', $section->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" style="background: none; border: none; padding: 0;" onclick="return confirm('Ushbu faoliyatni o‘chirishni xohlaysizmi?')">
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
                                <div class="tab-pane fade" id="notificationsTab" role="tabpanel">
                                    <div class="logs-history mb-0 mt-2">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Floor</h5>
                                            <a href="javascript:void(0)" class="brn btn-primary d-flex align-items-center px-2 py-1  rounded" data-bs-toggle="offcanvas" data-bs-target="#floorOffcanvas">
                                               <i class="feather feather-plus "></i>
                                               <span>Add floor</span>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-dark text-center border-top">
                                                <tr>
                                                    <th class="text-start ps-4">Building</th>
                                                    <th>Section name</th>
                                                    <th>Floor</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @foreach($building->floors as $section)
                                                    <tr>
                                                        <td class="fw-medium text-dark text-start ps-4">{{ $section->building->name }}</td>
                                                        <td>{{ $section->section->name }}</td>
                                                        <td>{{ $section->number }}</td>
                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="{{ route('floors.show', $section->id) }}" class="avatar-text avatar-md">
                                                                    <i class="feather-eye"></i>
                                                                </a>

                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                        <i class="feather feather-more-horizontal"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('floors.edit', $section->id) }}">
                                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form class="dropdown-item" action="{{ route('floors.destroy', $section->id) }}" method="POST" onsubmit="confirmDelete(event)">
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
                                    <div class="logs-history mb-0 mt-2">
                                        <div class="px-4 mb-4 d-flex justify-content-between">
                                            <h5 class="fw-bold">Xonalar</h5>
                                            <a href="javascript:void(0)" class="brn btn-primary d-flex align-items-center px-2 py-1  rounded" data-bs-toggle="offcanvas" data-bs-target="#roomOffcanvas">
                                               <i class="feather feather-plus "></i>
                                               <span>Add room</span>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-dark text-center border-top">
                                                <tr>
                                                    <th class="text-start ps-4">Building</th>
                                                    <th>Seksiya nomi</th>
                                                    <th>Qavati</th>
                                                    <th>Raqami</th>
                                                    <th>hajmi</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @foreach($building->rooms as $section)
                                                    <tr>
                                                        <td class="fw-medium text-dark text-start ps-4">{{ $section->building->name }}</td>
                                                        <td>{{ $section->section->name }}</td>
                                                        <td>{{ $section->floor->number }}</td>
                                                        <td>{{ $section->number }}</td>
                                                        <td>{{ $section->size }}</td>
                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="{{ route('rooms.show', $section->id) }}" class="avatar-text avatar-md">
                                                                    <i class="feather-eye"></i>
                                                                </a>

                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                        <i class="feather feather-more-horizontal"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('rooms.edit', $section->id) }}">
                                                                                <i class="feather feather-edit-3 me-3"></i>
                                                                                <span>Edit</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <form class="dropdown-item" action="{{ route('rooms.destroy', $section->id) }}" method="POST" onsubmit="confirmDelete(event)">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
    <x-modals.section-modal :building="$building"></x-modals.section-modal>
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
