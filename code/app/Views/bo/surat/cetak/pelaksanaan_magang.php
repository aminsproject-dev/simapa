<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>CETAK SURAT</title>

    <style type="text/css">
        .pagesetup {
            padding: 0.5cm 0.5cm 0.5cm 0.5cm;
        }

        .hed {
            font-size: 10px;
            font-weight: bold;
            line-height: 13px;
        }

        .text7 {
            font-size: 7px;
            text-align: center;
            padding: 1px;
        }

        .Content {
            font-size: 10px;
            text-align: left;
            padding: 3px;
        }

        .namaContent {
            font-size: 9px;
            text-align: left;
            padding: 3px;
        }

        p {
            font-size: 14px;
            margin-left: 0px;
            color: black;
        }

        .kop1 {
            font-size: 22px;
            margin: 2px;
            padding: 0px;
            font-weight: bold;
        }

        .kop2 {
            font-weight: 800;
            font-size: 24px;
            margin: 2px;
            padding: 0px;
            font-weight: bold;
        }

        .kop3 {
            font-size: 12px;
            margin: 0px;
            padding: 0px;
        }

        .kop4 {
            font-size: 12px;
            margin: 0px;
            padding: 0px;
        }

        .kop5 {
            font-size: 12px;
            margin: 0px;
            padding: 0px;
        }

        .created {
            font-size: 8px;
            margin: 0px;
            padding: 0px;
        }

        .note {
            font-size: 10px;
            margin: 0px;
            padding: 100px;
        }

        .qrgen {
            font-size: 10px;
            margin: 0px;
            padding: 0px;
        }

        .qrcode {
            margin: 0px;
            padding: 0px;
        }

        .qrcode1 {
            margin: 0px;
            padding: 0px;
        }

        .center {
            text-align: center;

        }

        .judul {
            font-size: 15px;
            margin: 1px;
            padding: 0px;
            font-weight: bold;
        }

        .nomor {
            font-size: 13px;
            margin: 1px;
            padding: 0px;
        }

        .isi {
            text-align: justify;
            text-indent: 0px;
            line-height: 1.5;
            font-size: 13px;
        }

        .tab4 {
            tab-size: 8;
        }
    </style>

    <style>
        .fulljustify {
            text-align: justify;
        }

        .fulljustify:after {
            content: "";
            display: inline-block;
            width: 100%;
        }

        #tagline {
            height: 80px;
            overflow: hidden;
            line-height: 80px;
            /* vert-center */
        }
    </style>

    <style>
        .container {
            position: relative;
            color: white;
            font-size: 10px;
        }

        .bottom-left {
            position: absolute;
            bottom: 8px;
            left: 16px;
        }

        .top-left {
            position: absolute;
            top: 5px;
            left: 15px;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .bottom-right {
            position: absolute;
            bottom: -11px;
            right: 95px;
        }

        .bottom-right2 {
            position: absolute;
            bottom: -11px;
            right: 95px;
        }

        .centered {
            position: absolute;
            top: 47%;
            left: 19%;
            transform: translate(-50%, -50%);
        }

        .kotak {
            perbatasan: 1px hijau solid;
        }
    </style>

    <style>
        #customers {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        #customers td,
        #customers th {
            border: 1px solid #000000;
            padding: 2px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #000000;
        }

        #customers th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #233B83;
            color: black;
        }
    </style>

    <style>
        #invoice {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        #invoice td,
        #invoice th {
            border: 0px solid #000000;
            padding: 2px;
        }

        #invoice tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #invoice tr:hover {
            background-color: #000000;
        }

        #invoice th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #233B83;
            color: white;
        }
    </style>
    <style>
        #invoicetab {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        #invoicetab td,
        #invoicetab th {
            border: 2px solid #145FA4;
            padding: 2px;
        }

        #invoicetab tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #invoicetab tr:hover {
            background-color: #000000;
        }

        #invoicetab th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #DCE6F1;
            color: black;
        }
    </style>

</head>

