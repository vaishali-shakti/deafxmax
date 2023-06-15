<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Members;
use DataTables;
use Hash;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $Members = Members::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
                $User = User::where('parent_id',auth()->user()->id)->orderBy('created_at','desc')->get();
                return DataTables::of($User)
                        ->addIndexColumn()
                        ->addColumn('action',function($row){
                            $btn = "";
                            $btn .= '<a href="'. route('members.edit', $row->id) .'" class="table-action-btn edit btn btn-primary m-1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                            $btn .= '<a href="javascript:void(0)" data-url="'. route('members.destroy', $row->id) .'" class="table-action-btn btn btn-danger m-1 delete_btn" data-id="'. $row->id .'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            return $btn;
                        })
                        ->make(true);
                    }

            return view('admin.members.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function create()
    {
        return view('admin.members.create');
    }
    #store members
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'pancard_no' => 'required',
            'bank_act_no' => 'required',
        ]);
        try{
            $User = new User();
            $User->parent_id = auth()->user()->id;
            $User->name = $request->name;
            $User->surname = $request->surname;
            $User->mobile_no = $request->mobile_no;
            $User->email = $request->email;
            $User->pancard_no = $request->pancard_no;
            $User->bank_act_no = $request->bank_act_no;
            $User->save();
            // dd($User);
            return redirect()->route('members.index')->with('success','Members created successfully');
        }catch(\Throwable $th){
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
    public function edit(string $id)
    {           
        $Members = Members::find($id);
        return view('admin.members.edit',compact('Members'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'pancard_no' => 'required',
            'bank_act_no' => 'required',
        ]);
        try{
            $Members = Members::find($id);
            $Members->user_id = auth()->user()->id;
            $Members->name = $request->name;
            $Members->surname = $request->surname;
            $Members->mobile = $request->mobile_no;
            $Members->email = $request->email;
            $Members->pancard_no = $request->pancard_no;
            $Members->bank_act_no = $request->bank_act_no;
            $Members->save();
            return redirect()->route('members.index')->with('success','Members updated successfully');
        }catch(\Throwable $th){
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
    public function destroy(string $id)
    {
           if(Members::whereId($id)->delete()){
               return response()->json(["status" => 1]);
           }
           else{
               return response()->json(["status" => 0]);
           }
    }
    
}
