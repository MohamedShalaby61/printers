@extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                الاعضاء
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">الاعضاء</li>
                <li class="active">تعديل</li>
            </ol>
        </section>

        <section class="content">
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'تعديل عضو' }}</h3>
                        </div>
                    @include('common::partials._errors')
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('users.update',$row->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الاسم</label>
                                    <input class="form-control" type="text" value="{{ $row->name }}" name="name">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">البريد الالكتروني</label>
                                    <input class="form-control" type="email" value="{{ $row->email }}" name="email">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">كلمة المرور</label>
                                    <input class="form-control" placeholder="اتركها فارغة ان لم ترد تغييرها" type="password" name="password">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الصلاحيات</label>
                                    <select class="form-control" name="role_id">
                                        @foreach($roles as $role)
                                            <option {{ $role->id == $row->role_id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> تعديل</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')

@endpush

