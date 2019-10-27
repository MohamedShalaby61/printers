@extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                المشرفين
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">المشرفين</li>
            </ol>
        </section>

        <section style="height: 600px" class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'جدول المشرفين' }}</h3>
                        </div>


                        <!-- /.box-header -->
                        <div class="box-body">
                            @include('common::partials._session')
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الايميل</th>
                                        <th>الصورة</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $index=>$row)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td><img style="width: 50px;height: 50px" src="{{ url('/storage/'.$row->avatar) }}"></td>
                                            <td>
                                                <form action="{{ route('users.destroy',$row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('users.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" onclick="return confirm('هل انت متأكد من حذف هذا العضو')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

@endpush

@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/w/bs/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>
    <script type="text/javascript">
    
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush