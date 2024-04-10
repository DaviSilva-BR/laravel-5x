<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    $this->get('/', 'AdminController@index')->name('admin.home');
    $this->get('balance', 'BalanceController@index')->name('balance.index');
    $this->get('balance/deposit', 'BalanceController@deposit')->name('balance.deposit');
    $this->post('balance/deposit/store', 'BalanceController@store')->name('balance.deposit.store');

});

$this->get('/', 'Site\SiteController@index')->name('site.home');



Auth::routes();


