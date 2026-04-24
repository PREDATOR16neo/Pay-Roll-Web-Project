<?php

use Illuminate\Support\Facades\Route;

// Routing Admin
Route::get('/', function () {
    return view('admin.index');
});

Route::get('/position', function () {
    return view('admin.position');
});

Route::get('/employee', function () {
    return view('admin.pegawai');
});

Route::get('/user', function () {
    return view('admin.pengguna');
});
// End Routing Admin
