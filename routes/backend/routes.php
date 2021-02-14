<?php

    Route::group(["prefix"=>"admin", "as"=>"backend", "namespace"=>"Backend"], function (){
        Route::group(["prefix"=>"settings", "as"=>".settings","namespace"=>"Settings"], function (){
            Route::get("/","settingsController@show")->name(".show");
        });
    });