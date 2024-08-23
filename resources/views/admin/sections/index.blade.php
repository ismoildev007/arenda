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
                                                    <a href="javascript:void(0)" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSectionModal{{ $section->id }}">
                                                        <span>Etaj qo'shish</span>
                                                        <span class="avatar-text avatar-md">
                                                            <i class="feather feather-plus me-3"></i>
                                                        </span>
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
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>

    @foreach($sections as $section)
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
                                        <option value="" disabled selected>Qavatni tanlang</option>
                                        @for ($i = 1; $i <= $section->floor; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
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

            @foreach($sections as $section)
            // Update the floor select when a section is selected
            $('#section_id_{{ $section->id }}').on('change', function() {
                let selectedSectionId = $(this).val();
                let sectionData = @json($sections);

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
