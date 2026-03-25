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
                                        <th>Kategori</th>
                                        <th>Nama Sertifikat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_guarantee)) {
                                        foreach ($dt_guarantee as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['nama_sertifikat']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_lihat_<?= $row['id_sertifikat_garansi']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Data">
                                                            <i class="ph-eye me-2"></i>
                                                        </a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_sertifikat_garansi']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/guarantee/delete/' . encrypt_data($row['id_sertifikat_garansi'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

            <form action="<?= site_url('master/guarantee/add'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Kategori<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control select-search" id="kategori_barang" name="kategori_barang" required>
                                <option>Pilih Kategori Barang</option>
                                <?php foreach ($dt_category as $category) { ?>
                                    <option value="<?= $category['id_kategori_barang']; ?>"><?= $category['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama Sertifikat<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_sertifikat" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Isi<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea name="isi_sertifikat" id="isi_sertifikat" class="form-control" rows="8" cols="8"></textarea>
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
if (isset($dt_guarantee)) {
    foreach ($dt_guarantee as $row) {
?>
        <div id="modal_lihat_<?= $row['id_sertifikat_garansi']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lihat Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 200px;">Kategori :</th>
                                            <td><?= $row['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">Nama Sertifikat :</th>
                                            <td><?= $row['nama_sertifikat']; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 200px;">Isi Sertifikat :</th>
                                            <td><?= $row['isi_sertifikat']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>

        <div id="modal_edit_<?= $row['id_sertifikat_garansi']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('master/guarantee/update/' . encrypt_data($row['id_sertifikat_garansi'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kategori<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control select-search" id="kategori_barang" name="kategori_barang" required>
                                        <option>Pilih Kategori Barang</option>
                                        <?php foreach ($dt_category as $category) { ?>
                                            <option value="<?= $category['id_kategori_barang']; ?>" <?= $category['id_kategori_barang'] == $row['kategori_barang'] ? 'selected' : ''; ?>><?= $category['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Sertifikat<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_sertifikat" value="<?= $row['nama_sertifikat']; ?>" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Isi<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="isi_sertifikat" id="isi_sertifikat" class="form-control" rows="8" cols="8"><?= $row['isi_sertifikat']; ?></textarea>
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