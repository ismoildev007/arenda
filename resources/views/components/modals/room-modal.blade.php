
<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="roomOffcanvas" aria-labelledby="roomOffcanvas">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeTempContractCheckSelect()" class="avatar-text avatar-md items-details-close-trigger" id="close-roomOffcanvas" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Close"><i class="feather-arrow-left"></i></div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Xona qo'shish</a>
        </div>
    </div>

    <div class="offcanvas-body">
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" id="roomForm">
            @csrf
            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="building_id" class="fw-semibold">Building :</label>
                </div>
                <div class="col-lg-8">
                    <select name="building_id" id="room_building_id" class="form-select max-select" required>
                        <option value="{{ $building->id }}">{{ $building->name }}</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="section_id" class="fw-semibold">Seksiya :</label>
                </div>
                <div class="col-lg-8">
                    <select name="section_id" id="room_section_id" class="form-select max-select" required>
                        <option value="" selected>Seksiyani tanlang</option>
                        @foreach($building->sections as $section)
                            <option value="{{ $section->id }}" >{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="floor_id" class="fw-semibold">Qavat :</label>
                </div>
                <div class="col-lg-8">
                    <select name="floor_id" id="floor_id" class="form-select max-select" required>
                        <option value="" disabled selected>Qavatni tanlang</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="number" class="fw-semibold">Xona raqami :</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="number" id="number" class="form-control" required>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="size" class="fw-semibold">O'lchami :</label>
                </div>
                <div class="col-lg-8">
                    <input type="number" name="size" id="size" class="form-control" required>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="price_per_sqm" class="fw-semibold">Kvadrat metriga narx :</label>
                </div>
                <div class="col-lg-8">
                    <input type="number" name="price_per_sqm" id="price_per_sqm" class="form-control" required>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="status" class="fw-semibold">Holat :</label>
                </div>
                <div class="col-lg-8">
                    <select name="status" id="status" class="form-select max-select" required>
                        <option value="" disabled selected>Holatni tanlang</option>
                        <option value="noactive">Faol emas</option>
                        <option value="active">Faol</option>
                        <option value="bron">Bronlangan</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <div class="col-lg-4">
                    <label for="type" class="fw-semibold">Turi :</label>
                </div>
                <div class="col-lg-8">
                    <select name="type" id="type" class="form-select max-select" required>
                        <option value="" disabled selected>Turlarni tanlang</option>
                        <option value="business">Biznes</option>
                        <option value="standard">Standart</option>
                    </select>
                </div>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-lg-4">
                    <label for="images" class="fw-semibold">Rasmlar</label>
                </div>
                <div class="col-lg-8">
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Yaratish</button>
        </form>
    </div>
</div>

<!-- Include Select2 and jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Custom Script -->
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.max-select').select2({
            theme: 'bootstrap-5',
            placeholder: 'Tanlang...',
            allowClear: true
        });

        $('#room_building_id').on('load', function() {
            alert(5432)
            let buildingId = $(this).val();
            if (buildingId) {
                let url = "{{ route('getSections', ':buildingId') }}".replace(':buildingId', buildingId);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#room_section_id').empty().append('<option value="" disabled selected>Seksiya tanlang</option>');
                        $('#floor_id').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');

                        if (data.sections.length > 0) {
                            $.each(data.sections, function(key, value) {
                                $('#room_section_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error: " + status + " - " + error);
                    }
                });
            } else {
                $('#room_section_id').empty().append('<option value="" disabled selected>Seksiya tanlang</option>');
                $('#floor_id').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');
            }
        });

        $('#room_section_id').on('change', function() {
            let sectionId = $(this).val();
            if (sectionId) {
                $.ajax({
                    url: "{{ route('getFloors', '') }}/" + sectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data); // Kelayotgan ma'lumotni ko'rsatish
                        $('#floor_id').empty().append('<option value="" disabled selected>Qavatni tanlang</option>');
                        $.each(data.floors, function(key, value) {
                            $('#floor_id').append('<option value="' + value.id + '">' + value.number + '</option>');
                        });
                    }
                });
            }
        });

        $('#roomForm').on('submit', function(e) {
            let floorValue = $('#floor_id').val();
            if (!floorValue) {
                e.preventDefault();
                alert('Iltimos, qavatni tanlang!');
            }
        });
    });
</script>

