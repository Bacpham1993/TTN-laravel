<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
//use Illuminate\Foundation\Auth\RegistersUsers;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //use RegistersUsers;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $this->data['title'] = 'Members';
        $this->data['users'] = User::orderBy('id','asc')->get();
        return view('cpanel.users.index',$this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Create New User';
        return view('cpanel.users.create',$this->data);
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ];

        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/users/create')
                ->withInput($request->input())->withErrors($validator);
        }
        else{
            User::create([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
            ]);
            Session::flash('message', "Created new user successfully");
            return Redirect::to('admin/users');
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
        $this->data['title'] = 'Edit Member';
        $this->data['user'] = User::find($id);
        return view('cpanel.users.edit',$this->data);
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
        $rule = [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

        ];

        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails())
        {
            return Redirect::to('admin/users/' .$id. '/edit' )
                ->withInput($request->input())->withErrors($validator);
        }
        else{
            $user = User::find($id);
            $user->name = Input::get('name');
            $user->password = bcrypt(Input::get('password'));
            $user->save();
            Session::flash('message','Edited user: '. $user->email .' successfully');
            Auth::logout();
            return Redirect::to('admin/users');


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
        $user = User::find($id);
        $user->delete();
        Session::flash('message','Deleted user:' . $user->name);
        return Redirect::to('admin/users');

    }
}
