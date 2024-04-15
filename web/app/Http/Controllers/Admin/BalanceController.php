<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Model\Historic;
use App\User;

class BalanceController extends Controller
{
    private $totalPage = 2;
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
    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function transferSearch(Request $request, User $user)
    {
        if((!$sender = $user->getSender($request->sender)) || $sender->id === auth()->user()->id){
            return redirect()
                ->back()
                ->with('error', 'Operação inválida, verifique o email da pessoa que vai receber o valor');
     
        } else {
            $balance = auth()->user()->balance;
            return view('admin.balance.transfer-confirm', compact('sender', 'balance'));
        }
        
    }

    public function transferStore(Request $request, User $user)
    {
        if(!$sender = $user->find($request->sender_id)){
            return redirect()
            ->route('admin.balance.transfer.index')
            ->with('error', 'Remetente não encontrado');
        }
        
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $sender);
        
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

   public function historic(Historic $historic)
   {
        $historics = auth()->user()->
            historics()
            ->with(['userSender'])
            ->paginate($this->totalPage);

        $types = $historic->type();    
        return view('admin.historic.index', compact('historics', 'types'));
   }


   public function historicSearch(Request $request, Historic $historic)
   {
    $dataForm = $request->except('_token');

    $historics = $historic->search($dataForm, $this->totalPage);

    $types = $historic->type();

    return view('admin.historic.index', compact('historics', 'types', 'dataForm'));
}
}
    
    
