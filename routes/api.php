<?php

use App\Http\Controllers\appointmentController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\localController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\paymentMethodController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\teacherController;
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

// Rutas para courses
Route::get('courses', [courseController::class, 'getCourses']);
Route::post('courses', [courseController::class, 'createCourse']);
Route::get('courses/{id}', [courseController::class, 'getCourseById']);
Route::put('courses/{id}', [courseController::class, 'updateCourseById']);
Route::delete('courses/{id}', [courseController::class, 'deleteCourse']);

// Rutas para students
Route::get('students', [studentController::class, 'getStudents']);
Route::post('students', [studentController::class, 'createStudent']);
Route::get('students/{id}', [studentController::class, 'getStudentById']);
Route::put('students/{id}', [studentController::class, 'updateStudentById']);
Route::delete('students/{id}', [studentController::class, 'deleteStudent']);

// Rutas para teachers
Route::get('teachers', [teacherController::class, 'getTeachers']);
Route::post('teachers', [teacherController::class, 'createTeacher']);
Route::get('teachers/{id}', [teacherController::class, 'getTeacherById']);
Route::put('teachers/{id}', [teacherController::class, 'updateTeacherById']);
Route::delete('teachers/{id}', [teacherController::class, 'deleteTeacher']);

// Rutas para payments
Route::get('payments', [paymentController::class, 'getPayments']);
Route::post('payments', [paymentController::class, 'createPayment']);
Route::get('payments/{id}', [paymentController::class, 'getPaymentById']);
Route::put('payments/{id}', [paymentController::class, 'updatePaymentById']);
Route::delete('payments/{id}', [paymentController::class, 'deletePayment']);

// Rutas para clients
Route::get('clients', [clientController::class, 'getClients']);
Route::post('clients', [clientController::class, 'createClient']);
Route::get('clients/{id}', [clientController::class, 'getClientById']);
Route::put('clients/{id}', [clientController::class, 'updateClientById']);
Route::delete('clients/{id}', [clientController::class, 'deleteClient']);


// Rutas para appointments
Route::get('appointments', [appointmentController::class, 'getAppointments']);
Route::post('appointments', [appointmentController::class, 'createAppointment']);
Route::get('appointments/{id}', [appointmentController::class, 'getAppointmenById']);
Route::put('appointments/{id}', [appointmentController::class, 'updateAppointmentById']);
Route::delete('appointments/{id}', [appointmentController::class, 'deleteAppointment']);