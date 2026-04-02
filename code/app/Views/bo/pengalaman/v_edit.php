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
                    <form action="<?= base_url('pengalaman/edit/' . encrypt_data($row_pengalaman['id_pengalaman'])); ?>" method="post">
                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Kontrak<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nama_kontrak" value="<?= old('nama_kontrak') ?: $row_pengalaman['nama_kontrak']; ?>" class="form-control" placeholder="Masukkan nama kontrak" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Nomor Kontrak<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" name="nomor_kontrak" value="<?= old('nomor_kontrak') ?: $row_pengalaman['nomor_kontrak']; ?>" class="form-control" placeholder="Masukkan nomor kontrak" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Mulai Kontrak<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_mulai" value="<?= old('tanggal_mulai') ?: $row_pengalaman['tanggal_mulai']; ?>" class="form-control daterange-single" placeholder="Masukkan tanggal mulai kontrak" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Selesai Kontrak<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_selesai" value="<?= old('tanggal_selesai') ?: $row_pengalaman['tanggal_selesai']; ?>" class="form-control daterange-single" placeholder="Masukkan tanggal selesai kontrak" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Tanggal Serah Terima<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" name="tanggal_serah_terima" value="<?= old('tanggal_serah_terima') ?: $row_pengalaman['tanggal_serah_terima']; ?>" class="form-control daterange-single" placeholder="Masukkan tanggal serah terima" required>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Nilai Kontrak<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                        <input type="text" name="nilai_kontrak" value="<?= old('nilai_kontrak') ?: $row_pengalaman['nilai_kontrak']; ?>" class="form-control" placeholder="Masukkan nilai kontrak (Rp)" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kategori Pekerjaan<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kategori_pekerjaan" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kategori</option>
                                        <?php foreach ($dt_kategori as $kategori) { ?>
                                            <option value="<?= $kategori['id_kategori_pekerjaan']; ?>" <?= (old('id_kategori_pekerjaan') ?: $row_pengalaman['id_kategori_pekerjaan']) == $kategori['id_kategori_pekerjaan'] ? 'selected' : ''; ?>><?= $kategori['nama_kategori_pekerjaan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Presentase Pekerjaan<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="number" name="persentase_pekerjaan" value="<?= old('persentase_pekerjaan') ?: $row_pengalaman['persentase_pekerjaan']; ?>" class="form-control" placeholder="Masukkan presentase pekerjaan (%)" required>
                                        <div class="input-group-text">
                                            %
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Uraian Pekerjaan<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <textarea name="uraian_pekerjaan" class="form-control ckeditor_classic"><?= old('uraian_pekerjaan') ?: $row_pengalaman['uraian_pekerjaan']; ?></textarea>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Ruang Lingkup Pekerjaan<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <textarea name="ruang_lingkup_pekerjaan" class="form-control ckeditor_classic"><?= old('ruang_lingkup_pekerjaan') ?: $row_pengalaman['ruang_lingkup_pekerjaan']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kbli<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kbli" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kbli</option>
                                        <?php foreach ($dt_kbli as $kbli) { ?>
                                            <option value="<?= $kbli['id_kbli']; ?>" <?= (old('id_kbli') ?: $row_pengalaman['id_kbli']) == $kbli['id_kbli'] ? 'selected' : ''; ?>><?= $kbli['kode_kbli']; ?> - <?= $kbli['nama_kbli']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Lokasi Pekerjaan</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <textarea name="alamat_pekerjaan" class="form-control ckeditor_classic"><?= old('alamat_pekerjaan') ?: $row_pengalaman['alamat_pekerjaan']; ?></textarea>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Negara<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_negara_pekerjaan" class="form-control select-search" required>
                                        <option value="">Silahkan pilih negara</option>
                                        <?php foreach ($dt_country as $country) { ?>
                                            <option value="<?= $country['id_negara']; ?>" <?= (old('id_negara_pekerjaan') ?: $row_pengalaman['id_negara_pekerjaan'])  == $country['id_negara'] ? 'selected' : ''; ?>><?= $country['nama_negara']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_provinsi_pekerjaan" id="id_provinsi_pekerjaan" class="form-control select-search" required>
                                        <option value="">Silahkan pilih provinsi</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>" <?= (old('id_provinsi_pekerjaan') ?: $row_pengalaman['id_provinsi_pekerjaan']) == $province['id'] ? 'selected' : ''; ?>><?= $province['nama_provinsi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Kota/Kabupaten<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_pekerjaan" id="id_kabupaten_pekerjaan" class="form-control select-search" required>
                                        <option value="">Silahkan pilih kota/kabupaten</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 border-bottom">
                                <label class="col-lg-2 col-form-label fw-bold">Instansi</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Jenis Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_jenis_instansi" id="id_jenis_instansi" class="form-control select-search" required>
                                        <option value="">Silahkan pilih jenis instansi</option>
                                        <?php foreach ($dt_jenis_instansi as $jenis) { ?>
                                            <option value="<?= $jenis['id_jenis_instansi']; ?>" <?= (old('id_jenis_instansi') ?: $row_pengalaman['id_jenis_instansi'])  == $jenis['id_jenis_instansi'] ? 'selected' : ''; ?>><?= $jenis['nama_jenis_instansi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Nama Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_nama_instansi" id="id_nama_instansi" class="form-control select-search" required>
                                        <option value="">Silahkan pilih nama instansi</option>
                                        <?php foreach ($dt_nama_instansi as $nama) { ?>
                                            <option value="<?= $nama['id_nama_instansi']; ?>" <?= (old('id_nama_instansi') ?: $row_pengalaman['id_nama_instansi']) == $nama['id_nama_instansi'] ? 'selected' : ''; ?>><?= $nama['nama_instansi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Satuan Kerja<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_satuan_kerja" id="id_satuan_kerja" class="form-control select-search" required>
                                        <option value="">Silahkan pilih satuan kerja</option>
                                        <?php foreach ($dt_satker as $satker) { ?>
                                            <option value="<?= $satker['id_satuan_kerja']; ?>" <?= (old('id_satuan_kerja') ?: $row_pengalaman['id_satuan_kerja']) == $satker['id_satuan_kerja'] ? 'selected' : ''; ?>><?= $satker['nama_satuan_kerja']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Provinsi Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_provinsi_instansi" id="id_provinsi_instansi" class="form-control select-search" required>
                                        <option value="">Silahkan pilih provinsi instansi</option>
                                        <?php foreach ($dt_province as $province) { ?>
                                            <option value="<?= $province['id']; ?>" <?= (old('id_provinsi_instansi') ?: $row_pengalaman['id_provinsi_instansi']) == $province['id'] ? 'selected' : ''; ?>><?= $province['nama_provinsi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Kota/Kabupaten Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <select name="id_kabupaten_instansi" id="id_kabupaten_instansi" class="form-control select-search">
                                        <option value="">Silahkan pilih kota/kabupaten instansi</option>
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label text-lg-end">Telepon Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-4">
                                    <input type="number" name="telepon_instansi" value="<?= old('telepon_instansi') ?: $row_pengalaman['telepon_instansi']; ?>" class="form-control" placeholder="Masukkan nomor telepon instansi" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Alamat Instansi<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <textarea name="alamat_instansi" class="form-control ckeditor_classic"><?= old('alamat_instansi') ?: $row_pengalaman['alamat_instansi']; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label text-lg-end">Status<span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="status" id="status" class="form-control select-search" required>
                                        <option value="">Silahkan pilih status</option>
                                        <option value="aktif" <?= $row_pengalaman['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="nonaktif" <?= $row_pengalaman['status'] == 'nonaktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
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
        getRegency("#id_provinsi_pekerjaan", "#id_kabupaten_pekerjaan", '<?= $row_pengalaman['id_kabupaten_pekerjaan']; ?>')
        getRegency("#id_provinsi_instansi", "#id_kabupaten_instansi", '<?= $row_pengalaman['id_kabupaten_instansi']; ?>')

        $('#id_provinsi_pekerjaan').on("select2:select", function(e) {
            getRegency(this, "#id_kabupaten_pekerjaan", '<?= $row_pengalaman['id_kabupaten_pekerjaan']; ?>')
        });

        $('#id_provinsi_instansi').on("select2:select", function(e) {
            getRegency(this, "#id_kabupaten_instansi", '<?= $row_pengalaman['id_kabupaten_instansi']; ?>')
        });

        function getRegency(elSource, elTarget, value) {
            var val = $(elSource).val();
            $.ajax({
                url: "<?php echo base_url('master/regency/get-specific'); ?>",
                type: 'GET',
                data: {
                    'id': val,
                },
                success: function(data) {
                    $(elTarget).html("");
                    $(elTarget).append(
                        "<option>Pilih kota/kabupaten</option>"
                    );
                    $.each(JSON.parse(data), function(key, i) {
                        if (value == this.id_kabupaten) {
                            $(elTarget).append(
                                "<option value=" + this.id_kabupaten + " selected>" + this.nama_kabupaten + "</option>"
                            );
                        } else {
                            $(elTarget).append(
                                "<option value=" + this.id_kabupaten + ">" + this.nama_kabupaten + "</option>"
                            );
                        }
                    });
                },
                failed: function(data) {
                    alert('Gagal mendapatkan data!');
                }
            });
        }
    })
</script>