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
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Hp</th>
                                        <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_pegawai)) {
                                        foreach ($dt_pegawai as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['nip']; ?></td>
                                                <td><?= $row['nama_pegawai']; ?></td>
                                                <td><?= $row['no_hp']; ?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_pegawai']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('master/employees/delete/' . encrypt_data($row['id_pegawai'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

            <form action="<?= site_url('master/employees/add'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">NIP/NRPD<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nip" class="form-control" placeholder="Masukkan Nip" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Jabatan<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control select-search" id="jabatan" name="jabatan" required>
                                <option>Pilih Jabatan</option>
                                <?php foreach ($dt_jabatan as $jabatan) { ?>
                                    <option value="<?= $jabatan['id_jabatan']; ?>"><?= $jabatan['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama Lengkap<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Tempat, Tanggal Lahir</label>
                        <div class="col-lg-5">
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                        </div>
                        <div class="col-lg-5">
                            <input type="text" name="tanggal_lahir" class="form-control daterange-single" placeholder="Masukkan Tanggal Lahir">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Jenis Kelamin<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control select-search" id="jenkel" name="jenkel" required>
                                <option>Pilih Jenis Kelamin</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Email<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">No Hp<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="no_hp" class="form-control" placeholder="Masukkan Nomor Hp" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Alamat<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea name="alamat" id="alamat" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
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
if (isset($dt_pegawai)) {
    foreach ($dt_pegawai as $row) {
?>
        <div id="modal_edit_<?= $row['id_pegawai']; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('master/employees/update/' . encrypt_data($row['id_pegawai'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">NIP/NRPD<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nip" value="<?= $row['nip']; ?>" class="form-control" placeholder="Masukkan Nip" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Jabatan<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control select-search" id="jabatan" name="jabatan" required>
                                        <option>Pilih Jabatan</option>
                                        <?php foreach ($dt_jabatan as $jabatan) { ?>
                                            <option value="<?= $jabatan['id_jabatan']; ?>" <?= $jabatan['id_jabatan'] == $row['jabatan'] ? 'selected' : ''; ?>><?= $jabatan['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Lengkap<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_pegawai" value="<?= $row['nama_pegawai']; ?>" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Tempat, Tanggal Lahir</label>
                                <div class="col-lg-5">
                                    <input type="text" name="tempat_lahir" value="<?= $row['tempat_lahir']; ?>" class="form-control" placeholder="Masukkan Tempat Lahir">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" class="form-control daterange-single" placeholder="Masukkan Tanggal Lahir">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Jenis Kelamin<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control select-search" id="jenkel" name="jenkel" required>
                                        <option>Pilih Jenis Kelamin</option>
                                        <option value="Pria" <?= $row['jenkel'] == 'Pria' ? 'selected' : ''; ?>>Pria</option>
                                        <option value="Wanita" <?= $row['jenkel'] == 'Wanita' ? 'selected' : ''; ?>>Wanita</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Email<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" value="<?= $row['email']; ?>" class="form-control" placeholder="Masukkan email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">No Hp<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>" class="form-control" placeholder="Masukkan Nomor Hp" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="alamat" id="alamat" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row['alamat']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Aktif?<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="aktif" class="form-control select-search">
                                        <option value="1" <?= $row['aktif'] == '1' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="0" <?= $row['aktif'] == '0' ? 'selected' : ''; ?>>Tidak Aktif</option>
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