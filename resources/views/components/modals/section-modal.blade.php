<?php

$buildings = \App\Models\Building::all();

?>

<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="sectionOffcanvas" aria-labelledby="section">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeTempContractCheckSelect()" class="avatar-text avatar-md items-details-close-trigger" id="close-section" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Details Close">
                <i class="feather-arrow-left"></i>
            </div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Seksiya qo'shish</a>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="buildingSelect" class="form-label">Bino:</label>
                    <select class="form-control max-select" id="buildingSelect" name="building_id" required>
                        <option class="selected" disabled selected>Bino tanlang</option>
                        @foreach ($buildings as $building)
                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="floor" class="form-label">Qavat:</label>
                    <input type="number" class="form-control" id="floor" name="floor" placeholder="Necha qavatligini kiriting" min="1" max="100" required>
                </div>
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Bo'lim nomi:</label>
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Bo'lim nomini kiriting" required>
                </div>
                <div class="mb-3">
                    <label for="imagesInput" class="form-label">Rasmlar (majburiy):</label>
                    <input type="file" class="form-control" id="imagesInput" name="images[]" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Yopish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
