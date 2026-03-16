<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Bo\Auth::login');
$routes->get('/logout', 'Bo\Auth::logout');
$routes->get('/showLogoApp', 'Bo\Dashboard::showLogoApp');

$routes->group('/auth', function ($routes) {
    $routes->get('loginbo', 'Bo\Auth::login');
    $routes->post('proseslogin', 'Bo\Auth::proseslogin');
});

$routes->group('/dashboard', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('', 'Bo\Dashboard::index');
});

$routes->group('/surat', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('', 'Bo\Surat::surat');
    $routes->get('menuSurat', 'Bo\Surat::menuSurat');
    $routes->post('menuSurat', 'Bo\Surat::menuSurat');
    $routes->get('deleteSurat/(:segment)', 'Bo\Surat::deleteSurat');
    $routes->get('lihatScanSurat/(:segment)', 'Bo\Surat::lihatScanSurat');
    $routes->get('archive/(:segment)', 'Bo\Surat::archive');
    $routes->get('unarchive/(:segment)', 'Bo\Surat::unarchive');
});

$routes->group('/marketing', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('ekatalog', 'Bo\Marketing::ekatalog');
    $routes->post('ekatalogAdd', 'Bo\Marketing::ekatalogAdd');
    $routes->post('ekatalogEdit', 'Bo\Marketing::ekatalogEdit');
    $routes->get('ekatalogDelete/(:segment)', 'Bo\Marketing::ekatalogDelete');
});

$routes->group('/master', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('pegawai', 'Bo\Master::pegawai');
    $routes->post('pegawaiAdd', 'Bo\Master::pegawaiAdd');
    $routes->post('pegawaiEdit', 'Bo\Master::pegawaiEdit');
    $routes->get('pegawaiDelete/(:segment)', 'Bo\Master::pegawaiDelete');

    $routes->get('struktur', 'Bo\Master::struktur');

    $routes->get('dokumen', 'Bo\Master::dokumen');
    $routes->get('dokumenShow', 'Bo\Master::dokumenShow');
    $routes->post('dokumenAdd', 'Bo\Master::dokumenAdd');
    $routes->get('dokumenDelete/(:segment)', 'Bo\Master::dokumenDelete');

    $routes->get('garansi', 'Bo\Master::garansi');
    $routes->post('garansiAdd', 'Bo\Master::garansiAdd');
    $routes->post('garansiEdit', 'Bo\Master::garansiEdit');
    $routes->get('garansiDelete/(:segment)', 'Bo\Master::garansiDelete');
});

$routes->group('/setting', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('', 'Bo\Dashboard::setting');
    $routes->post('prosesSetting', 'Bo\Dashboard::prosesSetting');
    $routes->post('prosesSettingKode', 'Bo\Dashboard::prosesSettingKode');

    $routes->get('pengguna', 'Bo\Dashboard::pengguna');
    $routes->post('penggunaAdd', 'Bo\Dashboard::penggunaAdd');
    $routes->post('penggunaEdit', 'Bo\Dashboard::penggunaEdit');
    $routes->get('penggunaDelete/(:segment)', 'Bo\Dashboard::penggunaDelete');
});
