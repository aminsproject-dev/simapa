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
            font-size: 14px;
        }

        .tab4 {
            tab-size: 8;
        }
    </style>

    <style>
        .container {
            position: relative;
            color: white;
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
            bottom: -10px;
            right: 90px;
        }

        .centered {
            position: absolute;
            top: 47%;
            left: 23%;
            transform: translate(-50%, -50%);
        }
    </style>

    <style>
        #customers {
            border-collapse: collapse;
            width: 100%;
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

</head>

<body>
    <?php $row_isiSurat = json_decode($row_surat['isi_surat']); ?>
    <?php $row_ttd = json_decode($row_surat['tanda_tangan']); ?>

    <div class="pagesetup">

        <img src="<?php echo FCPATH . 'assets/bo/images/kop_amplop_atas.jpg' ?>" alt="Snow" style="width:65%; margin-left: 15px; margin-top: 0px;">

        <table style="width: 100%; margin-left: 30px; margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th style="vertical-align: middle; text-align: left; width: 320px;"><b></b></th>
                    <th style="vertical-align: middle; text-align: left; width: 80px;"><b></b></th>
                    <th style="vertical-align: middle; text-align: left; width: 230px;"><b></b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kepada Yth,</td>
                    <td>Nomor</td>
                    <td>: <?php echo $row_surat['no_surat']; ?></td>
                </tr>
                <tr>
                    <td>Bapak/Ibu Pimpinan</td>
                    <td>Perihal</td>
                    <td>: <?php echo ($row_surat['nama_surat']); ?></td>
                </tr>
                <tr>
                    <td><?php echo $row_isiSurat->nama_bank; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?php echo $row_isiSurat->alamat_bank; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ditempat</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>



        </table>

        <div class="top-right"><img class="qrgen" style="margin-right: 300px; margin-top: 230;" height="130" src="<?php echo FCPATH . 'assets/bo/images/kode_validasi.png'; ?>"></div>
        <div class="top-right"><img class="qrgen" style="margin-right: 313px; margin-top: 254px;" height="85" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
        <div class="top-right" style="margin-right: 332px; margin-top: 342px; font-size: 15px; color:white;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>

    </div>

</body>

</html>