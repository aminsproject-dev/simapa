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
                                    <th>Nama Client</th>
                                    <th>Total Harga</th>
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
                                            <td><?= $row_isiSurat->nama_client; ?></td>
                                            <td>Rp. <?= number_format($row_isiSurat->total_all, 0, ',', '.'); ?></td>
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
                            <th>Nama Client</th>
                            <th>Total Harga</th>
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
                                    <td><?= $row_isiSurat->nama_client; ?></td>
                                    <td>Rp. <?= number_format($row_isiSurat->total_all, 0, ',', '.'); ?></td>
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

            <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . base64_encode($jns) . '&action=' . base64_encode('add')); ?>" method="post" name="autoSumForm">
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
                                        <option>-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_jabatan as $jabatan) { ?>
                                            <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanda tangan<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                        <option>-- Silahkan Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class="col-form-label">Nama Client<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_client" class="form-control" placeholder="Masukan Nama Client" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Alamat Client<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat_client" class="form-control" placeholder="Masukan Alamat Client" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Kota Client<span class="text-danger">*</span></label>
                                    <input type="text" name="kota_client" class="form-control" placeholder="Masukan Kota Client" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Telephone<span class="text-danger">*</span></label>
                                    <input type="text" name="no_tlp" class="form-control" placeholder="Masukan Nomor Telepone" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class="col-form-label">Noted<span class="text-danger">*</span></label>
                                    <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                                </div>

                            </div>

                            <div class="row ">
                                <table class="col-lg-12 mb-2">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="65px">No</th>
                                            <th width="300px">Nama Barang</th>
                                            <th style="text-align: center;" width="60px">Jumlah</th>
                                            <th style="text-align: center;" width="90px">Satuan</th>
                                            <th style="text-align: center;" width="120px">Harga</th>
                                            <th style="text-align: center;" width="120px">Total Harga</th>
                                        </tr>
                                    <tbody>
                                        </thead>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_1"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_1"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_1" class="form-control" name="jumlah_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_1" id="satuan_1" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_1" class="form-control" name="harga_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_1" class="form-control" name="total_harga_1" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_2"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_2" class="form-control" name="jumlah_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_2" id="satuan_2" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_2" class="form-control" name="harga_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_2" class="form-control" name="total_harga_2" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_3"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_3" class="form-control" name="jumlah_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_3" id="satuan_3" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_3" class="form-control" name="harga_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_3" class="form-control" name="total_harga_3" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_4"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_4" class="form-control" name="jumlah_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_4" id="satuan_4" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_4" class="form-control" name="harga_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_4" class="form-control" name="total_harga_4" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_5"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_5" class="form-control" name="jumlah_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_5" id="satuan_5" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_5" class="form-control" name="harga_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_5" class="form-control" name="total_harga_5" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_6"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_6" class="form-control" name="jumlah_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_6" id="satuan_6" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_6" class="form-control" name="harga_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_6" class="form-control" name="total_harga_6" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_7"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_7" class="form-control" name="jumlah_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_7" id="satuan_7" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_7" class="form-control" name="harga_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_7" class="form-control" name="total_harga_7" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_8"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_8"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_8" class="form-control" name="jumlah_8" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_8" id="satuan_8" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_8" class="form-control" name="harga_8" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_8" class="form-control" name="total_harga_8" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_9"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_9"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_9" class="form-control" name="jumlah_9" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_9" id="satuan_9" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_9" class="form-control" name="harga_9" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_9" class="form-control" name="total_harga_9" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_10"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_10"></td>
                                            <td><input type="text" style="text-align: center;" id="jumlah_10" class="form-control" name="jumlah_10" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_10" id="satuan_10" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>

                                            <td><input type="text" id="harga_10" class="form-control" name="harga_10" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input type="text" id="total_harga_10" class="form-control" name="total_harga_10" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Sub Total</th>
                                            <td colspan="4"><input style="text-align: right;" type="text" id="total_sementara" class="form-control" name="total_sementara" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><input style="text-align: center;" type="text" id="no_diskon" class="form-control" placeholder="No Diskon" name="no_diskon" readonly value="Diskon"></th>
                                            <td><input style="text-align: right;" type="text" id="persen_diskon" class="form-control" name="persen_diskon" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" id="diskon" class="form-control" name="diskon" onchange="tryNumberFormat(this.form.thirdBox);" readonly> </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4"><input style="text-align: center;" type="text" id="no_uang_muka" class="form-control" placeholder="No Uang Muka" name="no_uang_muka" readonly value="Uang Muka"></th>
                                            <td><input style="text-align: right;" type="text" id="persen_uang_muka" class="form-control" name="persen_uang_muka" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" id="uang_muka" class="form-control" name="uang_muka" onchange="tryNumberFormat(this.form.thirdBox);" readonly> </td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right;">Total Bayar</th>
                                            <td colspan="4"><input style="text-align: right;" type="text" id="total_all" class="form-control" name="total_all" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="text-muted"><span class="text-danger">*</span>) Wajib isi. Harga yang diinput tidak termasuk ppn dan pph</div>

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
                                <embed src='<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . base64_encode($jns) . '&action=' . base64_encode('cetakSurat') . '&idx=' . $row['id_surat']); ?>' width='100%' height='600px'></embed>
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

                    <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . base64_encode($jns) . '&action=' . base64_encode('uploadScan')); ?>" method="post" enctype="multipart/form-data">
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

                    <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . base64_encode($jns) . '&action=' . base64_encode('edit')); ?>" method="post">
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
                                                <option>-- Silahkan Pilih --</option>
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
                                                <option>-- Silahkan Pilih --</option>
                                                <option value="1" <?= $row_isiSurat->img_ttd == '1' ? 'selected' : ''; ?>>Ya</option>
                                                <option value="0" <?= $row_isiSurat->img_ttd == '0' ? 'selected' : ''; ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label class="col-form-label">Nama Client<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_client" value="<?= $row_isiSurat->nama_client; ?>" class="form-control" placeholder="Masukan Nama Client" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Alamat Client<span class="text-danger">*</span></label>
                                            <input type="text" name="alamat_client" value="<?= $row_isiSurat->alamat_client; ?>" class="form-control" placeholder="Masukan Alamat Client" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Kota Client<span class="text-danger">*</span></label>
                                            <input type="text" name="kota_client" value="<?= $row_isiSurat->kota_client; ?>" class="form-control" placeholder="Masukan Kota Client" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Telephone<span class="text-danger">*</span></label>
                                            <input type="text" name="no_tlp" value="<?= $row_isiSurat->no_tlp; ?>" class="form-control" placeholder="Masukan Nomor Telepone" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="<?= $row_isiSurat->email; ?>" class="form-control" placeholder="Masukan email" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label class="col-form-label">Noted<span class="text-danger">*</span></label>
                                            <textarea name="noted" id="noted" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->noted; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="row ">
                                        <table class="col-lg-12 mb-2">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;" width="65px">No</th>
                                                    <th width="300px">Nama Barang</th>
                                                    <th style="text-align: center;" width="60px">Jumlah</th>
                                                    <th style="text-align: center;" width="90px">Satuan</th>
                                                    <th style="text-align: center;" width="120px">Harga</th>
                                                    <th style="text-align: center;" width="120px">Total Harga</th>
                                                </tr>
                                            <tbody>
                                                </thead>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_1" value="<?= $row_isiSurat->no_1; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_1" value="<?= $row_isiSurat->nama_barang_1; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_1" class="form-control" name="jumlah_1" value="<?= $row_isiSurat->jumlah_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_1" id="satuan_1" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_1 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_1" class="form-control" name="harga_1" value="<?= $row_isiSurat->harga_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_1" class="form-control" name="total_harga_1" value="<?= $row_isiSurat->total_harga_1; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_2" value="<?= $row_isiSurat->no_2; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2" value="<?= $row_isiSurat->nama_barang_2; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_2" class="form-control" name="jumlah_2" value="<?= $row_isiSurat->jumlah_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_2" id="satuan_2" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_2 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_2" class="form-control" name="harga_2" value="<?= $row_isiSurat->harga_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_2" class="form-control" name="total_harga_2" value="<?= $row_isiSurat->total_harga_2; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_3" value="<?= $row_isiSurat->no_3; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3" value="<?= $row_isiSurat->nama_barang_3; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_3" class="form-control" name="jumlah_3" value="<?= $row_isiSurat->jumlah_3; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_3" id="satuan_3" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_3 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_3" class="form-control" name="harga_3" value="<?= $row_isiSurat->harga_3; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_3" class="form-control" name="total_harga_3" value="<?= $row_isiSurat->total_harga_3; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_4" value="<?= $row_isiSurat->no_4; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4" value="<?= $row_isiSurat->nama_barang_4; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_4" class="form-control" name="jumlah_4" value="<?= $row_isiSurat->jumlah_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_4" id="satuan_4" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_4 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_4" class="form-control" name="harga_4" value="<?= $row_isiSurat->harga_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_4" class="form-control" name="total_harga_4" value="<?= $row_isiSurat->total_harga_4; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_5" value="<?= $row_isiSurat->no_5; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5" value="<?= $row_isiSurat->nama_barang_5; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_5" class="form-control" name="jumlah_5" value="<?= $row_isiSurat->jumlah_5; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_5" id="satuan_5" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_5 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_5" class="form-control" name="harga_5" value="<?= $row_isiSurat->harga_5; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_5" class="form-control" name="total_harga_5" value="<?= $row_isiSurat->total_harga_5; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_6" value="<?= $row_isiSurat->no_6; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6" value="<?= $row_isiSurat->nama_barang_6; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_6" class="form-control" name="jumlah_6" value="<?= $row_isiSurat->jumlah_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_6" id="satuan_6" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_6 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_6" class="form-control" name="harga_6" value="<?= $row_isiSurat->harga_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_6" class="form-control" name="total_harga_6" value="<?= $row_isiSurat->total_harga_6; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_7" value="<?= $row_isiSurat->no_7; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7" value="<?= $row_isiSurat->nama_barang_7; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_7" class="form-control" name="jumlah_7" value="<?= $row_isiSurat->jumlah_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_7" id="satuan_7" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_7 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_7" class="form-control" name="harga_7" value="<?= $row_isiSurat->harga_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_7" class="form-control" name="total_harga_7" value="<?= $row_isiSurat->total_harga_7; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_8" value="<?= $row_isiSurat->no_8; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_8" value="<?= $row_isiSurat->nama_barang_8; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_8" class="form-control" name="jumlah_8" value="<?= $row_isiSurat->jumlah_8; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_8" id="satuan_8" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_8 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_8" class="form-control" name="harga_8" value="<?= $row_isiSurat->harga_8; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_8" class="form-control" name="total_harga_8" value="<?= $row_isiSurat->total_harga_8; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_9" value="<?= $row_isiSurat->no_9; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_9" value="<?= $row_isiSurat->nama_barang_9; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_9" class="form-control" name="jumlah_9" value="<?= $row_isiSurat->jumlah_9; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_9" id="satuan_9" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_9 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_9" class="form-control" name="harga_9" value="<?= $row_isiSurat->harga_9; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_9" class="form-control" name="total_harga_9" value="<?= $row_isiSurat->total_harga_9; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" style="text-align: center;" id="nama" class="form-control" placeholder="No" name="no_10" value="<?= $row_isiSurat->no_10; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_10" value="<?= $row_isiSurat->nama_barang_10; ?>"></td>
                                                    <td><input type="text" style="text-align: center;" id="jumlah_10" class="form-control" name="jumlah_10" value="<?= $row_isiSurat->jumlah_10; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_10" id="satuan_10" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) {
                                                                if ($row_isiSurat->satuan_10 == $satuan->nama_satuan) { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>" selected><?= $satuan->nama_satuan; ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" id="harga_10" class="form-control" name="harga_10" value="<?= $row_isiSurat->harga_10; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="text" id="total_harga_10" class="form-control" name="total_harga_10" value="<?= $row_isiSurat->total_harga_10; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>

                                                <tr>
                                                    <th colspan="3" style="text-align: right;">Sub Total</th>
                                                    <td colspan="4"><input style="text-align: right;" type="text" id="total_sementara" class="form-control" name="total_sementara" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"><input style="text-align: center;" type="text" id="no_diskon" class="form-control" placeholder="No Diskon" name="no_diskon" readonly value="Diskon"></th>
                                                    <td><input style="text-align: right;" type="text" id="persen_diskon" class="form-control" name="persen_diskon" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="diskon" class="form-control" name="diskon" onchange="tryNumberFormat(this.form.thirdBox);" readonly> </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"><input style="text-align: center;" type="text" id="no_uang_muka" class="form-control" placeholder="No Uang Muka" name="no_uang_muka" readonly value="Uang Muka"></th>
                                                    <td><input style="text-align: right;" type="text" id="persen_uang_muka" class="form-control" name="persen_uang_muka" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="uang_muka" class="form-control" name="uang_muka" onchange="tryNumberFormat(this.form.thirdBox);" readonly> </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" style="text-align: right;">Total Bayar</th>
                                                    <td colspan="4"><input style="text-align: right;" type="text" id="total_all" class="form-control" name="total_all" value="<?= $row_isiSurat->total_all; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="text-muted"><span class="text-danger">*</span>) Wajib isi. Harga yang diinput tidak termasuk ppn dan pph</div>

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
    function startCalc() {
        interval = setInterval("calc()", 1);
    }

    function calc() {
        jumlah_1 = document.autoSumForm.jumlah_1.value;
        harga_1 = document.autoSumForm.harga_1.value;
        document.autoSumForm.total_harga_1.value = (jumlah_1 * 1) * (harga_1 * 1);
        jumlah_2 = document.autoSumForm.jumlah_2.value;
        harga_2 = document.autoSumForm.harga_2.value;
        document.autoSumForm.total_harga_2.value = (jumlah_2 * 1) * (harga_2 * 1);
        jumlah_3 = document.autoSumForm.jumlah_3.value;
        harga_3 = document.autoSumForm.harga_3.value;
        document.autoSumForm.total_harga_3.value = (jumlah_3 * 1) * (harga_3 * 1);
        jumlah_4 = document.autoSumForm.jumlah_4.value;
        harga_4 = document.autoSumForm.harga_4.value;
        document.autoSumForm.total_harga_4.value = (jumlah_4 * 1) * (harga_4 * 1);
        jumlah_5 = document.autoSumForm.jumlah_5.value;
        harga_5 = document.autoSumForm.harga_5.value;
        document.autoSumForm.total_harga_5.value = (jumlah_5 * 1) * (harga_5 * 1);
        jumlah_6 = document.autoSumForm.jumlah_6.value;
        harga_6 = document.autoSumForm.harga_6.value;
        document.autoSumForm.total_harga_6.value = (jumlah_6 * 1) * (harga_6 * 1);
        jumlah_7 = document.autoSumForm.jumlah_7.value;
        harga_7 = document.autoSumForm.harga_7.value;
        document.autoSumForm.total_harga_7.value = (jumlah_7 * 1) * (harga_7 * 1);
        jumlah_8 = document.autoSumForm.jumlah_8.value;
        harga_8 = document.autoSumForm.harga_8.value;
        document.autoSumForm.total_harga_8.value = (jumlah_8 * 1) * (harga_8 * 1);
        jumlah_9 = document.autoSumForm.jumlah_9.value;
        harga_9 = document.autoSumForm.harga_9.value;
        document.autoSumForm.total_harga_9.value = (jumlah_9 * 1) * (harga_9 * 1);
        jumlah_10 = document.autoSumForm.jumlah_10.value;
        harga_10 = document.autoSumForm.harga_10.value;
        document.autoSumForm.total_harga_10.value = (jumlah_10 * 1) * (harga_10 * 1);
        total_sementara = document.autoSumForm.total_sementara.value;
        document.autoSumForm.total_sementara.value = ((jumlah_1 * 1) * (harga_1 * 1)) + ((jumlah_2 * 1) * (harga_2 * 1)) + ((jumlah_3 * 1) * (harga_3 * 1)) + ((jumlah_4 * 1) * (harga_4 * 1)) + ((jumlah_5 * 1) * (harga_5 * 1)) + ((jumlah_6 * 1) * (harga_6 * 1)) + ((jumlah_7 * 1) * (harga_7 * 1)) + ((jumlah_8 * 1) * (harga_8 * 1)) + ((jumlah_9 * 1) * (harga_9 * 1)) + ((jumlah_10 * 1) * (harga_10 * 1));
        persen_diskon = document.autoSumForm.persen_diskon.value;
        diskon = document.autoSumForm.diskon.value;
        document.autoSumForm.diskon.value = (persen_diskon / 100) * (total_sementara * 1);
        persen_uang_muka = document.autoSumForm.persen_uang_muka.value;
        uang_muka = document.autoSumForm.uang_muka.value;
        document.autoSumForm.uang_muka.value = (total_sementara - diskon) * (persen_uang_muka / 100);
        total_all = document.autoSumForm.total_all.value;
        document.autoSumForm.total_all.value = (total_sementara - diskon - uang_muka);
    }

    function stopCalc() {
        clearInterval(interval);
    }
</script>