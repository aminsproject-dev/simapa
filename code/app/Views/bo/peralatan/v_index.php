<!-- Main content -->
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2">
                            <a href="<?= base_url('peralatan/export'); ?>" class="btn btn-success fw-bold">
                                <i class="ph-file-xls me-1"></i>
                                Export Excel
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#modal_import" class="btn btn-primary fw-bold">
                                <i class="ph-upload-simple me-1"></i>
                                Import Excel
                            </a>
                            <a href="<?= base_url('peralatan/add'); ?>" class="btn btn-primary fw-bold">
                                <i class="ph-plus me-1"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form action="" method="get" class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari peralatan..." value="<?= old('search', $keyword ?? ''); ?>">
                                    <button class="btn btn-primary" type="submit"><i class="ph-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table datatable-8 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peralatan</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
                                        <th>Status Kepemilikan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($list_peralatan)) {
                                        foreach ($list_peralatan as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['nama_peralatan'] ?? '-'; ?></td>
                                                <td><?= $row['jumlah'] ?? '-'; ?></td>
                                                <td>
                                                    <?= match ((string)$row['kondisi']) {
                                                        'Baik' => '<span class="badge bg-success bg-opacity-10 text-success">Baik</span>',
                                                        'Buruk' => '<span class="badge bg-danger bg-opacity-10 text-danger">Buruk</span>',
                                                        default => '<span class="badge bg-secondary bg-opacity-10 text-secondary">-</span>',
                                                    }; ?>
                                                </td>
                                                <td>
                                                    <?= match ((string)$row['status_kepemilikan']) {
                                                        'Sendiri' => '<span class="badge bg-primary bg-opacity-10 text-primary">Sendiri</span>',
                                                        'Sewa' => '<span class="badge bg-warning bg-opacity-10 text-warning">Sewa</span>',
                                                        'Dukungan' => '<span class="badge bg-info bg-opacity-10 text-info">Dukungan</span>',
                                                        default => '<span class="badge bg-secondary bg-opacity-10 text-secondary">-</span>',
                                                    }; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex">
                                                        <a href="<?= base_url('peralatan/view/' . encrypt_data($row['id_peralatan'])); ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Data">
                                                            <i class="ph-magnifying-glass me-2"></i>
                                                        </a>
                                                        <a href="<?= base_url('peralatan/edit/' . encrypt_data($row['id_peralatan'])); ?>" class="dropdown-item" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit Data">
                                                            <i class="ph-note-pencil me-2"></i>
                                                        </a>
                                                        <a href="<?= base_url('peralatan/delete/' . encrypt_data($row['id_peralatan'])); ?>" class="dropdown-item sweet_warning_custom" data-url="<?= site_url('peralatan/delete/' . encrypt_data($row['id_peralatan'])); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus Data">
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

<div id="modal_import" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Excel Data Peralatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= site_url('peralatan/import-save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="alert alert-info">
                        <i class="ph-info me-2"></i>
                        Pastikan file Excel menggunakan urutan kolom yang sesuai.
                        <a href="<?= site_url('peralatan/import-example'); ?>" class="fw-bold">
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

<script>
    $(document).on('click', '.sweet_warning_custom', function(e) {
        e.preventDefault();
        var deleteUrl = $(this).data('url');
        Swal.fire({
            title: 'Hapus Data?',
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
</script>

