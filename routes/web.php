<?php

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/deal-stage/{deal}', function (Request $request, Deal $deal) {
    $request->validate([
        'stage' => 'required|string',
    ]);

    $deal->update([
        'stage' => $request->stage,
    ]);

    return back();
})->name('deal.stage.update');