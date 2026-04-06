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
                            <a href="<?= base_url('pengalaman-pekerja/add/' . encrypt_data($row_pekerja['id_pekerja'])); ?>">
                                <button type="button" class="btn btn-primary btn-labeled btn-labeled-start btn-sm my-1"
                                    data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Tambah pengalaman kontrak">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-plus ph-lg"></i>
                                    </span>
                                    Tambah Pengalaman
                                </button>
                            </a>

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

                            <!-- KOLOM KIRI -->
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

                            <!-- KOLOM KANAN -->
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
                        <!-- /row data pribadi -->

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-header py-2">
                                        <h6 class="mb-0">
                                            <i class="ph-image me-2"></i>
                                            Dokumen Foto
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <?php
                                            $fotoList = [
                                                'foto_ktp' => 'Foto KTP',
                                                'foto_ijazah' => 'Foto Ijazah',
                                                'foto_transkrip_nilai' => 'Foto Transkrip Nilai',
                                                'foto_npwp' => 'Foto NPWP',
                                                'foto_sertifikasi' => 'Foto Sertifikasi',
                                                'foto_nilai_sertifikasi' => 'Foto Nilai Sertifikasi',
                                            ];
                                            foreach ($fotoList as $fieldName => $label):
                                                $filename = $row_pekerja[$fieldName] ?? null;
                                            ?>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="card h-100 border text-center">
                                                        <div class="card-body p-2">
                                                            <p class="fw-semibold small mb-2"><?= $label; ?></p>
                                                            <?php if (!empty($filename)): ?>
                                                                <a href="<?= base_url('uploads/pekerja/' . $filename); ?>" target="_blank" rel="noopener noreferrer">
                                                                    <img src="<?= base_url('uploads/pekerja' . $filename); ?>" alt="<?= $label; ?>" class="img-thumbnail w-100" style="max-height: 200px; object-fit: cover;" loading="lazy">
                                                                </a>
                                                                <div class="mt-1">
                                                                    <a href="<?= base_url('uploads/pekerja' . $filename); ?>" target="_blank" class="btn btn-outline-primary btn-xs mt-1" rel="noopener noreferrer">
                                                                        <i class="ph-arrow-square-out me-1"></i>
                                                                        Lihat Penuh
                                                                    </a>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 160px;">
                                                                    <div class="text-muted">
                                                                        <i class="ph-image ph-2x d-block mb-1"></i>
                                                                        <small>Belum diisi</small>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL PENGALAMAN PEKERJA -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border">
                                    <div class="card-header py-2">
                                        <h6 class="mb-0">
                                            <i class="ph-briefcase me-2"></i>
                                            Riwayat Pengalaman Kontrak
                                        </h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Nama Kontrak</th>
                                                        <th>Nomor Kontrak</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>Nilai Kontrak</th>
                                                        <th>Tanggal Serah Terima</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($dt_pengalaman)): ?>
                                                        <?php $no = 1;
                                                        foreach ($dt_pengalaman as $pengalaman): ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td><?= $pengalaman['nama_kontrak'] ?? '-'; ?></td>
                                                                <td><?= $pengalaman['nomor_kontrak'] ?? '-'; ?></td>
                                                                <td>
                                                                    <?= !empty($pengalaman['tanggal_mulai'])
                                                                        ? date('d-m-Y', strtotime($pengalaman['tanggal_mulai']))
                                                                        : '-'; ?>
                                                                </td>
                                                                <td>
                                                                    <?= !empty($pengalaman['tanggal_selesai'])
                                                                        ? date('d-m-Y', strtotime($pengalaman['tanggal_selesai']))
                                                                        : '-'; ?>
                                                                </td>
                                                                <td>
                                                                    <?= !empty($pengalaman['nilai_kontrak'])
                                                                        ? 'Rp ' . number_format($pengalaman['nilai_kontrak'], 0, ',', '.')
                                                                        : '-'; ?>
                                                                </td>
                                                                <td>
                                                                    <?= !empty($pengalaman['tanggal_serah_terima'])
                                                                        ? date('d-m-Y', strtotime($pengalaman['tanggal_serah_terima']))
                                                                        : '-'; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= match (strtolower($pengalaman['status'] ?? '')) {
                                                                        'aktif'    => '<span class="badge bg-success bg-opacity-10 text-success">Aktif</span>',
                                                                        'nonaktif' => '<span class="badge bg-secondary bg-opacity-10 text-secondary">Nonaktif</span>',
                                                                        default    => '<span class="badge bg-secondary bg-opacity-10 text-secondary">-</span>',
                                                                    }; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="#"
                                                                        class="btn btn-danger btn-sm sweet_warning_hapus_pengalaman"
                                                                        data-url="<?= site_url('pengalaman-pekerja/delete/' . encrypt_data($pengalaman['id_pengalaman_pekerja'])); ?>"
                                                                        data-bs-popup="popover"
                                                                        data-bs-trigger="hover"
                                                                        data-bs-content="Hapus pengalaman ini">
                                                                        <i class="ph-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="9" class="text-center text-muted py-4">
                                                                <i class="ph-folder-open ph-lg me-2"></i>
                                                                Belum ada data pengalaman kontrak
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /TABEL PENGALAMAN -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /main content -->

<script>
    $(document).on('click', '.sweet_warning_custom', function(e) {
        e.preventDefault();
        var deleteUrl = $(this).data('url');
        Swal.fire({
            title: 'Hapus Data Pekerja?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    });

    $(document).on('click', '.sweet_warning_hapus_pengalaman', function(e) {
        e.preventDefault();
        var deleteUrl = $(this).data('url');
        Swal.fire({
            title: 'Hapus Pengalaman Ini?',
            text: 'Hanya menghapus keterkaitan, data kontrak tidak akan terhapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#e53935',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    });
</script>