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

                    <form action="<?= base_url('pekerja/add'); ?>" method="post">
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
                                                <?= $jenis['nama_jenis_tenaga_ahli']; ?>
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
                                        <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''; ?>>Pria</option>
                                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Wanita</option>
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
                                            <option value="<?= $country['id_negara']; ?>" <?= old('id_negara_tempat_lahir') == $country['id_negara'] ? 'selected' : ''; ?>>
                                                <?= $country['nama_negara']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" class="form-control daterange-single" placeholder="Masukkan tanggal lahir" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi Tempat Lahir</label>
                                <div class="col-lg-4">
                                    <select id="id_provinsi_tempat_lahir" class="form-control select-search">
                                        <option value="">Silahkan pilih provinsi</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>" <?= old('id_provinsi_tempat_lahir') == $province['id'] ? 'selected' : ''; ?>>
                                                <?= $province['nama_provinsi']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kota/Kabupaten Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_tempat_lahir" id="id_kabupaten_tempat_lahir" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kota/kabupaten</option>
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
                                    <input type="text" name="website" value="<?= old('website'); ?>" class="form-control" placeholder="Masukkan URL website (opsional)">
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
                                        <option value="">Silahkan pilih kota/kabupaten</option>
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
                                        <option value="Aktif" <?= old('tingkat_bahasa_indonesia') == 'Aktif' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Pasif" <?= old('tingkat_bahasa_indonesia') == 'Pasif' ? 'selected' : ''; ?>>Sedang</option>
                                        <option value="Tidak Bisa" <?= old('tingkat_bahasa_indonesia') == 'Tidak Bisa' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tingkat Bahasa Inggris <span class="text-danger">*</span></label>
                                <div class="col-lg-2">
                                    <select name="tingkat_bahasa_inggris" class="form-control select-search" required>
                                        <option value="">Pilih tingkat</option>
                                        <option value="Aktif" <?= old('tingkat_bahasa_inggris') == 'Aktif' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Pasif" <?= old('tingkat_bahasa_inggris') == 'Pasif' ? 'selected' : ''; ?>>Sedang</option>
                                        <option value="Tidak Bisa" <?= old('tingkat_bahasa_inggris') == 'Tidak Bisa' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tingkat Bahasa Setempat</label>
                                <div class="col-lg-2">
                                    <select name="tingkat_bahasa_setempat" class="form-control select-search">
                                        <option value="">Pilih tingkat</option>
                                        <option value="Aktif" <?= old('tingkat_bahasa_setempat') == 'Aktif' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Pasif" <?= old('tingkat_bahasa_setempat') == 'Pasif' ? 'selected' : ''; ?>>Sedang</option>
                                        <option value="Tidak Bisa" <?= old('tingkat_bahasa_setempat') == 'Tidak Bisa' ? 'selected' : ''; ?>>Buruk</option>
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


                            <div class="text-muted"><span class="text-danger">*</span>) Wajib di isi</div>

                        </div>
                        <div class="card-footer text-end">
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
        getRegency("#id_provinsi_tempat_lahir", "#id_kabupaten_tempat_lahir");
        getRegency("#id_provinsi_domisili", "#id_kabupaten_domisili");

        function getRegency(elSelected, elTarget) {
            $(elSelected).on("select2:select", function(e) {
                var val = $(this).val();
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
                            $(elTarget).append(
                                "<option value='" + this.id_kabupaten + "'>" + this.nama_kabupaten + "</option>"
                            );
                        });
                        $(elTarget).trigger("change");
                    },
                    error: function() {
                        alert('Gagal mendapatkan data!');
                    }
                });
            });
        }
    });
</script>