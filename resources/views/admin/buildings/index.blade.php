@extends('layouts.layout')

@section('content')
  <style>
  .nxl-container .nxl-content .main-content {
    overflow-x: unset !important;
    padding: 30px 30px 5px;
   }

  </style>



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
                            <span>Add Building </span>
                        </a>
                    </div>
                </div>
            </div>
              <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Section added successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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
                                        <th>Building name</th>
                                         <th>Owner</th>
                                        <th>Region</th>
                                        <th>City (district)</th>

                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buildings as $branch)
                                        <tr>
                                            <td>{{ $branch->name }}</td>
                                             <td>{{ $branch->first_name }} {{ $branch->last_name }}</td>
                                            <td>{!! $branch->region->name !!}</td>
                                            <td>{{ $branch->district->name }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-center">
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
                                                                <a class="dropdown-item printBTN" href="javascript:void(0)" data-bs-toggle="offcanvas"  data-bs-target="#addSectionModal{{ $branch->id }}">
                                                                    <i class="feather feather-plus"></i>
                                                                    <span>Add section </span>
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


  @foreach($buildings as $branch)
<form action="{{ route('sections.store') }}" method="POST">
    @csrf
    <!--! ================================================================ !-->
    <!--! [Start] Review Provider Offcanvas !-->
    <!--! ================================================================ !-->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="addSectionModal{{ $branch->id }}">
        <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
            <div class="d-flex align-items-center">
                <div class="avatar-text avatar-md items-details-close-trigger" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Details Close"><i class="feather-arrow-left"></i></div>
                <span class="vr text-muted mx-4"></span>
                Add Section
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="row">
               <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nameInput" class="fw-semibold">Section Name:</label>
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter section name">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="buildingSelect" class="fw-semibold">Building:</label>
                            <select class="form-control max-select" id="buildingSelect" name="building_id" placeholder="Select building">
                                <option class="selected" disabled selected>Select building</option>
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="addressInput" class="fw-semibold">Address:</label>
                            <input type="text" class="form-control" id="addressInput" name="address" placeholder="Enter address">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="classesInput" class="fw-semibold">Section Type:</label>
                            <input type="text" class="form-control" id="classesInput" name="section_type" placeholder="Enter section type">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="constructionInput" class="fw-semibold">Construction:</label>
                            <input type="text" class="form-control" id="constructionInput" name="construction" placeholder="Enter construction details">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="sizeInput" class="fw-semibold">Size:</label>
                            <input type="text" class="form-control" id="sizeInput" name="size" placeholder="Enter section size">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="section_price_per_sqm" class="fw-semibold">Price per Square Meter (UZS):</label>
                            <input type="number" name="price_per_sqm" id="section_price_per_sqm" class="form-control" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="foundedDateInput" class="fw-semibold">Founded Date:</label>
                            <input type="date" class="form-control"  name="founded_date">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                       <div class="col-md-12 mb-3">
                            <label for="safetyInput" class="fw-semibold">Safety:</label>
                            <input type="text" class="form-control" id="safetyInput" name="safety" placeholder="Enter safety details">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="modeOfOperationInput" class="fw-semibold">Mode of Operation:</label>
                            <input type="text" class="form-control" id="modeOfOperationInput" name="mode_of_operation" placeholder="Enter mode of operation">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="setInput" class="fw-semibold">Equipment:</label>
                            <input type="text" class="form-control" id="setInput" name="set" placeholder="Enter equipment details">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="floorInput" class="fw-semibold">Floor:</label>
                            <input type="text" class="form-control" id="floorInput" name="floor" placeholder="Enter floor number">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="numberOfRoomsInput" class="fw-semibold">Number of Rooms:</label>
                            <input type="text" class="form-control" id="numberOfRoomsInput" name="number_of_rooms" placeholder="Enter number of rooms">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="liftInput" class="fw-semibold">Lift:</label>
                            <input type="text" class="form-control" id="liftInput" name="lift" placeholder="Is there a lift?">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="parkingInput" class="fw-semibold">Parking:</label>
                            <input type="text" class="form-control" id="parkingInput" name="parking" placeholder="Enter parking details">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="imagesInput" class="fw-semibold">Images:</label>
                            <input type="file" class="form-control" id="imagesInput" name="images[]" multiple>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group mb-4 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Save Section</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--! ================================================================ !-->
    <!--! [End] Review Provider Offcanvas !-->
    <!--! ================================================================ !-->
</form>
@endforeach


    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Custom Script -->
<script>
    $(document).ready(function() {
        $('.max-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Bino tanlang',
            allowClear: true
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Simulate successful form submission (e.g., after Ajax call or validation)
        // Show toast
        const toastEl = document.getElementById('successToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        // Submit the form after showing the toast (you can remove this if submitting via Ajax)
        setTimeout(() => {
            form.submit();
        }, 1500); // Wait for 1.5 seconds before submitting the form
    });
});

</script>
@endsection
