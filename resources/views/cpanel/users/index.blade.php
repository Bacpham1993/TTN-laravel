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
        {{--<button class="btn btn-success btnCreate">
            <i class="fa fa-plus"></i>
            <span>Create new user</span>
        </button>--}}
        <a href="{{ url('admin/users/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span>Create new user</span>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Password</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Hành động</th></tr>
                            </thead>
                            <tbody>
                            @if (isset($users) && count($users) >0)
                                @foreach($users as $user)
                                    <tr role="row" class="odd">
                                        <td>{{ $user->id }}</td>
                                        <td class="sorting_1">{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>[Encrypted]</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('admin/users')}}/{{ $user->id }}/edit" class="btn btn-default bg-purple">
                                                    <i class="fa fa-edit"></i>
                                                    <span>Sửa</span>
                                                </a>
                                                <a href="#" class="btn btn-default bg-red btnDelete" data-value="{{ $user->id }}">
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
                            {{--{!! $users->render() !!}--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box -->


    </div>
    <!-- /.content -->
    {{-- form delete --}}
    <form action="" method="post" id="formDelete">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
    </form>
    <div id="confirm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Xác nhận xóa</h4>
                </div>
                <div class="modal-body">
                    <p> Bạn có chắc chắn không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Xóa</button>
                    <button type="button" data-dismiss="modal" class="btn">Hủy</button>
                </div>
            </div>
        </div>
    </div>
{{-- ./form delete--}}
    {{--<form action="" method="post" id="formRegister">
        <input type="hidden" name="_method" value="GET">
        {{ csrf_field() }}
    </form>
    <div id="mCreateUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create new user</h4>
                </div>
                <div class="modal-body">
                    --}}{{--modal register--}}{{--
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                --}}{{--end modal register--}}{{--
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="confirmCreate">Confirm</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
@section('page-js-script')
    <script>

        $(document).ready(function() {

            $('.btnDelete').click(function(){
                var userId = $(this).attr('data-value');
                $('#confirm')
                    .modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#delete', function (e) {
                        //delete function
                        var actionLink = "{{ url('admin/users/')}}/"+ userId;
                        $('#formDelete').attr('action', actionLink).submit();

                    });
            });
            //create new user
          /*  $('.btnCreate').click(function(){
                var userId = $(this).attr('data-value');
                $('#mCreateUser')
                    .modal({ backdrop: 'static', keyboard: false })
                    .one('click', '#confirmCreate', function (e) {
                        //delete function
                        var actionLink = "{{ url('admin/users/')}}/"+ userId;
                        $('#formRegister').attr('action', actionLink).submit();

                    });
            });*/
        });
    </script>
@endsection