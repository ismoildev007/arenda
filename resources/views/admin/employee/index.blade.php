@extends('layouts.layout')

@section('content')
<style>
  .nxl-container .nxl-content .main-content {
    overflow-x: unset !important;
    padding: 30px 30px 5px;
   }
.table-responsive {
    overflow-x: visible !important;
    -webkit-overflow-scrolling: touch;
}
</style>
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Hodimlar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a 
                            @if( auth()->user()->role == 'admin')
                                href="{{ route('dashboard') }}"
                            @elseif( auth()->user()->role == 'manager')
                                href="{{ route('manager.dashboard') }}"
                            @elseif (auth()->user()->role == 'staff')
                                href="{{ route('staff.dashboard') }}"
                            @endif class="nxl-link">Home</a></li>
                        <li class="breadcrumb-item">Hodimlar</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Yangi hodim qo'shish</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-top-0">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Position</th>
                                            <th>Pinfl</th>
                                            <th>Date of Birth</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            @if(!in_array($employee->role, ['admin']))
                                                <tr>
                                                    <td>{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}</td>
                                                    <td>{{ ucfirst($employee->role) }}</td>
                                                    <td>{{ $employee->pinfl }}</td>
                                                    <td>{{ $employee->birth_day }}</td>
                                                    <td>
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <a href="{{ route('employees.show', $employee->id) }}" class="avatar-text avatar-md">
                                                                <i class="feather-eye"></i>
                                                            </a>

                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">
                                                                            <i class="feather feather-edit-3 me-3"></i>
                                                                            <span>Edit</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form class="dropdown-item" action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" style="background: none; border: none; padding: 0;" onclick="return confirm('Are you sure you want to delete this record?')">
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
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
