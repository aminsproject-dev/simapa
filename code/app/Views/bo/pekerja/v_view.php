<!-- Main content -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-sm-12 col-xl-12">

                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2">
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="text-end mb-3">
                            <a href="<?= base_url('pekerja/edit/' . encrypt_data($row_pekerja['id_pekerja'])); ?>">
                                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start btn-sm my-1"
                                    data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit data">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-note-pencil ph-lg"></i>
                                    </span>
                                    Edit data
                                </button>
                            </a>

                            <a href="#" class="sweet_warning_custom" data-url="<?= site_url('pekerja/delete/' . encrypt_data($row_pekerja['id_pekerja'])); ?>">
                                <button type="button" class="btn btn-danger btn-labeled btn-labeled-start btn-sm my-1"
                                    data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus data">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-trash ph-lg"></i>
                                    </span>
                                    Hapus data
                                </button>
                            </a>
                        </div>


                        <div class="row">

                            <div class="col-lg-6 col-xs-12">

                                <!-- Data Pribadi -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Data Pribadi</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Nama Lengkap</td>
                                                <td><?= $row_pekerja['nama']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Kepegawaian</td>
                                                <td><?= $row_pekerja['nama_status'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Tenaga Ahli</td>
                                                <td><?= $row_pekerja['nama_jenis_tenaga_ahli'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kewarganegaraan</td>
                                                <td><?= $row_pekerja['negara_kewarganegaraan'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td><?= $row_pekerja['jenis_kelamin'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NIK / Paspor</td>
                                                <td><?= $row_pekerja['nik_paspor'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>NPWP</td>
                                                <td><?= $row_pekerja['npwp'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. BPJS Kesehatan</td>
                                                <td><?= $row_pekerja['no_bpjs_kesehatan'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. BPJS Ketenagakerjaan</td>
                                                <td><?= $row_pekerja['no_bpjs_ketenagakerjaan'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Data</td>
                                                <td>
                                                    <?php if ($row_pekerja['status'] == 1): ?>
                                                        <span class="badge bg-success">Aktif</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tempat & Tanggal Lahir -->
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Tempat &amp; Tanggal Lahir</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Negara Tempat Lahir</td>
                                                <td><?= $row_pekerja['negara_tempat_lahir'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten Tempat Lahir</td>
                                                <td><?= $row_pekerja['kabupaten_tempat_lahir'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>
                                                    <?= !empty($row_pekerja['tanggal_lahir'])
                                                        ? date('d-m-Y', strtotime($row_pekerja['tanggal_lahir']))
                                                        : '-'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Kemampuan Bahasa -->
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Kemampuan Bahasa</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Bahasa Indonesia</td>
                                                <td><?= $row_pekerja['tingkat_bahasa_indonesia'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bahasa Inggris</td>
                                                <td><?= $row_pekerja['tingkat_bahasa_inggris'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bahasa Setempat</td>
                                                <td><?= $row_pekerja['tingkat_bahasa_setempat'] ?? '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /KOLOM KIRI -->


                            <div class="col-lg-6 col-xs-12">

                                <!-- Kontak & Alamat -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Kontak &amp; Alamat</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Email</td>
                                                <td>
                                                    <?php if (!empty($row_pekerja['email'])): ?>
                                                        <a href="mailto:<?= $row_pekerja['email']; ?>"><?= $row_pekerja['email']; ?></a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Telepon</td>
                                                <td><?= $row_pekerja['telepon'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Website</td>
                                                <td>
                                                    <?php if (!empty($row_pekerja['website'])): ?>
                                                        <a href="<?= $row_pekerja['website']; ?>" target="_blank" rel="noopener noreferrer">
                                                            <?= $row_pekerja['website']; ?>
                                                        </a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Lengkap</td>
                                                <td><?= $row_pekerja['alamat'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi Domisili</td>
                                                <td><?= $row_pekerja['provinsi_domisili'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten Domisili</td>
                                                <td><?= $row_pekerja['kabupaten_domisili'] ?? '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pengalaman Kerja -->
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Pengalaman Kerja</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Lama Pengalaman Kerja</td>
                                                <td>
                                                    <?= !empty($row_pekerja['lama_pengalaman_kerja_tahun'])
                                                        ? $row_pekerja['lama_pengalaman_kerja_tahun'] . ' Tahun'
                                                        : '-'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Profesi / Keahlian</td>
                                                <td><?= $row_pekerja['profesi_keahlian'] ?? '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pendidikan -->
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Pendidikan</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Pendidikan Akhir</td>
                                                <td><?= $row_pekerja['nama_pendidikan_akhir'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Formal</td>
                                                <td>
                                                    <?= !empty($row_pekerja['pendidikan_formal'])
                                                        ? $row_pekerja['pendidikan_formal']
                                                        : '-'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Non Formal</td>
                                                <td>
                                                    <?= !empty($row_pekerja['pendidikan_non_formal'])
                                                        ? $row_pekerja['pendidikan_non_formal']
                                                        : '-'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /KOLOM KANAN -->

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /main content -->