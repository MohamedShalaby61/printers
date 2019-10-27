@extends('common::layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    @if(auth()->user()->role_id == 1 || (auth()->user()->role_id == 2 || auth()->user()->role_id == 3))
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                الرئيسية
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">الرئيسية</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $printers->count() }}</h3>

                            <p>عدد المطابع</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-print"></i>
                        </div>
                        <a href="#" class="small-box-footer">رؤية المزيد <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $users->count() }}</h3>

                            <p>الموظفين التابعين</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">رؤية المزيد <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $ownerRows->count() }}</h3>

                            <p>اصحاب المطابع</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <a href="#" class="small-box-footer">رؤية المزيد <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $rows->count() }}</h3>

                            <p>الطلبات</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="#" class="small-box-footer">رؤية المزيد <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                    <!-- Left col -->
                <div class="col-md-6">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">احدث الموظفين</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>الترتيب</th>
                                        <th>الإسم</th>
                                        <th>البريد الالكترونى</th>
                                    </tr>
                                    </thead>
                                        @foreach($users as $index=>$user)
                                    <tbody>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tbody>
                                        @endforeach
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
                
            <!-- Left col -->
                <div class="col-md-6">

                    <!-- TABLE: LATEST Bookings -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">اصحاب المطابع</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>الترتيب</th>
                                        <th>الإسم</th>
                                        <th>البريد الالكتروني</th>
                                    </tr>
                                    </thead>
                                    @foreach($ownerRows as $index=>$row)
                                    <tbody>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            
        </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    @endif
@endsection
