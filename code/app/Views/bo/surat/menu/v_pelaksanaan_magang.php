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
                            <a data-bs-toggle="modal" data-bs-target="#modal_arsip" class="btn btn-secondary fw-bold">
                                <i class="ph-archive me-1"></i>
                                Arsip Surat
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#modal_tambah" class="btn btn-primary fw-bold">
                                <i class="ph-plus me-1"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table datatable-6 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Kepada</th>
                                    <th>Mulai Magang</th>
                                    <th>Akhir Magang</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                if (isset($dt_surat)) {
                                    foreach ($dt_surat as $row) {
                                        $row_isiSurat = json_decode($row['isi_surat']);
                                ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['no_surat']; ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                            <td><?= $row_isiSurat->nama_kampus; ?></td>
                                            <td><?= $row_isiSurat->mulai_masuk; ?></td>
                                            <td><?= $row_isiSurat->akhir_masuk; ?></td>
                                            <td class="text-center">
                                                <div class="d-inline-flex">
                                                    <div class="dropdown">
                                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                            <i class="ph-list"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_cetakSurat_<?= $row['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Cetak Surat">
                                                                <i class="ph-printer me-2"></i>
                                                                Cetak Surat
                                                            </a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_uploadScan_<?= $row['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Upload Scan Surat">
                                                                <i class="ph-cloud-arrow-up me-2"></i>
                                                                Upload Scan
                                                            </a>
                                                            <?php if ($row['file_scan'] !== null && $row['file_scan'] !== '') { ?>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_lihatScan_<?= $row['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Scan Surat">
                                                                    <i class="ph-magnifying-glass me-2"></i>
                                                                    Lihat Scan File
                                                                </a>
                                                            <?php } ?>
                                                            <a href="#" class="dropdown-item sweet_confirm" data-url="<?= site_url('surat/archive/' . $row['id_surat']); ?>" data-message="Surat akan masuk ke arsip" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Arsip Surat">
                                                                <i class="ph-archive me-2"></i>
                                                                Arsip Surat
                                                            </a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_<?= $row['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Surat">
                                                                <i class="ph-note-pencil me-2"></i>
                                                                Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('surat/deleteSurat/' . $row['id_surat']); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Surat">
                                                                <i class="ph-trash me-2"></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
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
<!-- /content area -->
</div>
<!-- /main content -->


<div id="modal_arsip" class="modal fade" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Arsip <?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table datatable-6 table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Kepada</th>
                            <th>Mulai Magang</th>
                            <th>Akhir Magang</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        if (isset($dt_arsip)) {
                            foreach ($dt_arsip as $arsip) {
                                $row_isiSurat = json_decode($arsip['isi_surat']);
                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $arsip['no_surat']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($arsip['tanggal'])); ?></td>
                                    <td><?= $row_isiSurat->nama_kampus; ?></td>
                                    <td><?= $row_isiSurat->mulai_masuk; ?></td>
                                    <td><?= $row_isiSurat->akhir_masuk; ?></td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_cetakSurat_<?= $arsip['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Cetak Surat">
                                                        <i class="ph-printer me-2"></i>
                                                        Cetak Surat
                                                    </a>
                                                    <?php if ($arsip['file_scan'] !== null && $arsip['file_scan'] !== '') { ?>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_lihatScan_<?= $arsip['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Scan Surat">
                                                            <i class="ph-magnifying-glass me-2"></i>
                                                            Lihat Scan File
                                                        </a>
                                                    <?php } ?>
                                                    <a href="#" class="dropdown-item sweet_confirm" data-url="<?= site_url('surat/unarchive/' . $arsip['id_surat']); ?>" data-message="Surat akan keluar dari arsip" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Keluarkan Arsip Surat">
                                                        <i class="ph-cloud-arrow-down me-2"></i>
                                                        Kembalikan Arsip
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                        <?php }
                        } ?>


                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<div id="modal_tambah" class="modal fade" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('add')); ?>" method="post" name="autoSumForm">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Surat INVS<span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_surat" value="<?= $nomor_surat; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Qrgen<span class="text-danger">*</span></label>
                                    <input type="text" name="qrgen" value="<?= $qrgen; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Mengetahui<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="mengetahui" name="mengetahui" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_jabatan as $jabatan) { ?>
                                            <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanda tangan<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nama Kampus / Sekolah<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_kampus" class="form-control" placeholder="Masukan Nama Kampus/Sekolah Lengkap" required>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Alamat Kampus / Sekolah<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat_kampus" class="form-control" placeholder="Masukan Alamat Kampus  / Sekolah" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Jumlah Siswa / Mahasiswa<span class="text-danger">*</span></label>
                                    <input type="text" name="jumlah_siswa" class="form-control" placeholder="Masukan Jumlah Siswa" required>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Surat<span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_surat_balas" class="form-control" placeholder="Masukan Nomor Surat" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Mulai Masuk<span class="text-danger">*</span></label>
                                    <input type="text" name="mulai_masuk" class="form-control daterange-single" placeholder="Masukan Mulai Masuk" required>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Mulai Akhir<span class="text-danger">*</span></label>
                                    <input type="text" name="akhir_masuk" class="form-control daterange-single" placeholder="Masukan Mulai Akhir" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Jurusan<span class="text-danger">*</span></label>
                                    <input type="text" name="jurusan" class="form-control" placeholder="Masukan jurusan" required>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nama PJ<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_pj" class="form-control" placeholder="Masukan Nama PJ" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class="col-form-label">Noted<span class="text-danger">*</span></label>
                                    <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                                </div>

                            </div>

                            <div class="row">
                                <table class="col-lg-12 mb-2">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="65px">No</th>
                                            <th width="530px">Nama</th>
                                            <th style="text-align: center;" width="170px">NIS / NIM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_1" class="form-control" placeholder="No" name="no_1"></td>
                                            <td><input type="text" id="nama_1" class="form-control" placeholder="Nama" name="nama_1"></td>
                                            <td><input type="text" id="nis_1" class="form-control" placeholder="NIS / NIM" name="nis_1"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_2" class="form-control" placeholder="No" name="no_2"></td>
                                            <td><input type="text" id="nama_2" class="form-control" placeholder="Nama" name="nama_2"></td>
                                            <td><input type="text" id="nis_2" class="form-control" placeholder="NIS / NIM" name="nis_2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_3" class="form-control" placeholder="No" name="no_3"></td>
                                            <td><input type="text" id="nama_3" class="form-control" placeholder="Nama" name="nama_3"></td>
                                            <td><input type="text" id="nis_3" class="form-control" placeholder="NIS / NIM" name="nis_3"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_4" class="form-control" placeholder="No" name="no_4"></td>
                                            <td><input type="text" id="nama_4" class="form-control" placeholder="Nama" name="nama_4"></td>
                                            <td><input type="text" id="nis_4" class="form-control" placeholder="NIS / NIM" name="nis_4"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_5" class="form-control" placeholder="No" name="no_5"></td>
                                            <td><input type="text" id="nama_5" class="form-control" placeholder="Nama" name="nama_5"></td>
                                            <td><input type="text" id="nis_5" class="form-control" placeholder="NIS / NIM" name="nis_5"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_6" class="form-control" placeholder="No" name="no_6"></td>
                                            <td><input type="text" id="nama_6" class="form-control" placeholder="Nama" name="nama_6"></td>
                                            <td><input type="text" id="nis_6" class="form-control" placeholder="NIS / NIM" name="nis_6"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="no_7" class="form-control" placeholder="No" name="no_7"></td>
                                            <td><input type="text" id="nama_7" class="form-control" placeholder="Nama" name="nama_7"></td>
                                            <td><input type="text" id="nis_7" class="form-control" placeholder="NIS / NIM" name="nis_7"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="text-muted"><span class="text-danger">*</span>) Wajib isi.</div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
if (isset($dt_surat) || isset($dt_arsip)) {
    foreach (array_merge($dt_surat, $dt_arsip)  as $row) {
        $row_isiSurat = json_decode($row['isi_surat']);

?>
        <div id="modal_cetakSurat_<?= $row['id_surat']; ?>" data-bs-backdrop="static" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cetak Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <embed src='<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('cetakSurat') . '&idx=' . $row['id_surat']); ?>' width='100%' height='600px'></embed>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>

        <div id="modal_uploadScan_<?= $row['id_surat']; ?>" data-bs-backdrop="static" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Scan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('uploadScan')); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_surat" value="<?= $row['id_surat']; ?>">
                        <div class="modal-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nomor Surat<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nomor_surat" value="<?= $row['no_surat']; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Auto generate<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="qrgen" value="<?= $row['qrgen']; ?>" class="form-control" placeholder="qrgen" required readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">FIle Scan<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="file" name="file_scan" class="form-control" accept=".pdf" required>
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

        <div id="modal_lihatScan_<?= $row['id_surat']; ?>" data-bs-backdrop="static" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Lihat File Scan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <embed src='<?= site_url('surat/lihatScanSurat/' . $row['id_surat']); ?>' width='100%' height='600px'></embed>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>

        <div id="modal_edit_<?= $row['id_surat']; ?>" data-bs-backdrop="static" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('edit')); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_surat" value="<?= $row['id_surat']; ?>">
                        <div class="modal-body">

                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Surat INVS<span class="text-danger">*</span></label>
                                            <input type="text" name="nomor_surat" value="<?= $row['no_surat']; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Qrgen<span class="text-danger">*</span></label>
                                            <input type="text" name="qrgen" value="<?= $row['qrgen']; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Mengetahui<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="mengetahui" name="mengetahui" required>
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php
                                                $isiTtd = json_decode($row['tanda_tangan']);
                                                foreach ($dt_jabatan as $jabatan) {
                                                    if ($isiTtd->id_jabatan == $jabatan->id_jabatan) { ?>
                                                        <option value="<?= $jabatan->id_jabatan; ?>" selected><?= $jabatan->nama; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanda tangan<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                                <option value="">-- Silahkan Pilih --</option>
                                                <option value="1" <?= $row_isiSurat->img_ttd == '1' ? 'selected' : ''; ?>>Ya</option>
                                                <option value="0" <?= $row_isiSurat->img_ttd == '0' ? 'selected' : ''; ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nama Kampus / Sekolah<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_kampus" value="<?= $row_isiSurat->nama_kampus; ?>" class="form-control" placeholder="Masukan Nama Kampus/Sekolah Lengkap" required>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Alamat Kampus / Sekolah<span class="text-danger">*</span></label>
                                            <input type="text" name="alamat_kampus" value="<?= $row_isiSurat->alamat_kampus; ?>" class="form-control" placeholder="Masukan Alamat Kampus  / Sekolah" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Jumlah Siswa / Mahasiswa<span class="text-danger">*</span></label>
                                            <input type="text" name="jumlah_siswa" value="<?= $row_isiSurat->jumlah_siswa; ?>" class="form-control" placeholder="Masukan Jumlah Siswa" required>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Surat<span class="text-danger">*</span></label>
                                            <input type="text" name="nomor_surat_balas" value="<?= $row_isiSurat->nomor_surat_balas; ?>" class="form-control" placeholder="Masukan Nomor Surat" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Mulai Masuk<span class="text-danger">*</span></label>
                                            <input type="text" name="mulai_masuk" value="<?= $row_isiSurat->mulai_masuk; ?>" class="form-control daterange-single" placeholder="Masukan Mulai Masuk" required>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Mulai Akhir<span class="text-danger">*</span></label>
                                            <input type="text" name="akhir_masuk" value="<?= $row_isiSurat->akhir_masuk; ?>" class="form-control daterange-single" placeholder="Masukan Mulai Akhir" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Jurusan<span class="text-danger">*</span></label>
                                            <input type="text" name="jurusan" value="<?= $row_isiSurat->jurusan; ?>" class="form-control" placeholder="Masukan jurusan" required>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nama PJ<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_pj" value="<?= $row_isiSurat->nama_pj; ?>" class="form-control" placeholder="Masukan Nama PJ" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label class="col-form-label">Noted<span class="text-danger">*</span></label>
                                            <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->noted; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <table class="col-lg-12 mb-2">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;" width="65px">No</th>
                                                    <th width="530px">Nama</th>
                                                    <th style="text-align: center;" width="170px">NIS / NIM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_1" class="form-control" placeholder="No" name="no_1" value="<?= $row_isiSurat->no_1; ?>"></td>
                                                    <td><input type="text" id="nama_1" class="form-control" placeholder="Nama" name="nama_1" value="<?= $row_isiSurat->nama_1; ?>"></td>
                                                    <td><input type="text" id="nis_1" class="form-control" placeholder="NIS / NIM" name="nis_1" value="<?= $row_isiSurat->nis_1; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_2" class="form-control" placeholder="No" name="no_2" value="<?= $row_isiSurat->no_2; ?>"></td>
                                                    <td><input type="text" id="nama_2" class="form-control" placeholder="Nama" name="nama_2" value="<?= $row_isiSurat->nama_2; ?>"></td>
                                                    <td><input type="text" id="nis_2" class="form-control" placeholder="NIS / NIM" name="nis_2" value="<?= $row_isiSurat->nis_2; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_3" class="form-control" placeholder="No" name="no_3" value="<?= $row_isiSurat->no_3; ?>"></td>
                                                    <td><input type="text" id="nama_3" class="form-control" placeholder="Nama" name="nama_3" value="<?= $row_isiSurat->nama_3; ?>"></td>
                                                    <td><input type="text" id="nis_3" class="form-control" placeholder="NIS / NIM" name="nis_3" value="<?= $row_isiSurat->nis_3; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_4" class="form-control" placeholder="No" name="no_4" value="<?= $row_isiSurat->no_4; ?>"></td>
                                                    <td><input type="text" id="nama_4" class="form-control" placeholder="Nama" name="nama_4" value="<?= $row_isiSurat->nama_4; ?>"></td>
                                                    <td><input type="text" id="nis_4" class="form-control" placeholder="NIS / NIM" name="nis_4" value="<?= $row_isiSurat->nis_4; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_5" class="form-control" placeholder="No" name="no_5" value="<?= $row_isiSurat->no_5; ?>"></td>
                                                    <td><input type="text" id="nama_5" class="form-control" placeholder="Nama" name="nama_5" value="<?= $row_isiSurat->nama_5; ?>"></td>
                                                    <td><input type="text" id="nis_5" class="form-control" placeholder="NIS / NIM" name="nis_5" value="<?= $row_isiSurat->nis_5; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_6" class="form-control" placeholder="No" name="no_6" value="<?= $row_isiSurat->no_6; ?>"></td>
                                                    <td><input type="text" id="nama_6" class="form-control" placeholder="Nama" name="nama_6" value="<?= $row_isiSurat->nama_6; ?>"></td>
                                                    <td><input type="text" id="nis_6" class="form-control" placeholder="NIS / NIM" name="nis_6" value="<?= $row_isiSurat->nis_6; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="no_7" class="form-control" placeholder="No" name="no_7" value="<?= $row_isiSurat->no_7; ?>"></td>
                                                    <td><input type="text" id="nama_7" class="form-control" placeholder="Nama" name="nama_7" value="<?= $row_isiSurat->nama_7; ?>"></td>
                                                    <td><input type="text" id="nis_7" class="form-control" placeholder="NIS / NIM" name="nis_7" value="<?= $row_isiSurat->nis_7; ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                            <div class="text-muted"><span class="text-danger">*</span>) Wajib isi. </div>

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