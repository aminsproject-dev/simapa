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
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <?php foreach ($dt_menuSurat as $menuSurat) { ?>
                <div class="col-sm-4 col-xl-4">
                    <a href="<?= base_url('surat/menu-surat' . $menuSurat['url'] . '&jns=' . encrypt_data($menuSurat['jenis']) . '&action=' . encrypt_data('view')); ?>" data-bs-popup="popover" data-bs-trigger="hover" data-bs-content="Lihat Surat">
                        <div class="card card-body  ">
                            <div class="d-flex align-items-center">
                                <div class="flex-fill text-muted">
                                    <h5 class="mb-0"><?= $menuSurat['nama_menu']; ?></h5>
                                </div>

                                <i class="<?= $menuSurat['icon']; ?> ph-2x opacity-75 ms-3 bg-primary  text-white lh-1 rounded-pill p-2 "></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>


    </div>


</div>
<!-- /content area -->
</div>
<!-- /main content -->