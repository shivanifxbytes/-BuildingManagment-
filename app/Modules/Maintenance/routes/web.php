<?php

Route::group(['module' => 'Maintenance', 'middleware' => ['web'], 'namespace' => 'App\Modules\Maintenance\Controllers'], function() {

    Route::resource('maintenance', 'MaintenanceController');

});
