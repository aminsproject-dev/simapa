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

                    <form enctype="multipart/form-data" action="<?= base_url('pekerja/add'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-body">

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Identitas Pekerja</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama" value="<?= old('nama'); ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Status Kepegawaian <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_status_kepegawaian" class="form-control select-search" required>
                                        <option value="">Silahkan pilih status kepegawaian</option>
                                        <?php foreach ($dt_status_kepegawaian as $status) { ?>
                                            <option value="<?= $status['id_status']; ?>" <?= old('id_status_kepegawaian') == $status['id_status'] ? 'selected' : ''; ?>>
                                                <?= $status['nama_status']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Jenis Tenaga Ahli <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_jenis_tenaga_ahli" class="form-control select-search" required>
                                        <option value="">Silahkan pilih jenis tenaga ahli</option>
                                        <?php foreach ($dt_jenis_tenaga_ahli as $jenis) { ?>
                                            <option value="<?= $jenis['id_jenis']; ?>" <?= old('id_jenis_tenaga_ahli') == $jenis['id_jenis'] ? 'selected' : ''; ?>>
                                                <?= $jenis['nama_jenis']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kewarganegaraan <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kewarganegaraan" class="form-control select-search" required>
                                        <option value="">Silahkan pilih negara</option>
                                        <?php foreach ($dt_country as $country) { ?>
                                            <option value="<?= $country['id_negara']; ?>" <?= old('id_kewarganegaraan') == $country['id_negara'] ? 'selected' : ''; ?>>
                                                <?= $country['nama_negara']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="jenis_kelamin" class="form-control select-search" required>
                                        <option value="">Silahkan pilih jenis kelamin</option>
                                        <?php foreach ($opt_jenis_kelamin as $opt): ?>
                                            <option value="<?= $opt ?>" <?= old('jenis_kelamin') == $opt ? 'selected' : ''; ?>>
                                                <?= $opt ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">NIK / Nomor Paspor <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="nik_paspor" value="<?= old('nik_paspor'); ?>" class="form-control" placeholder="Masukkan NIK atau nomor paspor" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">NPWP</label>
                                <div class="col-lg-4">
                                    <input type="text" name="npwp" value="<?= old('npwp'); ?>" class="form-control" placeholder="Masukkan NPWP">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">No. BPJS Kesehatan</label>
                                <div class="col-lg-4">
                                    <input type="text" name="no_bpjs_kesehatan" value="<?= old('no_bpjs_kesehatan'); ?>" class="form-control" placeholder="Masukkan nomor BPJS Kesehatan">
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">No. BPJS Ketenagakerjaan</label>
                                <div class="col-lg-4">
                                    <input type="text" name="no_bpjs_ketenagakerjaan" value="<?= old('no_bpjs_ketenagakerjaan'); ?>" class="form-control" placeholder="Masukkan nomor BPJS Ketenagakerjaan">
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Tempat & Tanggal Lahir</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Negara Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_negara_tempat_lahir" class="form-control select-search" required>
                                        <option value="">Silahkan pilih negara</option>
                                        <?php foreach ($dt_country as $country) { ?>
                                            <option value="<?= $country['id_negara']; ?>"
                                                <?= old('id_negara_tempat_lahir') == $country['id_negara'] ? 'selected' : ''; ?>>
                                                <?= $country['nama_negara']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>"
                                        class="form-control daterange-single" placeholder="Masukkan tanggal lahir" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kota/Kabupaten Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_tempat_lahir" id="id_kabupaten_tempat_lahir"
                                        class="form-control select-search" required>
                                        <option value="">Silahkan pilih kota/kabupaten</option>
                                        <?php foreach ($dt_kabupaten as $kab) { ?>
                                            <option value="<?= $kab['id_kabupaten']; ?>"
                                                <?= old('id_kabupaten_tempat_lahir') == $kab['id_kabupaten'] ? 'selected' : ''; ?>>
                                                <?= $kab['nama_kabupaten']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Kontak</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="email" name="email" value="<?= old('email'); ?>" class="form-control" placeholder="Masukkan alamat email" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Telepon <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="telepon" value="<?= old('telepon'); ?>" class="form-control" placeholder="Masukkan nomor telepon" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Website</label>
                                <div class="col-lg-10">
                                    <input type="url" name="website" value="<?= old('website'); ?>" class="form-control" placeholder="Masukkan URL website (contoh: https://example.com)">
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Domisili</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi Domisili <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_provinsi_domisili" id="id_provinsi_domisili" class="form-control select-search" required>
                                        <option value="">Silahkan pilih provinsi</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>" <?= old('id_provinsi_domisili') == $province['id'] ? 'selected' : ''; ?>>
                                                <?= $province['nama_provinsi']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kota/Kabupaten Domisili <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_domisili" id="id_kabupaten_domisili" class="form-control select-search" required>
                                        <option value="">Silahkan pilih provinsi terlebih dahulu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat Lengkap <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap"><?= old('alamat'); ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Kompetensi & Bahasa</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Lama Pengalaman Kerja <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="number" name="lama_pengalaman_kerja_tahun" value="<?= old('lama_pengalaman_kerja_tahun'); ?>" class="form-control" placeholder="Contoh: 5" min="0" required>
                                        <div class="input-group-text">Tahun</div>
                                    </div>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Profesi / Keahlian <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="profesi_keahlian" value="<?= old('profesi_keahlian'); ?>" class="form-control" placeholder="Contoh: Struktur, Jalan, Jembatan" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Tingkat Bahasa Indonesia <span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <select name="tingkat_bahasa_indonesia" class="form-control select-search" required>
                                        <option value="">Pilih tingkat</option>
                                        <?php foreach ($opt_tingkat_bahasa as $opt): ?>
                                            <option value="<?= $opt ?>" <?= old('tingkat_bahasa_indonesia') == $opt ? 'selected' : ''; ?>>
                                                <?= $opt ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tingkat Bahasa Inggris <span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <select name="tingkat_bahasa_inggris" class="form-control select-search" required>
                                        <option value="">Pilih tingkat</option>
                                        <?php foreach ($opt_tingkat_bahasa as $opt): ?>
                                            <option value="<?= $opt ?>" <?= old('tingkat_bahasa_inggris') == $opt ? 'selected' : ''; ?>>
                                                <?= $opt ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tingkat Bahasa Setempat</label>
                                <div class="col-lg-2">
                                    <select name="tingkat_bahasa_setempat" class="form-control select-search">
                                        <option value="">Pilih tingkat</option>
                                        <?php foreach ($opt_tingkat_bahasa as $opt): ?>
                                            <option value="<?= $opt ?>" <?= old('tingkat_bahasa_setempat') == $opt ? 'selected' : ''; ?>>
                                                <?= $opt ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Pendidikan</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Akhir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_pendidikan_akhir" class="form-control select-search" required>
                                        <option value="">Silahkan pilih pendidikan akhir</option>
                                        <?php foreach ($dt_pendidikan_akhir as $pendidikan) { ?>
                                            <option value="<?= $pendidikan['id_pendidikan_akhir']; ?>" <?= old('id_pendidikan_akhir') == $pendidikan['id_pendidikan_akhir'] ? 'selected' : ''; ?>>
                                                <?= $pendidikan['nama_pendidikan_akhir']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Formal <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <textarea name="pendidikan_formal" class="form-control ckeditor_classic"><?= old('pendidikan_formal'); ?></textarea>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Non-Formal</label>
                                <div class="col-lg-4">
                                    <textarea name="pendidikan_non_formal" class="form-control ckeditor_classic"><?= old('pendidikan_non_formal'); ?></textarea>
                                </div>
                            </div>

                            <!-- SECTION DOKUMEN FOTO -->
                            <div class="card border mt-4">
                                <div class="card-header py-2">
                                    <h6 class="mb-0">
                                        <i class="ph-images me-2"></i>
                                        Dokumen Foto
                                        <small class="text-muted fw-normal ms-2">Format: JPEG | Maks: 2MB per file</small>
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
                                            $existingFile = $row_pekerja[$fieldName] ?? null;
                                            $isEdit       = isset($row_pekerja);
                                        ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="card h-100 border">
                                                    <div class="card-body">
                                                        <label class="form-label fw-semibold">
                                                            <?= $label; ?>
                                                            <span class="text-danger">*</span>
                                                        </label>

                                                        <?php if (!empty($existingFile)): ?>
                                                            <div class="mb-2" id="existing_<?= $fieldName; ?>">
                                                                <img src="<?= base_url('uploads/pekerja/' . $existingFile); ?>"
                                                                    alt="<?= $label; ?>"
                                                                    class="img-thumbnail w-100"
                                                                    style="max-height: 180px; object-fit: cover; cursor: pointer;"
                                                                    onclick="window.open(this.src, '_blank')">
                                                                <div class="text-muted small mt-1">
                                                                    <i class="ph-check-circle text-success me-1"></i>
                                                                    File sudah ada. Upload baru untuk mengganti.
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <input type="file"
                                                            name="<?= $fieldName; ?>"
                                                            id="<?= $fieldName; ?>"
                                                            class="form-control foto-input"
                                                            accept="image/jpeg"
                                                            data-preview="preview_<?= $fieldName; ?>"
                                                            <?= empty($existingFile) ? 'required' : ''; ?>>

                                                        <div class="img-preview-wrapper d-none mt-2" id="preview_<?= $fieldName; ?>">
                                                            <img src="" alt="Preview <?= $label; ?>"
                                                                class="img-thumbnail w-100"
                                                                style="max-height: 180px; object-fit: cover;">
                                                            <div class="d-flex align-items-center mt-1 text-success small">
                                                                <i class="ph-check-circle me-1"></i>
                                                                <span class="preview-filename"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- /SECTION DOKUMEN FOTO -->

                            <div class="text-muted"><span class="text-danger">*</span>) Wajib di isi</div>

                        </div>
                        <div class="card-footer text-end">
                            <a href="<?= base_url('pekerja'); ?>" class="btn btn-light me-2">
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

<script>
    $(document).ready(function() {

        function refreshSelect2(elId) {
            $(elId).select2({
                width: '100%'
            });
        }

        function loadKabupaten(id_provinsi, elTarget, selectedId = null) {
            if (!id_provinsi) {
                $(elTarget).html("<option value=''>Silahkan pilih provinsi terlebih dahulu</option>");
                refreshSelect2(elTarget);
                return;
            }

            $(elTarget).html("<option value=''>Memuat data...</option>");

            $.ajax({
                url: "<?= base_url('regency/get-specific'); ?>",
                type: 'GET',
                data: {
                    id: id_provinsi
                },
                success: function(data) {
                    var options = "<option value=''>Silahkan pilih kota/kabupaten</option>";
                    $.each(data, function() {
                        var selected = (selectedId && selectedId == this.id_kabupaten) ? ' selected' : '';
                        options += "<option value='" + this.id_kabupaten + "'" + selected + ">" +
                            this.nama_kabupaten + "</option>";
                    });
                    $(elTarget).html(options);
                    refreshSelect2(elTarget);
                },
                error: function() {
                    $(elTarget).html("<option value=''>Gagal memuat data</option>");
                    refreshSelect2(elTarget);
                }
            });
        }

        $('#id_provinsi_tempat_lahir').on('change', function() {
            loadKabupaten($(this).val(), '#id_kabupaten_tempat_lahir');
        });

        $('#id_provinsi_domisili').on('change', function() {
            loadKabupaten($(this).val(), '#id_kabupaten_domisili');
        });

    });

    document.querySelectorAll('.foto-input').forEach(function(input) {
        input.addEventListener('change', function(e) {
            var file = e.target.files[0];
            var previewId = e.target.dataset.preview;
            var wrapper = document.getElementById(previewId);
            var img = wrapper.querySelector('img');
            var nameSpan = wrapper.querySelector('.preview-filename');

            if (!file) {
                wrapper.classList.add('d-none');
                return;
            }

            if (!['image/jpeg', 'image/jpg'].includes(file.type)) {
                Swal.fire({
                    title: 'Format Salah',
                    text: 'File harus berformat JPEG (.jpg / .jpeg).',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                e.target.value = '';
                wrapper.classList.add('d-none');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal 2MB.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                e.target.value = '';
                wrapper.classList.add('d-none');
                return;
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                nameSpan.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                wrapper.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    });
</script>