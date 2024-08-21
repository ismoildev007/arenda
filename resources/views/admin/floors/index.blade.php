@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Qavatlar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="nxl-link">Home</a>
                        </li>
                        <li class="breadcrumb-item">Qavatlar</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <a href="{{ route('floors.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Yangi qavat qo'shish</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-top-0">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Qavat nomeri</th>
                                        <th>Filial</th>
                                        <th>Bo'lim</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($floors as $floor)
                                        <tr>
                                            <td>{{ $floor->number }}</td>
                                            <td>{{ $floor->building->name }}</td>
                                            <td>{{ $floor->section->name }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('floors.edit', $floor->id) }}" class="avatar-text avatar-md">
                                                        <i class="feather-edit-3"></i>
                                                    </a>
                                                    <form action="{{ route('floors.destroy', $floor->id) }}" method="POST" onsubmit="return confirm('Ushbu qavatni o‘chirishni xohlaysizmi?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: none; border: none;" class="avatar-text avatar-md">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </form>
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
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection
