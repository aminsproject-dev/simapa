<!-- Main content -->
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto">
                            <a data-bs-toggle="modal" data-bs-target="#modal_tambah" class="btn btn-primary fw-blod">
                                <i class="ph-plus me-1"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable-2 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pendidikan Akhir</th>
                                        <th class="tect-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_pendidikan_akhir)) {
                                        foreach ($dt_pendidikan_akhir as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_pendidikan_akhir']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_pendidikan_akhir']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/pendidikan-akhir/delete/' . encrypt_data($row['id_pendidikan_akhir'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

<!-- Modal Tambah -->
<div id="modal_tambah" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= site_url('master/pendidikan-akhir/add'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end">Nama Pendidikan Akhir <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_pendidikan_akhir" class="form-control" placeholder="Masukkan nama pendidikan akhir" required>
                        </div>
                    </div>
                    <div class="text-muted"><span class="text-danger">*</span>Wajib di isi</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php $i = 1;
if (isset($dt_pendidikan_akhir)) {
    foreach ($dt_pendidikan_akhir as $row) { ?>
        <div id="modal_edit_<?= $row['id_pendidikan_akhir']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= site_url('master/pendidikan-akhir/update/' . encrypt_data($row['id_pendidikan_akhir'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Pendidikan Akhir <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_pendidikan_akhir" value="<?= $row['nama_pendidikan_akhir']; ?>" class="form-control" placeholder="Masukkan nama pendidikan akhir" required>
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
                dropdownParent: modal
            });
        }
        $("#modal_tambah").on("shown.bs.modal", function() {
            initSelect2(this);
        });
    });
</script>