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

                        <table class="table datatable-8 table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Paket</th>
                                    <th>Nama Paket</th>
                                    <th>Satuan Kerja</th>
                                    <th>Tanggal Paket</th>
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
                                            <td><?= $row_isiSurat->id_paket; ?></td>
                                            <td><?= $row_isiSurat->nama_paket_pekerjaan; ?></td>
                                            <td><?= $row_isiSurat->satuan_kerja; ?></td>
                                            <td><?= $row_isiSurat->tanggal_paket_dibuat; ?></td>
                                            <td><?= $row_isiSurat->instansi; ?></td>
                                            <td><?= $row_isiSurat->qrgen; ?></td>
                                            <td>Rp.<?= number_format($row_isiSurat->total_all, 0, ',', '.'); ?></td>
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
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_cetakAmplop_<?= $row['id_surat']; ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Cetak Amplop">
                                                                <i class="ph-envelope-simple-open me-2"></i>
                                                                Cetak Sampul
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

                <table class="table datatable-8 table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Paket</th>
                            <th>Nama Paket</th>
                            <th>Satuan Kerja</th>
                            <th>Tanggal Paket</th>
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
                                    <td><?= $row_isiSurat->id_paket; ?></td>
                                    <td><?= $row_isiSurat->nama_paket_pekerjaan; ?></td>
                                    <td><?= $row_isiSurat->satuan_kerja; ?></td>
                                    <td><?= $row_isiSurat->tanggal_paket_dibuat; ?></td>
                                    <td><?= $row_isiSurat->instansi; ?></td>
                                    <td><?= $row_isiSurat->qrgen; ?></td>
                                    <td><?= $row_isiSurat->total_all; ?></td>
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

                    <div class="row justify-content-evenly">
                        <div class="col-lg-12">
                            <div class="row justify-content-evenly">
                                <div class="col-lg-12">
                                    <div class="row mb-3">
                                        <label class="col-form-label ">Surat Pengiriman Barang<span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_surat" value="<?= $nomor_surat; ?>" class="form-control" placeholder="Autogenerate" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class="col-form-label ">Surat Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                        <input type="text" name="sphp" value="<?= $sphp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Sertifikat Garansi<span class="text-danger">*</span></label>
                                        <input type="text" name="sg" value="<?= $sg; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                        <input type="text" name="sppp" value="<?= $sppp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                        <input type="text" name="spp" value="<?= $spp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Invoice Ekatalog<span class="text-danger">*</span></label>
                                        <input type="text" name="inv" value="<?= $inv; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Kwitansi Ekatalog<span class="text-danger">*</span></label>
                                        <input type="text" name="kwn" value="<?= $kwn; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                    </div>

                                </div>

                                <div class="col-lg-5 ">

                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_sphp" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Sertifikat Garansi<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_sg" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_sppp" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_spp" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Invoice Ekatalog<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_inv" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Kwitansi Ekatalog<span class="text-danger">*</span></label>
                                        <input type="text" name="tgl_kwn" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <div class="row mb-3">
                                        <label class="col-form-label">Auto Generate<span class="text-danger">*</span></label>
                                        <input type="text" name="qrgen" value="<?= $qrgen; ?>" class="form-control" placeholder="qrgen" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class="col-form-label">Tanda Tangan<span class="text-danger">*</span></label>
                                        <select class="form-control select-search" id="img_ttd" name="img_ttd" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class="col-form-label">Mengetahui<span class="text-danger">*</span></label>
                                        <select class="form-control select-search" id="mengetahui" name="mengetahui" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <?php foreach ($dt_jabatan as $jabatan) { ?>
                                                <option value="<?= $jabatan->id_jabatan; ?>"><?= $jabatan->nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-lg-3">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">ID Paket<span class="text-danger">*</span></label>
                                        <input type="text" name="id_paket" class="form-control" placeholder="Masukan ID Paket" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Jenis Paket<span class="text-danger">*</span></label>
                                        <input type="text" name="jenis_paket" class="form-control" placeholder="Masukan Jenis Paket" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">ID RUP<span class="text-danger">*</span></label>
                                        <input type="number" name="id_rup" class="form-control" placeholder="Masukan ID RUP" required>
                                    </div>
                                </div>


                                <div class="col-lg-6 mt-2">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nama Paket Pekerjaan<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_paket_pekerjaan" class="form-control" placeholder="Masukan Paket Pekerjaan" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Satuan Kerja<span class="text-danger">*</span></label>
                                        <input type="text" name="satuan_kerja" class="form-control" placeholder="Masukan Satuan Kerja" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Alamat Pengiriman<span class="text-danger">*</span></label>
                                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control ckeditor_classic" rows="4" cols="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-5 mt-2">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Instansi<span class="text-danger">*</span></label>
                                        <input type="text" name="instansi" class="form-control" placeholder="Masukan Nama Instansi" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Alamat Satuan Kerja<span class="text-danger">*</span></label>
                                        <textarea name="alamat_satuan_kerja" id="alamat_satuan_kerja" class="form-control ckeditor_classic" rows="4"></textarea>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">NPWP Satuan Kerja<span class="text-danger">*</span></label>
                                        <input type="text" name="npwp_satuan_kerja" class="form-control" placeholder="Masukan NPWP Satuan Kerja" required>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Paket Dibuat<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_paket_dibuat" class="form-control daterange-single" placeholder="Autogenerate" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Daerah Provinsi<span class="text-danger">*</span></label>
                                        <select class="form-control select-search" id="" name="nama_provinsi" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <?php foreach ($dt_provinsi as $provinsi) { ?>
                                                <option value="<?= $provinsi->nama_provinsi; ?>"><?= $provinsi->nama_provinsi; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                                        <select class="form-control select-search" id="" name="nama_kabupaten" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <?php foreach ($dt_kabupaten as $kabupaten) { ?>
                                                <option value="<?= $kabupaten->nama_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label class=" col-form-label">Tahun Anggaran<span class="text-danger">*</span></label>
                                    <input type="number" name="tahun_anggaran" class="form-control year-picker" placeholder="Masukan Tahun Anggaran" required>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nama PP<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_pp" class="form-control" placeholder="Masukan Nama PP" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nomor Telephone PP<span class="text-danger">*</span></label>
                                        <input type="text" name="no_tlp_pp" class="form-control" placeholder="Masukan Nomor Telephone PP" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nama PPK<span class="text-danger">*</span></label>
                                        <input type="text" name="nama_ppk" class="form-control" placeholder="Masukan Nama PPK" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nomor Telephone PPK<span class="text-danger">*</span></label>
                                        <input type="text" name="no_tlp_ppk" class="form-control" placeholder="Masukan Nomor Telephone PPK" required>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">NIP PP<span class="text-danger">*</span></label>
                                        <input type="text" name="nip_pp" class="form-control" placeholder="Masukan NIP PP" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">E-Mail PP<span class="text-danger">*</span></label>
                                        <input type="email" name="email_pp" class="form-control" placeholder="Masukan E-Mail PP" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">NIP PPK<span class="text-danger">*</span></label>
                                        <input type="text" name="nip_ppk" class="form-control" placeholder="Masukan NIP PPK" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">E-Mail PPK<span class="text-danger">*</span></label>
                                        <input type="email" name="email_ppk" class="form-control" placeholder="Masukan E-Mail PPK" required>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Sumber Anggaran<span class="text-danger">*</span></label>
                                        <input type="text" name="sumber_anggaran" class="form-control" placeholder="Masukan Sumber Anggaran" required>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Kode Anggaran<span class="text-danger">*</span></label>
                                        <input type="text" name="kode_anggaran" class="form-control" placeholder="Masukan Kode Anggaran" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nomor SPK / SP<span class="text-danger">*</span></label>
                                        <input type="text" name="no_spk" class="form-control" placeholder="Masukan Nomor SPK / SP" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Mulai SPK / SP<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_mulai_spk" class="form-control daterange-single" placeholder="Masukan Tanggal Mulai SPK / SP" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Selesai SPK / SP<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_selesai_spk" class="form-control daterange-single" placeholder="Masukan Tanggal Selesai SPK / SP" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Vendor Pengiriman<span class="text-danger">*</span></label>
                                        <input type="text" name="vendor_pengiriman" class="form-control" placeholder="Masukan Vendor Pengiriman" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nomor Resi<span class="text-danger">*</span></label>
                                        <input type="text" name="no_resi" class="form-control" placeholder="Masukan Nomor Resi" required>
                                    </div>

                                </div>
                                <div class="col-lg-5">
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Nomor Transaksi<span class="text-danger">*</span></label>
                                        <input type="text" name="no_transaksi" class="form-control" placeholder="Masukan Nomor Transaksi" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" col-form-label">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_pengiriman" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row mb-3">
                                        <label class="col-form-label">Kategori Barang<span class="text-danger">*</span></label>
                                        <select class="form-control select-search" id="" name="kategori_barang" required>
                                            <option value="">-- Silahkan Pilih --</option>
                                            <?php foreach ($dt_sertifikat as $sertifikat) { ?>
                                                <option value="<?= $sertifikat->id_sertifikat_garansi; ?>"><?= $sertifikat->nama_sertifikat; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="row mb-3">
                                        <table>
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
                                                    <td><input type="number" id="jumlah_1" class="form-control" name="jumlah_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_1" id="satuan_1" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_1" class="form-control" name="harga_1" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_1" class="form-control" name="total_harga_1" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_2"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2"></td>
                                                    <td><input type="number" id="jumlah_2" class="form-control" name="jumlah_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_2" id="satuan_2" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_2" class="form-control" name="harga_2" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_2" class="form-control" name="total_harga_2" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_3"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3"></td>
                                                    <td><input type="number" id="jumlah_3" class="form-control" name="jumlah_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_3" id="satuan_3" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_3" class="form-control" name="harga_3" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_3" class="form-control" name="total_harga_3" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_4"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4"></td>
                                                    <td><input type="number" id="jumlah_4" class="form-control" name="jumlah_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_4" id="satuan_4" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_4" class="form-control" name="harga_4" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_4" class="form-control" name="total_harga_4" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_5"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5"></td>
                                                    <td><input type="number" id="jumlah_5" class="form-control" name="jumlah_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_5" id="satuan_5" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_5" class="form-control" name="harga_5" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_5" class="form-control" name="total_harga_5" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_6"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6"></td>
                                                    <td><input type="number" id="jumlah_6" class="form-control" name="jumlah_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_6" id="satuan_6" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_6" class="form-control" name="harga_6" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_6" class="form-control" name="total_harga_6" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_7"></td>
                                                    <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7"></td>
                                                    <td><input type="number" id="jumlah_7" class="form-control" name="jumlah_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><select name="satuan_7" id="satuan_7" class="select-search form-control">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($dt_satuan as $satuan) { ?>
                                                                <option value="<?= $satuan->nama_satuan; ?>"><?= $satuan->nama_satuan; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" id="harga_7" class="form-control" name="harga_7" onFocus="startCalc();" onBlur="stopCalc();" /></td>
                                                    <td><input type="number" value='' id="total_harga_7" class="form-control" name="total_harga_7" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="text-align: right;">Total</th>
                                                    <td colspan="4"><input style="text-align: right;" type="number" value='' id="total_all" class="form-control" name="total_all" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                </tr>

                                            </tbody>

                                        </table>
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

        <div id="modal_cetakAmplop_<?= $row['id_surat']; ?>" data-bs-backdrop="static" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cetak Sampul</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <embed src='<?= site_url('surat/menuSurat?page=' . $page . '&jns=' . encrypt_data($jns) . '&action=' . encrypt_data('cetakAmplop') . '&idx=' . $row['id_surat']); ?>' width='100%' height='600px'></embed>
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

                            <div class="row justify-content-evenly">
                                <div class="col-lg-12">
                                    <div class="row justify-content-evenly">
                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <label class="col-form-label ">Surat Pengiriman Barang<span class="text-danger">*</span></label>
                                                <input type="text" name="nomor_surat" value="<?= $row['no_surat']; ?>" class="form-control" placeholder="Autogenerate" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="col-form-label ">Surat Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                                <input type="text" name="sphp" value="<?= $row_isiSurat->sphp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Sertifikat Garansi<span class="text-danger">*</span></label>
                                                <input type="text" name="sg" value="<?= $row_isiSurat->sg; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                                <input type="text" name="sppp" value="<?= $row_isiSurat->sppp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                                <input type="text" name="spp" value="<?= $row_isiSurat->spp; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Invoice Ekatalog<span class="text-danger">*</span></label>
                                                <input type="text" name="inv" value="<?= $row_isiSurat->inv; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Kwitansi Ekatalog<span class="text-danger">*</span></label>
                                                <input type="text" name="kwn" value="<?= $row_isiSurat->kwn; ?>" class="form-control" placeholder="Autogenerate" required readonly>
                                            </div>

                                        </div>

                                        <div class="col-lg-5 ">

                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Penyerahan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_sphp" value="<?= $row_isiSurat->tgl_sphp; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Sertifikat Garansi<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_sg" value="<?= $row_isiSurat->tgl_sg; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Surat Pemeriksaan Hasil Pekerjaan<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_sppp" value="<?= $row_isiSurat->tgl_sppp; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Surat Permohonan Pembayaran<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_spp" value="<?= $row_isiSurat->tgl_spp; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Invoice Ekatalog<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_inv" value="<?= $row_isiSurat->tgl_inv; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Kwitansi Ekatalog<span class="text-danger">*</span></label>
                                                <input type="text" name="tgl_kwn" value="<?= $row_isiSurat->tgl_kwn; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>

                                        </div>

                                        <div class="col-lg-3">
                                            <div class="row mb-3">
                                                <label class="col-form-label">Auto Generate<span class="text-danger">*</span></label>
                                                <input type="text" name="qrgen" value="<?= $row_isiSurat->qrgen; ?>" class="form-control" placeholder="qrgen" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
                                                <label class="col-form-label">Tanda Tangan<span class="text-danger">*</span></label>
                                                <select class="form-control select-search" id="" name="img_ttd" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="1" <?= $row_isiSurat->img_ttd == '1' ? 'selected' : ''; ?>>Ya</option>
                                                    <option value="0" <?= $row_isiSurat->img_ttd == '0' ? 'selected' : ''; ?>>Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
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
                                        </div>

                                        <hr>

                                        <div class="col-lg-3">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">ID Paket<span class="text-danger">*</span></label>
                                                <input type="text" name="id_paket" value="<?= $row_isiSurat->id_paket; ?>" class="form-control" placeholder="Masukan ID Paket" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Jenis Paket<span class="text-danger">*</span></label>
                                                <input type="text" name="jenis_paket" value="<?= $row_isiSurat->jenis_paket; ?>" class="form-control" placeholder="Masukan Jenis Paket" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">ID RUP<span class="text-danger">*</span></label>
                                                <input type="number" name="id_rup" value="<?= $row_isiSurat->id_rup; ?>" class="form-control" placeholder="Masukan ID RUP" required>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 mt-2">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nama Paket Pekerjaan<span class="text-danger">*</span></label>
                                                <input type="text" name="nama_paket_pekerjaan" value="<?= $row_isiSurat->nama_paket_pekerjaan; ?>" class="form-control" placeholder="Masukan Paket Pekerjaan" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Satuan Kerja<span class="text-danger">*</span></label>
                                                <input type="text" name="satuan_kerja" value="<?= $row_isiSurat->satuan_kerja; ?>" class="form-control" placeholder="Masukan Satuan Kerja" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Alamat Pengiriman<span class="text-danger">*</span></label>
                                                <textarea name="alamat_pengiriman" id="alamat_pengiriman" class="form-control ckeditor_classic" rows="4" cols="4"><?= $row_isiSurat->alamat_pengiriman; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mt-2">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Instansi<span class="text-danger">*</span></label>
                                                <input type="text" name="instansi" value="<?= $row_isiSurat->instansi; ?>" class="form-control" placeholder="Masukan Nama Instansi" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Alamat Satuan Kerja<span class="text-danger">*</span></label>
                                                <textarea name="alamat_satuan_kerja" id="alamat_satuan_kerja" class="form-control ckeditor_classic" rows="4"><?= $row_isiSurat->alamat_satuan_kerja; ?></textarea>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">NPWP Satuan Kerja<span class="text-danger">*</span></label>
                                                <input type="text" name="npwp_satuan_kerja" value="<?= $row_isiSurat->npwp_satuan_kerja; ?>" class="form-control" placeholder="Masukan NPWP Satuan Kerja" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Paket Dibuat<span class="text-danger">*</span></label>
                                                <input type="text" name="tanggal_paket_dibuat" value="<?= $row_isiSurat->tanggal_paket_dibuat; ?>" class="form-control daterange-single" placeholder="Autogenerate" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Daerah Provinsi<span class="text-danger">*</span></label>
                                                <select class="form-control select-search" id="" name="nama_provinsi" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <?php foreach ($dt_provinsi as $provinsi) {
                                                        if ($row_isiSurat->nama_provinsi == $provinsi->nama_provinsi) { ?>
                                                            <option value="<?= $provinsi->nama_provinsi; ?>" selected><?= $provinsi->nama_provinsi; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $provinsi->nama_provinsi; ?>"><?= $provinsi->nama_provinsi; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                                                <select class="form-control select-search" id="" name="nama_kabupaten" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <?php foreach ($dt_kabupaten as $kabupaten) {
                                                        if ($row_isiSurat->nama_kabupaten == $kabupaten->nama_kabupaten) { ?>
                                                            <option value="<?= $kabupaten->nama_kabupaten; ?>" selected><?= $kabupaten->nama_kabupaten; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $kabupaten->nama_kabupaten; ?>"><?= $kabupaten->nama_kabupaten; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-lg-3">
                                            <label class=" col-form-label">Tahun Anggaran<span class="text-danger">*</span></label>
                                            <input type="number" name="tahun_anggaran" value="<?= $row_isiSurat->tahun_anggaran; ?>" class="form-control year-picker" placeholder="Masukan Tahun Anggaran" required>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nama PP<span class="text-danger">*</span></label>
                                                <input type="text" name="nama_pp" value="<?= $row_isiSurat->nama_pp; ?>" class="form-control" placeholder="Masukan Nama PP" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nomor Telephone PP<span class="text-danger">*</span></label>
                                                <input type="text" name="no_tlp_pp" value="<?= $row_isiSurat->no_tlp_pp; ?>" class="form-control" placeholder="Masukan Nomor Telephone PP" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nama PPK<span class="text-danger">*</span></label>
                                                <input type="text" name="nama_ppk" value="<?= $row_isiSurat->nama_ppk; ?>" class="form-control" placeholder="Masukan Nama PPK" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nomor Telephone PPK<span class="text-danger">*</span></label>
                                                <input type="text" name="no_tlp_ppk" value="<?= $row_isiSurat->no_tlp_ppk; ?>" class="form-control" placeholder="Masukan Nomor Telephone PPK" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">NIP PP<span class="text-danger">*</span></label>
                                                <input type="text" name="nip_pp" value="<?= $row_isiSurat->nip_pp; ?>" class="form-control" placeholder="Masukan NIP PP" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">E-Mail PP<span class="text-danger">*</span></label>
                                                <input type="email" name="email_pp" value="<?= $row_isiSurat->email_pp; ?>" class="form-control" placeholder="Masukan E-Mail PP" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">NIP PPK<span class="text-danger">*</span></label>
                                                <input type="text" name="nip_ppk" value="<?= $row_isiSurat->nip_ppk; ?>" class="form-control" placeholder="Masukan NIP PPK" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">E-Mail PPK<span class="text-danger">*</span></label>
                                                <input type="email" name="email_ppk" value="<?= $row_isiSurat->email_ppk; ?>" class="form-control" placeholder="Masukan E-Mail PPK" required>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Sumber Anggaran<span class="text-danger">*</span></label>
                                                <input type="text" name="sumber_anggaran" value="<?= $row_isiSurat->sumber_anggaran; ?>" class="form-control" placeholder="Masukan Sumber Anggaran" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Kode Anggaran<span class="text-danger">*</span></label>
                                                <input type="text" name="kode_anggaran" value="<?= $row_isiSurat->kode_anggaran; ?>" class="form-control" placeholder="Masukan Kode Anggaran" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nomor SPK / SP<span class="text-danger">*</span></label>
                                                <input type="text" name="no_spk" value="<?= $row_isiSurat->no_spk; ?>" class="form-control" placeholder="Masukan Nomor SPK / SP" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Mulai SPK / SP<span class="text-danger">*</span></label>
                                                <input type="text" name="tanggal_mulai_spk" value="<?= $row_isiSurat->tanggal_mulai_spk; ?>" class="form-control daterange-single" placeholder="Masukan Tanggal Mulai SPK / SP" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Selesai SPK / SP<span class="text-danger">*</span></label>
                                                <input type="text" name="tanggal_selesai_spk" value="<?= $row_isiSurat->tanggal_selesai_spk; ?>" class="form-control daterange-single" placeholder="Masukan Tanggal Selesai SPK / SP" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Vendor Pengiriman<span class="text-danger">*</span></label>
                                                <input type="text" name="vendor_pengiriman" value="<?= $row_isiSurat->vendor_pengiriman; ?>" class="form-control" placeholder="Masukan Vendor Pengiriman" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nomor Resi<span class="text-danger">*</span></label>
                                                <input type="text" name="no_resi" value="<?= $row_isiSurat->no_resi; ?>" class="form-control" placeholder="Masukan Nomor Resi" required>
                                            </div>

                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Nomor Transaksi<span class="text-danger">*</span></label>
                                                <input type="text" name="no_transaksi" value="<?= $row_isiSurat->no_transaksi; ?>" class="form-control" placeholder="Masukan Nomor Transaksi" required>
                                            </div>
                                            <div class="row mb-3">
                                                <label class=" col-form-label">Tanggal Pengiriman<span class="text-danger">*</span></label>
                                                <input type="text" name="tanggal_pengiriman" value="<?= $row_isiSurat->tanggal_pengiriman; ?>" class="form-control daterange-single" placeholder="Masukan Tanggal Pengiriman" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <label class="col-form-label">Kategori Barang<span class="text-danger">*</span></label>
                                                <select class="form-control select-search" id="" name="kategori_barang" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <?php foreach ($dt_sertifikat as $sertifikat) {
                                                        if ($row['kategori_barang'] == $sertifikat->id_sertifikat_garansi) { ?>
                                                            <option value="<?= $sertifikat->id_sertifikat_garansi; ?>" selected><?= $sertifikat->nama_sertifikat; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $sertifikat->id_sertifikat_garansi; ?>"><?= $sertifikat->nama_sertifikat; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <table>
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
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_1" value="<?= $row_isiSurat->no_1; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_1" value="<?= $row_isiSurat->nama_barang_1; ?>"></td>
                                                            <td><input type="number" id="jumlah_1" class="form-control" name="jumlah_1" value="<?= $row_isiSurat->jumlah_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_1" class="form-control" name="satuan_1" value="<?= $row_isiSurat->satuan_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="harga_1" class="form-control" name="harga_1" value="<?= $row_isiSurat->harga_1; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_1" class="form-control" name="total_harga_1" value="<?= $row_isiSurat->total_harga_1; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_2" value="<?= $row_isiSurat->no_2; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_2" value="<?= $row_isiSurat->nama_barang_2; ?>"></td>
                                                            <td><input type="number" id="jumlah_2" class="form-control" name="jumlah_2" value="<?= $row_isiSurat->jumlah_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_2" class="form-control" name="satuan_2" value="<?= $row_isiSurat->satuan_2; ?>" readonly></td>
                                                            <td><input type="number" id="harga_2" class="form-control" name="harga_2" value="<?= $row_isiSurat->harga_2; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_2" class="form-control" name="total_harga_2" value="<?= $row_isiSurat->total_harga_2; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_3" value="<?= $row_isiSurat->no_3; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_3" value="<?= $row_isiSurat->nama_barang_3; ?>"></td>
                                                            <td><input type="number" id="jumlah_3" class="form-control" name="jumlah_3" value="<?= $row_isiSurat->jumlah_3; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_3" class="form-control" name="satuan_3" value="<?= $row_isiSurat->satuan_3; ?>" readonly /></td>
                                                            <td><input type="number" id="harga_3" class="form-control" name="harga_3" value="<?= $row_isiSurat->harga_3; ?>" readonly /></td>
                                                            <td><input type="number" id="total_harga_3" class="form-control" name="total_harga_3" value="<?= $row_isiSurat->total_harga_3; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_4" value="<?= $row_isiSurat->no_4; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_4" value="<?= $row_isiSurat->nama_barang_4; ?>"></td>
                                                            <td><input type="number" id="jumlah_4" class="form-control" name="jumlah_4" value="<?= $row_isiSurat->jumlah_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_4" class="form-control" name="satuan_4" value="<?= $row_isiSurat->satuan_4; ?>" readonly /></td>
                                                            <td><input type="number" id="harga_4" class="form-control" name="harga_4" value="<?= $row_isiSurat->harga_4; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_4" class="form-control" name="total_harga_4" value="<?= $row_isiSurat->total_harga_4; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_5" value="<?= $row_isiSurat->no_5; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_5" value="<?= $row_isiSurat->nama_barang_5; ?>"></td>
                                                            <td><input type="number" id="jumlah_5" class="form-control" name="jumlah_5" value="<?= $row_isiSurat->jumlah_5; ?>" onFocus=" startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_5" class="form-control" name="satuan_5" value="<?= $row_isiSurat->satuan_5; ?>" onFocus=" startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="harga_5" class="form-control" name="harga_5" value="<?= $row_isiSurat->harga_5; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_5" class="form-control" value="<?= $row_isiSurat->total_harga_5; ?>" name="total_harga_5" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_6" value="<?= $row_isiSurat->no_6; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_6" value="<?= $row_isiSurat->nama_barang_6; ?>"></td>
                                                            <td><input type="number" id="jumlah_6" class="form-control" name="jumlah_6" value="<?= $row_isiSurat->jumlah_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_6" class="form-control" name="satuan_6" value="<?= $row_isiSurat->satuan_6; ?>" readonly /></td>
                                                            <td><input type="number" id="harga_6" class="form-control" name="harga_6" value="<?= $row_isiSurat->harga_6; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_6" class="form-control" name="total_harga_6" value="<?= $row_isiSurat->total_harga_6; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="number" id="nama" class="form-control" placeholder="No" name="no_7" value="<?= $row_isiSurat->no_7; ?>" readonly></td>
                                                            <td><input type="text" id="nama" class="form-control" placeholder="Nama Barang" name="nama_barang_7" value="<?= $row_isiSurat->nama_barang_7; ?>"></td>
                                                            <td><input type="number" id="jumlah_7" class="form-control" name="jumlah_7" value="<?= $row_isiSurat->jumlah_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="text" id="satuan_7" class="form-control" name="satuan_7" value="<?= $row_isiSurat->satuan_7; ?>" readonly /></td>
                                                            <td><input type="number" id="harga_7" class="form-control" name="harga_7" value="<?= $row_isiSurat->harga_7; ?>" onFocus="startCalc();" onBlur="stopCalc();" readonly /></td>
                                                            <td><input type="number" id="total_harga_7" class="form-control" name="total_harga_7" value="<?= $row_isiSurat->total_harga_7; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2" style="text-align: right;">Total</th>
                                                            <td colspan="4"><input style="text-align: right;" type="number" id="total_all" class="form-control" name="total_all" value="<?= $row_isiSurat->total_all; ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly></td>
                                                        </tr>

                                                    </tbody>

                                                </table>
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

            modal.find(".select-search").select2("destroy");

            modal.find(".select-search").select2({
                dropdownParent: modal.find(".modal-content"),
                width: '100%'
            });
        }

        $("#modal_tambah").on("shown.bs.modal", function() {
            const modal = $(this);
            initSelect2(modal);
        });
    });

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
        document.autoSumForm.total_all.value = ((jumlah_1 * 1) * (harga_1 * 1)) + ((jumlah_2 * 1) * (harga_2 * 1)) + ((jumlah_3 * 1) * (harga_3 * 1)) + ((jumlah_4 * 1) * (harga_4 * 1)) + ((jumlah_5 * 1) * (harga_5 * 1)) + ((jumlah_6 * 1) * (harga_6 * 1)) + ((jumlah_7 * 1) * (harga_7 * 1));
    }

    function stopCalc() {
        clearInterval(interval);
    }
</script>