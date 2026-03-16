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
            bottom: 8px;
            right: 16px;
        }

        .centered {
            position: absolute;
            top: 47%;
            left: 23%;
            transform: translate(-50%, -50%);
        }
    </style>

</head>

<body>

    <?php $row_isiSurat = json_decode($row_surat['isi_surat']); ?>
    <?php $row_ttd = json_decode($row_surat['tanda_tangan']); ?>

    <div class="pagesetup">
        <img width="70" height="70" style="float: left; " src="<?php echo WRITEPATH . 'files/' . $model->getSetting(5)->content; ?>">

        <div align="center" style="margin-right: 0px; margin-left: -200px;">


            <p class="kop1"><?php echo $model->getSetting(9)->content; ?> </p>
            <b>
                <p class="kop3"> <?php echo $model->getSetting(10)->content; ?> </p>
                <p class="kop3"> <?php echo $model->getSetting(11)->content; ?> </p>
                <p class="kop3"> <?php echo $model->getSetting(17)->content; ?> </p>
            </b>
            <p class="kop3" style="color: blue;"> <i><?php echo $model->getSetting(18)->content; ?> </i></p>


        </div>
        <div style="width: 90%;">
            <hr / style="color: #145FA4; height: 3px; background: #145FA4;">
            <br>
            <p class="judul center"><u><?php echo strtoupper($row_surat['nama_surat']); ?></u></p>
            <p class="nomor center">Nomor : <?php echo $row_surat['no_surat']; ?></p>
            <br>
            <br>
        </div>

        <div style="width: 90%; margin-left: 0px;">



            <table style="width: 90%; margin-left: -3px;">

                <tr>
                    <td>Yang bertanda tangan dibawah ini :</td>
                </tr>
            </table>

            <table style="width: 65%; margin-left: 70px;">
                <tbody>

                    <tr>
                        <td>Nama</td>
                        <td>&nbsp; &nbsp; :</td>
                        <td><?php echo $row_ttd->nama; ?> </td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>&nbsp; &nbsp; :</td>
                        <td><?php $row_ttd->jabatan;
                            echo ucfirst(strtolower($row_ttd->jabatan)); ?> </td>
                    </tr>

                    <tr>
                        <td>Nama Perusahaan</td>
                        <td>&nbsp; &nbsp; :</td>
                        <td><?php echo $row_isiSurat->nama_perusahaan; ?></td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>&nbsp; &nbsp; :</td>
                        <td><?php echo $model->getSetting(10)->content; ?> </td>
                    </tr>

                </tbody>
            </table>

            <br>

            <table style="width: 90%; margin-left: -3px;">

                <tr>
                    <td>Dengan ini menyatakan bahwa nomor rekening atas nama :</td>
                </tr>
            </table>

            <table style="width: 65%; margin-left: 70px;">
                <tbody>

                    <tr>
                        <td>Nama Bank</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; :</td>
                        <td><?php echo $row_isiSurat->nama_bank; ?> </td>
                    </tr>

                    <tr>
                        <td>Nama Rekening</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; :</td>
                        <td><?php echo $row_isiSurat->nama_rekening; ?></td>
                    </tr>

                    <tr>
                        <td>Nama Rekening</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; :</td>
                        <td><?php echo $row_isiSurat->nomor_rekening; ?></td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>&nbsp; &nbsp; &nbsp; &nbsp; :</td>
                        <td><?php echo $model->getSetting(10)->content; ?> </td>
                    </tr>

                </tbody>
            </table>
            <br>
            <p class="isi" style="text-align: justify;">Merupakan asli dan sah Nomor Rekening perusahaan <b><?php echo $row_isiSurat->nama_perusahaan; ?></b>, sesuai dengan Formulir Permohonan Pembukaan Rekening yang tercatat
                di sistem penata usahaan, bahwa rekening tersebut tercatat sebagai rekening <b>GIRO</b> di <b><?php echo $row_isiSurat->nama_bank; ?></b> dan Masih Aktif. </p>

            <p class="isi">Demikian surat pernyataan ini kami buat dengan sebenarnya dan agar dapat digunakan sebagaimana mestinya, atas perhatian dan kerjasamanya kami ucapkan terimakasih.</p>


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
    <page_footer>
        <div class="container">
            <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat.png'; ?>" alt="Snow" style="margin-left: 0px;" height="98">
            <div class="top-left"><img class="qrgen" style="margin-left: -8px;" height="80" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
            <div class="centered"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
        </div>
        <br>

        <i class="created">*Dokumen ini dibuat dan dicetak pada tanggal <?php echo $row_surat['createdon']; ?> </i>
    </page_footer>

</body>



</html>