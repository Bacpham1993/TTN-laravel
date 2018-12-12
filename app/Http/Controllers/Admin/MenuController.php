<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\News;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $this->data['title'] = 'Menu';
        $this->data['menus'] = $this->getMenu();

        return view('cpanel.menus.index',$this->data);

    }


    public function getMenu($id = 0,$space=''){
        $menu = Menu::select('*')->orderBy('sort','asc')->get();
        $temp_menu = array();
        $totalmenu = array();
        foreach($menu as $key=>$item){

            if($item->parent == (int)$id){
                $temp_menu[] = $item;
            }
           // unset($menu[$key]);
        }
        if($temp_menu){
            foreach($temp_menu as $item){
                $item->label = $space. ' '. $item->label;
                array_push($totalmenu,$item);
                foreach($this->getMenu($item->id,$space.'--') as $is){
                    array_push($totalmenu,$is);
                };

            }

        }


        return $totalmenu;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $rule = [
            'label' => 'required|string',
            'link' =>'required|string|max:200',
            'parent_id' => 'required'

        ];
        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails())
        {
            //Session::flash('error_message',$validator);
            return Redirect::to('admin/menus')->withErrors($validator)
                ->withInput()->with('error_code',5);
        }
        else{
            $menu = new Menu();
            $menu->label = Input::get('label');
            $menu->link = Input::get('link');
            $menu->parent = Input::get('parent_id');
            $menu->sort = 0;
            $menu->save();
            Session::flash('message', 'Created successfully');
            return Redirect::to('admin/menus');
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
        $menu = Menu::find($id);
        $menu->label = Input::get('label');
        $menu->link  = Input::get('link');
        $menu->parent = Input::get('parent_id');
        $menu->sort = Input::get('sort');
        $menu->save();
        Session::flash('message','Edited successfully');
        return Redirect::to('/admin/menus');

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
        $menu = Menu::find($id);

        $news = News::select('id','title')->where('category',$id)->get();
        foreach($news as $item){
           $item->delete();
        }
        $menu->delete();
        Session::flash('message','Deleted ['. $menu->label .'] successfully');

        return Redirect::to('admin/menus');
    }
}
