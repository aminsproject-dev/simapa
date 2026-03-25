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

                        <table class="table datatable-5 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Nama Vendor</th>
                                    <th>Alamat Vendor</th>
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
                                            <td><?= $row_isiSurat->nama_vendor; ?></td>
                                            <td><?= $row_isiSurat->alamat_vendor; ?></td>
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

                <table class="table datatable-5 table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Nama Vendor</th>
                            <th>Alamat Vendor</th>
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
                                    <td><?= $row_isiSurat->nama_vendor; ?></td>
                                    <td><?= $row_isiSurat->alamat_vendor; ?></td>
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

            <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('add')); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nomor Surat<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nomor_surat" value="<?= $nomor_surat; ?>" class="form-control" placeholder="Autogenerate" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Auto generate<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="qrgen" value="<?= $qrgen; ?>" class="form-control" placeholder="qrgen" required readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_vendor" id="nama_vendor" class="form-control" placeholder="Masukan Nama Vendor" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Kota Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select class="form-control select-search" id="" name="kota_vendor" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_kabupaten as $kabupaten) { ?>
                                            <option value="<?= $kabupaten->nama_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama Rekening Bank Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_rekening_vendor" id="nama_rekening_vendor" class="form-control" placeholder="Masukan Nama Rekening Vendor" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nama NPWP<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="nama_npwp" id="nama_npwp" value="AMINS PROJECT TEKNOLOGI INDONESIA" class="form-control" placeholder="Masukan Nama NPWP" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="tanggal_pengiriman" id="tanggal_pengiriman" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Alamat Pengiriman<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control ckeditor_classic" rows="4" cols="4">a/n AMINS PROJECT TEKNOLOGI INDONESIA, Jl. Cempedak VI/I Taman, Kota Madiun, Jawa Timur (63131)</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Mengetahui<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select class="form-control select-search" id="" name="mengetahui" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_jabatan as $jabatan) { ?>
                                            <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Tanda Tangan<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Alamat Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="alamat_vendor" id="alamat_vendor" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Bank Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select class="form-control select-search" id="bank_vendor" name="bank_vendor" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_bank as $bank) { ?>
                                            <option value="<?= $bank->nama_bank; ?>"><?= $bank->nama_bank; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nomor Rekening Bank Vendor<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="number" name="rekening_vendor" id="rekening_vendor" class="form-control" placeholder="Masukan Rekening Vendor" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Nomor NPWP<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="number" name="npwp" id="npwp" class="form-control" placeholder="Masukan Nomor NPWP" value="93.501.450.6-621.000" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Down Payment<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="number" name="down_payment" id="down_payment" class="form-control" placeholder="Masukan Down Payment" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label text-lg-end">Noted<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-12 mt-2 ">
                            <div class="text-end">
                                <button type="button" class="btn btn-primary mb-3" onclick="tambahBaris()">Tambah Baris</button>
                            </div>

                            <div class="row mb-2 ">
                                <div class="col-1">
                                    <p class="fw-bold">No</p>
                                </div>
                                <div class="col-3">
                                    <p class="fw-bold">Nama Barang</p>
                                </div>
                                <div class="col-2">
                                    <p class="fw-bold">Jumlah</p>
                                </div>
                                <div class="col-2">
                                    <p class="fw-bold">Satuan</p>
                                </div>
                                <div class="col-3">
                                    <p class="fw-bold">Harga</p>
                                </div>
                            </div>
                            <div class="barang-wrapper">
                                <div class="row mb-2 barang-row" data-index="0">
                                    <div class="col-1">
                                        <input type="text" class="form-control" name="no[0]" id="no_0" placeholder="No">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="nama_barang[0]" id="nama_barang_0" placeholder="Nama Barang">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" class="form-control" name="jumlah[0]" id="jumlah_0" placeholder="Jumlah">
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control select-search" name="satuan[0]" id="satuan_0" required>
                                            <option value="">Pilih Satuan</option>
                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="number" class="form-control" name="harga[0]" id="harga_0" placeholder="Harga">
                                    </div>
                                </div>
                            </div>

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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nomor Surat<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nomor_surat" value="<?= $row['no_surat']; ?>" class="form-control" placeholder="Autogenerate" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Auto generate<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="qrgen" value="<?= $row['qrgen']; ?>" class="form-control" placeholder="qrgen" required readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nama Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nama_vendor" value="<?= $row_isiSurat->nama_vendor; ?>" id="nama_vendor" class="form-control" placeholder="Masukan Nama Vendor" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Kota Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" id="" name="kota_vendor" required>
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php foreach ($dt_kabupaten as $kabupaten) {
                                                    if ($row_isiSurat->kota_vendor == $kabupaten->nama_kabupaten) { ?>
                                                        <option value="<?= $kabupaten->nama_kabupaten; ?>" selected><?= $kabupaten->nama_kabupaten; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $kabupaten->nama_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nama Rekening Bank Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nama_rekening_vendor" value="<?= $row_isiSurat->nama_rekening_vendor; ?>" id="nama_rekening_vendor" class="form-control" placeholder="Masukan Nama Rekening Vendor" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nama NPWP<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="nama_npwp" id="nama_npwp" value="<?= $row_isiSurat->nama_npwp; ?>" class="form-control" placeholder="Masukan Nama NPWP" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="tanggal_pengiriman" id="tanggal_pengiriman" value="<?= $row_isiSurat->tanggal_pengiriman; ?>" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Alamat Pengiriman<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->alamat_pengiriman; ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Mengetahui<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" id="" name="mengetahui" required>
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
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Tanda Tangan<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                                <option value="">-- Silahkan Pilih --</option>
                                                <option value="1" <?= $row_isiSurat->img_ttd == '1' ? 'selected' : ''; ?>>Ya</option>
                                                <option value="0" <?= $row_isiSurat->img_ttd == '0' ? 'selected' : ''; ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Alamat Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <textarea name="alamat_vendor" id="alamat_vendor" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->alamat_vendor; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Bank Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" id="bank_vendor" name="bank_vendor" required>
                                                <option value="">-- Silahkan Pilih --</option>
                                                <?php foreach ($dt_bank as $bank) {
                                                    if ($row_isiSurat->bank_vendor == $bank->nama_bank) { ?>
                                                        <option value="<?= $bank->nama_bank; ?>" selected><?= $bank->nama_bank; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $bank->nama_bank; ?>"><?= $bank->nama_bank; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nomor Rekening Bank Vendor<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="number" name="rekening_vendor" value="<?= $row_isiSurat->rekening_vendor; ?>" id="rekening_vendor" class="form-control" placeholder="Masukan Rekening Vendor" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Nomor NPWP<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="number" name="npwp" id="npwp" class="form-control" placeholder="Masukan Nomor NPWP" value="<?= $row_isiSurat->npwp; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Down Payment<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="number" name="down_payment" value="<?= $row_isiSurat->down_payment; ?>" id="down_payment" class="form-control" placeholder="Masukan Down Payment" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label text-lg-end">Noted<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->noted; ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12 mt-2 ">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary mb-3" onclick="tambahBaris()">Tambah Baris</button>
                                    </div>

                                    <div class="row mb-2 ">
                                        <div class="col-1">
                                            <p class="fw-bold">No</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="fw-bold">Nama Barang</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="fw-bold">Jumlah</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="fw-bold">Satuan</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="fw-bold">Harga</p>
                                        </div>
                                    </div>
                                    <?php

                                    $index = 0;
                                    foreach ($row_isiSurat->barang as $barang) { ?>
                                        <div>
                                            <div class="row mb-2 barang-row" data-index="<?= $index; ?>">
                                                <div class="col-1">
                                                    <input type="text" class="form-control" name="no[<?= $index; ?>]" value="<?= $barang->no; ?>" id="no_<?= $index; ?>" placeholder="No">
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" name="nama_barang[<?= $index; ?>]" value="<?= $barang->nama_barang; ?>" id="nama_barang_<?= $index; ?>" placeholder="Nama Barang">
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="form-control" name="jumlah[<?= $index; ?>]" value="<?= $barang->jumlah; ?>" id="jumlah_<?= $index; ?>" placeholder="Jumlah">
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control select-search" name="satuan[<?= $index; ?>]" value="<?= $barang->satuan; ?>" id="satuan_<?= $index; ?>" required>
                                                        <option value="">Pilih Satuan</option>
                                                        <?php foreach ($dt_satuan as $satuan) {
                                                            if ($barang->satuan == $satuan->nama_satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control" name="harga[<?= $index; ?>]" value="<?= $barang->harga; ?>" id="harga_<?= $index; ?>" placeholder="Harga">
                                                    <div class="text-muted">Rp. <?= number_format((int)$barang->harga, 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $index++;
                                    } ?>

                                    <div class="barang-wrapper">
                                        <div class="row mb-2 barang-row" data-index="<?= $index; ?>">
                                            <div class="col-1">
                                                <input type="text" class="form-control" name="no[<?= $index; ?>]" id="no_<?= $index; ?>" placeholder="No">
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" name="nama_barang[<?= $index; ?>]" id="nama_barang_<?= $index; ?>" placeholder="Nama Barang">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" class="form-control" name="jumlah[<?= $index; ?>]" id="jumlah_<?= $index; ?>" placeholder="Jumlah">
                                            </div>
                                            <div class="col-2">
                                                <select class="form-control select-search" name="satuan[<?= $index; ?>]" id="satuan_<?= $index; ?>" >
                                                    <option value="">Pilih Satuan</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" class="form-control" name="harga[<?= $index; ?>]" id="harga_<?= $index; ?>" placeholder="Harga">
                                            </div>
                                        </div>
                                    </div>

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

    let index = 1;

    function tambahBaris() {
        const wrappers = document.querySelectorAll('.barang-wrapper');

        wrappers.forEach(wrapper => {
            const row = document.createElement('div');
            row.className = 'row mb-2 barang-row';
            row.dataset.index = index;

            row.innerHTML = `
            <div class="col-1">
                <input type="text" class="form-control" name="no[${index}]" id="no_${index}" placeholder="No">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="nama_barang[${index}]" id="nama_barang_${index}" placeholder="Nama Barang">
            </div>
            <div class="col-2">
                <input type="number" class="form-control" name="jumlah[${index}]" id="jumlah_${index}" placeholder="Jumlah">
            </div>
            <div class="col-2">
                <select class="form-control select-search" name="satuan[${index}]" id="satuan_${index}">
                    <option value="">Pilih Satuan</option>
                </select>
            </div>
            <div class="col-3">
                <input type="number" class="form-control" name="harga[${index}]" id="harga_${index}" placeholder="Harga">
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-danger" onclick="hapusBaris(this)"><i class="ph-x"></i></button>
            </div>
        `;

            wrapper.appendChild(row);
            index++;
        });
    }

    function hapusBaris(btn) {
        const row = btn.closest('.barang-row');
        row.remove();
    }
</script>