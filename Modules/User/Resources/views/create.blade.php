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
                <li class="active">اضف</li>
            </ol>
        </section>

        <section class="content">
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'اضف عضو' }}</h3>
                        </div>
                    @include('common::partials._errors')
                    <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الاسم</label>
                                    <input class="form-control" type="text" value="{{ old('name') }}" name="name">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">البريد الالكتروني</label>
                                    <input class="form-control" type="email" value="{{ old('email') }}" name="email">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">كلمة المرور</label>
                                    <input class="form-control" placeholder="كلمة مرور العضو" type="password" name="password">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الصلاحيات</label>
                                    <select class="form-control" name="role_id">
                                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        @elseif(auth()->user()->role_id == 3)
                                            <option value="5">موظف</option>
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>اضف</button>
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

