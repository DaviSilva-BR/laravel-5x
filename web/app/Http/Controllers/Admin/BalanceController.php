<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyValidationFormRequest;
class BalanceController extends Controller
{
    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;
        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function store(Request $request)
    {
        
        //$balance->deposit($request->value);
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);
        
        if($response['success']){
            return redirect()
            ->route('admin.balance.index')
            ->with('success', $response['message']);
        } else {
            return redirect()
            ->back()
            ->with('error', $response['message']);
        }
    }

    public function withdraw()
    {
       return view('admin.balance.withdraw');
    }

    public function withdrawStore(Request $request)
    {
        
        //$balance->deposit($request->value);
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);
        
        if($response['success']){
            return redirect()
            ->route('admin.balance.index')
            ->with('success', $response['message']);
        } else {
            return redirect()
            ->back()
            ->with('error', $response['message']);
        }
    }
}
