<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use App\Models\Income;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $incomes  =Income::all();


        
        if ($user->branch_id) {
            $incomes = $incomes->where('branch_id', $user->branch_id);

        }



        $params = [
        
            'incomes' => $incomes,
          
        

        ];
        return view('dashboard.account.index', $params);
    }



    /**
     * Display the specified resource.
     *
     * @param  Income  $fcategory
     * @return Response
     */
    public function show(Income $income)
    {

        $transactions = Transaction::all();
        $incomes_detail    = $transactions->where('type','=','Income');
       
        $transactions = $transactions->where('date', $income->date);
        $expenses_detail    = $transactions->where('type','=','Expense');

        $params = [
            'income' => $income,
            'incomes_detail' => $incomes_detail,
            'expenses_detail' => $expenses_detail,
        ];
        return view('dashboard.account.show', $params);
    }

    /**
     * Display the summarised resource.
     *
     * @param  Income  $income
     * @return Response
     */
    public function summary(Request $request)
    {       
        
            $user = Auth::user();
            $incomes  =Income::all();
            $total_expenses = Transaction::latest();
            $total_incomes = Transaction::latest();
       

        if ($user->branch_id) {
            
                $incomes = $incomes->where('branch_id', $user->branch_id);
                $total_expenses    = $total_expenses->where('branch_id', $user->branch_id);
                $total_incomes    = $total_incomes->where('branch_id', $user->branch_id);
        }

         
            $ticket_sale = $incomes->first();
            $total_expense = $total_expenses->where('type','=','Expense')->sum('total');
            $total_income = $total_incomes->where('type','=','Income')->sum('total');

  // dd($ticket_sale);

        $params = [

            'ticket_sale' => $ticket_sale,
            'total_expense' => $total_expense,
            'total_income' => $total_income,
        ];
        return view('dashboard.account.summary', $params);
    }


    /**
     * Display the specified resource.
     *
     * @param  Income  $fcategory
     * @return Response
     */
    public function detail(Request $request)
    {

        $account_categories = AccountCategory::all();


        $incomes_detail    = $account_categories->where('type','=','Income');
        $expenses_detail    = $account_categories->where('type','=','Expense');

        
   //     $transactions = $transactions->where('date', $income->date);
       
        $params = [

            'incomes_detail' => $incomes_detail,
            'expenses_detail' => $expenses_detail,
            'filter'    => [
                'date'      => $request->date,
            ],
        ];
        return view('dashboard.account.detail', $params);
    }

    

}
