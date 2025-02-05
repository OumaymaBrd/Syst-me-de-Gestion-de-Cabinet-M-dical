<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\Router;

$router = new Router();

// Define routes
$router->addRoute('GET', '/', 'AuthController@login');
$router->addRoute('GET', '/login', 'AuthController@login');
$router->addRoute('POST', '/login', 'AuthController@login');
$router->addRoute('GET', '/register', 'AuthController@register');
$router->addRoute('POST', '/register', 'AuthController@register');
$router->addRoute('GET', '/logout', 'AuthController@logout');

// Admin routes
$router->addRoute('GET', '/admin/dashboard', 'AdminController@dashboard');
$router->addRoute('GET', '/admin/users', 'AdminController@users');
$router->addRoute('GET', '/admin/appointments', 'AdminController@appointments');

// Patient routes
$router->addRoute('GET', '/patient/profile', 'PatientController@profile');
$router->addRoute('GET', '/patient/appointments', 'PatientController@appointments');
$router->addRoute('GET', '/patient/book-appointment', 'PatientController@bookAppointment');
$router->addRoute('POST', '/patient/book-appointment', 'PatientController@bookAppointment');

// Medecin routes
$router->addRoute('GET', '/medecin/profile', 'MedecinController@profile');
$router->addRoute('GET', '/medecin/schedule', 'MedecinController@schedule');
$router->addRoute('GET', '/medecin/update-availability', 'MedecinController@updateAvailability');
$router->addRoute('POST', '/medecin/update-availability', 'MedecinController@updateAvailability');

// Appointment routes
$router->addRoute('GET', '/appointments', 'AppointmentController@index');
$router->addRoute('POST', '/appointments/create', 'AppointmentController@create');
$router->addRoute('POST', '/appointments/update', 'AppointmentController@update');
$router->addRoute('POST', '/appointments/delete', 'AppointmentController@delete');

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$router->addRoute('GET', '/register', 'AuthController@register');
$router->addRoute('POST', '/register', 'AuthController@register');