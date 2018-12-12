<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Events';
        $this->data['events'] = Banner::orderBy('id','desc')->paginate(3);
        return view('cpanel.banners.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Create Event';
        return view('cpanel.banners.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'txtName' => 'required|string|max:100',
            'txtDesc' => 'required|string|min:50'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::to('/admin/banners/create')->withInput($request->input())->withErrors($validator);
        }
        else{
            $event = new Banner;
            $event->title = Input::get('txtName');
            $event->description = Input::get('txtDesc');
            $event->link = 'NOT FOUND';

            if($request->hasFile('image')) {
                $fileupload = Input::file('image');
                $fileupload->move(base_path(). '/public/image/event/', date('Y-m-d-H:i:s').$fileupload->getClientOriginalName());
                $event->image = 'image/event/'. date('Y-m-d-H:i:s'). $fileupload->getClientOriginalName();
            }
            else{
                $event->image = 'image/nothumb.jpg';
            }
            $event->save();
            Session::flash('message','Created event successfully');
            return Redirect::to('admin/banners');



        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->data['title'] = 'Edit Event';
        $this->data['event'] = Banner::find($id);
        return view('cpanel.banners.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'txtName' => 'required|string|max:100',
            'txtDesc' => 'required|string|min:200'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::to('/admin/banners/'.$id.'/edit')->withErrors($validator);
        }
        else{
            $event = Banner::find($id);
            $event->title = Input::get('txtName');
            $event->description = Input::get('txtDesc');

            if($request->hasFile('image')) {
                $fileupload = Input::file('image');
                $fileupload->move(base_path(). '/public/image/event/', date('Y-m-d-H:i:s').$fileupload->getClientOriginalName());
                $event->image = 'image/event/'. date('Y-m-d-H:i:s'). $fileupload->getClientOriginalName();
            }
            else{
                //$event->image = 'image/nothumb.jpg';
            }
            $event->save();
            Session::flash('message','Edited event '.$id . ' successfully');
            return Redirect::to('admin/banners');



        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $event = Banner::find($id);
        $event->delete();

        Session::flash('message','Deleted '.$event->title. ' successfully');
        return Redirect::to('admin/banners');
    }
}
