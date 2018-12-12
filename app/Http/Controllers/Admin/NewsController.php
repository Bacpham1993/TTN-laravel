<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\News;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class NewsController extends Controller
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
	/**/
    public function index()
    {
		$this->data['title'] = 'Tin tức chung';
		$listnews = News::orderBy('id','desc')->paginate(10);
		//var_dump($listnews);
		foreach($listnews as $key=>$val){
			$val['category'] = $this->getNameCat($val['category']);
		}
		$this->data['listnews']= $listnews;
        	return view('cpanel.news.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = "Tạo tin tức mới";
        $listnews = News::orderBy('id','desc')->get();
        $this->data['listnews'] = $listnews;

        $this->data['cat'] = $this->getSelectMenu(0,'');
        return view('cpanel.news.create', $this->data);
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
            'txtName' => 'required|string',
            'txtSDesc' =>'required|string|max:200',
            'txtDesc' =>'required|string'

        ];
        $message = [
            'name.required' => 'Tiêu đề không được để trống!',
            'txtSDesc.max' => 'Chú thích không quá 200 kí tự',
            'txtSDesc.required' =>'Chú thích không được để trống!',
            'txtDesc.required' =>'Chi tiết không được để trống!'

        ];
        $validator = Validator::make(Input::all(), $rule,$message);
        if ($validator->fails())
        {
            return Redirect::to('admin/news/create')
                ->withInput($request->input())->withErrors($validator);
        } else {
            $book = new News;
            $book->title = Input::get('txtName');
            $book->description = Input::get('txtDesc');
            $book->s_description = Input::get('txtSDesc');
            $book->category = Input::get('parent_id');
            //upload file process
            if($request->hasFile('image')) {
                $fileupload = Input::file('image');
                Input::file('image')->move(base_path(). '/public/image/', date('Y-m-d-H:i:s').$fileupload->getClientOriginalName());
                $book->image = 'image/'. date('Y-m-d-H:i:s'). $fileupload->getClientOriginalName();
            }
            else{
                $book->image = 'image/nothumb.jpg';
            }
	        $book->author = Auth::user()->name;
            $book->meta_title = Input::get('meta_title');
            $book->meta_keywords = Input::get('meta_keywords');
            $book->meta_description = Input::get('meta_description');
            $book->save();
            Session::flash('message', "Tạo thành công tin tức mới");
            return Redirect::to('admin/news');
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
        $this->data['title']="Sửa tin tức";
        $this->data['book'] = News::find($id);
        $category = $this->data['book']->category;
        $this->data['listCate'] = $this->getSelectMenu(0,'',$category);

        return view('cpanel.news.edit',$this->data);
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
            'txtName' => 'required',
            'txtSDesc' =>'required|max:200',
            'txtDesc' =>'required'

        ];
        $message = [
            'txtName.required' => 'Tiêu đề không được để trống!',
            'txtSDesc.max' => 'Chú thích không quá 200 kí tự',
            'txtSDesc.required' =>'Chú thích không được để trống!',
            'txtDesc.required' =>'Chi tiết không được để trống!'

        ];
        $validator = Validator::make(Input::all(), $rule,$message);
        if ($validator->fails())
        {
            return Redirect::to('admin/news/' . $id . '/edit')
                ->withInput($request->input())->withErrors($validator);
        } else {
            $book = News::find($id);
            $book->title = Input::get('txtName');
            $book->description = Input::get('txtDesc');
            $book->s_description = Input::get('txtSDesc');
            $book->category = Input::get('parent_id');

            $book->author = Auth::user()->name;
            $book->meta_title = Input::get('meta_title');
            $book->meta_keywords = Input::get('meta_keywords');
            $book->meta_description = Input::get('meta_description');
            $book->save();
            Session::flash('message', "Sửa thành công!");
            return Redirect::to('admin/news');
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
        $list = News::find($id);
        $list->delete();
 	Session::flash('message', "Đã xóa thành công $id");
        return Redirect::to('admin/news');
        

    }
    public function getNameCat($id){
		$data = DB::table('menu')->where('id',$id)->get();
		foreach($data as $k=>$v){
			$data = $v->label;
		}
		return $data;
    }
    function getSelectMenu($id_parent=0,$space,$secID=-1)
    {
	       $data_tmp = DB::table('menu')->orderBy('sort','asc')->get();
	       $menus = json_decode(json_encode($data_tmp), True);

	      $menu_tmp = array();

	      $totalMenu = '';



	      foreach ($menus as $key => $item) {
	       
		  if ((int) $item['parent'] == (int) $id_parent) {
				
		      $menu_tmp[] = $item ;
				  
		      unset($menus[$key]);
		  }
	      }


	      if ($menu_tmp)
	      {
		  foreach ($menu_tmp as $item)
		  {
                if($secID>0 && $secID == $item['id']){
                    $totalMenu .= '<option value="'.$item['id'].'" selected>'.$space.$item['label'].'</option>';
                }
                else {
                    $totalMenu .= '<option value="' . $item['id'] . '">' . $space . $item['label']. '</option>';
                }
                if(DB::table('menu')->where('id',$item['id'])->count()>0) {
                    $totalMenu .= $this->getSelectMenu($item['id'],$space.'--',$secID);
                }
		    
		       

		  }
		  
		  
	      }
	      return $totalMenu;
	     
	 }
	
}
