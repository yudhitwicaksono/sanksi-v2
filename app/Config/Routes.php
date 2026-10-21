<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->get('login/index', 'Login::index');
$routes->post('login/validasiLogin', 'Login::validasiLogin');
$routes->get('login/logout', 'Login::logout');

// Surat Panggilan Orang Tua Routes
$routes->get('surat_penggilan_orang_tua', 'Main::surat_penggilan_orang_tua');
$routes->get('surat_panggilan_orang_tua', 'Main::surat_panggilan_orang_tua');
$routes->get('main/surat_penggilan_orang_tua', 'Main::surat_penggilan_orang_tua');
$routes->get('main/surat_panggilan_orang_tua', 'Main::surat_panggilan_orang_tua');
$routes->get('main/data_wali_muridP', 'Main::surat_penggilan_orang_tua');
$routes->get('main/kirim_email_surat/(:any)/(:any)', 'Main::kirim_email_surat/$1/$2');
$routes->get('kirim_email_surat/(:any)/(:any)', 'Main::kirim_email_surat/$1/$2');
$routes->get('main/download_pdf_surat/(:any)/(:any)', 'Main::download_pdf_surat/$1/$2');
$routes->get('download_pdf_surat/(:any)/(:any)', 'Main::download_pdf_surat/$1/$2');

