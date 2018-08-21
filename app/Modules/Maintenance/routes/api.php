<?php

Route::group(['module' => 'Maintenance', 'middleware' => ['api'], 'namespace' => 'App\Modules\Maintenance\Controllers'], function() {

    Route::resource('maintenance', 'MaintenanceController');

});
