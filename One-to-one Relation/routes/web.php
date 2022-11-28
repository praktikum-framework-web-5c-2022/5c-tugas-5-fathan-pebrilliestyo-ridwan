<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;


Route::get('/', function () {
    return view('member.index');
});

Route::prefix('member')->group(function(){
    Route::get('/index', [MemberController::class,'index'])->name('member.index');
    Route::get('/edit/{id}', [MemberController::class,'edit'])->name('member.edit');
    Route::get('/create', [MemberController::class,'create'])->name('member.create');
    Route::post('/insert',[MemberController::class,'insert'])->name('member.insert');
    Route::post('/update/{id}', [MemberController::class,'update'])->name('member.update');
    Route::delete('/delete/{id}', [MemberController::class,'delete'])->name('member.delete');
});
