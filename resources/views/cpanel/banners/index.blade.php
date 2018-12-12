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
            <a href="{{ url('admin/banners/create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i>
                <span>Create {{ $title }}</span>
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
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Tiêu đề</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Description</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Action</th></tr>
                                </thead>
                                <tbody>
                                @if (isset($events) && count($events) >0)
                                    @foreach($events as $event)
                                        <tr role="row" class="odd">
                                            <td>{{ $event->id }}</td>
                                            <td class="sorting_1">{{ $event->title }}</td>
                                            <td>{{ $event->description }}</td>
                                            <td><img style="width:150px;height:150px" src="{{ URL::to('/') }}/{{ $event->image }}"></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ url('admin/banners')}}/{{ $event->id }}/edit" class="btn btn-default bg-purple">
                                                        <i class="fa fa-edit"></i>
                                                        <span>Sửa</span>
                                                    </a>
                                                    <a href="#" class="btn btn-default bg-red btnDelete" data-value="{{ $event->id }}">
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
                                {!! $events->render() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box -->
            </div>
        <!-- /.container-fluid-->
        <!-- /.content -->
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
                        var actionLink = "{{ url('admin/banners/')}}/"+ userId;
                        $('#formDelete').attr('action', actionLink).submit();

                    });
            });
        });
    </script>
@endsection