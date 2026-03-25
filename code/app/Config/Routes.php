<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Bo\AuthController::login');
$routes->get('/logout', 'Bo\AuthController::logout');
$routes->get('/showLogoApp', 'Bo\Dashboard::showLogoApp');

$routes->group('/auth', function ($routes) {
    $routes->get('loginbo', 'Bo\AuthController::login');
    $routes->post('proseslogin', 'Bo\AuthController::proseslogin');
});

$routes->group('/dashboard', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'DashboardController::index');
});

$routes->group('/structure', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'StructureController::index');
});

$routes->group('/surat', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'SuratController::surat');
    $routes->get('menuSurat', 'SuratController::menuSurat');
    $routes->post('menuSurat', 'SuratController::menuSurat');
    $routes->get('menu-surat', 'SuratController::menuSurat');
    $routes->post('menu-surat', 'SuratController::menuSurat');
    $routes->get('deleteSurat/(:segment)', 'SuratController::deleteSurat');
    $routes->get('lihatScanSurat/(:segment)', 'SuratController::lihatScanSurat');
    $routes->get('archive/(:segment)', 'SuratController::archive');
    $routes->get('unarchive/(:segment)', 'SuratController::unarchive');
});

$routes->group('/pekerja', ['filter' => 'authGuard'], function ($routes) {
    // Pekerja
    $routes->get('/', 'Bo\PekerjaControllers::index');
    $routes->get('export', 'Bo\PekerjaControllers::export');
    $routes->get('import', 'Bo\PekerjaControllers::import');
    $routes->post('import-save', 'Bo\PekerjaControllers::importSave');
});

$routes->group('/pengalaman', ['filter' => 'authGuard'], function ($routes) {
    // Pengalaman
    $routes->get('/', 'Bo\PengalamanPekerjaanControllers::index');
    $routes->get('export', 'Bo\PengalamanPekerjaanControllers::export');
    $routes->get('import', 'Bo\PengalamanPekerjaanControllers::import');
    $routes->post('import-save', 'Bo\PengalamanPekerjaanControllers::importSave');
});

$routes->group('/marketing', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo\Marketing',
], function ($routes) {

    $routes->group('ekatalog', function ($routes) {
        $routes->get('', 'EkatalogController::index');
        $routes->post('add', 'EkatalogController::add');
        $routes->post('update/(:segment)', 'EkatalogController::update/$1');
        $routes->get('delete/(:segment)', 'EkatalogController::delete/$1');
    });
});

$routes->group('/master', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo\Master',
], function ($routes) {
    $routes->get('struktur', 'Bo\Master::struktur');

    $routes->group('employees', function ($routes) {
        $routes->get('', 'EmployeesController::index');
        $routes->post('add', 'EmployeesController::add');
        $routes->post('update/(:segment)', 'EmployeesController::update/$1');
        $routes->get('delete/(:segment)', 'EmployeesController::delete/$1');
    });

    $routes->group('document', function ($routes) {
        $routes->get('', 'DocumentController::index');
        $routes->get('dokumenShow', 'Bo\Master::dokumenShow');
        $routes->post('add', 'DocumentController::add');
        $routes->post('update/(:segment)', 'DocumentController::update/$1');
        $routes->get('delete/(:segment)', 'DocumentController::delete/$1');
    });

    $routes->group('guarantee', function ($routes) {
        $routes->get('', 'GuaranteeController::index');
        $routes->post('add', 'GuaranteeController::add');
        $routes->post('update/(:segment)', 'GuaranteeController::update/$1');
        $routes->get('delete/(:segment)', 'GuaranteeController::delete/$1');
    });
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

$routes->group('/files', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('document/(:segment)', 'FilesController::document/$1');
});
$routes->group('/files', function ($routes) {
    $routes->get('logo', 'FilesController::logo');
});
