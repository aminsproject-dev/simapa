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
                                        <th>Instansi</th>
                                        <th>Satuan Kerja</th>
                                        <th>Alamat</th>
                                        <th>Nama PP</th>
                                        <th>Nama PPk</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_ekatalog)) {
                                        foreach ($dt_ekatalog as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->instansi; ?></td>
                                                <td><?= $row->satuan_kerja; ?></td>
                                                <td><?= $row->alamat_satuan_kerja; ?></td>
                                                <td><?= $row->nama_pp; ?></td>
                                                <td><?= $row->nama_ppk; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row->id_marketing_ekatalog; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('marketing/ekatalogDelete/' . $row->id_marketing_ekatalog); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

            <form action="<?= site_url('marketing/ekatalogAdd'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Instansi<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="instansi" class="form-control" placeholder="Masukkan Nama Instansi" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Satuan Kerja<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="satuan_kerja" class="form-control" placeholder="Masukkan Nama Satuan Kerja" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Alamat Satuan Kerja<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea name="alamat_satuan_kerja" id="alamat_satuan_kerja" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama PP<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_pp" class="form-control" placeholder="Masukkan Nama PP" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Jabatan PP<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="jabatan_pp" class="form-control" placeholder="Masukkan Jabatan PP" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">NIP PP<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nip_pp" class="form-control" placeholder="Masukkan Nip PP" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Email PP<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="email_pp" class="form-control" placeholder="Masukkan Email PP" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nomor Telephone PP<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="no_tlp_pp" class="form-control" placeholder="Masukkan Nomor Telephone PP" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nama PPk<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nama_ppk" class="form-control" placeholder="Masukkan Nama PPK" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Jabatan PPk<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="jabatan_ppk" class="form-control" placeholder="Masukkan Jabatan" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">NIP PPk<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="nip_ppk" class="form-control" placeholder="Masukkan NIP PPK" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Email PPk<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="email_ppk" class="form-control" placeholder="Masukkan Email PPK" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-2 col-form-label text-lg-end">Nomor Telephone PPk<span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="no_tlp_ppk" class="form-control" placeholder="Masukkan Nomor Telephone PPK" required>
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
if (isset($dt_ekatalog)) {
    foreach ($dt_ekatalog as $row) {
?>
        <div id="modal_edit_<?= $row->id_marketing_ekatalog; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('marketing/ekatalogEdit'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_marketing_ekatalog" value="<?= $row->id_marketing_ekatalog; ?>">
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="instansi" value="<?= $row->instansi; ?>" class="form-control" placeholder="Masukkan Nama Instansi" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Satuan Kerja<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="satuan_kerja" value="<?= $row->satuan_kerja; ?>" class="form-control" placeholder="Masukkan Nama Satuan Kerja" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat Satuan Kerja<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="alamat_satuan_kerja" id="alamat_satuan_kerja" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row->alamat_satuan_kerja; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama PP<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_pp" value="<?= $row->nama_pp; ?>" class="form-control" placeholder="Masukkan Nama PP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Jabatan PP<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="jabatan_pp" value="<?= $row->jabatan_pp; ?>" class="form-control" placeholder="Masukkan Jabatan PP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">NIP PP<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nip_pp" value="<?= $row->nip_pp; ?>" class="form-control" placeholder="Masukkan Nip PP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Email PP<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="email_pp" value="<?= $row->email_pp; ?>" class="form-control" placeholder="Masukkan Email PP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nomor Telephone PP<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="no_tlp_pp" value="<?= $row->no_tlp_pp; ?>" class="form-control" placeholder="Masukkan Nomor Telephone PP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama PPk<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_ppk" value="<?= $row->nama_ppk; ?>" class="form-control" placeholder="Masukkan Nama PPK" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Jabatan PPk<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="jabatan_ppk" value="<?= $row->jabatan_ppk; ?>" class="form-control" placeholder="Masukkan Jabatan" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">NIP PPk<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nip_ppk" value="<?= $row->nip_ppk; ?>" class="form-control" placeholder="Masukkan NIP PPK" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Email PPk<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="email_ppk" value="<?= $row->email_ppk; ?>" class="form-control" placeholder="Masukkan Email PPK" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nomor Telephone PPk<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="no_tlp_ppk" value="<?= $row->no_tlp_ppk; ?>" class="form-control" placeholder="Masukkan Nomor Telephone PPK" required>
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