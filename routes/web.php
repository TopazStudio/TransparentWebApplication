<?php

//RE-ROUTE ALL TO FRONTEND
Route::get('/{catchall?}', function () {
    return view('index');
})->where('catchall', '(.*)');
