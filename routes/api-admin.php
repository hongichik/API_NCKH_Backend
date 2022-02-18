<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\AuthController;


Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth:api-admin'])->group(function () {
    // toàn bộ nội dung dc viết vào đây phải đăng nhập bằng token gửi bằng Authorization = Bearer [API token]
    Route::get('/home', function(){
        return 'đã đăng nhập';
    });



    //logout
    Route::get('/logout', function(Request $request){
        return $request->user()->currentAccessToken()->delete();    
    });
});