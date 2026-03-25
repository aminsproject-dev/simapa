<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">

        <!-- STATISTIK MASTER -->
        <div class="row">
            <div class="col-sm-12 col-xl-12">

                <div class="card ">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto">
                            <a data-bs-toggle="modal" data-bs-target="#modal_tambah" class="btn btn-primary fw-bold">
                                <i class="ph-plus me-1"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table datatable-3 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kabupaten</th>
                                        <th>Nama Kecamatan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_district)) {
                                        foreach ($dt_district as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_kabupaten']; ?></td>
                                                <td><?= $row['nama_kecamatan']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_kecamatan']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/district/delete/' . encrypt_data($row['id_kecamatan'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
                                                            <i class="ph-trash me-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>


</div>
<!-- /content area -->
</div>
<!-- /main content -->

<div id="modal_tambah" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= site_url('master/district/add'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Kabupaten<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="id_kabupaten" class="form-control select-search">
                                <option value="">Silahkan pilih provinsi</option>
                                <?php foreach ($dt_regency as $regency) { ?>
                                    <option value="<?= $regency['id_kabupaten']; ?>" <?= $id_regency == $regency['id_kabupaten'] ? 'selected' : ''; ?>><?= $regency['nama_kabupaten']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama Kecamatan<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_kecamatan" class="form-control" placeholder="Masukkan nama kecamatan" required>
                        </div>
                    </div>

                    <div class="text-muted"><span class="text-danger">*</span>) Wajib di isi</div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php $i = 1;
if (isset($dt_district)) {
    foreach ($dt_district as $row) {
?>
        <div id="modal_edit_<?= $row['id_kecamatan']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('master/district/update/' . encrypt_data($row['id_kecamatan'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kabupaten<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="id_kabupaten" class="form-control select-search">
                                        <option value="">Silahkan pilih provinsi</option>
                                        <?php foreach ($dt_regency as $regency) { ?>
                                            <option value="<?= $regency['id_kabupaten']; ?>" <?= $row['id_kabupaten'] == $regency['id_kabupaten'] ? 'selected' : ''; ?>><?= $regency['nama_kabupaten']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Kecamatan<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_kecamatan" value="<?= $row['nama_kecamatan']; ?>" class="form-control" placeholder="Masukkan nama kecamatan" required>
                                </div>
                            </div>

                            <div class="text-muted"><span class="text-danger">*</span>) Wajib di isi</div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
<?php }
} ?>

<script>
    $(document).ready(function() {
        function initSelect2(modal) {
            $(".select-search", modal).select2({
                dropdownParent: modal,
            });
        }

        $("#modal_tambah").on("shown.bs.modal", function() {
            initSelect2(this);
        });
    });
</script>