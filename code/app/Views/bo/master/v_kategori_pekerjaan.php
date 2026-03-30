<!-- Main content -->
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto">
                            <a data-bs-toggle="modal" data-bs-target="#modal_tambah" class="btn btn-primary fw-bold">
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
                                        <th>Nama Kategori Pekerjaan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_kategori_pekerjaan)) {
                                        foreach ($dt_kategori_pekerjaan as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_kategori_pekerjaan']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_kategori_pekerjaan']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/kategori-pekerjaan/delete/' . encrypt_data($row['id_kategori_pekerjaan'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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
            <form action="<?= site_url('master/kategori-pekerjaan/add'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end">Nama Kategori Pekerjaan <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_kategori_pekerjaan" class="form-control" placeholder="Masukkan nama kategori pekerjaan" required>
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

<!-- Modal Edit -->
<?php $i = 1;
if (isset($dt_kategori_pekerjaan)) {
    foreach ($dt_kategori_pekerjaan as $row) { ?>
        <div id="modal_edit_<?= $row['id_kategori_pekerjaan']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= site_url('master/kategori-pekerjaan/update/' . encrypt_data($row['id_kategori_pekerjaan'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Kategori Pekerjaan <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_kategori_pekerjaan" value="<?= $row['nama_kategori_pekerjaan']; ?>" class="form-control" placeholder="Masukkan nama kategori pekerjaan" required>
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