@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Mijozlar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a @if(auth()->user()->role == 'admin')
                                   href="{{ route('dashboard') }}"
                               @elseif(auth()->user()->role == 'manager')
                                   href="{{ route('manager.dashboard') }}"
                               @elseif(auth()->user()->role == 'staff')
                                   href="{{ route('staff.dashboard') }}"
                               @endif class="nxl-link">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">Mijozlar</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <a href="{{ route('clients.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Yangi mijoz qo'shish</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <livewire:clients-sort/>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
