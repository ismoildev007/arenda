@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Seksiyalar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a @if(auth()->user()->role == 'admin')
                                                           href="{{ route('dashboard') }}"
                                                       @elseif(auth()->user()->role == 'manager')
                                                           href="{{ route('manager.dashboard') }}"
                                                       @elseif(auth()->user()->role == 'staff')
                                                           href="{{ route('staff.dashboard') }}"
                                                       @endif class="nxl-link">Home</a></li>
                        <li class="breadcrumb-item">Seksiyalar</li>
                    </ul>
                </div>
{{--                <div class="page-header-right ms-auto">--}}
{{--                    <div class="page-header-right-items">--}}
{{--                        <a href="{{ route('sections.create') }}" class="btn btn-primary">--}}
{{--                            <i class="feather-plus me-2"></i>--}}
{{--                            <span>Yangi Seksiya qo'shish</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
                                        <th>Building</th>
                                        <th>Seksiya nomi</th>
                                        <th>Qavati</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $section)
                                        <tr>
                                            <td>{{ $section->building->name }}</td>
                                            <td>{{ $section->name }}</td>
                                            <td>{{ $section->floor }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
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
                                                                    <button type="submit" style="background: none; border: none; padding: 0;"  onclick="return confirm('Ushbu bo\'limni o‘chirishni xohlaysizmi?')">
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
@endsection
