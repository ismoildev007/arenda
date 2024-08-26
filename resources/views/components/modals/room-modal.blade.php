<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="tempContractCheckSelectOffcanvas" aria-labelledby="tempContractCheckSelectOffcanvas">
    <div class="offcanvas-header border-bottom" style="padding-top: 20px; padding-bottom: 20px">
        <div class="d-flex align-items-center">
            <div onclick="closeTempContractCheckSelect()" class="avatar-text avatar-md items-details-close-trigger" id="close-tempContractCheckSelectOffcanvas" data-bs-dismiss="offcanvas" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Details Close"><i class="feather-arrow-left"></i></div>
            <span class="vr text-muted mx-4"></span>
            <a href="javascript:void(0);">Shablon qo'shish </a>
        </div>

    </div>
    <div class="offcanvas-body">
        <div class="row">



            <label  class=" form-label">
                Holati
                <span class="text-danger">*</span>
            </label>
            <div class="col-12 mb-4 d-flex align-items-center justify-content-between">

                <div class="col-5 ">
                    <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="success-outlined">Faol</label>
                </div>
                <div class="col-5">
                    <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                    <label class="btn btn-outline-primary" for="danger-outlined">Faol emas</label>
                </div>
            </div>

            <div class=" col-12 mb-4 align-items-center">
                <label for="new_shablon" class=" form-label">
                    Yangi shablon nomi
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="new_shablon"  name="new_shablon_name" placeholder="Yangi shablon kiriting" required>
            </div>

            <div class="col-12 mb-4">
                <div class="form-group mb-4">
                    <label class="form-label">Turi:</label>
                    <select class="form-control" data-select2-selector="status">
                        <option value="primary" data-bg="bg-primary" selected>PDF</option>
                        <option value="secondary" data-bg="bg-secondary">Zip</option>
                    </select>
                </div>
            </div>

            <div class="col-12 mb-4  align-items-center">
                <input type="file" class="form-control form-control-file"  name="file" required>
            </div>
            <div class="col-12 mb-4  align-items-center">
                <input type="date" class="form-control form-control-file"  name="date" required>
            </div>



        </div>

    </div>
</div>


<script>
    function closeTempContractCheckSelect() {
        const tempContractCheckSelectOffcanvas = document.getElementById('tempContractCheckSelectOffcanvas');
        tempContractCheckSelectOffcanvas.style.visibility = "hidden";
        tempContractCheckSelectOffcanvas.classList.remove('show');

    }
</script>
