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

                                        <?php foreach (
                                            [
                                                'foto_ktp' => 'Foto KTP',
                                                'foto_ijazah' => 'Foto Ijazah',
                                                'foto_transkrip_nilai' => 'Foto Transkrip Nilai',
                                                'foto_npwp' => 'Foto NPWP',
                                                'foto_sertifikasi' => 'Foto Sertifikasi',
                                                'foto_nilai_sertifikasi' => 'Foto Nilai Sertifikasi',
                                            ] as $field => $label
                                        ): ?>

                                            <div class="mb-3">
                                                <label for="<?= $field; ?>" class="form-label">
                                                    <?= $label; ?> <span class="text-danger">*</span>
                                                </label>

                                                <div id="preview_<?= $field; ?>" class="mb-2" style="display: none;">
                                                    <img id="img_<?= $field; ?>"
                                                        src=""
                                                        alt="Preview <?= $label; ?>"
                                                        class="img-thumbnail"
                                                        style="max-height: 150px; object-fit: cover;">
                                                    <div class="mt-1">
                                                        <small class="text-success fw-semibold">
                                                            <i class="bi bi-check-circle"></i>
                                                            Foto siap diupload
                                                        </small>

                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-danger p-0 ms-2"
                                                            onclick="clearPreview('<?= $field; ?>')">
                                                            <i class="bi bi-x-circle"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>

                                                <input type="file"
                                                    class="form-control <?= session('errors.' . $field) ? 'is-invalid' : ''; ?>"
                                                    id="<?= $field; ?>"
                                                    name="<?= $field; ?>"
                                                    accept="image/jpeg, image/jpg"
                                                    onchange="previewFoto(this, '<?= $field; ?>')"
                                                    required>

                                                <?php if (session('errors.' . $field)): ?>
                                                    <div class="invalid-feedback"><?= session('errors.' . $field); ?></div>
                                                <?php endif; ?>
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
            if ($(elId).data('select2')) {
                $(elId).select2('destroy');
            }
            $(elId).select2({
                width: '100%',
                theme: 'bootstrap4'
            });
        }

        function loadKabupaten(id_provinsi, elTarget, selectedId = null) {
            console.log('loadKabupaten dipanggil:', {
                id_provinsi: id_provinsi,
                elTarget: elTarget,
                selectedId: selectedId
            });

            if (!id_provinsi) {
                $(elTarget).html("<option value=''>Silahkan pilih provinsi terlebih dahulu</option>");
                refreshSelect2(elTarget);
                return;
            }

            $(elTarget).html("<option value=''>Memuat data...</option>");

            $.ajax({
                url: "<?= base_url('master/regency/get-specific'); ?>",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id_provinsi
                },
                success: function(data) {
                    console.log('Data kabupaten diterima:', data);
                    var options = "<option value=''>Silahkan pilih kota/kabupaten</option>";

                    if (data && data.length > 0) {
                        $.each(data, function() {
                            var selected = (selectedId && selectedId == this.id_kabupaten) ? ' selected' : '';
                            options += "<option value='" + this.id_kabupaten + "'" + selected + ">" +
                                this.nama_kabupaten + "</option>";
                        });
                    } else {
                        console.warn('Tidak ada data kabupaten untuk provinsi:', id_provinsi);
                    }

                    $(elTarget).html(options);
                    refreshSelect2(elTarget);
                },
                error: function(xhr, status, error) {
                    console.error('Gagal memuat data kabupaten:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText,
                        url: "<?= base_url('master/regency/get-specific'); ?>",
                        id_provinsi: id_provinsi
                    });
                    $(elTarget).html("<option value=''>Gagal memuat data</option>");
                    refreshSelect2(elTarget);
                }
            });
        }

        $('#id_provinsi_domisili').on('change', function() {
            var selectedProvince = $(this).val();
            console.log('Provinsi domisili changed:', selectedProvince);

            if (selectedProvince) {
                loadKabupaten(selectedProvince, '#id_kabupaten_domisili');
            } else {
                $('#id_kabupaten_domisili').html("<option value=''>Silahkan pilih provinsi terlebih dahulu</option>")
                    .val('').trigger('change');
            }
        });

    });

    function previewFoto(input, field) {
        const previewDiv = document.getElementById('preview_' + field);
        const previewImg = document.getElementById('img_' + field);

        if (!input.files || !input.files[0]) {
            previewDiv.style.display = 'none';
            return;
        }

        const file = input.files[0];

        if (!['image/jpeg', 'image/jpg'].includes(file.type)) {
            alert('File harus berformat JPG/JPEG.');
            input.value = '';
            previewDiv.style.display = 'none';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB.');
            input.value = '';
            previewDiv.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function clearPreview(field) {
        const input = document.getElementById(field);
        const previewDiv = document.getElementById('preview_' + field);
        const previewImg = document.getElementById('img_' + field);

        input.value = '';
        previewImg.src = '';
        previewDiv.style.display = 'none';
    }
</script>