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
                                        <th>Nama Dokumen</th>
                                        <th>Nama File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_document)) {
                                        foreach ($dt_document as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_dokumen']; ?></td>
                                                <td><?= $row['nama_file']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_lihat_<?= $row['id']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Dokumen">
                                                            <i class="ph-magnifying-glass me-2"></i>
                                                        </a>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/document/delete/' . encrypt_data($row['id'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Dokumen">
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

            <form action="<?= site_url('master/document/add'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama Dokumen<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_dokumen" class="form-control" placeholder="Masukkan Nama Dokumen" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Dokumen<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="file" name="nama_file" class="form-control" required accept=".pdf">
                        </div>
                    </div>

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
if (isset($dt_document)) {
    foreach ($dt_document as $row) {
?>
        <div id="modal_edit_<?= $row['id']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('master/document/update/' . encrypt_data($row['id'])); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Dokumen<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_dokumen" value="<?= $row['nama_dokumen']; ?>" class="form-control" placeholder="Masukkan Nama Dokumen" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Dokumen<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="file" name="nama_file" class="form-control" accept=".pdf">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Aktif?<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="rowstatus" class="form-control select-search">
                                        <option value="1" <?= $row['rowstatus'] == '1' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="0" <?= $row['rowstatus'] == '0' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div id="modal_lihat_<?= $row['id']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lihat Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>


                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <object data="<?php echo site_url('files/document/' . encrypt_data($row['id'])); ?>" type="application/pdf" width="100%" height="550px">
                                    <p>Unable to display PDF file. <a href="<?php echo site_url('files/document/' . encrypt_data($row['id'])); ?>">Download</a> instead.</p>
                                </object>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    </div>

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