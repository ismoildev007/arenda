<?php

$buildings = \App\Models\Building::all();

?>



<form action="{{ route('sections.store') }}" method="POST">
    @csrf
    <!--! ================================================================ !-->
    <!--! [Start] Review Provider Offcanvas !-->
    <!--! ================================================================ !-->
    <div class="offcanvas offcanvas-end w-50" tabindex="-1" id="sectionOffcanvas" aria-labelledby="section">
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
                            <input type="text" class="form-control" id="sizeInput" name="size" placeholder="Enter section size" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="section_price_per_sqm" class="fw-semibold">Price per Square Meter (UZS):</label>
                            <input type="text" name="price_per_sqm" id="section_price_per_sqm" class="form-control" required  oninput="this.value = this.value.replace(/[^0-9]/g, '');">
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
                            <input type="text" class="form-control" id="floorInput" name="floor" placeholder="Enter floor number" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
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
