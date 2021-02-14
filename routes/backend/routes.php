<?php

    Route::group(["prefix"=>"admin", "as"=>"backend", "namespace"=>"Backend"], function (){
        Route::group(["prefix"=>"settings", "as"=>".settings","namespace"=>"Settings"], function (){
            Route::get("/","settingsController@show")->name(".show");
            Route::post("/update","settingsController@update")->name(".update");
            Route::post("/create","settingsController@create")->name(".create");
            Route::post("/delete","settingsController@delete")->name(".delete");
        });
    });