@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Xonalar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a @if( auth()->user()->role == 'admin')
                                                           href="{{ route('dashboard') }}"
                                                       @elseif( auth()->user()->role == 'manager')
                                                           href="{{ route('manager.dashboard') }}"
                                                       @elseif (auth()->user()->role == 'staff')
                                                           href="{{ route('staff.dashboard') }}"
                                                       @endif class="nxl-link">Home</a></li>
                        <li class="breadcrumb-item">Xonalar</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Yangi xona qo'shish</span>
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
                                        <th>Nomer</th>
                                        <th>Building nomi</th>
                                        <th>Seksiya</th>
                                        <th>Qavat</th>
                                        <th>Hajmi</th>
                                        <th>Narxi (1m kv)</th>
                                        <th>Harakatlar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{ $room->number }}</td>
                                            <td>{{ $room->building->name }}</td>
                                            <td>{{ $room->section->name }}</td>
                                            <td>{{ $room->floor->number }}- qavat</td>
                                            <td>{{ $room->size }}</td>
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
