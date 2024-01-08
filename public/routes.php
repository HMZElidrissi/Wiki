<?php

use App\Controllers\VenteController;
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthentificationController;
use App\Controllers\MedicamentController;
use App\Controllers\VenteEnLigneController;
use App\Controllers\PatientController;

$router = new Router();

$router->get('/', HomeController::class, 'login');
$router->get('/dashboard', HomeController::class, 'dashboard');
$router->get('/register', HomeController::class, 'register');
$router->get('/medicaments', MedicamentController::class, 'displayMedicaments');
$router->get('/logout', AuthentificationController::class, 'logout');
$router->post('/buy', VenteEnLigneController::class, 'buy');
$router->post('/login', AuthentificationController::class, 'singIn');
$router->post('/register', AuthentificationController::class, 'singUp');
$router->get('/medicament_table', MedicamentController::class, 'D_medicament');
$router->post('/add_medicament', MedicamentController::class, 'A_medicament');
$router->post('/upp_medicament', MedicamentController::class, 'U_medicament');
$router->get('/delete_medicament', MedicamentController::class, 'delete_medicament');
$router->post('/export_pdf', MedicamentController::class, 'export_pdf');
$router->get('/VenteEnlingne', VenteController::class, 'Display_VentEnligne');
$router->get('/VenteEnmagasin', VenteController::class, 'display_ventEnmagasin');
$router->post('/add_vent', VenteController::class, 'Add_Vent');
$router->post('/update_vente', VenteController::class, 'update_vente');
$router->post('/vente_pdf', VenteController::class, 'export_pdf');
$router->get('/patient', PatientController::class, 'aficher');
$router->post('/insertpatient', PatientController::class, 'addPatient');
$router->post('/updatepatient', PatientController::class, 'upadatePatient');
$router->get('/deletePatient', PatientController::class, 'deletePatient');
$router->get('/sales_patient', VenteEnLigneController::class, 'getSalesOfPatient');
$router->post('/export_bon', VenteEnLigneController::class, 'exportBon');






return $router;