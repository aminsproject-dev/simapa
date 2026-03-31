<!-- Main content -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-sm-12 col-xl-12">

                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2">
                            <a href="<?= site_url('pekerja/export'); ?>" class="btn btn-success fw-bold">
                                <i class="ph-file-xls me-1"></i>
                                Export Excel
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#modal_import" class="btn btn-primary fw-bold">
                                <i class="ph-upload-simple me-1"></i>
                                Import Excel
                            </a>
                            <a href="<?= base_url('pekerja/add'); ?>" class="btn btn-primary fw-bold">
                                <i class="ph-plus me-1"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table datatable-8 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status Kepegawaian</th>
                                        <th>Jenis Tenaga Ahli</th>
                                        <th>NIK / Paspor</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Pendidikan Akhir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_pekerja)) {
                                        foreach ($dt_pekerja as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['id_status_kepegawaian'] ?? '-'; ?></td>
                                                <td><?= $row['id_jenis_tenaga_ahli'] ?? '-'; ?></td>
                                                <td><?= $row['nik_paspor'] ?? '-'; ?></td>
                                                <td>
                                                    <?= match ((string) $row['jenis_kelamin']) {
                                                        'Laki-laki' => '<span class="badge bg-primary bg-opacity-10 text-primary">Pria</span>',
                                                        'Perempuan' => '<span class="badge bg-danger bg-opacity-10 text-danger">Wanita</span>',
                                                        default => '<span class="badge bg-secondary bg-opacity-10 text-secondary">-</span>',
                                                    }; ?>
                                                </td>
                                                <td><?= $row['telepon'] ?? '-'; ?></td>
                                                <td><?= $row['email'] ?? '-'; ?></td>
                                                <td><?= $row['id_pendidikan_akhir'] ?? '-'; ?></td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="<?= base_url('pekerja/view/' . encrypt_data($row['id_pekerja'])); ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Data">
                                                            <i class="ph-magnifying-glass me-2"></i>
                                                        </a>
                                                        <a href="<?= base_url('pekerja/edit/' . encrypt_data($row['id_pekerja'])); ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('pekerja/delete/' . encrypt_data($row['id_pekerja'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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
<!-- /main content -->


<div id="modal_import" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Excel Data Pekerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= site_url('pekerja/import-save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="alert alert-info">
                        <i class="ph-info me-2"></i>
                        Pastikan file Excel menggunakan urutan kolom yang sesuai.
                        <a href="<?= site_url('pekerja/import-example'); ?>" class="fw-bold">
                            Download template Excel
                        </a>
                        terlebih dahulu.
                    </div>

                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end">
                            File Excel <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="file"
                                name="file_csv"
                                class="form-control"
                                accept=".xlsx,.xls"
                                required>
                            <span class="form-text text-muted">Format file: .xlsx/.xls</span>
                        </div>
                    </div>

                    <div class="text-muted">
                        <span class="text-danger">*</span> Wajib di isi
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-upload-simple me-1"></i>
                        Upload & Import
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>