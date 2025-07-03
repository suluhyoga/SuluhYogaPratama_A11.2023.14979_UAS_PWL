<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Halaman Publik ---
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// --- Halaman Setelah Login (admin dan user) ---
$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('/beranda', 'Home::homepage');
    $routes->get('/tentang', 'Home::about');
    $routes->get('/kontak', 'Home::contact');
    $routes->post('/kontak/submit', 'Contact::submit');
    $routes->get('/produk', 'Home::product');
    $routes->get('/profile', 'Home::profile'); // Pastikan rute profil ada di dalam filter login

    // Produk Detail
    $routes->get('/product/product_beras', 'Home::product_beras');
    $routes->get('/product/product_minyakgoreng', 'Home::product_minyakgoreng');
    $routes->get('/product/product_mieinstan', 'Home::product_mieinstan');
    $routes->get('/product/product_gulapasir', 'Home::product_gulapasir');
    $routes->get('/product/product_kecap', 'Home::product_kecap');
    $routes->get('/product/product_sarden', 'Home::product_sarden');
    $routes->get('/product/product_teh', 'Home::product_teh');
    $routes->get('/product/product_sirup', 'Home::product_sirup');

    // Keranjang
    $routes->group('keranjang', function ($routes) {
        $routes->get('/', 'Keranjang::index');
        $routes->post('tambah', 'Keranjang::tambah');
        $routes->get('tambahLangsung/(:segment)', 'Keranjang::tambahLangsung/$1');
        $routes->post('edit', 'Keranjang::edit');
        $routes->get('delete/(:segment)', 'Keranjang::delete/$1');
        $routes->get('clear', 'Keranjang::clear');
    });

    // Checkout dan Raja Ongkir API
    $routes->get('checkout', 'Keranjang::checkout');
    $routes->get('get-location', 'Keranjang::getLocation');
    $routes->get('get-cost', 'Keranjang::getCost');

    // Midtrans Integration Routes - Ditempatkan di dalam filter login jika hanya user terautentikasi yang bisa melakukan transaksi
    $routes->post('buy', 'Keranjang::buy');
    $routes->get('checkout/payment/(:num)', 'Keranjang::payment/$1');

    // Rute Khusus Admin
    $routes->group('admin', ['filter' => 'admin'], function ($routes) {
        $routes->get('riwayat', 'AdminController::riwayat');
    });
});

// CRUD Product
$routes->group('data_product', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

// CRUD Category
$routes->group('data_category', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'KategoriController::index');
    $routes->post('edit/(:any)', 'KategoriController::edit/$1');
});

// CRUD Feedback
$routes->group('data_feedback', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'FeedbackController::index');
    $routes->get('delete/(:any)', 'FeedbackController::delete/$1');
});

// CRUD User
$routes->group('data_user', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'UserController::index');
    $routes->post('', 'UserController::create');
    $routes->post('edit/(:any)', 'UserController::edit/$1');
});

// Rute Midtrans Callback
// Karena Midtrans akan memanggil endpoint ini tanpa otentikasi user
$routes->post('/midtrans/callback', 'Keranjang::midtransCallback');

// Web Service (API)
$routes->resource('api', ['controller' => 'ApiController']);
