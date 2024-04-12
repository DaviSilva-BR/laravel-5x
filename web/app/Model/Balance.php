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
       $transfer = $this->save();

       $historic = auth()->user()->historics()->create([
        'type' => 'I',
        'amount' => $value,
        'total_before' => $totalBefore,
        'total_after' => $this->amount,
        'date' => date('Ymd')
       ]);

       if($transfer && $historic){
        
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

 

    public function transfer(float $value, User $sender): Array 
    {
        if($this->amount < $value)
        return [
            'success' => false,
            'message' => 'saldo insuficiente'
        ];
    

    DB::beginTransaction();

    /** 
     * Atualiza o saldo do usuario logado
     */
    $totalBefore = $this->amount ? $this->amount : 0;
    $this->amount -= number_format($value, 2, '.', '');
   $transfer = $this->save();

   $historic = auth()->user()->historics()->create([
    'type'                 => 'T',
    'amount'                => $value,
    'total_before'          => $totalBefore,
    'total_after'           => $this->amount,
    'date'                  => date('Ymd'),
    'user_id_transaction' => $sender->id
   ]);


   /**
    * Atualizado o saldo do recebedor
    */
    $senderBalance = $sender->balance()->firstOrCreate([]);
    $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
    $senderBalance->amount += number_format($value, 2, '.', '');
    $transferSender = $senderBalance->save();

    $historicSender = $sender->historics()->create([
    'type'                   => 'I',
    'amount'                 => $value,
    'total_before'           => $totalBeforeSender,
    'total_after'            => $senderBalance->amount,
    'date'                   => date('Ymd'),
    'user_id_transaction'    => auth()->user()->id
    ]);


   if($transfer && $historic && $transferSender && $historicSender){
    
    DB::commit();
    return [
        'success' => true,
        'message' => 'Sucesso ao transferir'
    ];
    
   } else {

    DB::rollBack();
    return [
        'success' => false,
        'message' => 'Erro ao transfeir'
    ];

   }
    }
}