<body>

    <?php $row_isiSurat = json_decode($row_surat['isi_surat']); ?>
    <?php $row_ttd = json_decode($row_surat['tanda_tangan']); ?>

    <page_header>
        <img src="<?php echo FCPATH . 'assets/bo/images/kop_surat_atas.jpg' ?>" alt="Snow" style="width:105%; margin-left: -36px; margin-top: -21px;">
    </page_header>
    <div id="element" style="font-size: 13px;">

        <?php
        $a = $row_isiSurat->jumlah_siswa;
        function terbilang($x)
        {
            $ambil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

            if ($x < 12) return " " . $ambil[$x];
            elseif ($x < 20) return terbilang($x - 10) . " Belas";
            elseif ($x < 100) return terbilang($x / 10) . " Puluh" . terbilang($x % 10);
            elseif ($x < 200) return " Seratus" . terbilang($x - 100);
            elseif ($x < 1000) return terbilang($x / 100) . " Ratus" . terbilang($x % 100);
            elseif ($x < 2000) return " Seribu" . terbilang($x - 1000);
            elseif ($x < 1000000) return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
            elseif ($x < 1000000000) return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);
        }
        ?>

        <div style="margin-top: 70px;"></div>

        <div class="pagesetup">
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td>Nomor</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td><?php echo $row_surat['no_surat']; ?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td>1 (satu) Lembar</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td><?php echo ($row_surat['nama_surat']); ?></td>
                </tr>
            </table>
            <div style="width: 90%; margin-left: 0px;">

                <p class="isi">
                <table style="width: 90%; margin-left: -3px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Bapak/Ibu Pimpinan <?php echo $row_isiSurat->jurusan; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_kampus; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->alamat_kampus; ?></td>
                    </tr>
                    <tr>
                        <td>Ditempat</td>
                    </tr>
                </table>
                </p>
                <p class="isi">
                <table style="width: 90%; margin-left: -3px;">

                    <tr>
                        <td>Dengan hormat,</td>
                    </tr>
                    <tr>
                        <td>Sehubungan dengan Surat Permohonan Pelaksanaan Magang / PKL, Nomor : <?php echo $row_isiSurat->nomor_surat_balas; ?>, yang diajukan kepada kami oleh pihak <?php echo $row_isiSurat->nama_kampus; ?> - <?php echo $row_isiSurat->jurusan; ?>, dengan atas nama siswa/mahasiswa yang telah terlampir tersebut. Dengan data sebagai berikut:</td>
                    </tr>

                </table>
                </p>
                <table style="width: 90%; margin-left: 70px;">
                    <tr>
                        <td>Jumlah Siswa/Mahasiswa</td>
                        <td>:</td>
                        <td><?php echo $row_isiSurat->jumlah_siswa; ?> (<?php echo terbilang($a); ?> )</td>
                    </tr>

                    <tr>
                        <td width="160">Jadwal Pelaksanaan</td>
                        <td>:</td>
                        <td><?php setlocale(LC_ALL, 'IND');
                            echo strftime('%d %B %Y', strtotime($row_isiSurat->mulai_masuk)); ?> s/d <?php setlocale(LC_ALL, 'IND');
                                                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->akhir_masuk)); ?></td>
                    </tr>

                    <tr>
                        <td>Fakultas/Prodi</td>
                        <td>:</td>
                        <td><?php echo $row_isiSurat->jurusan; ?></td>
                    </tr>
                </table>
                <br>
                <table id="customers" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 30px;"><b>No</b></th>
                            <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 480px;"><b>Nama</b></th>
                            <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 160px;"><b>NIS/NIM</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_1; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_1; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_1; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_2; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_2; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_2; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_3; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_3; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_3; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_4; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_4; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_4; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_5; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_5; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_5; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_6; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_6; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_6; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_7; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 480px;"><?php echo $row_isiSurat->nama_7; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 160px;">&nbsp;<?php echo $row_isiSurat->nis_7; ?></td>
                        </tr>
                    </tbody>
                </table>
                <p class="isi" style="width: 90%;">Dengan ini kami memberikan ijin kepada siswa/mahasiswa tersebut diatas untuk melakukan kegiatan magang/pkl dan kegiatan kegiatan praktik lain yang berhubungan dengan keilmuan yang diampu selama di bangku pendidikan.</p>
                <p class="isi" style="width: 90%;">Demikian Surat Balasan ini dibuat untuk dipergunakan sebagaimana mestinya. Semoga kerjasama ini dapat berjalan dengan baik, kami ucapkan terima kasih.</p>
                <br>
                <br>
                <br>
                <table class="center" border="0" style="  margin-left: 325px;">
                    <tr>
                        <td width="380">Madiun, <?php setlocale(LC_ALL, 'IND');
                                                echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                    <?php
                    if ($row_ttd->wakilkan == 1) ?>
                </table>
                <div class="container">

                    <div class="bottom-right2" style="color:black; font-size: 13px; margin-right: -32px;">
                        <br><strong><u><?php echo $row_ttd->nama; ?></u></strong><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?>
                    </div>

                    <img src="<?php
                                if ($row_isiSurat->img_ttd == 1) {
                                    echo FCPATH . 'assets/bo/images/ttd_stampel_direktur.png';
                                } else {
                                    echo FCPATH . 'assets/bo/images/ttd_kosongan.png';
                                }
                                ?>" alt="Snow" style="margin-left: 385px;" height="93">
                </div>
            </div>
        </div>
    </div>
    <page_footer>
        <div class="container">
            <i class="top-left" style="color:black; margin-top: 85px;">*Note : <?php echo $row_isiSurat->noted; ?> </i>
            <img class="bottom-left" src="<?php echo FCPATH . 'assets/bo/images/kop_surat_bawah_baru.jpg'; ?>" style="width:102%; margin-left: -50px;">
            <div class="bottom-right"><img class="qrgen" style="margin-right: -46px;  margin-bottom: -61px;" height="65" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
        </div>
        <div class="bottom-right" style="color:white; margin-right: 165px;  margin-bottom: 22px;"><?php echo $row_isiSurat->qrgen; ?></div>
    </page_footer>

</body>



</html>