<?php

use App\Http\Controllers\localController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\paymentMethodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas para local
Route::get('locals', [localController::class, 'getLocals']);
Route::post('locals', [localController::class, 'createLocals']);
Route::get('locals/{id}', [localController::class, 'getLocalById']);
Route::put('locals/{id}', [localController::class, 'updateLocalById']);
Route::delete('locals/{id}', [localController::class, 'deleteLocal']);

// Rutas para supplier
Route::get('suppliers', [supplierController::class, 'getSuppliers']);
Route::post('suppliers', [supplierController::class, 'createSupplier']);
Route::get('suppliers/{id}', [supplierController::class, 'getSupplierById']);
Route::put('suppliers/{id}', [supplierController::class, 'updateSupplierById']);
Route::delete('suppliers/{id}', [supplierController::class, 'deleteSupplier']);

// Rutas para service
Route::get('services', [serviceController::class, 'getServices']);
Route::post('services', [serviceController::class, 'createService']);
Route::get('services/{id}', [serviceController::class, 'getServiceById']);
Route::put('services/{id}', [serviceController::class, 'updateServiceById']);
Route::delete('services/{id}', [serviceController::class, 'deleteService']);

// Rutas para paymentMethod
Route::get('paymentMethods', [paymentMethodController::class, 'getPaymentMethods']);
Route::post('paymentMethods', [paymentMethodController::class, 'createPaymentMethod']);
Route::get('paymentMethods/{id}', [paymentMethodController::class, 'getPaymentMethodById']);
Route::put('paymentMethods/{id}', [paymentMethodController::class, 'updatePaymentMethodById']);
Route::delete('paymentMethods/{id}', [paymentMethodController::class, 'deletePaymentMethod']);