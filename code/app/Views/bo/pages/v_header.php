<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= isset($title) ? $title : 'Limitless - Responsive Web Application Kit by Eugene Kopyov'; ?></title>
    <!-- Global stylesheets -->
    <link href="<?= base_url('assets/bo/fonts/inter/inter.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/bo/icons/phosphor/styles.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/bo/css/ltr/all.min.css'); ?>" id="stylesheet" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/bo/icons/icomoon/styles.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?= base_url('assets/bo/demo/demo_configurator.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/jquery/jquery.min.js'); ?>"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <!-- VENDOR -->
    <script src="<?= base_url('assets/bo/js/vendor/notifications/sweet_alert.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/visualization/echarts/echarts.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/tables/datatables/datatables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/tables/datatables/extensions/responsive.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/forms/selects/select2.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/forms/wizards/steps.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/forms/validation/validate.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/editors/ckeditor/ckeditor_classic.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/ui/moment/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/pickers/daterangepicker.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/pickers/datepicker.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/media/glightbox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/ui/fullcalendar/main.min.js'); ?>"></script>

    <script src="<?= base_url('assets/bo/js/vendor/visualization/d3/d3.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/visualization/d3/d3_tooltip.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/vendor/ui/prism.min.js'); ?>"></script>


    <!-- PAGES -->
    <script src="<?= base_url('assets/bo/js/app.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/custom.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/demo/pages/dashboard.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/demo/pages/components_popovers.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/demo/pages/picker_date.js'); ?>"></script>
    <!-- <script src="<?= base_url('assets/bo/demo/pages/fullcalendar_basic.js'); ?>"></script> -->

    <!-- /theme JS files -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <?php if ($success = session()->get('success')): ?>
        <div id="sweet_success_custom" data-message='<?= esc(json_encode($success), 'attr') ?>'></div>
    <?php elseif ($error = session()->get('error')): ?>
        <div id="sweet_error_custom" data-message='<?= esc(json_encode($error), 'attr') ?>'></div>
    <?php endif; ?>

    <div class="fixed-top">
        <!-- Main navbar -->
        <div class="navbar bg-primary navbar-expand-lg">
            <div class="container-fluid">
                <div class="d-flex d-lg-none me-2">
                    <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                        <i class="ph-list"></i>
                    </button>
                </div>

                <div class="navbar-brand flex-1 flex-lg-0">
                    <a href="<?= base_url('dashboard'); ?>" class="d-inline-flex align-items-center">
                        <img src="<?= base_url('files/logo'); ?>" alt="">
                    </a>
                </div>

                <ul class="nav flex-row justify-content-end order-1 order-lg-2">

                    <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                        <a href="#" class="navbar-nav-link bg-white align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                            <div class="status-indicator-container">
                                <span class="status-indicator bg-success"></span>
                                <img src="<?= base_url('assets/bo/images/demo/users/face11.jpg'); ?>" class="w-32px h-32px rounded-pill" alt="" />
                            </div>
                            <span class="d-none d-lg-inline-block mx-lg-2"><?= session()->get('username'); ?></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="<?= base_url('setting/profile'); ?>" class="dropdown-item">
                                <i class="ph-user me-2"></i>
                                Profile
                            </a>
                            <a href="<?= base_url('logout'); ?>" class="dropdown-item">
                                <i class="ph-sign-out me-2"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /main navbar -->

    </div>

    <!-- Page header -->
    <div class="page-header mt-5">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">SISURO - <span class="fw-normal"><?= isset($title) ? $title : ''; ?></span></h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>

        </div>
    </div>
    <!-- /page header -->

    <!-- Page content -->
    <div class="page-content pt-0">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-expand-lg align-self-start <?= isset($sidebar) ? $sidebar : ''; ?>">
            <!-- Sidebar content -->
            <div class="sidebar-content">
                <!-- Sidebar header -->
                <div class="sidebar-section">
                    <div class="sidebar-section-body d-flex justify-content-center">
                        <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigasi</h5>

                        <div>
                            <button type="button" class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                <i class="ph-arrows-left-right"></i>
                            </button>

                            <button type="button" class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                <i class="ph-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /sidebar header -->

                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <!-- Main -->
                        <li class="nav-item-header pt-0">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Dashboard</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= isset($active_dashboard) ? $active_dashboard : ''; ?>">
                                <i class="ph-house"></i>
                                <span>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('structure'); ?>" class="nav-link <?= isset($active_structure) ? $active_structure : ''; ?>">
                                <i class="ph-tree-structure"></i>
                                <span>
                                    Struktur Perusahaan
                                </span>
                            </a>
                        </li>

                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Surat</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('surat'); ?>" class="nav-link <?= isset($active_surat) ? $active_surat : ''; ?>">
                                <i class="ph-envelope"></i>
                                <span>
                                    Surat
                                </span>
                            </a>

                        </li>

                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Data</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('marketing/ekatalog'); ?>" class="nav-link <?= isset($active_ekatalog) ? $active_ekatalog : ''; ?>">
                                <i class="ph-storefront"></i>
                                <span>
                                    Data Ekatalog
                                </span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('pekerja'); ?>" class="nav-link <?= isset($active_pekerja) ? $active_pekerja : ''; ?>">
                                <i class="ph-address-book"></i>
                                <span>
                                    Data Pekerja
                                </span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('pengalaman'); ?>" class="nav-link <?= isset($active_pengalaman) ? $active_pengalaman : ''; ?>">
                                <i class="ph-address-book"></i>
                                <span>
                                    Data Pengalaman
                                </span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('master/document'); ?>" class="nav-link <?= isset($active_document) ? $active_document : ''; ?>">
                                <i class="ph-file-cloud"></i>
                                <span>
                                    Dokumen Penting
                                </span>
                            </a>

                        </li>

                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Master</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>

                        <li class="nav-item nav-item-submenu <?= isset($open_master) ? $open_master : ''; ?>">
                            <a href="#" class="nav-link">
                                <i class="ph-database"></i>
                                <span>Master</span>
                            </a>
                            <ul class="nav-group-sub collapse <?= isset($show_master) ? $show_master : ''; ?>" data-submenu-title="Master">
                                <li class="nav-item">
                                    <a href="<?= base_url('master/employees'); ?>" class="nav-link <?= isset($active_employees) ? $active_employees : ''; ?>">Pegawai </a>
                                    <a href="<?= base_url('master/guarantee'); ?>" class="nav-link <?= isset($active_guarantee) ? $active_guarantee : ''; ?>">Sertifikat Garansi </a>
                                    <a href="<?= base_url('master/employment-status'); ?>" class="nav-link <?= isset($active_employment_status) ? $active_employment_status : ''; ?>">Status Kepegawaian </a>
                                    <a href="<?= base_url('master/type-expert'); ?>" class="nav-link <?= isset($active_type_expert) ? $active_type_expert : ''; ?>">Jenis Tenaga Ahli </a>
                                    <a href="<?= base_url('master/bahasa'); ?>" class="nav-link <?= isset($active_bahasa) ? $active_bahasa : ''; ?>">Bahasa</a>
                                    <a href="<?= base_url('master/pendidikan-akhir') ?>" class="nav-link <?= isset($active_pendidikan_akhir) ? $active_pendidikan_akhir : ''; ?>">Pendidikan Akhir</a>
                                    <a href="<?= base_url('master/kbli') ?>" class="nav-link <?= isset($active_kbli) ? $active_kbli : ''; ?>">KBLI</a>
                                    <a href="<?= base_url('master/kategori-pekerjaan') ?>" class="nav-link <?= isset($active_kategori_pekerjaan) ? $active_kategori_pekerjaan : ''; ?>">Kategori Pekerjaan</a>
                                    <a href="<?= base_url('master/jenis-instansi') ?>" class="nav-link <?= isset($active_jenis_instansi) ? $active_jenis_instansi : ''; ?>">Jenis Instansi</a>
                                    <a href="<?= base_url('master/nama-instansi') ?>" class="nav-link <?= isset($active_nama_instansi) ? $active_nama_instansi : ''; ?>">Nama Instansi</a>
                                    <a href="<?= base_url('master/satuan-kerja') ?>" class="nav-link <?= isset($active_satuan_kerja) ? $active_satuan_kerja : ''; ?>">Satuan Kerja</a>

                                <li class="nav-item nav-item-submenu <?= isset($open_region) ? $open_region : ''; ?>">
                                    <a href="#" class="nav-link">
                                        <i class="ph-globe-hemisphere-west"></i>
                                        <span>Wilayah</span>
                                    </a>
                                    <ul class="nav-group-sub collapse <?= isset($show_region) ? $show_region : ''; ?>" data-submenu-title="Master">
                                        <li class="nav-item">
                                            <a href="<?= base_url('master/country'); ?>" class="nav-link <?= isset($active_country) ? $active_country : ''; ?>">Negara</a>
                                            <a href="<?= base_url('master/province'); ?>" class="nav-link <?= isset($active_province) ? $active_province : ''; ?>">Provinsi</a>
                                            <a href="<?= base_url('master/regency'); ?>" class="nav-link <?= isset($active_regency) ? $active_regency : ''; ?>">Kota/Kabupaten</a>
                                            <a href="<?= base_url('master/district'); ?>" class="nav-link <?= isset($active_district) ? $active_district : ''; ?>">Kecamatan</a>
                                            <a href="<?= base_url('master/village'); ?>" class="nav-link <?= isset($active_village) ? $active_village : ''; ?>">Desa</a>
                                        </li>

                                    </ul>
                                </li>

                        </li>

                    </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users'); ?>" class="nav-link <?= isset($active_users) ? $active_users : ''; ?>">
                            <i class="ph-users"></i>
                            <span>
                                Pengguna
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('setting'); ?>" class="nav-link <?= isset($active_setting) ? $active_setting : ''; ?>">
                            <i class="ph-gear-six"></i>
                            <span>
                                Setting Web
                            </span>
                        </a>
                    </li>


                    <!-- /layout -->
                    </ul>
                </div>
                <!-- /main navigation -->
            </div>
            <!-- /sidebar content -->
        </div>
        <!-- /main sidebar -->