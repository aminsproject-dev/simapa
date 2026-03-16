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
            padding: 0px;
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

    <div id="element" style="font-size: 13px;">

        <?php
        $a = $row_isiSurat->total_all;
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

        <?php

        $b = $row_isiSurat->hari_pekerjaan;
        function terbaca($x)
        {
            $ambil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

            if ($x < 12) return " " . $ambil[$x];
            elseif ($x < 20) return terbaca($x - 10) . " Belas";
            elseif ($x < 100) return terbaca($x / 10) . " Puluh" . terbaca($x % 10);
            elseif ($x < 200) return " Seratus" . terbaca($x - 100);
            elseif ($x < 1000) return terbaca($x / 100) . " Ratus" . terbaca($x % 100);
            elseif ($x < 2000) return " Seribu" . terbaca($x - 1000);
            elseif ($x < 1000000) return terbaca($x / 1000) . " Ribu" . terbaca($x % 1000);
            elseif ($x < 1000000000) return terbaca($x / 1000000) . " Juta" . terbaca($x % 1000000);
        }
        ?>

        <page_header>
            <img src="<?php echo FCPATH . 'assets/bo/images/kop_surat_atas.jpg' ?>" alt="Snow" style="width:105%; margin-left: -36px; margin-top: -21px;">
        </page_header>
        <page_footer>
            <div class="container">
                <i class="top-left" style="color:black; margin-top: 70px; margin-left: -35px;">*Note : <?php echo $row_isiSurat->noted; ?> </i>
                <img class="bottom-left" src="<?php echo FCPATH . 'assets/bo/images/kop_surat_bawah_baru.jpg'; ?>" style="width:102%; margin-left: -51px;">
                <div class="bottom-right"><img class="qrgen" style="margin-right: -46px;  margin-bottom: -61px;" height="65" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
            </div>


            <div class="bottom-right" style="color:white; margin-right: 165px;  margin-bottom: 22px;"><?php echo $row_isiSurat->qrgen; ?></div>


        </page_footer>
        <div style="margin-top: 70px;"></div>

        <div class="pagesetup">

            <div class="card-body" style="margin-left: -3px;">
                <table>
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
                <br>
                <table style="font-size: 13px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Kepala Dinas / Pejabat Pengadaan</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_client; ?></td>
                    </tr>
                    <tr>
                        <td>Di</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->kota_client; ?></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br>
                            Sehubungan dengan pekerjaan <?php echo $row_isiSurat->nama_pekerjaan; ?>, dengan ini kami mengajukan penawaran untuk pekerjaan tersebut, Tahun Anggaran <?php echo $row_isiSurat->tahun_anggaran; ?>, dengan total penawaran biaya sebesar : </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="pagesetup">
            <br>
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td style="text-align: justify; font-size: 14px;"><b><i>Rp. <?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?> (<?php echo terbilang($a) . " Rupiah"; ?> )</i></b></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="pagesetup">
            <br>
            <table style="width: 100%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Penawaran ini sudah memperhatikan ketentuan dan kaidah kaidah aturan yang berlaku.</td>
                </tr>
            </table>
            <br>
            <table style="width: 100%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Kami akan melaksanakan pekerjaan tersebut dengan jangka waktu pelaksanaan pekerjaan selama <?php echo $row_isiSurat->hari_pekerjaan; ?> (<?php echo terbaca($b); ?>) hari kalender.
                        Surat Penawaran beserta lampiranya kami sampaikan sebanyak 1 (satu) rangkap dokumen asli.</td>
                </tr>
            </table>
            <br>
            <table style="width: 100%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Sebagai penunjang kelengkapan surat penawaran pekerjaan ini, maka kami lampirkan data <b>Rencana Anggaran Biaya (RAB)</b> serta data data pendukung yang dapat melengkapi penawaran kami yang tidak terpisahkan dari surat ini.</td>
                </tr>
            </table>
            <br>
            <table style="width: 100%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Dengan disampaikannya Surat Penawaran Pekerjaan ini, maka kami menyatakan sanggup dan akan tunduk pada semua ketentuan yang berlaku.</td>
                </tr>
            </table>
            <br>
            <table style="width: 100%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Demikian surat penawaran pekerjaan ini kami sampaikan, besar harapan kami Bapak/Ibu berminat dengan harga yang kami tawarkan. Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</td>
                </tr>
            </table>
            <br>
            <br>
            <table class="center" border="0" style="  margin-left: 380px;">
                <tr>
                    <td width="380">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?></td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(7)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>


            </table>
            <div class="container">

                <div class="bottom-right" style="color:black; font-size: 13px; margin-right: -18px;">
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
                            ?>" alt="Snow" style="margin-left: 440px;" height="93">
            </div>


        </div>

    </div>
    <div class="html2pdf_page-break"></div>

    <div id="element" style="font-size: 13px;">

        <page_header>
            <img src="<?php echo FCPATH . 'assets/bo/images/kop_surat_atas.jpg' ?>" alt="Snow" style="width:105%; margin-left: -36px; margin-top: -21px;">
        </page_header>
        <page_footer>
            <div class="container">
                <i class="top-left" style="color:black; margin-top: 70px; margin-left: -35px;">*Note : <?php echo $row_isiSurat->noted; ?> </i>
                <img class="bottom-left" src="<?php echo FCPATH . 'assets/bo/images/kop_surat_bawah_baru.jpg'; ?>" style="width:102%; margin-left: -51px;">
                <div class="bottom-right"><img class="qrgen" style="margin-right: -46px;  margin-bottom: -61px;" height="65" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
            </div>


            <div class="bottom-right" style="color:white; margin-right: 165px;  margin-bottom: 22px;"><?php echo $row_isiSurat->qrgen; ?></div>

        </page_footer>

        <div style="margin-top: 70px;"></div>

        <div class="pagesetup">
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td><?php echo $row_isiSurat->srphp; ?></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>1 (satu) Lembar</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>Surat Rincian Penawaran Harga Pekerjaan</td>
                    </tr>
                </table>
                <br>
                <table style="font-size: 13px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Kepala Dinas / Pejabat Pengadaan</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_client; ?></td>
                    </tr>
                    <tr>
                        <td>Di</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->kota_client; ?></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br> Sehubungan dengan kegiatan pekerjaan <?php echo $row_isiSurat->nama_pekerjaan; ?>, dengan ini kami mengajukan penawaran untuk pekerjaan tersebut, Tahun Anggaran <?php echo $row_isiSurat->tahun_anggaran; ?>, dengan Rencana Anggaran Biaya (RAB) sebagai berikut :</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table id="customers" style="width: 100%;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 25px;"><b>No</b></th>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 325px;"><b>Nama Barang / Jasa</b></th>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 50px;"><b>Jumlah</b></th>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 50px;"><b>Satuan</b></th>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 100px;"><b>Harga</b></th>
                    <th style="vertical-align: middle; text-align: center; color: white; width: 100px;"><b>Total Harga</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_1; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_1; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format(ltrim($row_isiSurat->harga_1, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format(ltrim($row_isiSurat->total_harga_1, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_2; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_2; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_2, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_2, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_3; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_3; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_3, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_3, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_4; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_4; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_4, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_4, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_5; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_5; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_5, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_5, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_6; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_6; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_6, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_6, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_7; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_7; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_7, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_7, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_8; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_8; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_8; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_8; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_8, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_8, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_9; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_9; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_9; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_9; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_9, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_9, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_10; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 325px;"><?php echo $row_isiSurat->nama_barang_10; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_10; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_10; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->harga_10, '0'), 0, '', '.') ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 100px;">&nbsp;<?php echo number_format((float)ltrim($row_isiSurat->total_harga_10, '0'), 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"><b>Total Include Tax/PPN 11%</b></td>
                    <td style="text-align: right;"><b>&nbsp;<?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?></b></td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;"><b><i><?php echo terbilang($a) . " Rupiah"; ?></i></b></td>
                </tr>

            </tbody>
        </table>


        <div class="pagesetup">
            <br>
            <table style="margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Demikian surat penawaran harga pekerjaan ini kami sampaikan, besar harapan kami Bapak/Ibu berminat dengan harga yang kami tawarkan. Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</td>
                </tr>
            </table>
            <br>
            <table class="center" border="0" style="  margin-left: 380px;">
                <tr>
                    <td width="380">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?></td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(7)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>
            </table>
            <div class="container">

                <div class="bottom-right2" style="color:black; font-size: 13px;">
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
                            ?>" alt="Snow" style="margin-left: 440px;" height="93">
            </div>


        </div>


    </div>

</body>



</html>