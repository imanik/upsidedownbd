<?php

namespace App\Http\Controllers;

use Session;
use App\Models\AccountCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountCategoryController extends Controller
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
        $accountcategories = AccountCategory::latest()->get();
        $params = [
            'accountcategories' => $accountcategories,
        ];
        return view('dashboard.accountcategory.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.accountcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    //    $statuses = implode(",", config('upsidedown.fcategory.statuses'));

        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'type'          => ['required', 'string', 'max:191'],

        ]);

        $accountcategory                 = new AccountCategory;
        $accountcategory->name           = $request->name;
        $accountcategory->type           = $request->type;

        if (!$accountcategory->save()) {
            return back()->withInput()->with('fail', __('Category creation request failed!'));
        }
        return back()->with('success', __('Category added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  AccountCategory  $fcategory
     * @return Response
     */
    public function show(AccountCategory $accountcategory)
    {
        $params = [
            'accountcategory' => $accountcategory
        ];
        return view('dashboard.accountcategory.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AccountCategory  $fcategory
     * @return Response
     */
    public function edit(AccountCategory $accountcategory)
    {
        $params = [
            'accountcategory' => $accountcategory
        ];
        return view('dashboard.accountcategory.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  AccountCategory  $fcategory
     * @return Response
     */
    public function update(Request $request, AccountCategory $accountcategory)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:191'],

        ]);

        $accountcategory->name           = $request->name;
        $accountcategory->type           = $request->type;

        if (!$accountcategory->save()) {
            return back()->withInput()->with('fail', __('Category modification request failed!'));
        }
        return back()->with('success', __('Category modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AccountCategory  $fcategory
     * @return Response
     */
    public function destroy(AccountCategory $accountcategory)
    {
        if (!$accountcategory->delete()) {
            return back()->withInput()->with('fail', __('Category removing request failed!'));
        }
        return back()->with('success', __('Category removed successfully'));
    }

    public function csv(){
       
        return view('dashboard.accountCategory.csv');
      
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
                    "name" =>$importData[1],
                    "type"=>$importData[2]);
                 //   "created_at"=>$importData[3],
                  //  "updated_at"=>$importData[4],
                   // "deleted_at"=>$importData[5]);
               
                    
                    AccountCategory::insertData($insertData);
     
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
        return redirect()->action('AccountCategoryController@index');
      }
}
