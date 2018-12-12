<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\News;
use App\Banner;
use Illuminate\Support\Facades\View;
class IndexController extends Controller
{


    public function show($id)
    {
        if($id==0){
			return $this->menuHome(0,0);
		}
		else if($id==1){
			$data = News::select('title','view','id')->orderBy('view','desc')->take(10)->get();
            return $data;
		}

		else{
			return 'Design by BacPham - YK12C';
		}
    }
	public function getBookDetail($id){
        $data = News::find($id);
        $data->view += 1;
        $data->save();
		return $data;


	}
    public function getBookByCat($id){
		return $data = News::select('*')->where('category',$id)->orderBy('id','desc')->get();
	}
	
	public function getBookIndex($cat,$sub){
		    $child = $this->getCategory($cat);
			foreach($child as $key=>$val){
					$dt[$val->id] = $this->getCategory($val->id);
				$data[$val->id]=array();	
			foreach($dt[$val->id] as $k1=>$v1){
				$abc = News::select('title','s_description','view','id','image','category','created_at')->where('category',$v1->id)->get();
				if(count($abc)!=0){
				foreach($abc as $k=>$v){
					$data[$val->id][$v1->id] = $abc[$k];
				} 
				
				}

			}
			foreach($data[$val->id] as $k2=>$v2){
				$data[$val->id][$k2]->category = $this->getNameCat($v2->category);

			}			
				
			}
			//$data[$sub] = array();
			/*if($dt){
			foreach($dt[$sub] as $key=>$val){
				$abc = News::select('title','s_description','view','id','image','category','date_import')->where('category',$val->id)->get();
				if(count($abc)!=0){
				foreach($abc as $k=>$v){
					$data[$sub][] = $abc[$k];
				} 
				
				}

			}
			foreach($data[$sub] as $key=>$val){
				$data[$sub][$key]->category = $this->getNameCat($val->category);

			}
			}
			else{ }
			*/
			
			
	
	return $data;
	}
	public function getCategorybyCode($code,$data=array()){
              
			$Menu = DB::table('menu')->select('*')->where('id',$code)->get();
			if(!$data){
            $data=array();
			}
            if(count($Menu)>0){
                    $data[] = array("label" =>  $Menu[0]->label, "id" => $Menu[0]->id);
					
					if($Menu[0]->parent != 0){
						$data= $this->getCategorybyCode($Menu[0]->parent,$data);
						
						
					}
                }
            
            
            return $data;
        }
	public function ListMenu(){
		return	$Menu = DB::table('menu')->orderBy('sort','asc')->get();
			
          }
    public function getnewsI($limit){
	
			$data = News::select('title','s_description','view','id','image','category')->orderBy('id','desc')->take($limit)->get();
			return $data;
        }
	public function getNameCat($id){
		$data = DB::table('menu')->where('id',$id)->get();
		foreach($data as $k=>$v){
			$data = $v->label;
		}
		return $data;
	}	
	public function getCategory($id){
		$data = DB::table('menu')->where('parent',$id)->get();
		return $data;
	}	
    function countMenu($id){
			return DB::table('menu')->where('parent',$id)->count();	
        }
    public function Bannerlist(){
			return DB::table('banner')->where('status','1')->orderBy('id','desc')->get();	
        }
	public function menuIndex(){
		
		return view('index',['menu'=>$this->menuHome(0,0)]);
	}
	public function menuTopho($id){
        $event = Banner::findOrFail($id);
        //$this->data['title'] = $event->title;
        $this->data['menu'] = $this->menuHome(0,0);
        $this->data['item'] = $event;
        return view('topho.topho',$this->data);
    }
	public	function menuHome($id_parent,$child,$cdrop=0,$menuParent='') 
          {
			  
			   $totalMenu = $menuParent;
               $menus =  json_decode(json_encode($this->ListMenu()), True);
               $boo = true;
               $menu_tmp = array();
              if($id_parent !=0) $boo=false;
			  //var_dump($menus);
              foreach ($menus as $key => $item) {
               
                  if ((int) $item['parent'] == (int) $id_parent) {
                      $menu_tmp[] = $item;
                      
                                       
                      unset($menus[$key]);
                  }
              }
               
              if ($menu_tmp) 
              {
			  if((int)$child == 0){
                  $hihi = !($boo) ? 'dropdown-menu' : 'nav navbar-nav';
			  }
			  else{
				  $hihi = !($boo) ? 'nav navbar-nav' :'dropdown-menu';
		      }
			  
			$tag = 0;
			if($hihi == 'dropdown-menu') $tag = ((int)$cdrop%2 == 0) ? 'dropdown-menu':'dropdown-submenu';	

                  $totalMenu .= '<ul class = "'.$hihi.'" id="drop'.$cdrop.'">';
                  foreach ($menu_tmp as $item) 
                  {
                      
                      if($this->countMenu($item['id'])>0){ 
							if($cdrop == 0){
							$totalMenu .= '<li class="dropdown">';
                            $totalMenu .= '<a href="'.$item['link'].'" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded=true">'.$item['label'].' <span class="caret"></span></a>';	

							}
							else{
							$totalMenu .= '<li class="'.$tag.'" >';
							$totalMenu .= '<a class="test" href="'.$item['link'].'" >'.$item['label'].' <span class="caret"></span></a>';
                        	

							}
							$totalMenu =$this->menuHome($item['id'],$child,$cdrop+1,$totalMenu);
                            
                            $totalMenu .= '</li>';
                      }
                      else{
                        $totalMenu.= '<li>';
                        $totalMenu.= '<a href="'.$item['link'].'" >'.$item['label'].'</a>';
                        $totalMenu.= '</li>';

                      }

                  }
                  $totalMenu.= '</ul>';
              }
			  
			  return $totalMenu;
			 
          }
		  
		  
}
