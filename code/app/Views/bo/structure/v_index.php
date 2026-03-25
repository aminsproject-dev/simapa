<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/css/jquery.orgchart.min.css'>

<style>
    #chart-container {
        font-family: Arial;
        height: 420px;
        border: 2px dashed #aaa;
        border-radius: 5px;
        overflow: auto;
        text-align: center;
    }

    .orgchart .node {
        display: flex;
        width: 200px;
        flex-direction: column;
        align-items: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .orgchart .title,
    .orgchart .content {
        width: 100%;
        box-sizing: border-box;
        text-align: center;
    }

    .orgchart {
        background: #fff;
    }

    .orgchart td.left,
    .orgchart td.right,
    .orgchart td.top {
        border-color: #aaa;
    }

    .orgchart td>.down {
        background-color: #aaa;
    }

    .orgchart .biru .title {
        background-color: #006699;
    }

    .orgchart .biru .content {
        border-color: #006699;
    }

    .orgchart .hijau .title {
        background-color: #009933;
    }

    .orgchart .hijau .content {
        border-color: #009933;
    }

    .orgchart .ungu .title {
        background-color: #993366;
    }

    .orgchart .ungu .content {
        border-color: #993366;
    }

    .orgchart .cokelat .title {
        background-color: #996633;
    }

    .orgchart .cokelat .content {
        border-color: #996633;
    }

    .orgchart .magenta .title {
        background-color: #cc0066;
    }

    .orgchart .magenta .content {
        border-color: #cc0066;
    }
</style>

<!-- Main content -->
<div class="content-wrapper">
    <!-- Content area -->
    <div class="content">

        <!-- STATISTIK MASTER -->
        <div class="row">
            <div class="col-sm-12 col-xl-12">

                <div class="card ">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h5 class="py-sm-2 my-sm-1"><?= $title; ?></h5>
                        <div class="mt-2 mt-sm-0 ms-sm-auto">
                            <a href="<?= base_url('master/employees'); ?>" class="btn btn-primary fw-bold">
                                <i class="ph-database me-1"></i>
                                Kelola Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="chart-container"></div>

                    </div>
                </div>

            </div>

        </div>

    </div>


</div>
<!-- /content area -->
</div>
<!-- /main content -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/js/jquery.orgchart.min.js'></script>

<script>
    'use strict';

    (function($) {

        $(function() {

            var datascource = {
                'name': '<?= isset($row_direktur['nama']) ? $row_direktur['nama'] : 'Tidak ditemukan'; ?>',
                'title': '<?= isset($row_direktur['nama_pegawai']) ? $row_direktur['nama_pegawai'] : 'Tidak ditemukan'; ?>',
                'children': [
                    <?php foreach ($dt_employees as $employee) {
                        if ($employee['jabatan'] == 1) {
                            continue;
                        } ?> {
                            'name': '<?= $employee['nama']; ?>',
                            'title': '<?= $employee['nama_pegawai']; ?>',
                            'classname': '<?= $employee['warna']; ?>',
                        },
                    <?php } ?>
                ]
            };

            var oc = $('#chart-container').orgchart({
                'data': datascource,
                'nodeContent': 'title'
            });

        });

    })(jQuery);
</script>