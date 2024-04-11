<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\User;
class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value): Array
    {

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
       $withdraw = $this->save();

       $historic = auth()->user()->historics()->create([
        'type' => 'I',
        'amount' => $value,
        'total_before' => $totalBefore,
        'total_after' => $this->amount,
        'date' => date('Ymd')
       ]);

       if($withdraw && $historic){
        
        DB::commit();
        return [
            'success' => true,
            'message' => 'Sucesso ao recarregar'
        ];
        
       } else {

        DB::rollBack();
        return [
            'success' => false,
            'message' => 'Erro ao recarregar'
        ];

       }
    }

    public function withdraw(float $value): Array
    {
        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'saldo insuficiente'
            ];
        

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
       $withdraw = $this->save();

       $historic = auth()->user()->historics()->create([
        'type' => 'O',
        'amount' => $value,
        'total_before' => $totalBefore,
        'total_after' => $this->amount,
        'date' => date('Ymd')
       ]);

       if($withdraw && $historic){
        
        DB::commit();
        return [
            'success' => true,
            'message' => 'Sucesso ao retirar'
        ];
        
       } else {

        DB::rollBack();
        return [
            'success' => false,
            'message' => 'Erro ao retirar'
        ];

       }

    }
}
