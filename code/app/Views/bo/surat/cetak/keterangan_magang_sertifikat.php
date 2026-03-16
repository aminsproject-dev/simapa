<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CETAK SERTIFIKAT</title>

    <style>
        .container {
            position: relative;
            text-align: center;
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
            bottom: 8px;
            right: 16px;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

</head>

<body>

    <?php $row_isiSurat = json_decode($row_surat['isi_surat']); ?>
    <?php $row_ttd = json_decode($row_surat['tanda_tangan']); ?>

    <div class="container">
        <img src="<?php echo FCPATH . 'assets/bo/images/sertifikat.png'; ?>" alt="Snow" style="width:100%; height:793px;">
        <h4 class="centered" style="width:200px; font-size: 25px; margin-top: -230px; color: #09186C; text-transform:uppercase; text-align:center;"><?php echo $row_surat['no_surat']; ?></h4>
        <h4 class="centered" style="width:200px; font-size: 62px; margin-top: -180px; color: #09186C; text-transform:uppercase; text-align:center;"><b><?php echo $row_isiSurat->nama_siswa; ?></b></h4>
        <div class="centered" style="margin-left: -335px; margin-top: -100px;">
            <table style="text-align:left; color: #09186C; font-size: 25px;">
                <tr>
                    <td>NPM / NIS</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td><?php echo $row_isiSurat->nim; ?></td>
                </tr>
                <tr>
                    <td>Program Studi / Keahlian</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td><?php echo $row_isiSurat->prodi; ?></td>
                </tr>
                <tr>
                    <td>Asal</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
                    <td><?php echo $row_isiSurat->asal_sekolah; ?></td>
                </tr>
            </table>
        </div>
        <p class="centered" style="width:200px; color: #09186C; font-size: 25px; margin:10px auto 100 auto; text-align:center;">
            Telah Melaksanakan kegiatan <b>Praktik Kerja Lapangan / Magang</b>, <br>
            yang dilaksanakan pada tanggal <b><?php setlocale(LC_ALL, 'IND');
                                                echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_mulai)); ?></b> sampai dengan <b><?php setlocale(LC_ALL, 'IND');
                                                                                                                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_selesai)); ?></b>, <br>
            bertempat di <b>CV. AMINS PROJECT TEKNOLOGI INDONESIA</b>, <br>
            Dengan predikat <b><?php echo $row_isiSurat->nilai; ?></b>.
        </p>

        <p class="centered" style="width:200px; font-size: 25px; margin-top: 310px; color: #09186C; text-align:center;">
            <strong><u><?php echo $row_ttd->nama . ', S.Kom'; ?></u></strong><br>
            <?php $row_ttd->jabatan;
            echo ucfirst(strtolower($row_ttd->jabatan)); ?>
        </p>
        <p class="centered" style="width:200px; font-size: 25px; margin-top: 180px; color: #09186C; text-align:center;">Madiun, <?php setlocale(LC_TIME, 'id_ID');
                                                                                                                                echo strftime('%d %B %Y', strtotime($row_surat["createdon"])); ?></p>
        <img src="
	<?php
    if ($row_isiSurat->img_ttd == 1) {
        echo FCPATH . 'assets/bo/images/ttd_stampel_direktur.png';
    } else {
        echo FCPATH . 'assets/bo/images/ttd_kosongan.png';
    }
    ?>" alt="Snow" style="margin-top: 205px; margin-left: -202px;" class="centered" height="140">
        <div class="centered" style="width:200px; font-size: 15px; margin-left: 355px; margin-top: 340px; color: #FFFFFF; text-align:center;"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
        <div class="bottom-right"><img class="qrgen" style="margin-top: -165px; margin-left: -148px;" height="108" src="<?= WRITEPATH . 'files/qrcode/qrcode-' . $row_surat['qrgen'] . '.png' ?>"></div>
    </div>

</body>

</html>