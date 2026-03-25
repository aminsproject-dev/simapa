<!-- Main content -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-sm-12 col-xl-12">

                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2">
                            <a href="<?= site_url('pengalaman/export'); ?>" class="btn btn-success fw-bold">
                                <i class="ph-file-csv me-1"></i>
                                Export Excel
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#modal_import" class="btn btn-primary fw-bold">
                                <i class="ph-upload-simple me-1"></i>
                                Import Excel
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="ph-check-circle me-2"></i>
                                <?= session()->getFlashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="ph-warning-circle me-2"></i>
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table datatable-6 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kontrak</th>
                                        <th>Nomor Kontrak</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Nilai Kontrak</th>
                                        <th>Tgl Serah Terima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if (isset($dt_pengalaman)) {
                                        foreach ($dt_pengalaman as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row->nama_kontrak; ?></td>
                                                <td><?= $row->nomor_kontrak; ?></td>
                                                <td><?= $row->tanggal_mulai; ?></td>
                                                <td><?= $row->tanggal_selesai; ?></td>
                                                <td>Rp <?= number_format($row->nilai_kontrak, 0, ',', '.'); ?></td>
                                                <td><?= $row->tanggal_serah_terima; ?></td>
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
                <h5 class="modal-title">Import Excel Pengalaman Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= site_url('pengalaman/import-save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">

                    <div class="alert alert-info">
                        <i class="ph-info me-2"></i>
                        Pastikan file Excel menggunakan urutan kolom yang sesuai.
                        <a href="<?= site_url('pengalaman/export'); ?>" class="fw-bold">
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
    $(document).ready(function() {
        <?php if (session()->getFlashdata('error')): ?>
            var myModal = new bootstrap.Modal(document.getElementById('modal_import'));
            myModal.show();
        <?php endif; ?>
    });
</script>