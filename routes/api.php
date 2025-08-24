<?php

use Domains\Secret\Controllers\SecretController;
use Illuminate\Support\Facades\Route;

Route::get('secrets', [SecretController::class, 'index']);
