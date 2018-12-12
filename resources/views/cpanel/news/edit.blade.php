<?php
/**
 * Created by PhpStorm.
 * User: bac
 * Date: 1/15/18
 * Time: 10:47 AM
 */
?>
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
        <form action="{{ url('admin/news') }}/{{ $book->id }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            @if(count($errors) >0)
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="box">
                <div class="box-body row">
                    <div class="form-group col-md-12">
                        <label>Tiêu đề</label>
                        <input type="text" name="txtName" class="form-control" value="{{ $book->title }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Chú thích ngắn</label>
                        <input type="text" name="txtSDesc" class="form-control" value="{{ $book->s_description }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Danh mục</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">--</option>
                            {{--@foreach($listCate as $cate)
                                <option value="{{ $cate->id }}"
                                        @if ($cate->id == $book->category)
                                        selected="selected"
                                        @endif
                                >{{ $cate->label }}</option>
                            @endforeach--}}
                            {{!! $listCate !!}}
                        </select>

                    </div>
                <div class="form-group col-md-12">
                        <label>Chi tiết</label>
                        <textarea name="txtDesc" id ="mytextarea" class="form-control" style="height:500px;">{{ $book->description }}</textarea>
                </div>

                    <div class="form-group col-md-12">
                        <fieldset>  <legend>SEO:</legend>
                            SEO Title <input type="text" name="meta_title" class="form-control"  value="{{ $book->meta_title }}">
                            Meta Keywords <input type="text" name="meta_keywords" class="form-control"  value="{{ $book->meta_keywords }}">
                            Meta Description <input type="text" name="meta_description" class="form-control"  value="{{ $book->meta_description }}">
                        </fieldset>

                    </div>
                </div>
                <div class="box-footer row">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        <span>Save and back</span>
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection
