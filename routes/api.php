<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\AuthController;


Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth:api-user'])->group(function () {
    // toàn bộ nội dung dc viết vào đây phải đăng nhập bằng token gửi bằng 
    Route::get('/home', function(){
        return 'đã đăng nhập';
    });

});
