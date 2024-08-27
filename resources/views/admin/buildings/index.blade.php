@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Building</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a @if(auth()->user()->role == 'admin')
                                                           href="{{ route('dashboard') }}"
                                                       @elseif(auth()->user()->role == 'manager')
                                                           href="{{ route('manager.dashboard') }}"
                                                       @elseif(auth()->user()->role == 'staff')
                                                           href="{{ route('staff.dashboard') }}"
                                                       @endif class="nxl-link">Home</a></li>
                        <li class="breadcrumb-item">Building</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <a href="{{ route('buildings.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Yangi Building qo'shish</span>
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
                                        <th>Building nomi</th>
                                        <th>Viloyat</th>
                                        <th>shaxar (tuman)</th>
                                        <th>ism</th>
                                        <th>familiya</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buildings as $branch)
                                        <tr>
                                            <td>{{ $branch->name }}</td>
                                            <td>{!! $branch->region->name !!}</td>
                                            <td>{{ $branch->district->name }}</td>
                                            <td>{{ $branch->first_name }}</td>
                                            <td>{{ $branch->last_name }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="javascript:void(0)" class="d-flex align-items-center"  data-bs-toggle="modal" data-bs-target="#addSectionModal{{ $branch->id }}">
                                                        <span>Seksiya qo'shish</span>
                                                        <span class="avatar-text avatar-md">
                                                            <i class="feather feather-plus me-3"></i>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('buildings.show', $branch->id) }}" class="avatar-text avatar-md">
                                                        <i class="feather-eye"></i>
                                                    </a>

                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                            <i class="feather feather-more-horizontal"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('buildings.edit', $branch->id) }}">
                                                                    <i class="feather feather-edit-3 me-3"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form class="dropdown-item" action="{{ route('buildings.destroy', $branch->id) }}" method="POST" onsubmit="confirmDelete(event)">
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
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>

    <!-- Section qo'shish modallar -->
    @foreach($buildings as $branch)
        <div class="modal fade" id="addSectionModal{{ $branch->id }}" tabindex="-1" aria-labelledby="addSectionModalLabel{{ $branch->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSectionModalLabel{{ $branch->id }}">Section qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="building_id" value="{{ $branch->id }}">
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
    @endforeach
@endsection
