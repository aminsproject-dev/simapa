<!-- Main content -->
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2">
                            <a href="<?= base_url('peralatan/edit/' . encrypt_data($row_peralatan['id_peralatan'])); ?>">
                                <button type="button" class="btn btn-warning btn-labeled btn-labeled-start btn-sm my-1" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Edit data">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20"><i class="ph-note-pencil ph-lg"></i></span>
                                    Edit data
                                </button>
                            </a>
                            <a href="#" class="sweet_warning_custom" data-url="<?= site_url('peralatan/delete/' . encrypt_data($row_peralatan['id_peralatan'])); ?>">
                                <button type="button" class="btn btn-danger btn-labeled btn-labeled-start btn-sm my-1" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Hapus data">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20"><i class="ph-trash ph-lg"></i></span>
                                    Hapus data
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Data Peralatan</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">Nama Peralatan</td>
                                                <td><?= $row_peralatan['nama_peralatan'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Merk/Tipe</td>
                                                <td><?= $row_peralatan['merk_tipe'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kapasitas</td>
                                                <td><?= $row_peralatan['kapasitas'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Pembuatan</td>
                                                <td><?= !empty($row_peralatan['tahun_pembuatan']) ? $row_peralatan['tahun_pembuatan'] : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah</td>
                                                <td><?= $row_peralatan['jumlah'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kondisi</td>
                                                <td>
                                                    <?= match ((string)$row_peralatan['kondisi']) {
                                                        'Baik' => '<span class="badge bg-success bg-opacity-10 text-success">Baik</span>',
                                                        'Buruk' => '<span class="badge bg-danger bg-opacity-10 text-danger">Buruk</span>',
                                                        default => '-',
                                                    }; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status Kepemilikan</td>
                                                <td>
                                                    <?= match ((string)$row_peralatan['status_kepemilikan']) {
                                                        'Sendiri' => '<span class="badge bg-primary bg-opacity-10 text-primary">Sendiri</span>',
                                                        'Sewa' => '<span class="badge bg-warning bg-opacity-10 text-warning">Sewa</span>',
                                                        'Dukungan' => '<span class="badge bg-info bg-opacity-10 text-info">Dukungan</span>',
                                                        default => '-',
                                                    }; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lokasi Sekarang</td>
                                                <td><?= $row_peralatan['lokasi_sekarang'] ?? '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td><?= $row_peralatan['keterangan'] ?? '-'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Bukti Kepemilikan</th>
                                            </tr>
                                            <tr>
                                                <td width="40%">File Bukti</td>
                                                <td>
                                                    <?php if (!empty($row_peralatan['bukti_kepemilikan'])): ?>
                                                        <div class="mb-2">
                                                            <a href="<?= site_url('peralatan/file/' . $row_peralatan['bukti_kepemilikan']); ?>" target="_blank" rel="noopener noreferrer" data-fancybox="peralatan">
                                                                <img src="<?= site_url('peralatan/file/' . $row_peralatan['bukti_kepemilikan']); ?>"
                                                                    alt="Bukti Kepemilikan"
                                                                    class="img-thumbnail"
                                                                    style="max-height: 200px; object-fit: cover;">
                                                            </a>
                                                        </div>
                                                        <a href="<?= site_url('peralatan/file/' . $row_peralatan['bukti_kepemilikan']); ?>" target="_blank" rel="noopener noreferrer">
                                                            <button type="button" class="btn btn-outline-primary btn-sm">
                                                                <i class="ph-arrow-square-out me-1"></i> Lihat Penuh
                                                            </button>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">Belum diunggah</span>
                                                    <?php endif; ?>
                                                </td>
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