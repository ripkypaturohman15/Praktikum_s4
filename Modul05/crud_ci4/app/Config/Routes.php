<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/mahasiswa', 'MahasiswaController::index');
$routes->get('/mahasiswa/create', 'MahasiswaController::create');
$routes->post('/mahasiswa/store', 'MahasiswaController::store');
