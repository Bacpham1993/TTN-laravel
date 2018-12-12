@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <a href="{{ url('/admin') }}">Tổng quan</a>
                    </li>
                    <li class="active">
                        {{$title}}
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Content -->
        <a href="#" class="btn btn-success btnCreate">
            <i class="fa fa-plus"></i>
            <span>Create {{ $title }}  </span>
        </a>
        <p style="height: 5px"></p>
    @if (Session::has('message'))
            <div class="alert alert-info"> {{ Session::get('message') }}</div>
    @endif
    <!-- .row -->
        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">ID</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Label</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Link</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Sort</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th></tr>
                            </thead>
                            <tbody>
                            @if (isset($menus) && count($menus) >0)
                                @foreach($menus as $menu)
                                    <tr role="row" class="odd">
                                        <td>{{ $menu->id }}</td>
                                        <td class="sorting_1">{{ $menu->label }}</td>
                                        <td>{{ $menu->link }}</td>
                                        <td>{{ $menu->sort }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-default bg-purple btnEdit" data-value="{{ $menu }}">
                                                    <i class="fa fa-edit"></i>
                                                    <span>Sửa</span>
                                                </a>
                                                <a href="#" class="btn btn-default bg-red btnDelete" data-value="{{ $menu->id }}">
                                                    <i class="fa fa-edit"></i>
                                                    <span>Xóa</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div style="float:right">
                            {{--{!! $listnews->render() !!}--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box -->


    </div>
    <!-- /.content -->
    <form action="" method="post" id="formDelete">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
    </form>
    <div id="confirmDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p> When you delete this item, you will delete all news in it. Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    {{--./modal fix--}}
    <form action="" method="post" id="formEdit">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}

    <div id="confirmEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Label</label>
                        <input class="form-control" name = "label" value="" required autofocus>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name = "link" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Parent menu</label>
                        <select class="form-control" id="parentFix" name="parent_id"  value="" required>
                            <option value="0">---</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{$menu->label}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort</label>
                        <input class="form-control" name = "sort" value="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="editconfirm">Save</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    {{-- modal/create --}}
    <form action="" method="POST" id="formCreate">

        {{ csrf_field() }}

        <div id="confirmCreate" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create {{$title}}</h4>
                    </div>
                    <div class="modal-body">
                        @if(count($errors) >0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group">
                            <label>Label</label>
                            <input class="form-control" name = "label" value="{{ old('label') }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name = "link" value="{{ old('link') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Parent menu</label>
                            <select class="form-control" id="parentFix" name="parent_id"  value="{{ old('parent_id') }}" required>
                                <option value="0">---</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{$menu->label}}</option>

                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                                <label>Sort</label>
                                <input class="form-control" name = "sort" value="0" disabled>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-primary" id="create">Create</button>
                        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('page-js-script')
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script>
            $(function() {
                $('#confirmCreate').modal('show');
            });
        </script>
    @endif
    <script>

        $(document).ready(function() {

            $('.btnDelete').click(function(){
                var userId = $(this).attr('data-value');
                $('#confirmDelete')
                    .modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#delete', function (e) {
                        //delete function
                        var actionLink = "{{ url('admin/menus/')}}/"+ userId;
                        $('#formDelete').attr('action', actionLink).submit();

                    });
            });
            //btnCreate
            $('.btnCreate').click(function(){
                $('#confirmCreate')
                    .modal({ backdrop: 'static', keyboard: true })
                    .one('click', '#create', function (e) {
                        //Create function
                        var actionLink = "{{ url('admin/menus')}}";
                        $('#formCreate').attr('action', actionLink).submit();

                    });
            });
            //btnEdit
            $('.btnEdit').click(function(){
                var recv = $(this).attr('data-value');
                var data = JSON.parse(recv);
                var k = (data.label).lastIndexOf("-");
                var label = (data.label).substr(k+1,(data.label).length).toUpperCase();


                $('#confirmEdit').find('input[name="label"]').val(label);
                $('#confirmEdit').find('input[name="link"]').val(data.link);
                $('#confirmEdit').find('select[name=parent_id]').val(data.parent);
                $('#confirmEdit').find('input[name="sort"]').val(data.sort);



                //alert(xxx);
                // $("#confirmEdit").on('show.bs.modal', function (e) {
                //     var xxx=$(e.currentTarget).find('input[name="label"]').val();
                //     alert(xxx);
                //
                // });

            $('#confirmEdit')
                    .modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#editconfirm', function (e) {
                        //Edit function
                        var actionLink = "{{ url('admin/menus/')}}/"+ data.id;
                        $('#formEdit').attr('action', actionLink).submit();

                    });
                //var label =$('#confirmEdit .modal-dialog .modal-content .modal-body').find('input[name=label]').val;
                //alert(label);
                //alert();
            });



        });
    </script>

@endsection
