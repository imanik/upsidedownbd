<?php

namespace App\Http\Controllers;

use Session;
use App\Models\AccountCategory;
use App\Models\Branch;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
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
        $incomes = Income::latest()->get();

        if ($user->branch_id) {
            $incomes = $incomes->where('branch_id', $user->branch_id);;
        }

        $params = [
            'incomes' => $incomes,
        ];
        return view('dashboard.income.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


        $params = [
            'branch'  => Branch::all(),

        ];
        return view('dashboard.income.create',$params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $user_id =  Auth::user()->id;

       $branch = Branch::where('id', $user->branch_id)->first();

        if (!$branch) {
            return back()->withInput()->with('fail', __('Branch not found!'));
        }

        $accountcategory = "Cash Sale";
        $account_category_id = AccountCategory::where('name', $accountcategory)->first()->id;

        $type_id = AccountCategory::select('type')->where('id', $account_category_id)->first();

        $total = ($request->adult_number * $branch->regular_price) + ($request->child_number * $branch->child_price) + ($request->discount_number * $request->discount_amount) +($request->dslr_type1_number * 300) + ($request->dslr_type2_number * 500);

        $grand_total = $total;


    $request->validate([
        'date'                  => ['required', 'string', 'max:191'],
        'cc_sale'               => ['required', 'string', 'max:191'],
        'discount_amount'       => ['required', 'string', 'max:191'],
    ]);
        $income                               = new Income;
        $income->date                         = $request->date;
        $income->adult_ticket_count           = $request->adult_number;
        $income->child_ticket_count           = $request->child_number;
        $income->discount_ticket_count        = $request->discount_number;
        $income->dslr_type1_count             = $request->dslr_type1_number;
        $income->dslr_type2_count             = $request->dslr_type2_number;
        $income->dslr_type2_count             = $request->dslr_type2_number;
        $income->account_category_id          = $account_category_id;
        $income->branch_id                    = $branch->id;
        $income->type_id                      = $account_category_id;
        $income->user_id                      = $user_id;
        $income->cc_sale                      = $request->cc_sale;
        $income->discount                     = $request->discount_amount;
        $income->total                        = $total;
        $income->grand_total                  =$grand_total;
        $income->description                  =$request->notes;

        if (!$income->save()) {
            return back()->withInput()->with('fail', __('Income creation request failed!'));
        }
        return back()->with('success', __('Income added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Income  $fIncome
     * @return Response
     */
    public function show(Income $income)
    {
        $params = [
            'income' => $income
        ];
        return view('dashboard.income.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Income  $fIncome
     * @return Response
     */
    public function edit(Income $income)
    {
        $params = [
            'income' => $income
        ];
        return view('dashboard.income.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Income  $fIncome
     * @return Response
     */
    public function update(Request $request, Income $income)
    {

        $user = Auth::user();
        $user_id =  Auth::user()->id;

        $branch = Branch::where('id', $user->branch_id)->first();

        if (!$branch) {
            return back()->withInput()->with('fail', __('Branch not found!'));
        }

        $accountcategory = "Cash Sale";
        $account_category_id = AccountCategory::where('name', $accountcategory)->first()->id;

        $type_id = AccountCategory::select('type')->where('id', $account_category_id)->first();

        $total = ($request->adult_number * $branch->regular_price) + ($request->child_number * $branch->child_price) + ($request->discount_number * $request->discount_amount) +($request->dslr_type1_number * 300) + ($request->dslr_type2_number * 500);

        $grand_total = $total;

        $request->validate([
        //    'date'                  => ['required', 'string', 'max:191'],
            'cc_sale'               => ['required', 'string', 'max:191'],
            'discount_amount'       => ['required', 'string', 'max:191'],
        ]);


        $income->adult_ticket_count           = $request->adult_number;
        $income->child_ticket_count           = $request->child_number;
        $income->discount_ticket_count        = $request->discount_number;
        $income->dslr_type1_count             = $request->dslr_type1_number;
        $income->dslr_type2_count             = $request->dslr_type2_number;
        $income->dslr_type2_count             = $request->dslr_type2_number;
        $income->account_category_id          = $account_category_id;
        $income->branch_id                    = $branch->id;
        $income->type_id                      = $account_category_id;
        $income->user_id                      = $user_id;
        $income->cc_sale                      = $request->cc_sale;
        $income->discount                     = $request->discount_amount;
        $income->total                        = $total;
        $income->grand_total                  =$grand_total;
        $income->description                  =$request->notes;

        if (!$income->save()) {
            return back()->withInput()->with('fail', __('Income modification request failed!'));
        }
        return back()->with('success', __('Income modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Income  $fIncome
     * @return Response
     */
    public function destroy(Income $income)
    {
        if (!$income->delete()) {
            return back()->withInput()->with('fail', __('Income removing request failed!'));
        }
        return back()->with('success', __('Income removed successfully'));
    }

    public function csv(){
       
        return view('dashboard.income.csv');
      
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
                    "adult_ticket_count" =>$importData[1],
                    "child_ticket_count"=>$importData[2],
                    "discount_ticket_count"=>$importData[3],
                    "dslr_type1_count"=>$importData[4],
                    "dslr_type2_count"=>$importData[5],
                    "branch_id"=>$importData[6],
                    "account_category_id"=>$importData[7],
                    "type_id"=>$importData[8],
                    "user_id"=>$importData[9],
                    "cc_sale"=>$importData[10],
                    "discount"=>$importData[11],
                    "total"=>$importData[12],
                    "grand_total"=>$importData[13],
                    "description"=>$importData[14],
                    "date"=>$importData[15],
                    "created_at"=>$importData[16]);
               
                    
                    Income::insertData($insertData);
     
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
        return redirect()->action('IncomeController@index');
      }
}
