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
                            <a href="<?= base_url('pengalaman/edit/' . encrypt_data($row_experience['id_pengalaman'])); ?>">
                                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start btn-sm my-1"
                                    data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit data">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-note-pencil ph-lg"></i>
                                    </span>
                                    Edit data
                                </button>
                            </a>

                            <a href="#" class="sweet_warning_custom" data-url="<?= site_url('pengalaman/delete/' . encrypt_data($row_experience['id_pengalaman'])); ?>">
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
                                <div class="table reponsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    Data pekerjaan
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Nama Kontrak</td>
                                                <td><?= $row_experience['nama_kontrak']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Kontrak</td>
                                                <td><?= $row_experience['nomor_kontrak']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Mulai</td>
                                                <td><?= $row_experience['tanggal_mulai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Selesai</td>
                                                <td><?= $row_experience['tanggal_selesai']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Serah Terima</td>
                                                <td><?= $row_experience['tanggal_serah_terima']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nilai Kontrak</td>
                                                <td>Rp. <?= number_format($row_experience['nilai_kontrak'], 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kategori Pekerjaan</td>
                                                <td><?= $row_experience['nama_kategori_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Presentase Pekerjaan</td>
                                                <td><?= $row_experience['persentase_pekerjaan']; ?> %</td>
                                            </tr>
                                            <tr>
                                                <td>Uraian Pekerjaan</td>
                                                <td><?= $row_experience['uraian_pekerjaan']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Ruang Lingkup Pekerjaan</td>
                                                <td><?= $row_experience['ruang_lingkup_pekerjaan']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>Kbli Pekerjaan</td>
                                                <td><?= $row_experience['kode_kbli']; ?> - <?= $row_experience['nama_kbli']; ?> </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="table reponsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    Data lokasi pekerjaan
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Alamat Pekerjaan</td>
                                                <td><?= $row_experience['alamat_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Negara Pekerjaan</td>
                                                <td><?= $row_experience['nama_negara']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi Pekerjaan</td>
                                                <td><?= $row_experience['provinsi_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten Pekerjaan</td>
                                                <td><?= $row_experience['kabupaten_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="text-center">
                                                    Data instansi
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Jenis Instansi</td>
                                                <td><?= $row_experience['nama_jenis_instansi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Instansi</td>
                                                <td><?= $row_experience['nama_instansi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Satuan Kerja</td>
                                                <td><?= $row_experience['nama_satuan_kerja']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Provinsi Instansi</td>
                                                <td><?= $row_experience['provinsi_instansi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kabupaten Instansi</td>
                                                <td><?= $row_experience['kabupaten_instansi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Instansi</td>
                                                <td><?= strip_tags($row_experience['alamat_instansi']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telepon Instansi</td>
                                                <td><?= $row_experience['telepon_instansi']; ?></td>
                                            </tr>

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
<!-- /main content -->