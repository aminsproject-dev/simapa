<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pekerja - <?= esc($row_pekerja['nama']); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            color: #1a1a2e;
            background: #ffffff;
        }

        .header {
            background: #1a1a2e;
            color: #ffffff;
            padding: 18px 24px;
            margin-bottom: 0;
        }

        .header-table {
            width: 100%;
        }

        .header-title {
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .header-sub {
            font-size: 8pt;
            color: #a0aec0;
            margin-top: 3px;
        }

        .header-meta {
            text-align: right;
            font-size: 7.5pt;
            color: #a0aec0;
        }

        .header-badge {
            background: #e53e3e;
            color: #ffffff;
            font-size: 7.5pt;
            padding: 3px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-bottom: 4px;
        }

        .accent-bar {
            background: #e53e3e;
            height: 4px;
            width: 100%;
        }

        .profile-section {
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-table {
            width: 100%;
        }

        .profile-foto {
            width: 110px;
            vertical-align: top;
            padding-right: 16px;
        }

        .profile-foto img {
            width: 100px;
            height: 120px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            border-radius: 4px;
        }

        .profile-foto-placeholder {
            width: 100px;
            height: 120px;
            background: #f0f4f8;
            border: 2px dashed #cbd5e0;
            border-radius: 4px;
            text-align: center;
            padding-top: 40px;
            color: #a0aec0;
            font-size: 7.5pt;
        }

        .profile-name {
            font-size: 14pt;
            font-weight: bold;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .profile-badge-wrap {
            margin-bottom: 8px;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 7.5pt;
            margin-right: 4px;
        }

        .badge-blue {
            background: #ebf8ff;
            color: #2b6cb0;
            border: 1px solid #bee3f8;
        }

        .badge-green {
            background: #f0fff4;
            color: #276749;
            border: 1px solid #c6f6d5;
        }

        .badge-gray {
            background: #f7fafc;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }

        .quick-info {
            width: 100%;
            margin-top: 6px;
        }

        .quick-info td {
            font-size: 8.5pt;
            padding: 2px 0;
            color: #4a5568;
            vertical-align: top;
        }

        .quick-info td.label {
            width: 130px;
            color: #718096;
        }

        .quick-info td.sep {
            width: 10px;
            color: #718096;
        }

        .section {
            padding: 14px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 9pt;
            font-weight: bold;
            color: #1a1a2e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-left: 3px solid #e53e3e;
            padding-left: 8px;
            margin-bottom: 10px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 4px 6px;
            font-size: 8.5pt;
            vertical-align: top;
        }

        .data-table tr:nth-child(even) td {
            background: #f7fafc;
        }

        .data-table .td-label {
            width: 38%;
            color: #718096;
            font-size: 8pt;
        }

        .data-table .td-sep {
            width: 2%;
            color: #718096;
            text-align: center;
        }

        .data-table .td-value {
            width: 60%;
            color: #1a1a2e;
        }

        .two-col {
            width: 100%;
            border-collapse: collapse;
        }

        .two-col td {
            vertical-align: top;
            padding: 0;
        }

        .two-col td.col-left {
            width: 50%;
            padding-right: 10px;
        }

        .two-col td.col-right {
            width: 50%;
            padding-left: 10px;
            border-left: 1px solid #e2e8f0;
        }

        .lang-table {
            width: 100%;
        }

        .lang-table td {
            padding: 3px 0;
            font-size: 8.5pt;
            vertical-align: middle;
        }

        .lang-label {
            width: 120px;
            color: #4a5568;
        }

        .lang-bar-wrap {
            background: #edf2f7;
            border-radius: 3px;
            height: 10px;
        }

        .lang-bar {
            height: 10px;
            border-radius: 3px;
        }

        .lang-bar-baik {
            background: #48bb78;
            width: 100%;
        }

        .lang-bar-sedang {
            background: #ed8936;
            width: 60%;
        }

        .lang-bar-buruk {
            background: #fc8181;
            width: 30%;
        }

        .lang-text {
            width: 55px;
            text-align: right;
            font-size: 8pt;
            color: #718096;
            padding-left: 6px;
        }

        .foto-table {
            width: 100%;
            border-collapse: collapse;
        }

        .foto-table td {
            width: 50%;
            padding: 8px;
            vertical-align: top;
            text-align: center;
        }

        .foto-card {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 6px;
            background: #f7fafc;
        }

        .foto-card img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 3px;
            border: 1px solid #e2e8f0;
        }

        .foto-card .foto-placeholder {
            height: 150px;
            background: #edf2f7;
            border: 1.5px dashed #cbd5e0;
            border-radius: 3px;
            color: #a0aec0;
            font-size: 7.5pt;
            text-align: center;
            padding-top: 35px;
        }

        .foto-label {
            font-size: 8pt;
            font-weight: bold;
            color: #4a5568;
            margin-top: 5px;
        }

        .footer {
            background: #f7fafc;
            padding: 8px 24px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 7pt;
            color: #a0aec0;
        }

        .text-muted {
            color: #a0aec0;
            font-style: italic;
        }

        .text-bold {
            font-weight: bold;
        }

        .mt-2 {
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <div class="header-title">SISURO</div>
                    <div class="header-sub">Sistem Informasi Sumber Daya Manusia</div>
                </td>
                <td class="header-meta">
                    <div class="header-badge">DATA PEKERJA</div>
                    <div>Dicetak: <?= date('d/m/Y H:i'); ?> WIB</div>
                    <div>No. ID: <?= esc($row_pekerja['id_pekerja']); ?></div>
                </td>
            </tr>
        </table>
    </div>
    <div class="accent-bar"></div>

    <div class="profile-section">
        <table class="profile-table">
            <tr>
                <td class="profile-foto">
                    <?php if (!empty($foto_base64['foto_ktp'])): ?>
                        <img src="<?= $foto_base64['foto_ktp']; ?>" alt="Foto KTP">
                    <?php else: ?>
                        <div class="profile-foto-placeholder">
                            Foto<br>tidak ada
                        </div>
                    <?php endif; ?>
                    <div style="font-size:7pt; color:#a0aec0; text-align:center; margin-top:3px;">Foto KTP</div>
                </td>
                <td style="vertical-align: top;">
                    <div class="profile-name"><?= esc($row_pekerja['nama']); ?></div>
                    <div class="profile-badge-wrap">
                        <?php if (!empty($row_pekerja['nama_status'])): ?>
                            <span class="badge badge-blue"><?= esc($row_pekerja['nama_status']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($row_pekerja['nama_jenis_tenaga_ahli'])): ?>
                            <span class="badge badge-green"><?= esc($row_pekerja['nama_jenis_tenaga_ahli']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($row_pekerja['nama_pendidikan_akhir'])): ?>
                            <span class="badge badge-gray"><?= esc($row_pekerja['nama_pendidikan_akhir']); ?></span>
                        <?php endif; ?>
                    </div>

                    <table class="quick-info">
                        <tr>
                            <td class="label">NIK / Paspor</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['nik_paspor']) ? esc($row_pekerja['nik_paspor']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="label">NPWP</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['npwp']) ? esc($row_pekerja['npwp']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['email']) ? esc($row_pekerja['email']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Telepon</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['telepon']) ? esc($row_pekerja['telepon']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kewarganegaraan</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['negara_kewarganegaraan']) ? esc($row_pekerja['negara_kewarganegaraan']) : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                        <tr>
                            <td class="label">Pengalaman Kerja</td>
                            <td class="sep">:</td>
                            <td><?= !empty($row_pekerja['lama_pengalaman_kerja_tahun']) ? esc($row_pekerja['lama_pengalaman_kerja_tahun']) . ' Tahun' : '<span class="text-muted">-</span>'; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Data Pribadi & Domisili</div>
        <table class="two-col">
            <tr>
                <td class="col-left">
                    <table class="data-table">
                        <tr>
                            <td class="td-label">Jenis Kelamin</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['jenis_kelamin'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">Tanggal Lahir</td>
                            <td class="td-sep">:</td>
                            <td class="td-value">
                                <?= !empty($row_pekerja['tanggal_lahir'])
                                    ? date('d F Y', strtotime($row_pekerja['tanggal_lahir']))
                                    : '-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">Negara Tempat Lahir</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['negara_tempat_lahir'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">Kabupaten Tempat Lahir</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['kabupaten_tempat_lahir'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">No. BPJS Kesehatan</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['no_bpjs_kesehatan'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">No. BPJS Tenagakerjaan</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['no_bpjs_ketenagakerjaan'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">Website</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['website'] ?? '-'); ?></td>
                        </tr>
                    </table>
                </td>

                <td class="col-right">
                    <table class="data-table">
                        <tr>
                            <td class="td-label">Provinsi Domisili</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['provinsi_domisili'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">Kabupaten Domisili</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['kabupaten_domisili'] ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="td-label">Alamat</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= !empty($row_pekerja['alamat']) ? strip_tags($row_pekerja['alamat']) : '-'; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Kemampuan Bahasa & Keahlian</div>
        <table class="two-col">
            <tr>
                <td class="col-left">
                    <?php
                    $bahasaList = [
                        'tingkat_bahasa_indonesia' => 'Bahasa Indonesia',
                        'tingkat_bahasa_inggris' => 'Bahasa Inggris',
                        'tingkat_bahasa_setempat' => 'Bahasa Setempat',
                    ];
                    $barClass = [
                        'Baik' => 'lang-bar-baik',
                        'Sedang' => 'lang-bar-sedang',
                        'Buruk' => 'lang-bar-buruk',
                    ];
                    ?>
                    <table class="lang-table">
                        <?php foreach ($bahasaList as $field => $langLabel): ?>
                            <?php $level = $row_pekerja[$field] ?? '-'; ?>
                            <tr>
                                <td class="lang-label"><?= $langLabel; ?></td>
                                <td>
                                    <div class="lang-bar-wrap">
                                        <div class="lang-bar <?= $barClass[$level] ?? ''; ?>"></div>
                                    </div>
                                </td>
                                <td class="lang-text"><?= $level; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
                <td class="col-right">
                    <table class="data-table">
                        <tr>
                            <td class="td-label">Profesi / Keahlian</td>
                            <td class="td-sep">:</td>
                            <td class="td-value"><?= esc($row_pekerja['profesi_keahlian'] ?? '-'); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Riwayat Pendidikan</div>
        <table class="data-table">
            <tr>
                <td class="td-label">Pendidikan Akhir</td>
                <td class="td-sep">:</td>
                <td class="td-value"><?= esc($row_pekerja['nama_pendidikan_akhir'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td class="td-label">Pendidikan Formal</td>
                <td class="td-sep">:</td>
                <td class="td-value"><?= !empty($row_pekerja['pendidikan_formal']) ? strip_tags($row_pekerja['pendidikan_formal']) : '-'; ?></td>
            </tr>
            <tr>
                <td class="td-label">Pendidikan Non Formal</td>
                <td class="td-sep">:</td>
                <td class="td-value"><?= !empty($row_pekerja['pendidikan_non_formal']) ? strip_tags($row_pekerja['pendidikan_non_formal']) : '-'; ?></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Dokumen Foto</div>
        <table class="foto-table">
            <tr>
                <?php
                $fotoRow1 = [
                    'foto_ktp' => 'Foto KTP',
                    'foto_ijazah' => 'Foto Ijazah',
                ];
                foreach ($fotoRow1 as $field => $label): ?>
                    <td>
                        <div class="foto-card">
                            <?php if (!empty($foto_base64[$field])): ?>
                                <img src="<?= $foto_base64[$field]; ?>" alt="<?= $label; ?>">
                            <?php else: ?>
                                <div class="foto-placeholder">Belum ada foto</div>
                            <?php endif; ?>
                            <div class="foto-label"><?= $label; ?></div>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>

            <tr>
                <?php
                $fotoRow2 = [
                    'foto_transkrip_nilai' => 'Foto Transkrip Nilai',
                    'foto_npwp' => 'Foto NPWP',
                ];
                foreach ($fotoRow2 as $field => $label): ?>
                    <td>
                        <div class="foto-card">
                            <?php if (!empty($foto_base64[$field])): ?>
                                <img src="<?= $foto_base64[$field]; ?>" alt="<?= $label; ?>">
                            <?php else: ?>
                                <div class="foto-placeholder">Belum ada foto</div>
                            <?php endif; ?>
                            <div class="foto-label"><?= $label; ?></div>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>

            <tr>
                <?php
                $fotoRow3 = [
                    'foto_sertifikasi' => 'Foto Sertifikasi',
                    'foto_nilai_sertifikasi' => 'Foto Nilai Sertifikasi',
                ];
                foreach ($fotoRow3 as $field => $label): ?>
                    <td>
                        <div class="foto-card">
                            <?php if (!empty($foto_base64[$field])): ?>
                                <img src="<?= $foto_base64[$field]; ?>" alt="<?= $label; ?>">
                            <?php else: ?>
                                <div class="foto-placeholder">Belum ada foto</div>
                            <?php endif; ?>
                            <div class="foto-label"><?= $label; ?></div>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dokumen ini dicetak secara otomatis oleh Sistem SISURO &nbsp;|&nbsp;
        <?= date('d F Y H:i'); ?> WIB &nbsp;|&nbsp;
        Dokumen ini bersifat resmi dan rahasia
    </div>

</body>

</html>