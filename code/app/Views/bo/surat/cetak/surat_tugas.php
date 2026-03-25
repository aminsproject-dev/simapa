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
            background-color: #233B83;
            color: black;
        }
    </style>

</head>

<body>

    <?php $row_isiSurat = json_decode($row_surat['isi_surat']); ?>
    <?php $row_ttd = json_decode($row_surat['tanda_tangan']); ?>

    <div class="pagesetup">
        <img src="<?php echo FCPATH . 'assets/bo/images/kop_surat_atas.jpg' ?>" alt="Snow" style="width:100%; margin-left: 0px; margin-top: -30px;">

        <table style="width: 100%; margin-left: 45px; margin-top: 40px; font-size: 14px;">

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

        <div style="width: 100%; margin-left: 45px; margin-top: 15px;">

            <p class="isi">
            <table style="width: 100%; font-size: 14px;">

                <tr>
                    <td>Yang bertandatangan dibawah ini :</td>
                </tr>
            </table>
            <table style="margin-left: 30px; font-size: 14px;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Munif Amin Romadhon</td>
                </tr>
                <tr>
                    <td width="120">Jabatan </td>
                    <td>:</td>
                    <td>Direktur</td>
                </tr>
                <tr>
                    <td>Perusahaan </td>
                    <td>:</td>
                    <td>CV. AMINS PROJECT TEKNOLOGI INDONESIA</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Cempedak VI-I, Taman, Kota Madiun</td>
                </tr>
            </table>

            </p>
            <table style="width: 100%; font-size: 14px;">
                <tr>
                    <td>Dengan ini memberi tugas dan tanggung jawab kepada :</td>
                </tr>
            </table>
            <table id="customers" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 30px;"><b>No</b></th>
                        <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 330px;"><b>Nama</b></th>
                        <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 150px;"><b>Jabatan</b></th>
                        <th style="vertical-align: middle; color: #FFFFFF; text-align: center; width: 150px;"><b>NIP</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_1; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_1; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_1; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_1; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_2; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_2; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_2; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_2; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_3; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_3; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_3; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_3; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_4; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_4; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_4; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_4; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_5; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_5; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_5; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_5; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_6; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_6; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_6; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_6; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 30px;"><?php echo $row_isiSurat->no_7; ?></td>
                        <td style="vertical-align: middle; text-align: left; width: 330px;"><?php echo $row_isiSurat->nama_7; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;"><?php echo $row_isiSurat->jabatan_7; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 150px;">&nbsp;<?php echo $row_isiSurat->nip_7; ?></td>
                    </tr>
                </tbody>
            </table>
            <p class="isi">
            <table style="width: 100%; font-size: 14px;">
                <tr class="justify">
                    <td>Untuk melaksanakan tugas dan tanggung jawab berupa : </td>
                </tr>
            </table>
            <table style="margin-left: 30px; font-size: 14px;">
                <tr>
                    <td>1</td>
                    <td>.</td>
                    <td>Kegiatan <?php echo $row_isiSurat->kegiatan; ?><?php echo $row_isiSurat->keterangan; ?></td>
                </tr>
            </table>
            <table style="margin-left: 65px; font-size: 14px;">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php setlocale(LC_ALL, 'IND');
                        echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_mulai)); ?> s/d <?php setlocale(LC_ALL, 'IND');
                                                                                                    echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_selesai)); ?></td>
                </tr>
                <tr>
                    <td>Tempat / Lokasi Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo $row_isiSurat->lokasi_kegiatan; ?></td>
                </tr>
            </table>
            </p>
            <p class="isi">
            <table style="width: 100%; font-size: 14px;">
                <tr class="justify">
                    <td>Demikianlah surat tugas ini dibuat dengan sebenarnya dan dapat digunakan sebagaimana mestinya,</td>
                </tr>
                <tr class="justify">
                    <td>Atas perhatian dan kerjasamanya kami ucapkan terimakasih.</td>
                </tr>
            </table>
            </p>
            <br>
            <br>
            <br>
            <table class="center" border="0" style="margin-left: 345px;">
                <tr>
                    <td>Madiun, <?php setlocale(LC_ALL, 'IND');
                                echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?></td>
                </tr>
                <tr>
                    <td><?php echo $model->getSetting(9)->content; ?></td>
                </tr>
                <?php
                if ($row_ttd->wakilkan == 1) ?>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="bottom-right" style="color:black;">
            <strong> <u><?php echo $row_ttd->nama; ?></u> </strong>
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php $row_ttd->jabatan;
            echo ucfirst(strtolower($row_ttd->jabatan)); ?>
        </div>
        <img src="<?php
                    if ($row_isiSurat->img_ttd == 1) {
                        echo FCPATH . 'assets/bo/images/ttd_stampel_direktur.png';
                    } else {
                        echo FCPATH . "assets/bo/images/ttd_kosongan.png";
                    }
                    ?>" alt="Snow" style="margin-left: 410px;" height="90">
    </div>
    <page_footer>
        <div class="container">
            <img class="bottom-left" src="<?php echo 'assets/bo/images/kop_surat_bawah.jpg'; ?>" style="width:107%; margin-left: -18px;">
            <div class="top-right"><img class="qrgen" style="margin-right: -38px; margin-top: 136px;" height="79" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
            <div class="top-right" style="margin-right: 229px; margin-top: 203px; font-size: 15px;"><?php echo $row_isiSurat->qrgen; ?></div>
        </div>
    </page_footer>

</body>



</html>