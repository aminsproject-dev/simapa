<!DOCTYPE html>
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
        <img src="<?= FCPATH . 'assets/bo/images/kop_surat_atas.jpg'; ?>" alt="Snow" style="width:105%; margin-left: -36px; margin-top: -21px;">
    </page_header>

    <div id="element" style="font-size: 13px;">

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
                        <td>Bapak/Ibu Pimpinan</td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->nama_bank; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $row_isiSurat->alamat_bank; ?></td>
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
                        <td>Bersama surat ini, kami mohon agar diterbitkan cetak rekening koran <?php echo $row_isiSurat->nama_bank; ?>, mulai tanggal <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                        echo strftime('%d %B %Y', strtotime($row_isiSurat->mulai_cetak)); ?> sampai dengan tanggal <?php setlocale(LC_ALL, 'IND');
                                                                                                                                                                                                                                                    echo strftime('%d %B %Y', strtotime($row_isiSurat->akhir_cetak)); ?>, atas nama sebagai berikut :</td>
                    </tr>

                </table>
                </p>
                <table style="margin-left: 70px;">

                    <tr>
                        <td>Nama Perusahaan</td>
                        <td>:</td>
                        <td><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>

                    <tr>
                        <td width="160">Alamat</td>
                        <td>:</td>
                        <td><?php echo $model->getSetting(10)->content; ?></td>
                    </tr>

                    <tr>
                        <td>Nama Rekening</td>
                        <td>:</td>
                        <td><?php echo $row_isiSurat->nama_rekening; ?></td>
                    </tr>

                    <tr>
                        <td>Nomor Rekening</td>
                        <td>:</td>
                        <td><?php echo $row_isiSurat->nomor_rekening; ?> </td>
                    </tr>

                </table>
                <br>
                <p class="isi">Demikian permohonan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>

                <br>
                <br>
                <br>
                <br>

                <table class="center" border="0" style="  margin-left: 400px;">
                    <tr>
                        <td width="160">Madiun, <?php setlocale(LC_ALL, 'IND');
                                                echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?> </td>
                    </tr>
                    <tr>
                        <td><?php echo $model->getSetting(9)->content; ?></td>
                    </tr>
                    <?php
                    if ($row_ttd->wakilkan == 1) ?>

                    <tr>
                        <td><br><br><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td><strong><u><?php echo $row_ttd->nama; ?></u></strong></td>
                    </tr>
                    <tr>

                        <td><?php $row_ttd->jabatan;
                            echo ucfirst(strtolower($row_ttd->jabatan)); ?></td>
                        <!--
							<td><?php echo $row_ttd->jabatan; ?></td>  
							-->
                    </tr>

                </table>
            </div>


        </div>

    </div>

    <page_footer>
        <div class="container">
            <i class="top-left" style="color:black; margin-top: 85px;">*Note : <?php echo $row_isiSurat->noted; ?> </i>
            <img class="bottom-left" src="<?= FCPATH . 'assets/bo/images/kop_surat_bawah_baru.jpg'; ?>" style="width:102%; margin-left: -50px;">
            <div class="bottom-right"><img class="qrgen" style="margin-right: -46px;  margin-bottom: -61px;" height="65" src="<?= WRITEPATH . 'files/qrcode/qrcode-' . $row_surat['qrgen'] . '.png' ?>"></div>
        </div>
        <div class="bottom-right" style="color:white; margin-right: 165px;  margin-bottom: 22px;"><?= $row_surat['qrgen']; ?></div>
    </page_footer>

</body>

</html>