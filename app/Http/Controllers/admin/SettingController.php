<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\History;
use Illuminate\Support\Str;
use DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            if ($request->ajax()) {
                $data = Setting::get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->editcolumn('value', function($row){
                            if($row->type == "File")
                            {
                                return '<div class="m-r-10"><img src=" '.asset('/admin_images/setting/' . $row->value).'" alt="user" width="80" class="rounded-circle"  /></div>';
                            }
                            else{
                                return $row->value;
                            }
                        })
                        ->addColumn('action', function($row){
                            $btn = "";
                            $btn .= '<a href="'. route('setting.edit', $row->id) .'" class="table-action-btn edit btn btn-primary m-1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action','value'])
                        ->make(true);
                }
                return view('admin.setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:settings,name',
        ]);
        try{
            if($request->type == "File"){
                $value = rand(0000,9999) . time().'.'.$request->image->extension();
                $request->image->move(public_path('admin_images/setting/'),$value);
                $setting['image'] = $value;
            } else {
                $value = $request->value;
            }
            $setting = array(
                "name" => $request->name,
                "slug_name" =>Str::slug($request->name),
                "type" => $request->type,
                "value" => $value
            );

            $setting = Setting::create($setting);
            return redirect()->route("setting.index")->with("success", "Setting created Successfully.");
        } catch (\Throwable $th) {
            $data = array(
                "name" => 'SettingController',
                "module" => 'store',
                "description" => $th->getMessage(),
            );
            History::create($data);
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
        $Setting = Setting::find($id);
        return view('admin.setting.edit',compact('Setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting_data = Setting::find($id);
        $request->validate([
            'name' => 'required',
        ]);
        try{
            $setting = array(
                "name" => $request->name,
            );
            if($setting_data->type == "File"){
                if(isset($request->image) && !empty($request->image)){
                    if(isset($setting_data->value) && $setting_data->value != ""){
                        $name_image = str_replace(url('admin_images/setting').'/', '', $setting_data->value);
                        $image_path = public_path('admin_images/setting').'/'.$name_image;
                        if(file_exists($image_path)){
                            unlink($image_path);
                        }
                    }
                    // $value = rand(0000,9999).$request->value->getclientoriginalname();
                    $value = rand(0000,9999) . time().'.'.$request->image->extension();
                    $request->image->move(public_path('admin_images/setting/'),$value);
                    $setting['value'] = $value;
                }
        }
        else{
            $setting['value'] = $request->value;
            }
            Setting::whereId($id)->update($setting);
            return redirect()->route("setting.index")->with("success", "Setting Updated Successfully.");
        } catch (\Throwable $th) {
            $data = array(
                "name" => 'SettingController',
                "module" => 'update',
                "description" => $th->getMessage(),
            );
            History::create($data);
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setting_unique_name(Request $request)
    {
        try{
            $rules = [
                'name'=> 'required|unique:settings,name',
            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return response()->json(['status' => '1','message' => 'Name Already Exists!']);
            }
            else{
                return response()->json(['status' => 0]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function setting_unique_name_update(Request $request)
    {
        try{
            $rules = [
                'name'=> 'required|unique:settings,name,'.$request->id,
            ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return response()->json(['status' => '1','message' => 'Name Already Exists!']);
            }
            else{
                return response()->json(['status' => 0]);
            }
        } catch (\Throwable $th) {
            $data = array(
                "name" => 'SettingController',
                "module" => 'setting_unique_name_update',
                "description" => $th->getMessage(),
            );
            History::create($data);
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
    