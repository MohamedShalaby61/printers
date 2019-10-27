@extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                العروض
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">العروض</li>
                <li class="active">تعديل</li>
            </ol>
        </section>

        <section class="content">
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'تعديل عرض' }}</h3>
                        </div>
                    @include('common::partials._errors')
                    <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('offers.update',$row->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">العنوان</label>
                                    <input class="form-control" type="text" value="{{ $row->title }}" name="title">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الوصف</label>
                                    <textarea class="form-control" name="content">{{$row->content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">كود العرض</label>
                                    <input class="form-control" type="text" value="{{$row->code}}" name="code">
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="font-family: 'Cairo', sans-serif;">يبدأ في</label>
                                    <input class="form-control" type="date" value="{{ $row->started_at }}" name="started_at">
                                </div>

                                <div class="form-group col-md-6">
                                    <label style="font-family: 'Cairo', sans-serif;">ينتهي في</label>
                                    <input class="form-control" type="date" value="{{ $row->ended_at }}" name="ended_at">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">نسبة الخصم المئوية</label>
                                    <input class="form-control" type="text" placeholder="نسبة الخصم بدون العلامة % " value="{{ $row->count }}" name="count">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الصورة</label>
                                    <input class="form-control" type="file" name="photo">
                                </div>


                                <div class="form-group">
                                    <img src="{{ url('storage/offers/'.$row->photo) }}">
                                </div>

                                

                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>تعديل</button>
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

