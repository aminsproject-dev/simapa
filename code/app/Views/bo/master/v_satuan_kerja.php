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
                                        <th>Nama Satuan Kerja</th>
                                        <th>Nama Instansi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_satuan_kerja)) {
                                        foreach ($dt_satuan_kerja as $row) {
                                            $instansi = '-';
                                            if (isset($dt_nama_instansi)) {
                                                foreach ($dt_nama_instansi as $ni) {
                                                    if ($ni['id_nama_instansi'] == $row['id_nama_instansi']) {
                                                        $instansi = $ni['nama_instansi'];
                                                        break;
                                                    }
                                                }
                                            } ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_satuan_kerja']; ?></td>
                                                <td><?= $instansi; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_satuan_kerja']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/satuan-kerja/delete/' . encrypt_data($row['id_satuan_kerja'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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
            <form action="<?= site_url('master/satuan-kerja/add'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end">Nama Instansi <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select name="id_nama_instansi" class="form-select select-search" required>
                                <option value="">-- Pilih Nama Instansi --</option>
                                <?php if (isset($dt_nama_instansi)) {
                                    foreach ($dt_nama_instansi as $ni) { ?>
                                        <option value="<?= $ni['id_nama_instansi']; ?>"><?= $ni['nama_instansi']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end">Nama Satuan Kerja <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_satuan_kerja" class="form-control" placeholder="Masukkan nama satuan kerja" required>
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
<?php if (isset($dt_satuan_kerja)) {
    foreach ($dt_satuan_kerja as $row) { ?>
        <div id="modal_edit_<?= $row['id_satuan_kerja']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= site_url('master/satuan-kerja/update/' . encrypt_data($row['id_satuan_kerja'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Instansi <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="id_nama_instansi" class="form-select select-search" required>
                                        <option value="">-- Pilih Nama Instansi --</option>
                                        <?php if (isset($dt_nama_instansi)) {
                                            foreach ($dt_nama_instansi as $ni) { ?>
                                                <option value="<?= $ni['id_nama_instansi']; ?>" <?= $ni['id_nama_instansi'] == $row['id_nama_instansi'] ? 'selected' : ''; ?>>
                                                    <?= $ni['nama_instansi']; ?>
                                                </option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Satuan Kerja <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_satuan_kerja" value="<?= $row['nama_satuan_kerja']; ?>" class="form-control" placeholder="Masukkan nama satuan kerja" required>
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
        <?php if (isset($dt_satuan_kerja)) {
            foreach ($dt_satuan_kerja as $row) { ?>
                $("#modal_edit_<?= $row['id_satuan_kerja']; ?>").on("shown.bs.modal", function() {
                    initSelect2(this);
                });
        <?php }
        } ?>
    });
</script>