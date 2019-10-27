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
                <li class="active">اضف</li>
            </ol>
        </section>

        <section class="content">
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'اضف مطبعة' }}</h3>
                        </div>
                    @include('common::partials._errors')
                    <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{ route('printers.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">الاسم</label>
                                    <input class="form-control" type="text" value="{{ old('name') }}" name="name">
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">العنوان</label>
                                    <input class="form-control" type="text" value="{{ old('address') }}" name="address">
                                </div>


                                <div class="form-group">
                                    <label style="font-family: 'Cairo', sans-serif;">صاحب المطبعة</label>
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                        <select class="form-control" name="user_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input value="{{ auth()->user()->user_id !== null ? auth()->user()->user_id : auth()->user()->id }}" name="user_id" class="hidden" hidden>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input hidden class="hidden" name="logo" type='file' id="imgInp" />
                                    <img style="width: 70px;height: 70px;" id="blah" src="{{ url('storage/printers/default.png') }}" alt="your image" />

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
<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });

    $('#blah').on('click',function(){
        $('#imgInp').click();
    });

</script>
@endpush

