<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use DataTables;
use Hash;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $User = User::where('role_id',2)->orderBy('created_at','desc')->get();
                return DataTables::of($User)
                        ->addIndexColumn()
                        ->editColumn('image', function($row){
                            $image = '<div class="m-r-10"><img src="'.$row->image .'" alt="user" width="80" class="rounded-circle" /></div>';
                            return $image;
                        })
                        ->editColumn('state', function($row){
                            $name = isset($row->State_Detail->name)?$row->State_Detail->name:'-';
                            return $name;
                        })
                        ->addColumn('active_toggle', function($row){
                            $btn = "";
                            $btn .= '<label class="switch employee-switch">
                                    <input type="checkbox" id="consultant_switch" data-id="'. $row->id .'" '.($row->status == 0 ? 'checked' : '').'>
                                    <span class="slider round"></span>
                                </label>';
                            return $btn;
                        })
                        ->addColumn('action', function($row){
                            $btn =" ";
                                $btn .= '<a href="'. route('consultant.edit', $row->id) .'" class="table-action-btn edit btn btn-primary m-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                $btn .= '<a href="javascript:void(0)" data-url="'. route('consultant.destroy', $row->id) .'" class="table-action-btn btn btn-danger m-1 delete_btn" data-id="'. $row->id .'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action','image','active_toggle'])
                        ->make(true);
                    }

            return view('admin.consultant.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $State =  State::get();
      return view('admin.consultant.create',compact('State'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
            'image' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        try {
            $User = array(
                "name" => $request->name,
                "email" => $request->email,
                "mobile_no" => $request->mobile_no,
                "address" => $request->address,
                "state" => $request->state,
                "city" => $request->city,
                "password" => Hash::make($request->password),
                "role_id" => 2,
            );

            if(isset($request->image) && !empty($request->image)){
                $imagename = rand(0000,9999) . time().'.'.$request->image->extension();
                $request->image->move(public_path('admin_images/my_profile'), $imagename);
                $User['image'] = $imagename;
            }
            User::create($User);
            return redirect()->route("consultant.index")->with("success", "Consultant Created Successfully.");

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $State =  State::get();
        return view('admin.consultant.edit',compact('State','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);
        try {
            $profile = User::find($id);
            $User = array(
                "name" => $request->name,
                "email" => $request->email,
                "mobile_no" => $request->mobile_no,
                "address" => $request->address,
                "state" => $request->state,
                "city" => $request->city,
            );
            if(isset($request->image) && !empty($request->image)){
                if(isset($profile->image) && $profile->image != ""){
                    $name_image = str_replace(url('admin_images/my_profile').'/', '', $profile->image);
                    $image_path = public_path('admin_images/my_profile').'/'.$name_image;
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                }
                $imagename = rand(0000,9999) . time().'.'.$request->image->extension();
                $request->image->move(public_path('admin_images/my_profile'), $imagename);
                $User['image'] = $imagename;
            }
            User::whereId($id)->update($User);
            return redirect()->route("consultant.index")->with("success", "Consultant Updated Successfully.");
            } catch (\Throwable $th) {
                 return redirect()->back()->with('error',$th->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $consultant = User::find($id);
        if(isset($consultant->image) && $consultant->image != ""){
            $name_image = str_replace(url('admin_images/my_profile').'/', '', $consultant->image);
            $image_path = public_path('admin_images/my_profile').'/'.$name_image;
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }
        if(User::whereId($id)->delete()){
            return response()->json(["status" => 1]);
        }
        else{
            return response()->json(["status" => 0]);
        }

    }

    public function unique_user_email(Request $request){
        $rules = [
            'email'=> 'required|unique:users,email',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return response()->json(['status' => '1','message' => 'Email Already Exists!']);
        }
        return response()->json(['status' => '0']);
    }

    public function consultant_status_change(Request $request){
        if(isset($request->id) && $request->id != null){
            $consultant = User::find($request->id);
            if($consultant != 'null'){
                $consultant->status = $request->status;
                $consultant->save();
                return response()->json(["status" => 1]);
            }
            return response()->json(["status" => 0]);
        }
        return response()->json(["status" => 0]);
    }
}
