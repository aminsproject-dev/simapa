<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title>CETAK SAMPUL</title>

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
            font-size: 11px;
            margin: 2px;
            padding: 0px;
            font-weight: bold;
        }

        .kop2 {
            font-weight: 800;
            font-size: 8px;
            margin: 2px;
            padding: 0px;
            font-weight: bold;
        }

        .kop3 {
            font-size: 7px;
            margin: 0px;
            padding: 0px;
        }

        .kop4 {
            font-size: 8px;
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
            font-size: 9px;
            margin-left: 3px;
            margin-right: 2px;
        }

        .tab4 {
            tab-size: 7;
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
            width: 50%;
            font-size: 12px;
        }

        #customers td,
        #customers th {
            border: 1px solid #000000;
            width: 50%;
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

    <div style="font-size: 9px; margin-left: -17px; margin-top: -20px;">
        <div style="background-color: #DCE6F1; border: 2px solid #145FA4;" id="centered">
            <img width="50" height="50" style="float: left; margin-top: 5px; margin-bottom: 5px;" src="<?php echo WRITEPATH . 'files/' . $model->getSetting(5)->content; ?>">
            <table style="margin-left: 10px;" class="center">
                <tr>
                    <td>
                        <p style="margin-top: 5px;" class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
                        <b>
                            <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                            <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                            <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
                        </b>
                        <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="background-color: #ffffff; border: 2px solid #145FA4; margin-top: -3px;">
            <table style="margin-left: 150px;">
                <tr>
                    <td><b><u>DOKUMEN</u></b></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Kepada</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->instansi; ?> - <?php echo $row_isiSurat->satuan_kerja; ?> - <?php echo $row_isiSurat->nama_kabupaten; ?> - <?php echo $row_isiSurat->nama_provinsi; ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->nama_paket_pekerjaan; ?> </td>
                </tr>
                <tr>
                    <td>No SP</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->no_spk; ?>, Tanggal <?php setlocale(LC_ALL, 'IND');
                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_mulai_spk)); ?></td>
                </tr>

                <tr>
                    <td> ID Paket</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->id_paket; ?>, Tanggal <?php setlocale(LC_ALL, 'IND');
                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_paket_dibuat)); ?></td>
                </tr>

                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->alamat_satuan_kerja; ?></td>
                </tr>

            </table>
            <br>
            <p class="isi">
                - Stopmap ini berisi dokumen, dimohon setelah dokumen ditandatangani oleh kedua belah pihak harap discan / difoto dan dikirim kepada kami melalui nomor WhatsApp <i style="color: blue;">+62 895-3799-05511</i> / E-mail : <i style="color: blue;">aminstech@gmail.com</i><br>
                - Harap mengirim / memberi rating / bintang terbaik diplatform marketplace pembelian E-Catalogue/LPSE/LKPP/SIPLAH sebagai syarat klaim garansi barang maupun jasa kami.
            </p>
            <table class="center" border="0" style="  margin-left: 120px;">
                <tr>

                    <td width="160">Madiun, <?php setlocale(LC_ALL, 'IND');
                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tgl_sg)); ?> </td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle; text-align: center; width: 33%;"><br>
                        <img src="<?= FCPATH . 'assets/bo/images/ttd_diah.png'; ?>" alt="Snow" height="50" style="margin-top: -10px;"><br>
                        <b><u>Diah Pamungkas</u></b><br>Accounting
                    </td>
                </tr>
            </table>
            <br>
            <table style="font-size: 10px; color: #09186C;">
                <tr>
                    <td>
                        <b><i>"Start Project From The Heart"</i></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><i>"Semangat Tanpo Sambat, Bedo Dino Bedo Cerito"</i></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><i>#KITALOKALKITABISA</i></b>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <table style="margin-left: 3px;">
                <tr>
                    <td>
                        <img src="<?= FCPATH . 'assets/bo/images/footer_aminsproject.png'; ?>" alt="Snow" height="18">
                    </td>
                </tr>
            </table>
            <br>
        </div>

    </div>

</body>



</html>