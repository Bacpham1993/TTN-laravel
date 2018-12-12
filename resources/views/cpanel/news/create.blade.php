@extends('layouts.app')
@section('content')
    <section class="content-header">
	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                  
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> <a href="{{ url('/admin') }}">Tổng quan</a>
                            </li>
							<li class="active">
                               <a href="{{ url('/admin/news') }}">Tin tức - Tin tức chung</a>
                            </li>
							 <li class="active">
							 {{$title}} 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
       <h1>
	   {{$title}}
       </h1>
   
   </section>
   <section class="content">
       <form action="{{ url('admin/news') }}" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}
           @if(count($errors) >0)
               <ul>
               @foreach($errors->all() as $error)
                   <li class="text-danger">{{ $error }}</li>
               @endforeach
               </ul>
           @endif
           <div class="col-md-8">
           <div class="box">
               <div class="box-header with-border">
                   <h3 class="box-title">THÔNG TIN</h3>
               </div>
               <div class="box-body row">
                   <div class="form-group col-md-12">
                       <label>Tiêu đề</label>
                       <input type="text" name="txtName" class="form-control" value="{{ old('txtName') }}">
                   </div>
		   <div class="form-group col-md-12">
                       <label>Chú thích ngắn</label>
                       <input type="text" name="txtSDesc" class="form-control" value="{{ old('txtSDesc') }}" maxlength="200">
           </div>
                   <div class="form-group col-md-12">
                       <label>Danh mục</label>
                       <select class="form-control" name="parent_id"  value="{{ old('parent_id') }}">
                           <option value="0">---</option>
                         {{!! $cat !!}}
                       </select>
                       {{--{{ var_dump($cat) }}--}}

                   </div>
		 
                   <div class="form-group col-md-12">
                       <label>Chi tiết</label>
                       <textarea style="height:500px" name="txtDesc" id = "mytextarea" class="form-control">{{ old('txtDesc') }}</textarea>
                   </div>
               </div>
           </div>
           </div>
               <div class="col-md-4">
                   <div class="box">
                       <div class="box-header with-border">
                           <h3 class="box-title">SEO</h3>
                       </div>
                       <div class="box-body">
                   <div class="form-group col-md-12">
                       SEO Title <input type="text" name="meta_title" class="form-control"  value="{{ old('meta_title') }}">
                       Meta Keywords <input type="text" name="meta_keywords" class="form-control"  value="{{ old('meta_keywords') }}">
                       Meta Description <input type="text" name="meta_description" class="form-control"  value="{{ old('meta_description') }}">
                   </div>
                   <div class="form-group col-md-12">
                       Hình ảnh <input type="file" name="image" class="form-control">
                   </div>

                           <button type="submit" class="btn btn-success pull-right">
                               <i class="fa fa-save"></i>
                               <span>Save and back</span>
                           </button>
                   </div>
                   </div>
               </div>
           {{--</div>--}}
               <div class="col-md-12">

           </div>
       </form>
   </section>
@endsection
