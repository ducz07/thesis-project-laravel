<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class SiteController extends Controller
{
    //edit site
    public function edit_site(){
        $site_description_view = DB::table('tbl_site')
            ->select('*')
            ->where('site_id',1)
            ->first();
        $manage_description_site=view('admin/edit_site')
            ->with('specific_edit_site',$site_description_view);
        return view('admin_layout')
            ->with('edit_site',$manage_description_site);
    }

    // update site
    public function update_site(Request $request){
        $this->validate($request,[
            'site_title' => 'required|max:10',
            'site_number' => 'required|min:11',
            'site_email' => 'required',
            'site_address' => 'required|min:5',
            'site_fb' => 'required',
            'site_tw' => 'required',
            'site_ln' => 'required',
            'site_yt' => 'required',
            'site_copyright' => 'required'
        ]);

        $data = array();
        $data['site_title'] = $request->site_title;
        $data['site_number'] = $request->site_number;
        $data['site_email'] = $request->site_email;
        $data['site_address'] = $request->site_address;
        $data['site_fb'] = $request->site_fb;
        $data['site_tw'] = $request->site_tw;
        $data['site_ln'] = $request->site_ln;
        $data['site_yt'] = $request->site_yt;
        $data['site_copyright'] = $request->site_copyright;

        //image upload
        $image = $request->file('site_logo');
        if ($image) {
            $image_name= 'logo';
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='uploads/logo/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['site_logo']=$image_url;
                DB::table('tbl_site')
                    ->where('site_id',1)
                    ->update($data);
                Session::put('message', 'Updated successfully!!');
                return Redirect::to('/edit_site');
            }
        }
        //else
        $data['site_logo'] = '';
        $previous_image = $request->previous_image;
        $data['site_logo'] = $previous_image;
        DB::table('tbl_site')
            ->where('site_id',1)
            ->update($data);
        Session::put('message', 'Updated successfully!!');
        return Redirect::to('/edit_site');
    }
    
    
    
    
    
    
    
}
