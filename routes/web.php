<?php

use App\Http\Controllers\LivewireController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LivewireController::class, 'index']);
