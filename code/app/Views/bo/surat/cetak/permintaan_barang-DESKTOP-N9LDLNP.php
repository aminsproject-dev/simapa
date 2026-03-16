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
            color: white;
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
        </div>



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
                    <td><?php echo $row_isiSurat->nama_vendor; ?></td>
                </tr>
                <tr>
                    <td><?php echo $row_isiSurat->alamat_vendor; ?></td>
                </tr>
                <tr>
                    <td>Di <?php echo $row_isiSurat->kota_vendor; ?> </td>
                </tr>

            </table>
            </p>
            <p class="isi">
            <table style="width: 90%; margin-left: -3px;">
                <tr>
                    <td>Dengan hormat,</td>
                </tr>
                <tr>
                    <td>Berdasarkan informasi dari marketing/bagian pemasaran perusahaan saudara, kami akan melakukan pemesanan barang-barang berikut :</td>
                </tr>

            </table>
            </p>
            <table style="margin-left: 50px;">
                <tr>
                    <td>1. Data barang sebagai berikut</td>
                    <td>:</td>
                </tr>
            </table>
            <table id="customers">
                <tr>
                    <th style="text-align: center; width: 5%;"><b>No</b></th>
                    <th style="text-align: center; width: 48%;"><b>Nama Barang</b></th>
                    <th style="text-align: center; width: 9%;"><b>Jumlah</b></th>
                    <th style="text-align: center; width: 9%;"><b>Satuan</b></th>
                    <th style="text-align: center; width: 14%;"><b>Harga</b></th>
                    <th style="text-align: center; width: 15%;"><b>Total Harga</b></th>
                </tr>
                <?php
                $semuaHarga = 0;
                foreach ($row_isiSurat->barang as $barang) { ?>
                    <tr>
                        <td class="col-md-1" style="vertical-align: middle; text-align: center; width: 5%;"><?php echo $barang->no; ?></td>
                        <td style="width: 48%;"><?php echo $barang->nama_barang; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 9%;"><?php echo $barang->jumlah; ?></td>
                        <td style="vertical-align: middle; text-align: center; width: 9%;"><?php echo $barang->satuan; ?></td>
                        <td style="vertical-align: middle; text-align: right; width: 14%;"><?php echo number_format(ltrim($barang->harga, '0'), 0, '', '.') ?></td>
                        <?php
                        $totalHarga = $barang->jumlah * $barang->harga;
                        $semuaHarga += $totalHarga;
                        ?>
                        <td style="vertical-align: middle; text-align: right; width: 15%;">&nbsp;<?php echo number_format(ltrim($totalHarga, '0'), 0, '', '.') ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="5" style="text-align: right;"><b>Total Harga Termasuk PPN 11%</b></td>
                    <td style="text-align: right;"><?php echo number_format($semuaHarga, 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"><b>Down Payment <?php echo $row_isiSurat->down_payment; ?>%</b></td>
                    <td style="text-align: right;"><?php echo number_format($semuaHarga * $row_isiSurat->down_payment / 100, 0, '', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;"><b>Sisa Bayar</b></td>
                    <td style="text-align: right;"><?php echo number_format($semuaHarga - $semuaHarga * $row_isiSurat->down_payment / 100, 0, '', '.') ?></td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: center;">
                        <i><b>
                                <?php

                                $a = $semuaHarga - $semuaHarga * $row_isiSurat->down_payment / 100;
                                echo terbilang($a) . " Rupiah";

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
                            </b></i>
                    </td>
                </tr>
            </table>


            <table style="width: 65%; margin-left: 50px;">
                <tr>
                    <td>2. Tanggal Pengiriman Barang</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;">Paling lambat pengiriman barang tanggal, <?php setlocale(LC_ALL, 'IND');
                                                                                                            echo strftime('%d %B %Y', strtotime($row_isiSurat->tanggal_pengiriman)); ?></td>
                </tr>
                <tr>
                    <td>3. Alamat Penerima Barang</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->alamat_pengiriman; ?></td>
                </tr>
                <tr>
                    <td>4. Faktur Pajak</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;"><?php echo $row_isiSurat->nama_npwp; ?> / <?php echo $row_isiSurat->npwp; ?></td>
                </tr>
                <tr>
                    <td>5. Pembayaran</td>
                    <td>:</td>
                    <td style="width: 100%; text-align: justify;">Pembayaran akan dilakukan secara transfer ke rekening <b><?php echo $row_isiSurat->bank_vendor; ?></b>, Atas nama <b><?php echo $row_isiSurat->nama_rekening_vendor; ?></b>, Nomor Rekening <b><?php echo $row_isiSurat->rekening_vendor; ?></b>, dengan melampirkan dokumen berupa invoice/tagihan, serta mengirim faktur pajak dan nomor resi pengiriman barang.</td>
                </tr>
            </table>

            <p class="isi">Demikian permohonan permintaan barang ini kami sampaikan, atas persetujuan dan kerjasamanya kami ucapkan terimakasih.</p>

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
            </table>

        </div>

    </div>
    <div class="container">
        <div class="bottom-right" style="color:black;"><strong><u><?php echo $row_ttd->nama; ?></u></strong> <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php $row_ttd->jabatan;
            echo ucfirst(strtolower($row_ttd->jabatan)); ?></div>
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
            <img src="<?php echo FCPATH . 'assets/bo/images/validasi_surat.png'; ?>" alt="Snow" style="margin-left: 0px;" height="98">
            <div class="top-left"><img class="qrgen" style="margin-left: -8px;" height="80" src="<?php echo WRITEPATH . 'files/qrcode/qrcode-' . $row_isiSurat->qrgen . '.png' ?>"></div>
            <div class="centered"><b><?php echo $row_isiSurat->qrgen; ?></b></div>
        </div>
        <br>

        <i class="note">*Note : <?php echo $row_isiSurat->noted; ?> </i><br>
        <i class="created">*Dokumen ini dibuat dan dicetak pada tanggal <?php echo $row_surat['createdon']; ?> </i>
    </page_footer>

</body>



</html>