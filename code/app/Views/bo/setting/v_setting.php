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
                        </div>
                    </div>
                    <div class="card-body">


                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a
                                    href="#js-tab1"
                                    class="nav-link active"
                                    data-bs-toggle="tab">
                                    Profile
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#js-tab2" class="nav-link" data-bs-toggle="tab">
                                    Kop Surat
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#js-tab3" class="nav-link" data-bs-toggle="tab">
                                    Konfigurasi Sistem
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#js-tab4" class="nav-link" data-bs-toggle="tab">
                                    Kode Surat
                                </a>
                            </li>



                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="js-tab1">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Konten</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dt_setting as $setting) {
                                                if ($setting['jenis'] != '1') continue;
                                            ?>
                                                <tr>
                                                    <td><?= $setting['desc']; ?></td>
                                                    <td><?= $setting['content']; ?></td>
                                                    <td>
                                                        <a href="#modal_edit_<?= $setting['id']; ?>" data-bs-toggle="modal" class="dropdown-item">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade " id="js-tab2">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Konten</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dt_setting as $setting) {
                                                if ($setting['jenis'] != '3') continue;
                                            ?>
                                                <tr>
                                                    <td><?= $setting['desc']; ?></td>
                                                    <td><?= $setting['content']; ?></td>
                                                    <td>
                                                        <a href="#modal_edit_<?= $setting['id']; ?>" data-bs-toggle="modal" class="dropdown-item">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade " id="js-tab3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Konten</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dt_setting as $setting) {
                                                if ($setting['jenis'] != '2') continue;
                                            ?>
                                                <tr>
                                                    <td><?= $setting['desc']; ?></td>
                                                    <td><?= $setting['content']; ?></td>
                                                    <td>
                                                        <a href="#modal_edit_<?= $setting['id']; ?>" data-bs-toggle="modal" class="dropdown-item">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="js-tab4">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Konten</th>
                                                <th>Jenis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dt_kode as $kode) { ?>
                                                <tr>
                                                    <td><?= $kode['nama_menu']; ?></td>
                                                    <td><?= $kode['kode']; ?></td>
                                                    <td><?= $kode['jenis']; ?></td>
                                                    <td>
                                                        <a href="#modal_editKode_<?= $kode['id']; ?>" data-bs-toggle="modal" class="dropdown-item">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

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

<?php foreach ($dt_kode as $kode) { ?>
    <div id="modal_editKode_<?= $kode['id']; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu <?= $kode['nama_menu']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?= base_url('setting/update-kode/' . encrypt_data($kode['id'])); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label text-lg-end">Nama Menu</label>
                            <div class="col-lg-9">
                                <input type="text" name="nama_menu" value="<?= $kode['nama_menu']; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label text-lg-end">Url Menu</label>
                            <div class="col-lg-9">
                                <input type="text" name="url" value="<?= $kode['url']; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label text-lg-end">Kode Surat</label>
                            <div class="col-lg-9">
                                <input type="text" name="kode" value="<?= $kode['kode']; ?>" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label text-lg-end">Jenis Surat</label>
                            <div class="col-lg-9">
                                <input type="text" name="jenis" value="<?= $kode['jenis']; ?>" class="form-control" required>
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
<?php } ?>

<?php foreach ($dt_setting as $setting) { ?>
    <div id="modal_edit_<?= $setting['id']; ?>" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?= base_url('setting/update/' . encrypt_data($setting['id'])); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="setting_gambar" value="<?= $setting['gambar']; ?>">
                    <div class="modal-body">
                        <?php if ($setting['gambar'] == 1) { ?>
                            <div class="row justify-content-center mb-3">
                                <img src="<?= base_url('showLogoApp'); ?>" alt="image" style="width: 200px;">
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end"><?= $setting['desc']; ?></label>
                                <div class="col-lg-10">
                                    <input type="file" name="content" accept=".png,.jpg,.jpeg" class="form-control" required>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end"><?= $setting['desc']; ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="content" value="<?= $setting['content']; ?>" class="form-control" required>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php } ?>