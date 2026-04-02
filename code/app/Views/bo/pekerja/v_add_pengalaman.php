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

                    <div class="card-body">

                        <div class="alert alert-info d-flex align-items-center mb-4">
                            <i class="ph-user-circle ph-lg me-2"></i>
                            <div>
                                Menambahkan pengalaman kontrak untuk pekerja:
                                <strong><?= $row_pekerja['nama']; ?></strong>
                            </div>
                        </div>

                        <form action="<?= site_url('pengalaman-pekerja/save'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_pekerja" value="<?= encrypt_data($row_pekerja['id_pekerja']); ?>">

                            <div class="alert alert-warning d-flex align-items-center mb-3">
                                <i class="ph-warning ph-lg me-2"></i>
                                <div>
                                    Hanya menampilkan kontrak yang <strong>belum dikaitkan</strong> ke pekerja ini.
                                    Pilih satu atau lebih kontrak yang ingin dikaitkan.
                                </div>
                            </div>

                            <div id="loading_pengalaman" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <div class="mt-2 text-muted">Memuat data pengalaman...</div>
                            </div>

                            <div id="empty_pengalaman" class="text-center text-muted py-5 d-none">
                                <i class="ph-folder-open ph-2x mb-3"></i>
                                <p class="mb-0">Semua pengalaman kontrak sudah dikaitkan ke pekerja ini.</p>
                            </div>

                            <div id="wrapper_tabel_pengalaman" class="d-none">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%" class="text-center">
                                                    <input type="checkbox" id="check_all" class="form-check-input">
                                                </th>
                                                <th>Nama Kontrak</th>
                                                <th>Nomor Kontrak</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Nilai Kontrak</th>
                                                <th>Tgl. Serah Terima</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_pengalaman">
                                            //
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tombol aksi -->
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a href="<?= site_url('pekerja/view/' . encrypt_data($row_pekerja['id_pekerja'])); ?>"
                                        class="btn btn-light btn-labeled btn-labeled-start btn-sm">
                                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                                            <i class="ph-arrow-left ph-lg"></i>
                                        </span>
                                        Kembali
                                    </a>
                                    <button type="submit"
                                        id="btn_simpan_pengalaman"
                                        class="btn btn-primary btn-labeled btn-labeled-start btn-sm">
                                        <span class="btn-labeled-icon bg-black bg-opacity-20">
                                            <i class="ph-floppy-disk ph-lg"></i>
                                        </span>
                                        Simpan Pilihan
                                    </button>
                                </div>
                            </div>

                            <!-- Tombol kembali saat empty state -->
                            <div id="wrapper_btn_kembali" class="text-end d-none">
                                <a href="<?= site_url('pekerja/view/' . encrypt_data($row_pekerja['id_pekerja'])); ?>"
                                    class="btn btn-light btn-labeled btn-labeled-start btn-sm">
                                    <span class="btn-labeled-icon bg-black bg-opacity-20">
                                        <i class="ph-arrow-left ph-lg"></i>
                                    </span>
                                    Kembali
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /main content -->

<script>
    $(document).ready(function() {

        var idPekerjaEnc = "<?= encrypt_data($row_pekerja['id_pekerja']); ?>";

        $.ajax({
            url: "<?= site_url('pengalaman-pekerja/get-available'); ?>/" + idPekerjaEnc,
            type: 'GET',
            success: function(data) {
                $('#loading_pengalaman').addClass('d-none');

                if (data.length === 0) {
                    $('#empty_pengalaman').removeClass('d-none');
                    $('#wrapper_btn_kembali').removeClass('d-none');
                    return;
                }

                var rows = '';
                $.each(data, function() {
                    var nilaiKontrak = this.nilai_kontrak ?
                        'Rp ' + parseFloat(this.nilai_kontrak).toLocaleString('id-ID') :
                        '-';
                    var tglMulai = formatTanggal(this.tanggal_mulai);
                    var tglSelesai = formatTanggal(this.tanggal_selesai);
                    var tglSerahTerima = formatTanggal(this.tanggal_serah_terima);
                    var status = this.status ? this.status.toLowerCase() : '';
                    var badgeStatus = status === 'aktif' ?
                        '<span class="badge bg-success bg-opacity-10 text-success">Aktif</span>' :
                        status === 'nonaktif' ?
                        '<span class="badge bg-secondary bg-opacity-10 text-secondary">Nonaktif</span>' :
                        '<span class="badge bg-secondary bg-opacity-10 text-secondary">-</span>';

                    rows += '<tr>' +
                        '<td class="text-center"><input type="checkbox" name="id_pengalaman[]" value="' + this.id_pengalaman + '" class="form-check-input cb_pengalaman"></td>' +
                        '<td>' + (this.nama_kontrak || '-') + '</td>' +
                        '<td>' + (this.nomor_kontrak || '-') + '</td>' +
                        '<td>' + tglMulai + '</td>' +
                        '<td>' + tglSelesai + '</td>' +
                        '<td>' + nilaiKontrak + '</td>' +
                        '<td>' + tglSerahTerima + '</td>' +
                        '<td class="text-center">' + badgeStatus + '</td>' +
                        '</tr>';
                });

                $('#tbody_pengalaman').html(rows);
                $('#wrapper_tabel_pengalaman').removeClass('d-none');
            },
            error: function() {
                $('#loading_pengalaman').addClass('d-none');
                $('#empty_pengalaman')
                    .html('<i class="ph-warning ph-2x mb-3 text-danger"></i><p class="mb-0 text-danger">Gagal memuat data. Silahkan muat ulang halaman.</p>')
                    .removeClass('d-none');
                $('#wrapper_btn_kembali').removeClass('d-none');
            }
        });

        $('#check_all').on('change', function() {
            $('.cb_pengalaman').prop('checked', $(this).is(':checked'));
        });

        $('form').on('submit', function(e) {
            if ($('.cb_pengalaman:checked').length === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Belum Ada yang Dipilih',
                    text: 'Pilih minimal satu pengalaman kontrak terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });

        function formatTanggal(dateStr) {
            if (!dateStr) return '-';
            var parts = dateStr.split('-');
            if (parts.length !== 3) return dateStr;
            return parts[2] + '-' + parts[1] + '-' + parts[0];
        }

    });
</script>