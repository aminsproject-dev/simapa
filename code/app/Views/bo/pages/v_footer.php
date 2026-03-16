<?php

use App\Models\BaseModel;

$this->model = new BaseModel();
?>

</div>
<!-- /page content -->
<!-- Footer -->
<div class="navbar navbar-sm navbar-footer border-top <?= isset($footer) ? $footer : ''; ?>">
    <div class="container-fluid">
        <span>&copy; <?= date('Y'); ?> <a href="<?= base_url('dashboard'); ?>"><?= $this->model->getSetting(1)->content; ?></a></span>
    </div>
</div>
<!-- /footer -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
    <div class="position-absolute top-50 end-100 visible">
        <button type="button" class="btn btn-primary btn-icon translate-middle-y rounded-end-0" data-bs-toggle="offcanvas" data-bs-target="#demo_config">
            <i class="ph-gear"></i>
        </button>
    </div>

    <div class="offcanvas-header border-bottom py-0">
        <h5 class="offcanvas-title py-3">Konfigurasi</h5>
        <button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill" data-bs-dismiss="offcanvas">
            <i class="ph-x"></i>
        </button>
    </div>

    <div class="offcanvas-body">
        <div class="fw-semibold mb-2">Mode Tema</div>
        <div class="list-group mb-3">
            <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
                <div class="d-flex flex-fill my-1">
                    <div class="form-check-label d-flex me-2">
                        <i class="ph-sun ph-lg me-3"></i>
                        <div>
                            <span class="fw-bold">Tema Terang</span>
                            <div class="fs-sm text-muted">Pilih tema terang atau default</div>
                        </div>
                    </div>
                    <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="light" checked />
                </div>
            </label>

            <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
                <div class="d-flex flex-fill my-1">
                    <div class="form-check-label d-flex me-2">
                        <i class="ph-moon ph-lg me-3"></i>
                        <div>
                            <span class="fw-bold">Tema Gelap</span>
                            <div class="fs-sm text-muted">Ganti ke tema gelap</div>
                        </div>
                    </div>
                    <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="dark" />
                </div>
            </label>

            <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-0">
                <div class="d-flex flex-fill my-1">
                    <div class="form-check-label d-flex me-2">
                        <i class="ph-translate ph-lg me-3"></i>
                        <div>
                            <span class="fw-bold">Tema Otomatis</span>
                            <div class="fs-sm text-muted">Pilih Tema berdasarkan tema sistem</div>
                        </div>
                    </div>
                    <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="auto" />
                </div>
            </label>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".time_in", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>
<script>
    $(document).ready(function() {
        function initSelect2(modal) {
            $(".select-search", modal).select2({
                dropdownParent: $('#modal_tambah .modal-content'),
                width: '100%',
            });
        }

        $("#modal_tambah").on("shown.bs.modal", function() {
            initSelect2(this);
        });
    });
</script>
<script>
    $(document).ready(function() {
        function initSelect2(modal) {
            $(".select-search", modal).select2({
                dropdownParent: modal,
            });

            $(".year-picker", modal).select2({
                dropdownParent: modal,
                data: yearOptions,
                placeholder: "Pilih Tahun",
                allowClear: true,
            });
        }

        $("#modal_ekspor").on("shown.bs.modal", function() {
            initSelect2(this);
        });
    });
</script>


</body>

</html>