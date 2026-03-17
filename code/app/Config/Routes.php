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
    $routes->group('employees', [
        'namespace' => 'App\Controllers\Bo\Master',
    ], function ($routes) {
        $routes->get('', 'EmployeesController::index');
        $routes->post('pegawaiAdd', 'EmployeesController::pegawaiAdd');
        $routes->post('pegawaiEdit', 'EmployeesController::pegawaiEdit');
        $routes->get('pegawaiDelete/(:segment)', 'EmployeesController::pegawaiDelete');
    });

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

$routes->group('/users', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'UsersController::index');
    $routes->post('create', 'UsersController::create');
    $routes->post('update/(:segment)', 'UsersController::update/$1');
    $routes->get('delete/(:segment)', 'UsersController::delete/$1');
});

$routes->group('/setting', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'SettingController::index');

    $routes->post('update/(:segment)', 'SettingController::update/$1');
    $routes->post('update-kode/(:segment)', 'SettingController::updateKode/$1');
});
