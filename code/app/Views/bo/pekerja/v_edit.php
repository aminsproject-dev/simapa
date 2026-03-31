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

                    <form action="<?= base_url('pekerja/update/' . encrypt_data($row_pekerja['id_pekerja'])); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="card-body">


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Data Pribadi</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama" value="<?= old('nama') ?: $row_pekerja['nama']; ?>" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Status Kepegawaian <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_status_kepegawaian" class="form-control select-search" required>
                                        <option value="">Silahkan pilih status kepegawaian</option>
                                        <?php foreach ($dt_status_kepegawaian as $status) { ?>
                                            <option value="<?= $status['id_status']; ?>" <?= (old('id_status_kepegawaian') ?: $row_pekerja['id_status_kepegawaian']) == $status['id_status'] ? 'selected' : ''; ?>>
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
                                            <option value="<?= $jenis['id_jenis']; ?>" <?= (old('id_jenis_tenaga_ahli') ?: $row_pekerja['id_jenis_tenaga_ahli']) == $jenis['id_jenis'] ? 'selected' : ''; ?>>
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
                                        <option value="">Silahkan pilih kewarganegaraan</option>
                                        <?php foreach ($dt_country as $country) { ?>
                                            <option value="<?= $country['id_negara']; ?>" <?= (old('id_kewarganegaraan') ?: $row_pekerja['id_kewarganegaraan']) == $country['id_negara'] ? 'selected' : ''; ?>>
                                                <?= $country['nama_negara']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="jenis_kelamin" class="form-control select-search" required>
                                        <option value="">Silahkan pilih jenis kelamin</option>
                                        <option value="Laki-laki" <?= (old('jenis_kelamin') ?: $row_pekerja['jenis_kelamin']) == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= (old('jenis_kelamin') ?: $row_pekerja['jenis_kelamin']) == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">NIK / Paspor <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="nik_paspor" value="<?= old('nik_paspor') ?: $row_pekerja['nik_paspor']; ?>" class="form-control" placeholder="Masukkan NIK atau nomor paspor" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">NPWP</label>
                                <div class="col-lg-4">
                                    <input type="text" name="npwp" value="<?= old('npwp') ?: $row_pekerja['npwp']; ?>" class="form-control" placeholder="Masukkan nomor NPWP">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">No. BPJS Kesehatan</label>
                                <div class="col-lg-4">
                                    <input type="text" name="no_bpjs_kesehatan" value="<?= old('no_bpjs_kesehatan') ?: $row_pekerja['no_bpjs_kesehatan']; ?>" class="form-control" placeholder="Masukkan nomor BPJS Kesehatan">
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">No. BPJS Ketenagakerjaan</label>
                                <div class="col-lg-4">
                                    <input type="text" name="no_bpjs_ketenagakerjaan" value="<?= old('no_bpjs_ketenagakerjaan') ?: $row_pekerja['no_bpjs_ketenagakerjaan']; ?>" class="form-control" placeholder="Masukkan nomor BPJS Ketenagakerjaan">
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
                                            <option value="<?= $country['id_negara']; ?>" <?= (old('id_negara_tempat_lahir') ?: $row_pekerja['id_negara_tempat_lahir']) == $country['id_negara'] ? 'selected' : ''; ?>>
                                                <?= $country['nama_negara']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?: $row_pekerja['tanggal_lahir']; ?>" class="form-control daterange-single" placeholder="Masukkan tanggal lahir" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi Tempat Lahir</label>
                                <div class="col-lg-4">
                                    <select id="id_provinsi_tempat_lahir" class="form-control select-search">
                                        <option value="">Silahkan pilih provinsi</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>">
                                                <?= $province['nama_provinsi']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kabupaten Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_tempat_lahir" id="id_kabupaten_tempat_lahir" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kota/kabupaten</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Kontak & Alamat</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="email" name="email" value="<?= old('email') ?: $row_pekerja['email']; ?>" class="form-control" placeholder="Masukkan alamat email" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Telepon <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="telepon" value="<?= old('telepon') ?: $row_pekerja['telepon']; ?>" class="form-control" placeholder="Masukkan nomor telepon" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Website</label>
                                <div class="col-lg-10">
                                    <input type="url" name="website" value="<?= old('website') ?: $row_pekerja['website']; ?>" class="form-control" placeholder="Masukkan URL website (contoh: https://example.com)">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat Lengkap <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="alamat" class="form-control ckeditor_classic"><?= old('alamat') ?: $row_pekerja['alamat']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi Domisili <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_provinsi_domisili" id="id_provinsi_domisili" class="form-control select-search" required>
                                        <option value="">Silahkan pilih provinsi domisili</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>" <?= (old('id_provinsi_domisili') ?: $row_pekerja['id_provinsi_domisili']) == $province['id'] ? 'selected' : ''; ?>>
                                                <?= $province['nama_provinsi']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kabupaten Domisili <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_domisili" id="id_kabupaten_domisili" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kota/kabupaten domisili</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Pengalaman Kerja</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Lama Pengalaman Kerja <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="number" name="lama_pengalaman_kerja_tahun" value="<?= old('lama_pengalaman_kerja_tahun') ?: $row_pekerja['lama_pengalaman_kerja_tahun']; ?>" class="form-control" placeholder="Masukkan lama pengalaman kerja" min="0" required>
                                        <div class="input-group-text">Tahun</div>
                                    </div>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Profesi / Keahlian <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="profesi_keahlian" value="<?= old('profesi_keahlian') ?: $row_pekerja['profesi_keahlian']; ?>" class="form-control" placeholder="Masukkan profesi atau keahlian utama" required>
                                </div>
                            </div>


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Kemampuan Bahasa</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Bahasa Indonesia <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="tingkat_bahasa_indonesia" class="form-control select-search" required>
                                        <option value="">Silahkan pilih tingkat kemampuan</option>
                                        <option value="Tidak Ada" <?= (old('tingkat_bahasa_indonesia') ?: $row_pekerja['tingkat_bahasa_indonesia']) == 'Tidak Ada' ? 'selected' : ''; ?>>Tidak Ada</option>
                                        <option value="Pasif" <?= (old('tingkat_bahasa_indonesia') ?: $row_pekerja['tingkat_bahasa_indonesia']) == 'Pasif' ? 'selected' : ''; ?>>Pasif</option>
                                        <option value="Aktif" <?= (old('tingkat_bahasa_indonesia') ?: $row_pekerja['tingkat_bahasa_indonesia']) == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Sangat Aktif" <?= (old('tingkat_bahasa_indonesia') ?: $row_pekerja['tingkat_bahasa_indonesia']) == 'Sangat Aktif' ? 'selected' : ''; ?>>Sangat Aktif</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Bahasa Inggris <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="tingkat_bahasa_inggris" class="form-control select-search" required>
                                        <option value="">Silahkan pilih tingkat kemampuan</option>
                                        <option value="Tidak Ada" <?= (old('tingkat_bahasa_inggris') ?: $row_pekerja['tingkat_bahasa_inggris']) == 'Tidak Ada' ? 'selected' : ''; ?>>Tidak Ada</option>
                                        <option value="Pasif" <?= (old('tingkat_bahasa_inggris') ?: $row_pekerja['tingkat_bahasa_inggris']) == 'Pasif' ? 'selected' : ''; ?>>Pasif</option>
                                        <option value="Aktif" <?= (old('tingkat_bahasa_inggris') ?: $row_pekerja['tingkat_bahasa_inggris']) == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Sangat Aktif" <?= (old('tingkat_bahasa_inggris') ?: $row_pekerja['tingkat_bahasa_inggris']) == 'Sangat Aktif' ? 'selected' : ''; ?>>Sangat Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Bahasa Setempat</label>
                                <div class="col-lg-4">
                                    <select name="tingkat_bahasa_setempat" class="form-control select-search">
                                        <option value="">Silahkan pilih tingkat kemampuan</option>
                                        <option value="Tidak Ada" <?= (old('tingkat_bahasa_setempat') ?: $row_pekerja['tingkat_bahasa_setempat']) == 'Tidak Ada' ? 'selected' : ''; ?>>Tidak Ada</option>
                                        <option value="Pasif" <?= (old('tingkat_bahasa_setempat') ?: $row_pekerja['tingkat_bahasa_setempat']) == 'Pasif' ? 'selected' : ''; ?>>Pasif</option>
                                        <option value="Aktif" <?= (old('tingkat_bahasa_setempat') ?: $row_pekerja['tingkat_bahasa_setempat']) == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Sangat Aktif" <?= (old('tingkat_bahasa_setempat') ?: $row_pekerja['tingkat_bahasa_setempat']) == 'Sangat Aktif' ? 'selected' : ''; ?>>Sangat Aktif</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Pendidikan</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Akhir <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="id_pendidikan_akhir" class="form-control select-search" required>
                                        <option value="">Silahkan pilih pendidikan akhir</option>
                                        <?php foreach ($dt_pendidikan_akhir as $pendidikan) { ?>
                                            <option value="<?= $pendidikan['id_pendidikan_akhir']; ?>" <?= (old('id_pendidikan_akhir') ?: $row_pekerja['id_pendidikan_akhir']) == $pendidikan['id_pendidikan_akhir'] ? 'selected' : ''; ?>>
                                                <?= $pendidikan['nama_pendidikan_akhir']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Formal</label>
                                <div class="col-lg-4">
                                    <textarea name="pendidikan_formal" class="form-control ckeditor_classic"><?= old('pendidikan_formal') ?: $row_pekerja['pendidikan_formal']; ?></textarea>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Pendidikan Non Formal</label>
                                <div class="col-lg-4">
                                    <textarea name="pendidikan_non_formal" class="form-control ckeditor_classic"><?= old('pendidikan_non_formal') ?: $row_pekerja['pendidikan_non_formal']; ?></textarea>
                                </div>
                            </div>


                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Status Data</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Status <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="status" class="form-control select-search" required>
                                        <option value="">Silahkan pilih status</option>
                                        <option value="1" <?= (old('status') ?: $row_pekerja['status']) == 1 ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="0" <?= (old('status') ?: $row_pekerja['status']) == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>


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
<!-- /main content -->


<script>
    jQuery(function($) {

        // Load kabupaten dengan nilai terpilih saat halaman dibuka
        getRegency(
            "#id_provinsi_domisili",
            "#id_kabupaten_domisili",
            '<?= $row_pekerja['id_kabupaten_domisili']; ?>'
        );

        getRegency(
            "#id_provinsi_tempat_lahir",
            "#id_kabupaten_tempat_lahir",
            '<?= $row_pekerja['id_kabupaten_tempat_lahir']; ?>'
        );

        // Event change provinsi domisili
        $('#id_provinsi_domisili').on("select2:select", function() {
            getRegency(this, "#id_kabupaten_domisili", null);
        });

        // Event change provinsi tempat lahir (helper, tidak disimpan)
        $('#id_provinsi_tempat_lahir').on("select2:select", function() {
            getRegency(this, "#id_kabupaten_tempat_lahir", null);
        });

        function getRegency(elSource, elTarget, value) {
            var val = $(elSource).val();
            $.ajax({
                url: "<?= base_url('master/regency/get-specific'); ?>",
                type: 'GET',
                data: {
                    'id': val
                },
                success: function(data) {
                    $(elTarget).html("");
                    $(elTarget).append("<option value=''>Pilih kota/kabupaten</option>");
                    $.each(JSON.parse(data), function(key, i) {
                        if (value && value == this.id_kabupaten) {
                            $(elTarget).append(
                                "<option value='" + this.id_kabupaten + "' selected>" + this.nama_kabupaten + "</option>"
                            );
                        } else {
                            $(elTarget).append(
                                "<option value='" + this.id_kabupaten + "'>" + this.nama_kabupaten + "</option>"
                            );
                        }
                    });

                    // Refresh select2 setelah data dimuat
                    $(elTarget).trigger('change');
                },
                error: function() {
                    alert('Gagal mendapatkan data kabupaten!');
                }
            });
        }

    });
</script>