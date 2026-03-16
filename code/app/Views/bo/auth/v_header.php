<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>

    <!-- Global stylesheets -->
    <link href="<?= base_url('assets/bo/fonts/inter/inter.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/bo/icons/phosphor/styles.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/bo/css/ltr/all.min.css'); ?>" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?= base_url('assets/bo/demo/demo_configurator.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/jquery/jquery.min.js'); ?>"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url('assets/bo/js/vendor/notifications/sweet_alert.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/app.js'); ?>"></script>
    <script src="<?= base_url('assets/bo/js/custom.js'); ?>"></script>
    <!-- /theme JS files -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
    <?php if (session()->getFlashdata('success') !== null) { ?>
        <div id="sweet_success_custom" data-message="<?= session()->getFlashdata('success'); ?>"></div>
    <?php } elseif (session()->getFlashdata('error')) { ?>
        <div id="sweet_error_custom" data-message='<?= session()->getFlashdata('error') ?>'></div>
    <?php } ?>

    <!-- Main navbar -->
    <div class="navbar bg-primary navbar-static py-2">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="<?= base_url(''); ?>" class="d-inline-flex align-items-center">
                    <img src="<?= base_url('showLogoApp'); ?>" alt="">
                </a>
            </div>
        </div>
    </div>
    <!-- /main navbar -->