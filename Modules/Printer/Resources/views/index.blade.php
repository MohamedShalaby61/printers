@extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                المطابع
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">المطابع</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'جدول المطابع' }}</h3>
                        </div>

                    <!-- /.box-header -->
                        <div class="box-body">
                            @include('common::partials._session')
                            @if($rows->count() > 0)
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>الصورة</th>
                                            <th>العنوان</th>
                                            <th>المالك</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $index=>$row)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td><img style="width: 50px;height: 50px" src="{{ url('/storage/printers/'.$row->logo) }}"></td>
                                            <td>{{ $row->address }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>
                                                <form action="{{ route('printers.destroy',$row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    @if(auth()->user()->role_id == 5 )
                                                        <a href="####" class="btn btn-success disabled btn-sm"><i class="fa fa-edit"></i></a>
                                                    @else
                                                        <a href="{{ route('printers.edit',$row->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                                        <button type="submit" onclick="return confirm('هل انت متأكد من حذف المطبعة')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    @else
                                                   
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h1 style="font-family: 'Cairo', sans-serif;">للاسف لا يوجد مطابع حتي الان</h1>
                            @endif
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