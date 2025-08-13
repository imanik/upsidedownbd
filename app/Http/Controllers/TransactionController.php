<?php

namespace App\Http\Controllers;

use Session;
use App\Helpers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Transaction;
use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
        $transactions_all = Transaction::latest()->get();
      //  $new_transactions = Transaction::whereDate('created_at', Carbon::today())->count() ?? 0;
      $month = "2022-01";
      //$month = $request->month ?? date('Y-m');
      $month_first_day = Carbon::parse(date('Y-m-d', strtotime($month)))->startOfMonth()->format('w');
      $date = Carbon::parse(date('Y-m-d', strtotime($month)))->format('Y-m-d');
      $expenses = Transaction:: groupBy('date')->selectRaw("sum(amount) as amount, DATE(date) as date")->where("type","Expenses")->get();
   //   $transaction_count = $transaction_amount->count();
   //   $transactions = [];
    //   for ($i = 0; $i < $transaction_count; $i++) {
    // //       $transactions[] = [

    // //         'date'      => $transaction_amount[$i]->date,
    // //         'amount'      => $transaction_amount[$i]->amount,


    // //    //       'date'      => Carbon::parse($date)->format('d/m/Y'),
    // //     //      'transaction_count' => Transaction::whereDate('created_at', $date)->get()->count(),



    // //       ];
    //       $date = Carbon::parse($date)->addDay()->format('Y-m-d');
    //   }

//dd($transactions);
 //       dd($transaction_amount[28]->amount);
        $params = [
            'expenses' => $expenses,
         //   'calenders' => $calenders,
        ];
        return view('dashboard.transaction.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


        $account_categories = AccountCategory::latest()->get();

        $account_category_box = AccountCategory::all()->map(function ($account_category) {

            return [
                'account_category_id' => $account_category->id,
                'account_category'    => $account_category,
            ];
        })->toArray();


        $params = [
            'account_categories'       => $account_categories,
            'account_category_box'     => array_column($account_category_box, 'account_category', 'account_category_id'),
        ];

        return view('dashboard.transaction.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    //    dd($request);

        $user = Auth::user();
        $user_id =  Auth::user()->id;

        $branch = Branch::where('id', $user->branch_id)->first();
    //    $branch = Branch::where('id', 2)->first();

        if (!$branch) {
            return back()->withInput()->with('fail', __('Branch not found!'));
        }


        $account_category = AccountCategory::where('id', $request->account_category)->first();
    //    dd($type);
    //    $total = ($request->adult_number * $branch->regular_price) + ($request->child_number * $branch->child_price) + ($request->discount_number * $request->discount_amount) +($request->dslr_type1_number * 300) + ($request->dslr_type2_number * 500);

    //    $grand_total = $total;

        $request->validate([
            'date'                  => ['required', 'string', 'max:191'],
            'amount'                => ['required', 'string', 'max:191'],
            'account_category'      => ['required', 'string', 'max:999'],
            'notes'                 => ['required', 'string', 'max:191'],

        ]);

        $transaction                                = new Transaction;
        $transaction->date                          = $request->date;
        $transaction->account_category_id           = $request->account_category;
        $transaction->amount                        = $request->amount;
        $transaction->total                         = $request->amount;
        $transaction->grand_total                   = $request->amount;
        $transaction->branch_id                     = $branch->id;
        $transaction->user_id                       = $user_id;
        $transaction->type                          = $account_category->type;
        $transaction->description                   = $request->notes;

        if (!$transaction->save()) {
            return back()->withInput()->with('fail', __('Transaction creation request failed!'));
        }
        return back()->with('success', __('Transaction added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Transaction  $fcategory
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        $params = [
            'transactions' => $transaction
        ];
        return view('dashboard.transaction.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Transaction  $fcategory
     * @return Response
     */
    public function edit(Transaction $transaction)
    {
        $account_categories = AccountCategory::all();
    //    dd($account_categories);


        $params = [
            'transaction'               => $transaction,
            'account_categories'        => $account_categories,
        ];
        return view('dashboard.transaction.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Transaction  $fcategory
     * @return Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $user = Auth::user();
        $user_id =  Auth::user()->id;
        $account_category = AccountCategory::where('id', $request->account_category)->first();

        $request->validate([
        //    'date'                  => ['required', 'string', 'max:191'],
            'amount'                => ['required', 'string', 'max:191'],
            'account_category'      => ['required', 'string', 'max:999'],
            'notes'                 => ['required', 'string', 'max:191'],

        ]);


        $transaction->date                          = $request->date;
        $transaction->account_category_id           = $request->account_category;
        $transaction->amount                        = $request->amount;
        $transaction->total                         = $request->amount;
        $transaction->grand_total                   = $request->amount;
        $transaction->user_id                       = $user_id;
        $transaction->type                          = $account_category->type;
        $transaction->description                   = $request->notes;

        if (!$transaction->save()) {
            return back()->withInput()->with('fail', __('Transaction modification request failed!'));
        }
        return back()->with('success', __('Transaction modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction  $fcategory
     * @return Response
     */
    public function destroy(Transaction $transaction)
    {
        if (!$transaction->delete()) {
            return back()->withInput()->with('fail', __('Transaction removing request failed!'));
        }
        return back()->with('success', __('Transaction removed successfully'));
    }


    public function csv(){
       
        return view('dashboard.transaction.csv');
      
    }

    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){
    
          $file = $request->file('file');
    
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
    
          // Valid File Extensions
          $valid_extension = array("csv");
    
          // 2MB in Bytes
          $maxFileSize = 2097152; 
    
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
              // File upload location
              $location = 'uploads';
    
              // Upload file
              $file->move($location,$filename);
    
              // Import CSV to Database
              $filepath = public_path($location."/".$filename);
    
              // Reading file
              $file = fopen($filepath,"r");
    
              $importData_arr = array();
              $i = 0;
    
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );
                 
                 // Skip first row (Remove below comment if you want to skip the first row)
                 /*if($i == 0){
                    $i++;
                    continue; 
                 }*/
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
    
              // Insert to MySQL database
              foreach($importData_arr as $importData){
    
                $insertData = array(
           

                    "id"=>$importData[0],
                    "type" =>$importData[1],
                    "amount"=>$importData[2],
                    "branch_id"=>$importData[3],
                    "account_category_id"=>$importData[4],
                    "user_id"=>$importData[5],
                    "total"=>$importData[6],
                    "grand_total"=>$importData[7],
                    "description"=>$importData[8],
                    "date"=>$importData[9],
                    "created_at"=>$importData[10]);
               
                    
                    Transaction::insertData($insertData);
     
               }
          
    
              Session::flash('message','Import Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 2MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }
    
      //  return view('dashboard.invite.index');
        // Redirect to index
        return redirect()->action('TransactionController@index');
      }
}

                 