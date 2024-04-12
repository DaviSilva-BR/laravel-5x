<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    $this->get('/', 'AdminController@index')->name('admin.home');
    $this->get('balance', 'BalanceController@index')->name('admin.balance.index');
    $this->get('balance/deposit', 'BalanceController@deposit')->name('admin.balance.deposit');
    $this->post('balance/deposit/store', 'BalanceController@store')->name('admin.balance.deposit.store');

    $this->get('balance/withdraw', 'BalanceController@withdraw')->name('admin.balance.withdraw.index');
    $this->post('balance/withdraw/store', 'BalanceController@withdrawStore')->name('admin.balance.withdraw.store');

    $this->get('balance/transfer', 'BalanceController@transfer')->name('admin.balance.transfer.index');
    $this->post('balance/transfer/search', 'BalanceController@transferSearch')->name('admin.balance.transfer.search');
    $this->post('balance/transfer/store', 'BalanceController@transferStore')->name('admin.balance.transfer.store');

});

$this->get('/', 'Site\SiteController@index')->name('site.home');



Auth::routes();


