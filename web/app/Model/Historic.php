<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
   protected $fillable = [
    'type',
    'amount',
    'total_before',
    'total_after',
    'date'
   ];

   public function type($type = null)
   {
      $types = [
         'I' => 'Entrada',
         'O' => 'Saque',
         'T' => 'Transferencia'
      ];

      if(!$type)
         return $types;

      if($this->user_id_transaction != null && $type == "I")
         return 'Recebido';

      return $types[$type];
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function userSender()
   {
      return $this->belongsTo(User::class, 'user_id_transaction');
   }

   public function getDateAttribute($value)
   {
      return Carbon::parse($value)->format('d/m/Y');
   }

   public function search(Array $data, $totalPage)
   {
      return  $this->where(function ($query) use ($data) {
         if(isset($data['id']))
            $query->where('id', $data['id']);

         if(isset($data['date']))
         $query->where('date', $data['date']);

         if(isset($data['type']))
         $query->where('type', $data['type']);

      })
      ->paginate($totalPage);
   }
}
