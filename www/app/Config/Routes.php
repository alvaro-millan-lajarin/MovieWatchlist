<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->get('/sign-up', 'RegisterController::signUp');
$routes->post('/sign-up', 'RegisterController::signUpPost');

$routes->get('/sign-in', 'LoginController::signIn');
$routes->post('/sign-in', 'LoginController::signInPost');

$routes->get('/', 'HomeController::index');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/movies', 'MovieSearchController::index');


$routes->get('/movie/(:num)', 'MovieController::details/$1');
$routes->post('/movie/(:num)', 'MovieController::addComment/$1');

$routes->post('/favorites', 'MovieController::toggleFavorite');
$routes->post('/shared', 'MovieController::shareMovie');

$routes->get('/favorites', 'FavoritesController::index');

$routes->get('/shared', 'SharedMoviesController::index');






