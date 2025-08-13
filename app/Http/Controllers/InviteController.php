<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Invite;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Mail\CouponMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
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
        $users = new User;

    
        $users = $users->latest()->get();
        $params = [

         //   'users'  => User::all(),
            'users'     => $users,
            'branches'  => Branch::all(),
            'roles'     => Role::all(),
            'filter'    => [
                'branch'    => $request->branch,
                'role'      => $request->role,
            ],
        ];
        return view('dashboard.invite.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'branches'  => Branch::all(),
            'roles'     => Role::all(),
        ];
        return view('dashboard.invite.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      // dd("here");

        $invite = new Invite;

        
        $invite->name             = $customer->name;
        $invite->mobile           = $customer->mobile;
     
      

       
       
        if (!$invite->save()) {
            return back()->withInput()->with('fail', __('Invite creation request failed!'));
        }
        return back()->with('success', __('Invite added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return Response
     */
    public function show(User $user)
    {
        $params = [
            'user' => $user
        ];
        return view('dashboard.invite.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Invite  $invite
     * @return Response
     */
    public function edit(Invite $invite)
    {
        $params = [
            'branches'      => Branch::all(),
            'invite'      => $invite,
        ];
        return view('dashboard.invite.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Invite  $invite
     * @return Response
     */
    public function update(Request $request, Invite $invite)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'mobile'        => ['nullable', 'string', 'max:191'],
        ]);

        $invite->name             = $request->name;
        $invite->mobile           = $request->mobile;
        if (!$invite->save()) {
            return back()->withInput()->with('fail', __('Invite modification request failed!'));
        }
        return back()->with('success', __('Invite modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return Response
     */
    public function destroy(Usder $user)
    {
        if (!$user->delete()) {
            return back()->withInput()->with('fail', __('Invite removing request failed!'));
        }
        return back()->with('success', __('Invite removed successfully'));
    }

    public function coupon_mail(Request $request)

    {
      
        
 
        $customer = User::where('id', $request->id)->first();
       
       
  
         if (!$customer) {
             abort(404);
         }


         $invite                   = new Invite;
         $invite->customer_id      = $customer->id;
         $invite->email            = $customer->email;
         $invite->mobile           = $customer->mobile;
         $invite->status           = "Sent";


         if (!$invite->save()) {
            return back()->withInput()->with('fail', __('Mail sent request failed!'));
        }


        $code = "loveusdbd";

        $params = [
            'code' => $code,
            'message'   => 'Dear ' . $customer->name . ',',
       
       //     'message'   => 'Dear ' . optional($customer->name)->name . ', go through the link and preserve it.',
        ];

        $admin_emails = "usdbd.uttara@gmail.com";

        return back()->with('success', __('Mail sent successfully'));

        

     

        Mail::to($customer->email)->bcc($admin_emails)->send(new CouponMail($params));

   //    Mail::to($request->customer->email)->bcc($admin_emails)->send(new TicketConfirmed($params));
    }


    public function csv(){
       
        return view('dashboard.invite.csv');
      
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
                //    "id"=>$importData[0],
                //    "name"=>$importData[1],
                //    "email"=>$importData[2],
                //    "number"=>$importData[3],
                //    "type"=>$importData[4]);
                
                   "id"=>$importData[0],
                   "slug" =>$importData[1],
                   "name"=>$importData[2],
                   "email"=>$importData[3],
                   "email_verified_at"=>$importData[4],
                   "password"=>$importData[5],
                   "remember_token"=>$importData[6],
                   "created_at"=>$importData[7],
                   "updated_at"=>$importData[8],
                   "mobile"=>$importData[9],
                   "address"=>$importData[10],
                   "photo"=>$importData[11],
                   "status"=>$importData[12],
                   "is_admin"=>$importData[13],
                   "branch_id"=>$importData[14],
                   "role_id"=>$importData[15]);
                   
                   User::insertData($insertData);
    
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
        return redirect()->action('InviteController@index');
      }

}
