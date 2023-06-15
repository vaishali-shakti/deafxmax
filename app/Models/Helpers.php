<?php
use App\Models\Setting;

if(! function_exists('routeActive')){
	function routeActive($routeName)
	{
		return	request()->routeIs($routeName) ? 'active' : '';
	}
}

if(! function_exists('getlogo')){
	function getlogo($key)
	{
		$Setting = Setting::where('slug_name',$key)->first();
        if($Setting != null){
		    return asset('admin_images/setting').'/'.$Setting->value;
        }
        return null;
	}
}
