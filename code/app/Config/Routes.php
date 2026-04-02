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

$routes->group('/pekerja', [
    'filter'    => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'PekerjaController::index');
    $routes->get('view/(:segment)', 'PekerjaController::view/$1');

    $routes->get('add', 'PekerjaController::create');
    $routes->post('add', 'PekerjaController::add');

    $routes->get('edit/(:segment)', 'PekerjaController::edit/$1');
    $routes->post('edit/(:segment)', 'PekerjaController::update/$1');

    $routes->get('delete/(:segment)', 'PekerjaController::delete/$1');

    $routes->get('import-example', 'PekerjaController::importExample');
    $routes->post('import-save', 'PekerjaController::importSave');
    $routes->get('export', 'PekerjaController::export');
});

$routes->group('/pengalaman', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('', 'PengalamanPekerjaanController::index');
    $routes->get('view/(:segment)', 'PengalamanPekerjaanController::view/$1');

    $routes->get('add', 'PengalamanPekerjaanController::create');
    $routes->post('add', 'PengalamanPekerjaanController::add');

    $routes->get('edit/(:segment)', 'PengalamanPekerjaanController::edit/$1');
    $routes->post('edit/(:segment)', 'PengalamanPekerjaanController::update/$1');

    $routes->get('delete/(:segment)', 'PengalamanPekerjaanController::delete/$1');

    $routes->get('import-example', 'PengalamanPekerjaanController::importExample');
    $routes->post('import-save', 'PengalamanPekerjaanController::importSave');
    $routes->get('export', 'PengalamanPekerjaanController::export');
});

$routes->group('/pengalaman-pekerja', [
    'filter' => 'authGuard',
    'namespace' => 'App\Controllers\Bo',
], function ($routes) {
    $routes->get('add/(:segment)', 'PengalamanPekerjaController::add/$1');
    $routes->get('get-available/(:segment)', 'PengalamanPekerjaController::getAvailable/$1');
    $routes->post('save', 'PengalamanPekerjaController::save');
    $routes->get('delete/(:segment)', 'PengalamanPekerjaController::delete/$1');
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

    $routes->group('country', function ($routes) {
        $routes->get('', 'CountryController::index');
        $routes->post('add', 'CountryController::add');
        $routes->post('update/(:segment)', 'CountryController::update/$1');
        $routes->get('delete/(:segment)', 'CountryController::delete/$1');
    });
    $routes->group('province', function ($routes) {
        $routes->get('', 'ProvinceController::index');
        $routes->post('add', 'ProvinceController::add');
        $routes->post('update/(:segment)', 'ProvinceController::update/$1');
        $routes->get('delete/(:segment)', 'ProvinceController::delete/$1');
    });
    $routes->group('regency', function ($routes) {
        $routes->get('', 'RegencyController::index');
        $routes->post('add', 'RegencyController::add');
        $routes->post('update/(:segment)', 'RegencyController::update/$1');
        $routes->get('delete/(:segment)', 'RegencyController::delete/$1');
        $routes->get('get-specific', 'RegencyController::getSpecific');
    });
    $routes->group('district', function ($routes) {
        $routes->get('', 'DistrictController::index');
        $routes->post('add', 'DistrictController::add');
        $routes->post('update/(:segment)', 'DistrictController::update/$1');
        $routes->get('delete/(:segment)', 'DistrictController::delete/$1');
    });
    $routes->group('village', function ($routes) {
        $routes->get('', 'VillageController::index');
        $routes->post('add', 'VillageController::add');
        $routes->post('update/(:segment)', 'VillageController::update/$1');
        $routes->get('delete/(:segment)', 'VillageController::delete/$1');
    });
    $routes->group('employment-status', function ($routes) {
        $routes->get('', 'EmploymentStatusController::index');
        $routes->post('add', 'EmploymentStatusController::add');
        $routes->post('update/(:segment)', 'EmploymentStatusController::update/$1');
        $routes->get('delete/(:segment)', 'EmploymentStatusController::delete/$1');
    });
    $routes->group('type-expert', function ($routes) {
        $routes->get('', 'TypeExpertController::index');
        $routes->post('add', 'TypeExpertController::add');
        $routes->post('update/(:segment)', 'TypeExpertController::update/$1');
        $routes->get('delete/(:segment)', 'TypeExpertController::delete/$1');
    });
    $routes->group('bahasa', function ($routes) {
        $routes->get('', 'BahasaController::index');
        $routes->post('add', 'BahasaController::add');
        $routes->post('update/(:segment)', 'BahasaController::update/$1');
        $routes->get('delete/(:segment)', 'BahasaController::delete/$1');
    });
    $routes->group('pendidikan-akhir', function ($routes) {
        $routes->get('', 'PendidikanAkhirController::index');
        $routes->post('add', 'PendidikanAkhirController::add');
        $routes->post('update/(:segment)', 'PendidikanAkhirController::update/$1');
        $routes->get('delete/(:segment)', 'PendidikanAkhirController::delete/$1');
    });
    $routes->group('kbli', function ($routes) {
        $routes->get('', 'KbliController::index');
        $routes->post('add', 'KbliController::add');
        $routes->post('update/(:segment)', 'KbliController::update/$1');
        $routes->get('delete/(:segment)', 'KbliController::delete/$1');
    });
    $routes->group('kategori-pekerjaan', function ($routes) {
        $routes->get('', 'KategoriPekerjaanController::index');
        $routes->post('add', 'KategoriPekerjaanController::add');
        $routes->post('update/(:segment)', 'KategoriPekerjaanController::update/$1');
        $routes->get('delete/(:segment)', 'KategoriPekerjaanController::delete/$1');
    });
    $routes->group('jenis-instansi', function ($routes) {
        $routes->get('', 'JenisInstansiController::index');
        $routes->post('add', 'JenisInstansiController::add');
        $routes->post('update/(:segment)', 'JenisInstansiController::update/$1');
        $routes->get('delete/(:segment)', 'JenisInstansiController::delete/$1');
    });
    $routes->group('nama-instansi', function ($routes) {
        $routes->get('', 'NamaInstansiController::index');
        $routes->post('add', 'NamaInstansiController::add');
        $routes->post('update/(:segment)', 'NamaInstansiController::update/$1');
        $routes->get('delete/(:segment)', 'NamaInstansiController::delete/$1');
    });
    $routes->group('satuan-kerja', function ($routes) {
        $routes->get('', 'SatuanKerjaController::index');
        $routes->post('add', 'SatuanKerjaController::add');
        $routes->post('update/(:segment)', 'SatuanKerjaController::update/$1');
        $routes->get('delete/(:segment)', 'SatuanKerjaController::delete/$1');
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
