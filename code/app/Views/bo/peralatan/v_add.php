<!-- Main content -->
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto d-flex gap-2"></div>
                    </div>

                    <form enctype="multipart/form-data" action="<?= base_url('peralatan/add'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Data Peralatan</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Peralatan <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_peralatan" value="<?= old('nama_peralatan'); ?>" class="form-control" placeholder="Masukkan nama peralatan" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Merk/Tipe</label>
                                <div class="col-lg-4">
                                    <input type="text" name="merk_tipe" value="<?= old('merk_tipe'); ?>" class="form-control" placeholder="Masukkan merk dan tipe">
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kapasitas</label>
                                <div class="col-lg-4">
                                    <input type="text" name="kapasitas" value="<?= old('kapasitas'); ?>" class="form-control" placeholder="Masukkan kapasitas">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Tahun Pembuatan</label>
                                <div class="col-lg-4">
                                    <input type="number" name="tahun_pembuatan" value="<?= old('tahun_pembuatan'); ?>" class="form-control" placeholder="Contoh: 2020" min="1900" max="2099">
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Jumlah <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="number" name="jumlah" value="<?= old('jumlah'); ?>" class="form-control" placeholder="Masukkan jumlah" min="1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kondisi <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="kondisi" class="form-control select-search" required>
                                        <option value="">Pilih kondisi</option>
                                        <option value="Baik" <?= old('kondisi') == 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?= old('kondisi') == 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Status Kepemilikan <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="status_kepemilikan" class="form-control select-search" required>
                                        <option value="">Pilih status kepemilikan</option>
                                        <option value="Sendiri" <?= old('status_kepemilikan') == 'Sendiri' ? 'selected' : ''; ?>>Sendiri</option>
                                        <option value="Sewa" <?= old('status_kepemilikan') == 'Sewa' ? 'selected' : ''; ?>>Sewa</option>
                                        <option value="Dukungan" <?= old('status_kepemilikan') == 'Dukungan' ? 'selected' : ''; ?>>Dukungan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Lokasi Sekarang</label>
                                <div class="col-lg-10">
                                    <input type="text" name="lokasi_sekarang" value="<?= old('lokasi_sekarang'); ?>" class="form-control" placeholder="Masukkan lokasi saat ini">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Keterangan</label>
                                <div class="col-lg-10">
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan"><?= old('keterangan'); ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Bukti Kepemilikan</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Bukti Kepemilikan <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="file" name="bukti_kepemilikan" class="form-control <?= session('errors.bukti_kepemilikan') ? 'is-invalid' : ''; ?>" accept="image/jpg,image/jpeg,image/png,application/pdf" required>
                                    <span class="form-text text-muted">Format: JPG, JPEG, PNG, atau PDF (Maks: 2MB)</span>
                                    <?php if (session('errors.bukti_kepemilikan')): ?>
                                        <div class="invalid-feedback"><?= session('errors.bukti_kepemilikan'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="text-muted"><span class="text-danger">*</span>) Wajib di isi</div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="<?= base_url('peralatan'); ?>" class="btn btn-light me-2">
                                <i class="ph-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary sweet-confirm">
                                Simpan
                                <i class="ph-paper-plane-tilt ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
