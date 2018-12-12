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
                        <a href="{{ url('/admin/banners') }}">Events</a>
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
        <form action="{{ url('/admin/banners') }}/{{ $event->id }}" method="POST" enctype="multipart/form-data">
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
                        <label>Title</label>
                        <input type="text" name="txtName" class="form-control" value="{{ $event->title }}" required autofocus>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea style="height:500px" name="txtDesc" id = "mytextarea" class="form-control">{{ $event->description }}</textarea>
                    </div>
                    <div class="form-group col-md-12">
                         <label>Image</label>
                        <input type="file" name="image" class="form-control">

                        <img src = "{{ URL::to('/') }}/{{ $event->image }}"  class="img-thumbnail" width="200px" height="200px">

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
