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
                            <table class="table datatable-6 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jabatan</th>
                                        <th>NIP/NRPD</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_pengguna)) {
                                        foreach ($dt_pengguna as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->nama; ?></td>
                                                <td><?= $row->nip; ?></td>
                                                <td><?= $row->nama_pegawai; ?></td>
                                                <td><?= $row->username; ?></td>
                                                <td><?= $row->role; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row->id; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('setting/penggunaDelete/' . $row->id); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

            <form action="<?= site_url('setting/penggunaAdd'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Pegawai<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control select-search" id="id_pegawai" name="id_pegawai" required>
                                <option>Pilih Pegawai</option>
                                <?php foreach ($dt_pegawai as $pegawai) { ?>
                                    <option value="<?= $pegawai->id_pegawai; ?>"><?= $pegawai->nama_pegawai; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Username<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Kata Sandi<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Role Akses<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control select-search" id="role" name="role" required>
                                <option>Pilih Akses</option>
                                <option value="Admin">Admin</option>
                                <option value="Kepala Desa">Kepala Desa</option>
                                <option value="Staf">Staf</option>
                            </select>
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
if (isset($dt_pengguna)) {
    foreach ($dt_pengguna as $row) {
?>
        <div id="modal_edit_<?= $row->id; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('setting/penggunaEdit'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?= $row->id; ?>">
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Pegawai<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control select-search" id="id_pegawai" name="id_pegawai" required>
                                        <option>Pilih Pegawai</option>
                                        <?php foreach ($dt_pegawai as $pegawai) {
                                            if ($row->id_pegawai == $pegawai->id_pegawai) { ?>
                                                <option value="<?= $pegawai->id_pegawai; ?>" selected><?= $pegawai->nama_pegawai; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $pegawai->id_pegawai; ?>"><?= $pegawai->nama_pegawai; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Username<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="username" value="<?= $row->username; ?>" class="form-control" placeholder="Masukkan Username" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kata Sandi<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Role Akses<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control select-search" id="role" name="role" required>
                                        <option>Pilih Akses</option>
                                        <option value="<?= $row->role; ?>" selected><?= $row->role; ?></option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kepala Desa">Kepala Desa</option>
                                        <option value="Staf">Staf</option>
                                    </select>
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