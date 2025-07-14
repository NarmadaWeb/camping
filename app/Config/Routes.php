<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");

// User routes
$routes->resource("users", ["controller" => "User"]);

// Authentication routes
$routes->get("register", "AuthController::register");
$routes->post("register/store", "AuthController::store");
$routes->get("login", "AuthController::login");
$routes->post("login/auth", "AuthController::auth");
$routes->get("logout", "AuthController::logout");

// Dashboard route (for after login)
$routes->get("dashboard", "Home::dashboard", ["filter" => "auth"]);

// Campsites routes
$routes->get("campsites", "CampsiteController::index", ["filter" => "auth"]);
$routes->get("campsites/view/(:num)", "CampsiteController::show/$1", [
    "filter" => "auth",
]);

// Booking routes
$routes->get("my-bookings", "BookingController::index", ["filter" => "auth"]);
$routes->post("bookings/store", "BookingController::store", [
    "filter" => "auth",
]);
$routes->get("bookings/cancel/(:num)", "BookingController::cancel/$1", [
    "filter" => "auth",
]);

// Payment routes
$routes->get("payments/checkout/(:num)", "PaymentController::checkout/$1", [
    "filter" => "auth",
]);
$routes->post("payments/store", "PaymentController::store", [
    "filter" => "auth",
]);
$routes->get("my-payments", "PaymentController::myPayments", [
    "filter" => "auth",
]);
$routes->get("bookings/payment/(:num)", "BookingController::viewPayment/$1", [
    "filter" => "auth",
]);

// Admin routes
$routes->group("admin", ["filter" => "admin"], function ($routes) {
    $routes->get("dashboard", "AdminController::dashboard");
    $routes->get("campsites", "AdminController::campsites");
    $routes->get("add-campsite", "AdminController::addCampsite");
    $routes->post("add-campsite", "AdminController::addCampsite");
    $routes->get("edit-campsite/(:num)", "AdminController::editCampsite/$1");
    $routes->post("edit-campsite/(:num)", "AdminController::editCampsite/$1");
    $routes->get(
        "delete-campsite/(:num)",
        "AdminController::deleteCampsite/$1"
    );
    $routes->get("bookings", "AdminController::bookings");
    $routes->post(
        "update-booking-status/(:num)",
        "AdminController::updateBookingStatus/$1"
    );
    $routes->get("payments", "AdminController::payments");
    $routes->get("payment/(:num)", "PaymentController::adminView/$1");
    $routes->post(
        "update-payment-status/(:num)",
        "AdminController::updatePaymentStatus/$1"
    );
    $routes->get("users", "AdminController::users");
    $routes->get("reports", "AdminController::reports");
});
