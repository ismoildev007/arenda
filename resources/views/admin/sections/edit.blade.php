@extends('layouts.layout')

@section('content')
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Bo'limni tahrirlash</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Bo'limlar</a></li>
                        <li class="breadcrumb-item">Bo'limni tahrirlash</li>
                    </ul>
                </div>
            </div>

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="card border-top-0">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item flex-fill border-top" role="presentation">
                                <a href="javascript:void(0);" class="nav-link text-start">Bo'lim ma'lumotlarini tahrirlang:</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                            <div class="card-body personal-info">
                                <?php
                                $buildings = \App\Models\Building::all();
                                ?>
                                <form action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!--! ================================================================ !-->
                                    <!--! [Start] Edit Section Offcanvas !-->
                                    <!--! ================================================================ !-->
                                        <div class="offcanvas-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="nameInput" class="fw-semibold">Section Name:</label>
                                                            <input type="text" class="form-control" id="nameInput" name="name" value="{{ $section->name }}" placeholder="Enter section name">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="buildingSelect" class="fw-semibold">Building:</label>
                                                            <select class="form-control max-select" id="buildingSelect" name="building_id">
                                                                <option class="selected" disabled>Select building</option>
                                                                @foreach ($buildings as $building)
                                                                    <option value="{{ $building->id }}" {{ $building->id == $section->building_id ? 'selected' : '' }}>
                                                                        {{ $building->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="addressInput" class="fw-semibold">Address:</label>
                                                            <input type="text" class="form-control" id="addressInput" name="address" value="{{ $section->address }}" placeholder="Enter address">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="classesInput" class="fw-semibold">Section Type:</label>
                                                            <input type="text" class="form-control" id="classesInput" name="section_type" value="{{ $section->section_type }}" placeholder="Enter section type">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="constructionInput" class="fw-semibold">Construction:</label>
                                                            <input type="text" class="form-control" id="constructionInput" name="construction" value="{{ $section->construction }}" placeholder="Enter construction details">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="sizeInput" class="fw-semibold">Size:</label>
                                                            <input type="text" class="form-control" id="sizeInput" name="size" value="{{ $section->size }}" placeholder="Enter section size" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="section_price_per_sqm" class="fw-semibold">Price per Square Meter (UZS):</label>
                                                            <input type="text" name="price_per_sqm" id="section_price_per_sqm" class="form-control" value="{{ $section->price_per_sqm }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="foundedDateInput" class="fw-semibold">Founded Date:</label>
                                                            <input type="date" class="form-control" name="founded_date" value="{{ $section->founded_date }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="safetyInput" class="fw-semibold">Safety:</label>
                                                            <input type="text" class="form-control" id="safetyInput" name="safety" value="{{ $section->safety }}" placeholder="Enter safety details">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="modeOfOperationInput" class="fw-semibold">Mode of Operation:</label>
                                                            <input type="text" class="form-control" id="modeOfOperationInput" name="mode_of_operation" value="{{ $section->mode_of_operation }}" placeholder="Enter mode of operation">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="setInput" class="fw-semibold">Equipment:</label>
                                                            <input type="text" class="form-control" id="setInput" name="set" value="{{ $section->set }}" placeholder="Enter equipment details">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="floorInput" class="fw-semibold">Floor:</label>
                                                            <input type="text" class="form-control" id="floorInput" name="floor" value="{{ $section->floor }}" placeholder="Enter floor number" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="numberOfRoomsInput" class="fw-semibold">Number of Rooms:</label>
                                                            <input type="text" class="form-control" id="numberOfRoomsInput" name="number_of_rooms" value="{{ $section->number_of_rooms }}" placeholder="Enter number of rooms" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="liftInput" class="fw-semibold">Lift:</label>
                                                            <input type="text" class="form-control" id="liftInput" name="lift" value="{{ $section->lift }}" placeholder="Is there a lift?">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="parkingInput" class="fw-semibold">Parking:</label>
                                                            <input type="text" class="form-control" id="parkingInput" name="parking" value="{{ $section->parking }}" placeholder="Enter parking details">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="imagesInput" class="fw-semibold">Images:</label>
                                                            <input type="file" class="form-control" id="imagesInput" name="images[]" multiple accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-4 text-center">
                                                        <button type="submit" class="btn btn-primary btn-lg">Update Section</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--! ================================================================ !-->
                                    <!--! [End] Edit Section Offcanvas !-->
                                    <!--! ================================================================ !-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection

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
</script>

