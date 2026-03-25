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
            top: 8px;
            left: 16px;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .bottom-right {
            position: absolute;
            bottom: 22px;
            right: 33px;
        }

        .centered {
            position: absolute;
            top: 47%;
            left: 23%;
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
            background-color: #60A5BF;
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
            background-color: #60A5BF;
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

    <!-- SURAT PENGIRIMAN BARANG -->

    <div id="element" style="font-size: 12px;">

        <page_header>
            <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;" />
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 650px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 639px; margin-top: -98px;" height="51" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="centered" style="margin-left: 497px; margin-top: -33px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>
        </page_header>
        <div style="margin-top: 85px;"></div>


        <div class="pagesetup">
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <?php
                        $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                        $bln      = $array_bln[date('n', strtotime((isset($row_isiSurat->tgl_spb) ? $row_isiSurat->tgl_spb : '')))];
                        ?>
                        <td style="font-size: 13px;"><?php echo ($row_surat['no_surat']); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                                echo strftime('%Y', strtotime($row_isiSurat->tgl_sphp)); ?></td>
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
                <table style="font-size: 12px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Pejabat Pengguna Anggaran / PPK</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->satuan_kerja; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Di <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?> </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br> Sehubungan dengan kegiatan pekerjaan menggunakan proses belanja dengan metode pembelian E-Catalogue/ EPURCHASING <i style="color: blue;">(https://katalog.inaproc.id/)</i>, dengan Nomor Pesanan : <?php echo $row_isiSurat->no_pemesanan; ?>, Tanggal Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                                                                                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_pemesanan)); ?>, sesuai dengan pekerjaan yang sudah dikerjakan serta dikirim : </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table id="customers" style="width: 100%;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: center; width: 25px;"><b>No</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 350px;"><b>Nama Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Jumlah</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Satuan</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 90px;"><b>Paraf Pengirim Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 90px;"><b>Paraf Penerima Barang</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_1; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_1; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_2; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_2; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_3; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_3; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_4; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_4; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_5; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_5; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_6; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_6; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 25px;"><?php echo $row_isiSurat->no_7; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_7; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="pagesetup">

            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td>Pesanan telah dikirim pada tanggal <?php setlocale(LC_ALL, 'IND');
                                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_pengiriman)); ?>, dengan identitas pengiriman sebagai berikut :</td>
                    </tr>
                </table>
            </div>
            <table style="width: 74%; margin-left: 20px;">
                <tr>
                    <td>Vendor Pengirim</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->vendor_pengiriman; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        No. Resi : <?php echo $row_isiSurat->no_resi; ?>
                    </td>
                </tr>
                <tr>
                    <td>No. Transaksi</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->no_transaksi; ?></td>
                </tr>
                <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->nama_penerima; ?></td>
                </tr>
                <tr>
                    <td>Alamat Pengiriman </td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;">
                        <?php echo $row_isiSurat->alamat_pengiriman; ?> - <?php echo $row_isiSurat->satuan_kerja; ?> - <?php echo $row_isiSurat->nama_instansi; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Telp Penerima</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->notlp_penerima; ?></td>
                </tr>
            </table>
            <br>
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;">Bersama ini pula kami lampirkan dokumen Surat Permohonan Pembayaran dan Faktur Pajak. Demikian surat ini kami sampaikan, atas persetujuan dan kerjasamanya kami ucapkan terimakasih.</td>
                </tr>
            </table>
            <br>
            <br>
            <table class="center" border="0" style="  margin-left: 20px;">
                <tr>
                    <td width="160"></td>
                    <td width="80"></td>
                    <td width="380">Madiun, <?php setlocale(LC_TIME, 'id_ID');
                                            echo strftime('%d %B %Y', strtotime((isset($row_isiSurat->tgl_spb) ? $row_isiSurat->tgl_spb : ''))); ?></td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                    <td></td>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>

                <tr>
                    <td><br><br><br><br></td>
                </tr>
                <tr>
                    <td><strong><u>Alfian Efendi</u></strong></td>
                    <td></td>
                    <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                </tr>
                <tr>

                    <td>Pelaksana Lapangan</td>
                    <td></td>
                    <td><?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                </tr>
            </table>
            <br>

            <div align="center" style="  margin-left: -60px;">
                <p class="kop3"> Yang Menerima Barang Atau Jasa,
                    <br><?php echo $row_isiSurat->satuan_kerja; ?>
                    <br><?php echo $row_isiSurat->nama_instansi; ?>
                    <br>Pejabat Pembuat Komitmen
                </p>
                <br><br><br><br><br>
                <p class="kop3"><strong><u><?php echo $row_isiSurat->nama_ppk; ?></u></strong></p>

            </div>
        </div>


    </div>
    <div class="html2pdf_page-break"></div>


    <!-- SURAT PENYERAHAN HASIL PEKERJAAN -->
    <div id="element" style="font-size: 12px;">

        <page_header>
            <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;" />
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 650px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 639px; margin-top: -98px;" height="51" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="centered" style="margin-left: 497px; margin-top: -33px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>
        </page_header>
        <div style="margin-top: 85px;"></div>

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

        <div class="pagesetup">
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <?php
                        $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                        $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_sphp))];
                        ?>
                        <td style="font-size: 13px;"><?php echo ($row_isiSurat->sphp); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                                echo strftime('%Y', strtotime($row_isiSurat->tgl_sphp)); ?></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>1 (satu) Lembar</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>Surat Penyerahaan Hasil Pekerjaan</td>
                    </tr>
                </table>
                <br>
                <table style="font-size: 12px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Pejabat Pengguna Anggaran / PPK</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->satuan_kerja; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Di <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?> </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br> Sehubungan dengan kegiatan pekerjaan menggunakan proses belanja dengan metode pembelian E-Catalogue/ EPURCHASING <i style="color: blue;">(https://katalog.inaproc.id/)</i>, dengan Nomor Pesanan : <?php echo $row_isiSurat->no_pemesanan; ?>, Tanggal Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                                                                                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_pemesanan)); ?>, sesuai dengan pekerjaan yang sudah dikerjakan serta dikirim : </td>
                    </tr>
                </table>
                <table style="width: 75%; margin-left: 20px;">
                    <tr>
                        <td>Nomor Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php echo $row_isiSurat->no_surat_pemesanan; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php setlocale(LC_ALL, 'IND');
                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Kontrak </td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;">
                            Rp. <?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?>
                            <i>(<?php echo terbilang($a) . " Rupiah"; ?>)</i>
                        </td>
                    </tr>
                    <tr>
                        <td>Pelaksana</td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;"><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <table id="customers" style="width: 100%;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: center; width: 25px;"><b>No</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 350px;"><b>Nama Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Jumlah</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Satuan</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 90px;"><b>Paraf Pengirim Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 90px;"><b>Paraf Penerima Barang</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_1; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_1; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_2; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_2; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_3; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_3; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_4; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_4; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_5; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_5; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_6; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_6; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_7; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 350px;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->jumlah_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_7; ?></td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                    <td style="vertical-align: middle; text-align: right; width: 90px;">&nbsp;</td>
                </tr>
            </tbody>
        </table>


        <div class="pagesetup">
            <br>
            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Demikian penyerahan dan pelaksanaan pekerjaan ini kami sampaikan, atas persetujuan dan kerjasamanya kami ucapkan terimakasih.</td>
                    </tr>
                </table>
            </div>

            <br>
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;"></td>
                </tr>
            </table>
            <br>
            <table class="center" border="0" style="  margin-left: 20px;">
                <tr>
                    <td width="160"></td>
                    <td width="80"></td>
                    <td width="380">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_sphp)); ?></td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                    <td></td>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>

                <tr>
                    <td><br><br><br><br></td>
                </tr>
                <tr>
                    <td><strong><u>Alfian Efendi</u></strong></td>
                    <td></td>
                    <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                </tr>
                <tr>

                    <td>Pelaksana Lapangan</td>
                    <td></td>
                    <td><?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                </tr>
            </table>
            <br>
            <div align="center" style="  margin-left: -60px;">
                <p class="kop3"> Yang Menerima Barang Atau Jasa,
                    <br><?php echo $row_isiSurat->satuan_kerja; ?>
                    <br><?php echo $row_isiSurat->nama_instansi; ?>
                    <br>Pejabat Pembuat Komitmen
                </p>
                <br><br><br><br><br>
                <p class="kop3"><strong><u><?php echo $row_isiSurat->nama_ppk; ?></u></strong></p>

            </div>
        </div>

    </div>
    <div class="html2pdf_page-break"></div>

    <!-- SERTIFIKAT GARANSI -->

    <div id="element" style="font-size: 12px;">
        <page_header>
            <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;" />
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 650px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 639px; margin-top: -98px;" height="51" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="centered" style="margin-left: 497px; margin-top: -33px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>
        </page_header>
        <div style="margin-top: 85px;"></div>

        <div class="pagesetup">
            <table class="center" border="0" style="margin-left: 252px;">
                <tr>
                    <td style="text-align: center;" style="font-size: 13px;"><strong><u>SERTIFIKAT GARANSI</u></strong></td>
                </tr>
                <tr>
                    <?php

                    $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

                    $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_sg))];

                    ?>
                    <td style="font-size: 13px;"><?php echo ($row_isiSurat->sg); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                        echo strftime('%Y', strtotime($row_isiSurat->tgl_sg)); ?></td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>Yang bertanda tangan di bawah ini :</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td>Munif Amin Romadhon</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td>Direktur</td>
                </tr>
                <tr>
                    <td>Bertindak untuk atas nama</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td>CV. AMINS PROJECT TEKNOLOGI INDONESIA</td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>Dengan ini menyatakan bahwa kami memberikan Sertifikat Garansi atas barang / jasa yang kami serahkan untuk pekerjaan <?php  //echo $row_isiSurat->nama_paket_pekerjaan; 
                                                                                                                                                ?>, sesuai dengan Nomor Surat Pesanan : <?php echo $row_isiSurat->no_surat_pemesanan; ?> tanggal Surat Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                                    echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>, yang dilaksanankan oleh <?php echo $model->getSetting(9)->content; ?> :
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <table id="customers" style="width: 100%;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: center; width: 25px;"><b>No</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 553px;"><b>Nama Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Jumlah</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Satuan</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_1; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_1; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_2; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_2; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_3; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_3; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_4; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_4; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_5; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_5; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_6; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_6; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_7; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_7; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="pagesetup">

            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td>Pesanan telah dikirim pada tanggal <?php setlocale(LC_ALL, 'IND');
                                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_pengiriman)); ?>, Adapun ketentuan garansi sebagai berikut :</td>
                    </tr>
                </table>
            </div>
            <table style="width: 100%;">
                <tr>


                    <td style="width: 100%; text-align: left; font-size: 12px;">
                        <?php if (isset($row_isiSurat->kategori_barang)) { ?>
                            <?php $row_garansi = $model->getSelectedData('tb_sertifikat_garansi', ['id_sertifikat_garansi' => $row_isiSurat->kategori_barang])->getRow(); ?>
                            <?= $row_garansi->isi_sertifikat; ?>
                        <?php } ?>

                    </td>
                </tr>
            </table>

            <br>
            <table class="center" border="0" style="  margin-left: 400px;">
                <tr>
                    <td width="160">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_sg)); ?> </td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>

                <tr>
                    <td><br><br></td>
                </tr>
                <tr>
                    <td style="text-align: left; font-size: 7px; ">mat</td>
                </tr>
                <tr>
                    <td><br><br></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                </tr>
                <tr>
                    <td><?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                </tr>
            </table>
            <br>

        </div>

    </div>

    <div class="html2pdf_page-break"></div>
    <!-- SURAT PERMOHONAN PEMERIKSAAN HASIL PEKERJAAN -->

    <div id="element" style="font-size: 12px;">

        <page_header>
            <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;" />
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 650px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 639px; margin-top: -98px;" height="51" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="centered" style="margin-left: 497px; margin-top: -33px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>
        </page_header>

        <div style="margin-top: 85px;"></div>
        <div class="pagesetup">
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <?php
                        $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                        $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_sppp))];
                        ?>
                        <td style="font-size: 13px;"><?php echo ($row_isiSurat->sppp); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                                echo strftime('%Y', strtotime($row_isiSurat->tgl_sppp)); ?></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>1 (satu) Lembar</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>Surat Permohonan Pemeriksaan Hasil Pekerjaan</td>
                    </tr>
                </table>
                <br>
                <table style="font-size: 12px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Pejabat Pengguna Anggaran / PPK</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->satuan_kerja; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Di <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?> </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br> Sehubungan dengan kegiatan pekerjaan yang menggunakan proses belanja dengan metode pembelian E-Catalogue/ EPURCHASING <i style="color: blue;">(https://katalog.inaproc.id/)</i>, dengan Nomor Surat Pesanan : <?php echo $row_isiSurat->no_surat_pemesanan; ?>, Tanggal Surat Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                                                                                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>, sesuai dengan pekerjaan yang sudah dikerjakan serta dikirim : </td>
                    </tr>
                </table>
                <table style="width: 75%; margin-left: 20px;">
                    <tr>
                        <td>Nomor Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php echo $row_isiSurat->no_surat_pemesanan; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php setlocale(LC_ALL, 'IND');
                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Kontrak </td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;">
                            Rp. <?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?>
                            <i>(<?php echo terbilang($a) . " Rupiah"; ?>)</i>
                        </td>
                    </tr>
                    <tr>
                        <td>Pelaksana</td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;"><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table id="customers" style="width: 100%;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: center; width: 25px;"><b>No</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 553px;"><b>Nama Barang</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Jumlah</b></th>
                    <th style="vertical-align: middle; text-align: center; width: 50px;"><b>Satuan</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_1; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_1; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_1; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_2; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_2; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_2; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_3; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_3; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_3; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_4; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_4; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_4; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_5; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_5; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_5; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_6; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_6; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_6; ?></td>
                </tr>
                <tr>
                    <td class="col-md-1" style="vertical-align: middle; text-align: center; 25px; "><?php echo $row_isiSurat->no_7; ?></td>
                    <td style="vertical-align: middle; text-align: left; width: 553px;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;">&nbsp;<?php echo $row_isiSurat->jumlah_7; ?></td>
                    <td style="vertical-align: middle; text-align: center; width: 50px;"><?php echo $row_isiSurat->satuan_7; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="pagesetup">
            <br>
            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Dengan ini memberitahukan bahwa, Pelaksanaan pekerjaan tersebut di atas sudah mencapai fisik 100% (seratus persen) <b>Mohon untuk dapat diadakan Pemeriksaan dan Penyerahan Pertama Pekerjaan (P.1)</b> untuk pekerjaan tersebut.</td>
                    </tr>
                </table>
            </div>
            <br>
            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Demikian permohonan ini kami sampaikan, atas persetujuan dan kerjasamanya kami ucapkan terimakasih.</td>
                    </tr>
                </table>
            </div>

            <br>
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;"></td>
                </tr>
            </table>
            <br>
            <br>
            <table class="center" border="0" style="  margin-left: 400px;">
                <tr>
                    <td width="160">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_sppp)); ?> </td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>

                <tr>
                    <td><br><br><br></td>
                </tr>
                <tr>
                    <td><br><br><br></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                </tr>
                <tr>
                    <td><?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="html2pdf_page-break"></div>
    <!-- SURAT PERMOHONAN PEMBAYARAN -->

    <div id="element" style="font-size: 12px;">
        <page_header>
            <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;" />
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 650px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 639px; margin-top: -98px;" height="51" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="centered" style="margin-left: 497px; margin-top: -33px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>
        </page_header>

        <div style="margin-top: 85px;"></div>
        <div class="pagesetup">
            <div class="card-body" style="margin-left: -3px;">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <?php
                        $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                        $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_spp))];
                        ?>
                        <td style="font-size: 13px;"><?php echo ($row_isiSurat->spp); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                            echo strftime('%Y', strtotime($row_isiSurat->tgl_spp)); ?></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>1 (satu) Lembar</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                        <td>Surat Permohonan Pembayaran</td>
                    </tr>
                </table>
                <br>
                <table style="font-size: 12px;">
                    <tr>
                        <td>Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td>Pejabat Pengguna Anggaran / PPK</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->satuan_kerja; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_instansi; ?></td>
                    </tr>
                    <tr>
                        <td>Di <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?> </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td style="text-align: justify;">Dengan hormat, <br>
                            Bersama Surat ini kami mengajukan permohonan pembayaran, Sehubungan dengan telah terlaksananya pekerjaan pada <?php echo $row_isiSurat->satuan_kerja; ?> - <?php echo $row_isiSurat->nama_instansi; ?>, yang telah dilaksanankan sesuai dengan :
                        </td>
                    </tr>

                </table>
                <br>
                <table style="width: 75%; margin-left: 20px;">
                    <tr>
                        <td>Nomor Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php echo $row_isiSurat->no_surat_pemesanan; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat Pesanan</td>
                        <td>:</td>
                        <td style="text-align: justify; width: 100%;"><?php setlocale(LC_ALL, 'IND');
                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai Kontrak </td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;">
                            Rp. <?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?>
                            <i>(<?php echo terbilang($a) . " Rupiah"; ?>)</i>
                        </td>
                    </tr>
                    <tr>
                        <td>Pelaksana</td>
                        <td>:</td>
                        <td style="width: 100%; text-align: justify;"><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pagesetup">
            <br>
            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Pada kegiatan pekerjaan yang menggunakan proses belanja dengan metode pembelian E-Catalogue/ EPURCHASING <i style="color: blue;">(https://katalog.inaproc.id/)</i>, dengan ID Paket : <?php echo $row_isiSurat->no_pemesanan; ?>, tanggal paket dibuat : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                                                                                    echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_pemesanan)); ?>.</td>
                    </tr>
                </table>
            </div>
            <br>

            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Mohon pembayaran yang dimaksud di Transfer ke rekening <b>CV. AMINS PROJECT TEKNOLOGI INDONESIA</b> melalui :
                            <br>
                            <b>BANK MANDIRI Cab. Madiun</b>, Nomor Rekening : <b>1710016813191</b> a/n <b>AMINS PROJECT TEKNOLOGI INDONESIA</b> atau
                            <b>BANK JATIM Cab. Madiun</b>, Nomor Rekening : <b>0051048156</b> a/n <b>AMINS PROJECT CV</b>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div style="width: 100%; margin-left: 0px;">
                <table style="width: 100%; margin-left: -3px;">
                    <tr>
                        <td style="text-align: justify;">Demikian permohonan ini kami sampaikan, atas persetujuan dan kerjasamanya kami ucapkan terimakasih.</td>
                    </tr>
                </table>
            </div>

            <br>
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td style="text-align: justify;"></td>
                </tr>
            </table>
            <br>
            <br>
            <table class="center" border="0" style="  margin-left: 400px;">
                <tr>
                    <td width="160">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_spp)); ?> </td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>

                <tr>
                    <td><br><br><br></td>
                </tr>
                <tr>
                    <td><br><br><br></td>
                </tr>
                <tr>
                    <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                </tr>
                <tr>
                    <td><?php $row_ttd->jabatan;
                        echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="html2pdf_page-break"></div>
    <!-- INVOICE -->

    <div id="element" style="font-size: 12px; margin-left: -17px;">
        <div style="background-color: #DCE6F1; border: 3px solid #145FA4;">
            <img width="70" height="70" style="float: left; margin-top: 12px;" src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;  margin-top: 12px;">


                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;">
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 675px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 666px; margin-top: -96px;" height="48" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="bottom-right" style="right: 30px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>

            <div style="margin-top: -33px;"></div>
            <div class="pagesetup" style="background-color: white;">
                <br>
                <div class="card-body">
                    <table class="center" border="0" style="margin-left: 270px;">
                        <tr>
                            <td style="text-align: center;" style="font-size: 18px; color: #145FA4;"><strong><u>INVOICE / TAGIHAN</u></strong></td>
                        </tr>

                        <tr>
                            <?php
                            $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                            $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_inv))];
                            ?>
                            <td style="font-size: 12;"><?php echo ($row_isiSurat->inv); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                                echo strftime('%Y', strtotime($row_isiSurat->tgl_inv)); ?></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table id="invoice" style="width: 100%;">
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>MAILING</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;"><?php echo $model->getSetting(9)->content; ?></td>
                            <td rowspan="3" class="col-md-1" style="text-align: right; width: 13%;"><b>BILL TO</b></td>
                            <td rowspan="3" style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td rowspan="3" style="text-align: left; width: 36%;"><?php echo $row_isiSurat->satuan_kerja; ?> - <?php echo $row_isiSurat->nama_instansi; ?> - <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>NPWP</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;">93.501.450.6-621.000</td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Address</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;"><?php echo $model->getSetting(10)->content; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Phone</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;">(+62) 895-3799-05511</td>
                            <td rowspan="3" class="col-md-1" style="text-align: right; width: 13%;"><b>Address</b></td>
                            <td rowspan="3" style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td rowspan="3" style="text-align: left; width: 36%;"><?php echo $row_isiSurat->alamat_pemesan; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Email</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;" style="color: blue;">aminstech@gmail.com</td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Website</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 35%;" style="color: blue;">www.aminsproject.com</td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"></td>
                            <td style="text-align: left; width: 1%;"></td>
                            <td style="text-align: left; width: 35%;"></td>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Phone</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 36%;"><?php echo $row_isiSurat->notlp_penerima; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"></td>
                            <td style="text-align: left; width: 1%;"></td>
                            <td style="text-align: left; width: 35%;"></td>
                            <!-- <td class="col-md-1" style="text-align: right; width: 13%;"><b>Email</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 36%;" style="color: blue;"><?php
                                                                                            //  echo $row_isiSurat->email_ppk; 
                                                                                            ?></td> -->
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"></td>
                            <td style="text-align: left; width: 1%;"></td>
                            <td style="text-align: left; width: 35%;"></td>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>Note</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 36%;">No. Surat Pesanan : <?php echo $row_isiSurat->no_pemesanan; ?>, Tanggal Surat Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_pemesanan)); ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 13%;"></td>
                            <td style="text-align: left; width: 1%;"></td>
                            <td style="text-align: left; width: 35%;"></td>
                            <td class="col-md-1" style="text-align: right; width: 13%;"><b>NPWP</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 36%;"><?php echo $row_isiSurat->npwp_satuan_kerja; ?></td>
                        </tr>
                    </table>
                    <br>
                    <table id="invoicetab" style="width: 100%;">
                        <tr>
                            <th style="vertical-align: middle; text-align: center; width: 5%;"><b>No</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 53%;"><b>Nama Barang</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;"><b>Jumlah</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;"><b>Satuan</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 13%;"><b>Harga</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 15%;"><b>Total Harga</b></th>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_1; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_1; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_1; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_1 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_1 / 111 * 100 * (int)$row_isiSurat->jumlah_1, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_2; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_2; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_2; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_2 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_2 / 111 * 100 * (int)$row_isiSurat->jumlah_2, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_3; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_3; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_3; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_3 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_3 / 111 * 100 * (int)$row_isiSurat->jumlah_3, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_4; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_4; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_4; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_4 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_4 / 111 * 100 * (int)$row_isiSurat->jumlah_4, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_5; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_5; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_5; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_5 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_5 / 111 * 100 * (int)$row_isiSurat->jumlah_5, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_6; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_6; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_6; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_6 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_6 / 111 * 100 * (int)$row_isiSurat->jumlah_6, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_7; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_7; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_7; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_7 / 111 * 100, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_7 / 111 * 100 * (int)$row_isiSurat->jumlah_7, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>Sub Total</b></td>
                            <td style="text-align: right;">&nbsp;<?php echo number_format((int)ltrim(($row_isiSurat->total_all - $row_isiSurat->total_harga_ongkir) * 100 / 111, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>Tax/PPN 11%</b></td>
                            <td style="text-align: right;">&nbsp;<?php echo number_format((int)ltrim(($row_isiSurat->total_all - $row_isiSurat->total_harga_ongkir) - ($row_isiSurat->total_all - $row_isiSurat->total_harga_ongkir) * 100 / 111, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>Ongkir</b></td>
                            <td style="text-align: right;">&nbsp;<?php echo number_format((int)ltrim($row_isiSurat->total_harga_ongkir, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>TOTAL</b></td>
                            <td style="text-align: right;"><b>&nbsp;<?php echo number_format((int)ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center;"><b><i><?php echo terbilang($a) . " Rupiah"; ?></i></b></td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="pagesetup" style="background-color: white;">

                <br>


                <table id="invoice" style="width: 100%;">
                    <tr>
                        <td colspan="2" class="col-md-1" style="text-align: left; width: 50%;"><b>KETERANGAN :</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: right; width: 5%;">1.</td>
                        <td class="col-md-1" style="text-align: left; width: 45%;">Invoice Tagihan pembayaran resmi dari Amins Project Teknologi Indonesia</td>
                        <td rowspan="2" class="col-md-1" style="text-align: center; width: 50%;">Madiun, <?php setlocale(LC_ALL, 'IND');
                                                                                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_inv)); ?><br><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: right; width: 5%;">2.</td>
                        <td class="col-md-1" style="text-align: left; width: 45%;">Jika ada yang kurang jelas segera konfirmasi ke email aminstech@gmail.com atau informasi ke nomor +62 895-3799-05511</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: right; width: 5%;">3.</td>
                        <td class="col-md-1" style="text-align: left; width: 45%;">Segera konfirmasi setelah melakukan pembayaran melalui nomor handphone / email informasi</td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: right; width: 5%;"></td>
                        <td class="col-md-1" style="text-align: left; width: 45%;"></td>
                        <td rowspan="2" class="col-md-1" style="text-align: center; width: 50%;"><strong><u><?php echo $row_ttd->nama; ?></u></strong><br><?php $row_ttd->jabatan;
                                                                                                                                                            echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                    </tr>
                </table>
                <br>
                <br>
                <table id="invoice" style="width: 100%;">
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 18%;" style="color: #145FA4; font-size: 13px;"><b>No. Rek. Bank Mandiri</b></td>
                        <td style="text-align: left; width: 1%;" style="color: #145FA4; font-size: 13px;"><b>:</b></td>
                        <td style="text-align: left; width: 35%;" style="color: #145FA4; font-size: 13px;"><b>1710016813191</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 18%;" style="color: #145FA4; font-size: 13px;"><b>Atas nama</b></td>
                        <td style="text-align: left; width: 1%;" style="color: #145FA4; font-size: 13px;"><b>:</b></td>
                        <td style="text-align: left; width: 35%;" style="color: #145FA4; font-size: 13px;"><b>AMINS PROJECT TEKNOLOGI INDONESIA</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 18%;" style="color: #145FA4; font-size: 13px;"><b>No. Rek. Bank Jatim</b></td>
                        <td style="text-align: left; width: 1%;" style="color: #145FA4; font-size: 13px;"><b>:</b></td>
                        <td style="text-align: left; width: 35%;" style="color: #145FA4; font-size: 13px;"><b>0051048156</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 18%;" style="color: #145FA4; font-size: 13px;"><b>Atas nama</b></td>
                        <td style="text-align: left; width: 1%;" style="color: #145FA4; font-size: 13px;"><b>:</b></td>
                        <td style="text-align: left; width: 35%;" style="color: #145FA4; font-size: 13px;"><b>AMINS PROJECT CV</b></td>
                    </tr>
                </table>
                <br>
                <table id="invoice" style="width: 100%;">
                    <tr>
                        <td colspan="2" class="col-md-1" style="text-align: left; width: 50%;"><b><i>"Start Project From The Heart"</i></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="col-md-1" style="text-align: left; width: 50%;"><b><i>"Semangat Tanpo Sambat, Bedo Dino Bedo Cerito"</i></b></td>
                    </tr>
                </table>
                <br>
                <br>

            </div>
            <div class="html2pdf_page-break"></div>
        </div>
    </div>


    <!-- KWITANSI -->

    <div id="element" style="font-size: 12px; margin-left: -17px;">
        <div style="background-color: #DCE6F1; border: 3px solid #145FA4;">
            <img width="70" height="70" style="float: left; margin-top: 12px;" src="<?php echo WRITEPATH . 'files/setting/' . $model->getSetting(5)->content; ?>">
            <div align="center" style="margin-right: 0px; margin-left: -170px;  margin-top: 12px;">

                <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                <b>
                    <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                    <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                </b>
                <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
            </div>
            <hr style="color: #145FA4; height: 3px; background: #145FA4;">
            <div class="container">
                <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat_box.png'; ?>" alt="Snow" style="margin-left: 675px; margin-top: -95px;" height="75">
                <div class="top-left"><img class="qrgen" style="margin-left: 666px; margin-top: -96px;" height="48" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
                <div class="bottom-right" style="right: 30px;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
            </div>

            <div style="margin-top: -33px;"></div>
            <div class="pagesetup" style="background-color: white;">
                <br>
                <div class="card-body">
                    <table class="center" border="0" style="margin-left: 270px;">
                        <tr>
                            <td style="text-align: center;" style="font-size: 18px; color: #145FA4;"><strong><u>KWITANSI</u></strong></td>
                        </tr>

                        <tr>
                            <?php
                            $array_bln    = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                            $bln      = $array_bln[date('n', strtotime($row_isiSurat->tgl_kwn))];
                            ?>
                            <td style="font-size: 12;"><?php echo ($row_isiSurat->kwn); ?><?php echo $bln; ?>/<?php setlocale(LC_ALL, 'IND');
                                                                                                                echo strftime('%Y', strtotime($row_isiSurat->tgl_kwn)); ?></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <table id="invoice" style="width: 100%;">
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 16%;"><b>Telah diterima dari</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 83%;"><?php echo $row_isiSurat->satuan_kerja; ?> - <?php echo $row_isiSurat->nama_instansi; ?> - <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 16%;"><b>Uang sejumlah</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 83%; background-color: #DCE6F1;">
                                <b>
                                    Rp. <?php echo number_format(ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?>
                                    <i>(<?php echo terbilang($a) . " Rupiah"; ?>)</i>
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 16%;"><b>Untuk pembayaran</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 83%;">
                                No Surat Pesanan : <?php echo $row_isiSurat->no_surat_pemesanan; ?>,
                                <br>
                                Tanggal Surat Pesanan : <?php setlocale(LC_ALL, 'IND');
                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_surat_pemesanan)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="text-align: right; width: 16%;"><b>NPWP</b></td>
                            <td style="text-align: left; width: 1%;" style="border-right:1px dotted black;"></td>
                            <td style="text-align: left; width: 83%;"><?php echo $row_isiSurat->npwp_satuan_kerja; ?></td>
                        </tr>

                    </table>
                    <br>
                    <br>
                    <table id="invoicetab" style="width: 100%;">
                        <tr>
                            <th style="vertical-align: middle; text-align: center; width: 5%;"><b>No</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 53%;"><b>Nama Barang</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;"><b>Jumlah</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 7%;"><b>Satuan</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 13%;"><b>Harga</b></th>
                            <th style="vertical-align: middle; text-align: center; width: 15%;"><b>Total Harga</b></th>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_1; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_1; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_1; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_1; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_1, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_1, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_2; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_2; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_2; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_2; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_2, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_2, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_3; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_3; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_3; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_3; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_3, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_3, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_4; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_4; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_4; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_4; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_4, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_4, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_5; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_5; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_5; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_5; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_5, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_5, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_6; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_6; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_6; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_6; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_6, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_6, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $row_isiSurat->no_7; ?></td>
                            <td style="vertical-align: middle; text-align: left; width: 53%;"><?php echo $row_isiSurat->nama_barang_7; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->jumlah_7; ?></td>
                            <td style="vertical-align: middle; text-align: center; width: 7%;"><?php echo $row_isiSurat->satuan_7; ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 13%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->harga_7, '0'), 0, '', '.') ?></td>
                            <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format((int)ltrim((int)$row_isiSurat->total_harga_7, '0'), 0, '', '.') ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right; background-color: #DCE6F1;"><b>Ongkir</b></td>
                            <td style="text-align: right; background-color: #DCE6F1;"><b>&nbsp;<?php echo number_format((int)ltrim($row_isiSurat->total_harga_ongkir, '0'), 0, '', '.') ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right; background-color: #DCE6F1;"><b>Total Sudah Termasuk PPN 11%</b></td>
                            <td style="text-align: right; background-color: #DCE6F1;"><b>&nbsp;<?php echo number_format((int)ltrim($row_isiSurat->total_all, '0'), 0, '', '.') ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="pagesetup" style="background-color: white;">

                <br>
                <br>
                <table id="invoice" style="width: 100%;">
                    <tr>
                        <td colspan="2" class="col-md-1" style="text-align: left; width: 50%;"><b></b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;" style="color: #145FA4; font-size: 13px;"><b>No. Rek. Bank Mandiri</b></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;" style="color: #145FA4; font-size: 13px;"><b>: 1710016813191</b></td>
                        <td rowspan="5" class="col-md-1" style="text-align: center; width: 50%;">Madiun, <?php setlocale(LC_ALL, 'IND');
                                                                                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_kwn)); ?><br><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;" style="color: #145FA4; font-size: 13px;"><b>Atas nama</b></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;" style="color: #145FA4; font-size: 13px;"><b>: AMINS PROJECT TEKNOLOGI INDONESIA</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;" style="color: #145FA4; font-size: 13px;"><b>No. Rek. Bank Jatim</b></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;" style="color: #145FA4; font-size: 13px;"><b>: 0051048156</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;" style="color: #145FA4; font-size: 13px;"><b>Atas nama</b></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;" style="color: #145FA4; font-size: 13px;"><b>: AMINS PROJECT CV</b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;"></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;"></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 20%;"></td>
                        <td class="col-md-1" style="text-align: left; width: 30%;"></td>
                    </tr>
                </table>
                <table class="center" border="0" style="margin-left: 450px;">
                    <tr>
                        <td style="text-align: left; font-size: 7px; ">mat</td>
                    </tr>
                </table>
                <table id="invoice" style="width: 100%;">
                    <tr>

                        <td rowspan="5" class="col-md-1" style="text-align: center; width: 23%;"></td>
                        <td rowspan="5" class="col-md-1" style="text-align: center; width: 50%;"></td>
                        <td rowspan="5" class="col-md-1" style="text-align: center; width: -30px;"><strong><u><?php echo $row_ttd->nama; ?></u></strong><br><?php $row_ttd->jabatan;
                                                                                                                                                            echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>

                    </tr>
                </table>
                <table id="invoice" style="width: 100%;">
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 50%;"><b><i>"Start Project From The Heart"</i></b></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="text-align: left; width: 50%;"><b><i>"Semangat Tanpo Sambat, Bedo Dino Bedo Cerito"</i></b></td>
                    </tr>
                </table>


                <br>
                <br>

            </div>
            <div class="html2pdf_page-break"></div>
        </div>
    </div>

</body>



</html>