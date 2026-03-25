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

                        <table class="table datatable-7 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No SP</th>
                                    <th>Satuan Kerja</th>
                                    <th>Tanggal Kontrak</th>
                                    <th>Instansi</th>
                                    <th>Kode QR</th>
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
                                            <td><?= $row_isiSurat->no_pemesanan; ?></td>
                                            <td><?= $row_isiSurat->satuan_kerja; ?></td>
                                            <td><?= date('d/m/Y', strtotime($row_isiSurat->tgl_pemesanan)); ?></td>
                                            <td><?= $row_isiSurat->nama_instansi; ?></td>
                                            <td><?= $row_isiSurat->qrgen; ?></td>
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

                <table class="table datatable-7 table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No SP</th>
                            <th>Satuan Kerja</th>
                            <th>Tanggal Kontrak</th>
                            <th>Instansi</th>
                            <th>Kode QR</th>
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
                                    <td><?= $row_isiSurat->no_pemesanan; ?></td>
                                    <td><?= $row_isiSurat->satuan_kerja; ?></td>
                                    <td><?= date('d/m/Y', strtotime($row_isiSurat->tgl_pemesanan)); ?></td>
                                    <td><?= $row_isiSurat->nama_instansi; ?></td>
                                    <td><?= $row_isiSurat->qrgen; ?></td>
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

            <form action="<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('add')); ?>" method="post" name="autoSumForm">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Surat Pengiriman Barang<span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_surat" value="<?= $nomor_surat; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Pengiriman Barang<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_spb" class="form-control daterange-single" placeholder="Tanggal Pengiriman Barang" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Surat Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="sphp" value="<?php echo $sphp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_sphp" class="form-control daterange-single" placeholder="Tanggal Penyerahan Hasil Pekerjaan" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Sertifikat Garansi<span class="text-danger">*</span></label>
                                    <input type="text" name="sg" value="<?php echo $sg; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Sertifikat Garansi<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_sg" class="form-control daterange-single" placeholder="Tanggal Sertifikat Garansi" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="sppp" value="<?php echo $sppp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_sppp" class="form-control daterange-single" placeholder="Tanggal Surat Pemeriksaan Hasil Pekerjaan" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                    <input type="text" name="spp" value="<?php echo $spp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_spp" class="form-control daterange-single" placeholder="Tanggal Surat Permohonan Pembayaran" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Invoice Inaproc<span class="text-danger">*</span></label>
                                    <input type="text" name="inv" value="<?php echo $inv; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Invoice Inaproc<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_inv" class="form-control daterange-single" placeholder="Tanggal Invoice Inaproc" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Kwitansi Inaproc<span class="text-danger">*</span></label>
                                    <input type="text" name="kwn" value="<?php echo $kwn; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Kwitansi Inaproc<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_kwn" class="form-control daterange-single" placeholder="Tanggal Kwitansi Inaproc" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-4 mb-2">
                                    <label class="col-form-label">Auto Generate<span class="text-danger">*</span></label>
                                    <input type="text" name="qrgen" value="<?php echo $qrgen; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <label class="col-form-label">Tanda Tangan<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                        <option>-- Silahkan Pilih --</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <label class="col-form-label">Mengetahui<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="mengetahui" name="mengetahui" required>
                                        <option>-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_jabatan as $jabatan) { ?>
                                            <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Pesanan<span class="text-danger">*</span></label>
                                    <input type="text" name="no_pemesanan" class="form-control" placeholder="Masukan Nomor Pesanan" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Pesanan<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_pemesanan" class="form-control daterange-single" placeholder="Masukkan Tanggal Pesanan" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Surat Pesanan<span class="text-danger">*</span></label>
                                    <input type="text" name="no_surat_pemesanan" class="form-control" placeholder="Masukan Nomor Surat Pemesanan" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Surat Pesanan<span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_surat_pemesanan" class="form-control daterange-single" placeholder="Masukkan Tanggal Surat Pesanan" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nama PPK<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_ppk" class="form-control" placeholder="Masukan Nama PPK" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Divisi<span class="text-danger">*</span></label>
                                    <input type="text" name="divisi" class="form-control " placeholder="Masukkan Nama Divisi" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Satuan Kerja<span class="text-danger">*</span></label>
                                    <input type="text" name="satuan_kerja" class="form-control" placeholder="Masukan Satuan Kerja" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Alamat Pemesan<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat_pemesan" class="form-control daterange-single" placeholder="Masukan Alamat Pemesan" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="nama_kabupaten" name="nama_kabupaten" required>
                                        <option>-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_kabupaten as $kabupaten) { ?>
                                            <option value="<?= $kabupaten->id_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Daerah Provinsi<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="nama_provinsi" name="nama_provinsi" required>
                                        <option>-- Silahkan Pilih --</option>
                                        <?php foreach ($tb_provinsi as $provinsi) { ?>
                                            <option value="<?= $provinsi->id; ?>"><?= $provinsi->nama_provinsi; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nama Instansi<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_instansi" class="form-control" placeholder="Masukan Nama Instansi" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">NPWP Satuan Kerja<span class="text-danger">*</span></label>
                                    <input type="text" name="npwp_satuan_kerja" class="form-control" placeholder="Masukan NPWP Satuan Kerja" required>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Permintaan Tiba<span class="text-danger">*</span></label>
                                    <input type="text" name="permintaan_tiba" class="form-control daterange-single" placeholder="Masukan Permintaan Tiba" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Perlu Dikirim Sebelum<span class="text-danger">*</span></label>
                                    <input type="text" name="perlu_dikirim_sebelum" class="form-control daterange-single" placeholder="Masukan Perlu Dikirim Sebelum" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Mulai Dikirim<span class="text-danger">*</span></label>
                                    <input type="text" name="mulai_dikirim" class="form-control" placeholder="Masukan Mulai Dikirim" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Estimasi Tiba<span class="text-danger">*</span></label>
                                    <input type="text" name="estimasi_tiba" class="form-control" placeholder="Masukan Estimasi Tiba" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class="col-form-label">Catatan Permintaan Tiba<span class="text-danger">*</span></label>
                                    <input type="text" name="catatan_permintaan_tiba" class="form-control" placeholder="Masukan Catatan Permintaan Tiba" required>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Pembayaran<span class="text-danger">*</span></label>
                                    <input type="text" name="pembayaran" class="form-control" placeholder="Masukan Pembayaran" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Pengiriman<span class="text-danger">*</span></label>
                                    <input type="text" name="pengiriman" class="form-control" placeholder="Masukan pengiriman" required>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nama Penerima<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penerima" class="form-control" placeholder="Masukan Nama Penerima" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Alamat Pengiriman<span class="text-danger">*</span></label>
                                    <input type="text" name="alamat_pengiriman" class="form-control" placeholder="Masukan Alamat Pengiriman" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Telp Penerima<span class="text-danger">*</span></label>
                                    <input type="text" name="notlp_penerima" class="form-control" placeholder="Masukan Nomor Telp Penerima" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Catatan Alamat Pengiriman<span class="text-danger">*</span></label>
                                    <input type="text" name="catatan_alamat_pengiriman" class="form-control" placeholder="Masukan Catatan Alamat Pengiriman" required>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Vendor Pengiriman<span class="text-danger">*</span></label>
                                    <input type="text" name="vendor_pengiriman" class="form-control" placeholder="Masukan Vendor Pengiriman" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Transaksi<span class="text-danger">*</span></label>
                                    <input type="text" name="no_transaksi" class="form-control" placeholder="Masukan Nomor Transaksi" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Nomor Resi<span class="text-danger">*</span></label>
                                    <input type="text" name="no_resi" class="form-control" placeholder="Masukan Nomor Resi" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="col-form-label">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                    <input type="text" name="tanggal_pengiriman" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <label class="col-form-label">Garansi Kategori Barang<span class="text-danger">*</span></label>
                                    <select class="form-control select-search" id="kategori_barang" name="kategori_barang" required>
                                        <option value="">-- Silahkan Pilih --</option>
                                        <?php foreach ($dt_garansi as $garansi) { ?>
                                            <option value="<?= $garansi->id_sertifikat_garansi; ?>"><?= $garansi->nama_sertifikat; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <table class="col-lg-12 mb-2">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="65px">No</th>
                                            <th width="300px">Nama Barang</th>
                                            <th style="text-align: center;" width="70px">Jumlah</th>
                                            <th style="text-align: center;" width="100px">Satuan</th>
                                            <th style="text-align: center;" width="120px">Harga</th>
                                            <th style="text-align: center;" width="120px">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_1"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_1"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_1" class="form-control" name="jumlah_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_1" id="satuan_1" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_1" class="form-control" name="harga_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_1" class="form-control" name="total_harga_1" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_2"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_2" class="form-control" name="jumlah_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_2" id="satuan_2" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_2" class="form-control" name="harga_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_2" class="form-control" name="total_harga_2" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_3"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_3" class="form-control" name="jumlah_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_3" id="satuan_3" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_3" class="form-control" name="harga_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_3" class="form-control" name="total_harga_3" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_4"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_4" class="form-control" name="jumlah_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_4" id="satuan_4" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_4" class="form-control" name="harga_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_4" class="form-control" name="total_harga_4" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_5"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_5" class="form-control" name="jumlah_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_5" id="satuan_5" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_5" class="form-control" name="harga_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_5" class="form-control" name="total_harga_5" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_6"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_6" class="form-control" name="jumlah_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_6" id="satuan_6" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_6" class="form-control" name="harga_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_6" class="form-control" name="total_harga_6" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_7"></td>
                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7"></td>
                                            <td><input style="text-align: center;" type="text" id="jumlah_7" class="form-control" name="jumlah_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><select name="satuan_7" id="satuan_7" class="select-search form-control">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($dt_satuan as $satuan) { ?>
                                                        <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input style="text-align: right;" type="text" id="harga_7" class="form-control" name="harga_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" value='' id="total_harga_7" class="form-control" name="total_harga_7" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                        </tr>

                                        <tr>
                                            <th colspan="4"><input style="text-align: center;" type="text" id="no_ongkir" class="form-control" placeholder="No" name="no_ongkir" readonly value="Ongkir"></th>
                                            <td><input style="text-align: right;" type="text" id="harga_ongkir" class="form-control" name="harga_ongkir" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                            <td><input style="text-align: right;" type="text" id="total_harga_ongkir" class="form-control" name="total_harga_ongkir" onchange="tryNumberFormat(this.form.thirdBox);" readonly value=""> </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Total</th>
                                            <td colspan="4"><input style="text-align: right;" type="text" value='' id="total_all" class="form-control" name="total_all" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
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
    foreach (array_merge($dt_surat, $dt_arsip) as $row) {
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
                                            <label class="col-form-label">Surat Pengiriman Barang<span class="text-danger">*</span></label>
                                            <input type="text" name="nomor_surat" value="<?= $row['no_surat']; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Pengiriman Barang<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_spb" value="<?= (isset($row_isiSurat->tgl_spb)) ? $row_isiSurat->tgl_spb : ''; ?>" class="form-control daterange-single" placeholder="Tanggal Pengiriman Barang" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Surat Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                            <input type="text" name="sphp" value="<?= $row_isiSurat->sphp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_sphp" value="<?= $row_isiSurat->tgl_sphp; ?>" class="form-control daterange-single" placeholder="Tanggal Penyerahan Hasil Pekerjaan" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Sertifikat Garansi<span class="text-danger">*</span></label>
                                            <input type="text" name="sg" value="<?= $row_isiSurat->sg; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Sertifikat Garansi<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_sg" value="<?= $row_isiSurat->tgl_sg; ?>" class="form-control daterange-single" placeholder="Tanggal Sertifikat Garansi" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                            <input type="text" name="sppp" value="<?= $row_isiSurat->sppp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_sppp" value="<?= $row_isiSurat->tgl_sppp; ?>" class="form-control daterange-single" placeholder="Tanggal Surat Pemeriksaan Hasil Pekerjaan" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                            <input type="text" name="spp" value="<?= $row_isiSurat->spp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_spp" value="<?= $row_isiSurat->tgl_spp; ?>" class="form-control daterange-single" placeholder="Tanggal Surat Permohonan Pembayaran" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Invoice Inaproc<span class="text-danger">*</span></label>
                                            <input type="text" name="inv" value="<?= $row_isiSurat->inv; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Invoice Inaproc<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_inv" value="<?= $row_isiSurat->tgl_inv; ?>" class="form-control daterange-single" placeholder="Tanggal Invoice Inaproc" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Kwitansi Inaproc<span class="text-danger">*</span></label>
                                            <input type="text" name="kwn" value="<?= $row_isiSurat->kwn; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Kwitansi Inaproc<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_kwn" value="<?= $row_isiSurat->tgl_kwn; ?>" class="form-control daterange-single" placeholder="Tanggal Kwitansi Inaproc" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <label class="col-form-label">Auto Generate<span class="text-danger">*</span></label>
                                            <input type="text" name="qrgen" value="<?= $row_isiSurat->qrgen; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label class="col-form-label">Tanda Tangan<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                                <option>-- Silahkan Pilih --</option>
                                                <option value="1" <?= ($row_isiSurat->img_ttd == 1) ? 'selected' : ''; ?>>Ya</option>
                                                <option value="0" <?= ($row_isiSurat->img_ttd == 0) ? 'selected' : ''; ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <label class="col-form-label">Mengetahui<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="mengetahui" name="mengetahui" required>
                                                <option>-- Silahkan Pilih --</option>
                                                <?php foreach ($dt_jabatan as $jabatan) {
                                                    if (isset($row_isiSurat->mengetahui) && $row_isiSurat->mengetahui == $jabatan->id_jabatan) { ?>
                                                        <option value="<?= $jabatan->id_jabatan; ?>" selected><?= $jabatan->nama; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Pesanan<span class="text-danger">*</span></label>
                                            <input type="text" name="no_pemesanan" value="<?= $row_isiSurat->no_pemesanan; ?>" class="form-control" placeholder="Masukan Nomor Pesanan" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Pesanan<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_pemesanan" value="<?= $row_isiSurat->tgl_pemesanan; ?>" class="form-control daterange-single" placeholder="Masukkan Tanggal Pesanan" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Surat Pesanan<span class="text-danger">*</span></label>
                                            <input type="text" name="no_surat_pemesanan" value="<?= $row_isiSurat->no_surat_pemesanan; ?>" class="form-control" placeholder="Masukan Nomor Surat Pemesanan" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Surat Pesanan<span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_surat_pemesanan" value="<?= $row_isiSurat->tgl_surat_pemesanan; ?>" class="form-control daterange-single" placeholder="Masukkan Tanggal Surat Pesanan" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nama PPK<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_ppk" value="<?= $row_isiSurat->nama_ppk; ?>" class="form-control" placeholder="Masukan Nama PPK" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Divisi<span class="text-danger">*</span></label>
                                            <input type="text" name="divisi" value="<?= $row_isiSurat->divisi; ?>" class="form-control " placeholder="Masukkan Nama Divisi" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Satuan Kerja<span class="text-danger">*</span></label>
                                            <input type="text" name="satuan_kerja" value="<?= $row_isiSurat->satuan_kerja; ?>" class="form-control" placeholder="Masukan Satuan Kerja" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Alamat Pemesan<span class="text-danger">*</span></label>
                                            <input type="text" name="alamat_pemesan" value="<?= $row_isiSurat->alamat_pemesan; ?>" class="form-control daterange-single" placeholder="Masukan Alamat Pemesan" required>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="nama_kabupaten" name="nama_kabupaten" required>
                                                <option>-- Silahkan Pilih --</option>
                                                <?php foreach ($dt_kabupaten as $kabupaten) {
                                                    if ($row_isiSurat->nama_kabupaten == $kabupaten->nama_kabupaten) { ?>
                                                        <option value="<?= $kabupaten->nama_kabupaten; ?>" selected><?= $kabupaten->nama_kabupaten; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $kabupaten->nama_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Daerah Provinsi<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="nama_provinsi" name="nama_provinsi" required>
                                                <option>-- Silahkan Pilih --</option>
                                                <?php foreach ($tb_provinsi as $provinsi) {
                                                    if ($row_isiSurat->nama_provinsi == $provinsi->nama_provinsi) { ?>
                                                        <option value="<?= $provinsi->nama_provinsi; ?>" selected><?= $provinsi->nama_provinsi; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $provinsi->nama_provinsi; ?>"><?= $provinsi->nama_provinsi; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nama Instansi<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_instansi" value="<?= $row_isiSurat->nama_instansi; ?>" class="form-control" placeholder="Masukan Nama Instansi" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">NPWP Satuan Kerja<span class="text-danger">*</span></label>
                                            <input type="text" name="npwp_satuan_kerja" value="<?= $row_isiSurat->npwp_satuan_kerja; ?>" class="form-control" placeholder="Masukan NPWP Satuan Kerja" required>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Permintaan Tiba<span class="text-danger">*</span></label>
                                            <input type="text" name="permintaan_tiba" value="<?= $row_isiSurat->permintaan_tiba; ?>" class="form-control daterange-single" placeholder="Masukan Permintaan Tiba" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Perlu Dikirim Sebelum<span class="text-danger">*</span></label>
                                            <input type="text" name="perlu_dikirim_sebelum" value="<?= $row_isiSurat->perlu_dikirim_sebelum; ?>" class="form-control daterange-single" placeholder="Masukan Perlu Dikirim Sebelum" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Mulai Dikirim<span class="text-danger">*</span></label>
                                            <input type="text" name="mulai_dikirim" value="<?= $row_isiSurat->mulai_dikirim; ?>" class="form-control" placeholder="Masukan Mulai Dikirim" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Estimasi Tiba<span class="text-danger">*</span></label>
                                            <input type="text" name="estimasi_tiba" value="<?= $row_isiSurat->estimasi_tiba; ?>" class="form-control" placeholder="Masukan Estimasi Tiba" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label class="col-form-label">Catatan Permintaan Tiba<span class="text-danger">*</span></label>
                                            <input type="text" name="catatan_permintaan_tiba" value="<?= $row_isiSurat->catatan_permintaan_tiba; ?>" class="form-control" placeholder="Masukan Catatan Permintaan Tiba" required>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Pembayaran<span class="text-danger">*</span></label>
                                            <input type="text" name="pembayaran" value="<?= $row_isiSurat->pembayaran; ?>" class="form-control" placeholder="Masukan Pembayaran" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Pengiriman<span class="text-danger">*</span></label>
                                            <input type="text" name="pengiriman" value="<?= $row_isiSurat->pengiriman; ?>" class="form-control" placeholder="Masukan pengiriman" required>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nama Penerima<span class="text-danger">*</span></label>
                                            <input type="text" name="nama_penerima" value="<?= $row_isiSurat->nama_penerima; ?>" class="form-control" placeholder="Masukan Nama Penerima" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Alamat Pengiriman<span class="text-danger">*</span></label>
                                            <input type="text" name="alamat_pengiriman" value="<?= $row_isiSurat->alamat_pengiriman; ?>" class="form-control" placeholder="Masukan Alamat Pengiriman" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Telp Penerima<span class="text-danger">*</span></label>
                                            <input type="text" name="notlp_penerima" value="<?= $row_isiSurat->notlp_penerima; ?>" class="form-control" placeholder="Masukan Nomor Telp Penerima" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Catatan Alamat Pengiriman<span class="text-danger">*</span></label>
                                            <input type="text" name="catatan_alamat_pengiriman" value="<?= $row_isiSurat->catatan_alamat_pengiriman; ?>" class="form-control" placeholder="Masukan Catatan Alamat Pengiriman" required>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Vendor Pengiriman<span class="text-danger">*</span></label>
                                            <input type="text" name="vendor_pengiriman" value="<?= $row_isiSurat->vendor_pengiriman; ?>" class="form-control" placeholder="Masukan Vendor Pengiriman" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Transaksi<span class="text-danger">*</span></label>
                                            <input type="text" name="no_transaksi" value="<?= $row_isiSurat->no_transaksi; ?>" class="form-control" placeholder="Masukan Nomor Transaksi" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Nomor Resi<span class="text-danger">*</span></label>
                                            <input type="text" name="no_resi" value="<?= $row_isiSurat->no_resi; ?>" class="form-control" placeholder="Masukan Nomor Resi" required>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label class="col-form-label">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                            <input type="text" name="tanggal_pengiriman" value="<?= $row_isiSurat->tanggal_pengiriman; ?>" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label class="col-form-label">Garansi Kategori Barang<span class="text-danger">*</span></label>
                                            <select class="form-control select-search" id="kategori_barang" name="kategori_barang" required>
                                                <option>-- Silahkan Pilih --</option>
                                                <?php foreach ($dt_garansi as $garansi) {
                                                    if (isset($row_isiSurat->kategori_barang) && $row_isiSurat->kategori_barang == $garansi->id_sertifikat_garansi) { ?>
                                                        <option value="<?= $garansi->id_sertifikat_garansi; ?>" selected><?= $garansi->nama_sertifikat; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $garansi->id_sertifikat_garansi; ?>"><?= $garansi->nama_sertifikat; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <table class="col-lg-12 mb-2">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;" width="65px">No</th>
                                                    <th width="300px">Nama Barang</th>
                                                    <th style="text-align: center;" width="70px">Jumlah</th>
                                                    <th style="text-align: center;" width="100px">Satuan</th>
                                                    <th style="text-align: center;" width="120px">Harga</th>
                                                    <th style="text-align: center;" width="120px">Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_1" value="<?= $row_isiSurat->no_1; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_1" value="<?= $row_isiSurat->nama_barang_1; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_1" class="form-control" name="jumlah_1" value="<?= $row_isiSurat->jumlah_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_1" class="form-control" name="harga_1" value="<?= $row_isiSurat->harga_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="total_harga_1" class="form-control" name="total_harga_1" value="<?= $row_isiSurat->total_harga_1; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_2" value="<?= $row_isiSurat->no_2; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2" value="<?= $row_isiSurat->nama_barang_2; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_2" class="form-control" name="jumlah_2" value="<?= $row_isiSurat->jumlah_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_2" class="form-control" name="harga_2" value="<?= $row_isiSurat->harga_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" value='' id="total_harga_2" class="form-control" name="total_harga_2" value="<?= $row_isiSurat->total_harga_2; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_3" value="<?= $row_isiSurat->no_3; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3" value="<?= $row_isiSurat->nama_barang_3; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_3" class="form-control" name="jumlah_3" value="<?= $row_isiSurat->jumlah_3; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_3" class="form-control" name="harga_3" value="<?= $row_isiSurat->harga_3; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="total_harga_3" class="form-control" name="total_harga_3" value="<?= $row_isiSurat->total_harga_3; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_4" value="<?= $row_isiSurat->no_4; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4" value="<?= $row_isiSurat->nama_barang_4; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_4" class="form-control" name="jumlah_4" value="<?= $row_isiSurat->jumlah_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_4" class="form-control" name="harga_4" value="<?= $row_isiSurat->harga_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="total_harga_4" class="form-control" name="total_harga_4" value="<?= $row_isiSurat->total_harga_4; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_5" value="<?= $row_isiSurat->no_5; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5" value="<?= $row_isiSurat->nama_barang_5; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_5" class="form-control" name="jumlah_5" value="<?= $row_isiSurat->jumlah_5; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_5" class="form-control" name="harga_5" value="<?= $row_isiSurat->harga_5; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" value='' id="total_harga_5" class="form-control" name="total_harga_5" value="<?= $row_isiSurat->total_harga_5; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_6" value="<?= $row_isiSurat->no_6; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6" value="<?= $row_isiSurat->nama_barang_6; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_6" class="form-control" name="jumlah_6" value="<?= $row_isiSurat->jumlah_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_6" class="form-control" name="harga_6" value="<?= $row_isiSurat->harga_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" value='' id="total_harga_6" class="form-control" name="total_harga_6" value="<?= $row_isiSurat->total_harga_6; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_7" value="<?= $row_isiSurat->no_7; ?>"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7" value="<?= $row_isiSurat->nama_barang_7; ?>"></td>
                                                    <td><input style="text-align: center;" type="text" id="jumlah_7" class="form-control" name="jumlah_7" value="<?= $row_isiSurat->jumlah_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
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
                                                    <td><input style="text-align: right;" type="text" id="harga_7" class="form-control" name="harga_7" value="<?= $row_isiSurat->harga_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" value='' id="total_harga_7" class="form-control" name="total_harga_7" value="<?= $row_isiSurat->total_harga_7; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>

                                                <tr>
                                                    <th colspan="4"><input style="text-align: center;" type="text" id="no_ongkir" class="form-control" placeholder="No" name="no_ongkir" readonly value="Ongkir"></th>
                                                    <td><input style="text-align: right;" type="text" id="harga_ongkir" class="form-control" name="harga_ongkir" value="<?= $row_isiSurat->harga_ongkir; ?>" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input style="text-align: right;" type="text" id="total_harga_ongkir" class="form-control" name="total_harga_ongkir" value="<?= $row_isiSurat->total_harga_ongkir; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly> </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">Total</th>
                                                    <td colspan="4"><input style="text-align: right;" type="text" id="total_all" class="form-control" name="total_all" value="<?= $row_isiSurat->total_all; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
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
        harga_ongkir = document.autoSumForm.harga_ongkir.value;
        document.autoSumForm.total_harga_ongkir.value = (harga_ongkir * 1);
        document.autoSumForm.total_all.value = ((jumlah_1 * 1) * (harga_1 * 1)) + ((jumlah_2 * 1) * (harga_2 * 1)) + ((jumlah_3 * 1) * (harga_3 * 1)) + ((jumlah_4 * 1) * (harga_4 * 1)) + ((jumlah_5 * 1) * (harga_5 * 1)) + ((jumlah_6 * 1) * (harga_6 * 1)) + ((jumlah_7 * 1) * (harga_7 * 1)) + (harga_ongkir * 1);
    }

    function stopCalc() {
        clearInterval(interval);
    }
</script>