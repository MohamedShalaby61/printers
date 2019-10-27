@extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                الاعدادات
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">الاعدادات</li>
                <li class="active">تعديل</li>
            </ol>
        </section>

        <section style="height:600px" class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'تعديل الاعدادات' }}</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            @include('common::partials._session')
                            <div class="form-group">
                                <form class="form" id="form_send" action="{{ route('update_configs') }}" method="post">
                                    @csrf
                                    @method('put')
                                        <span class="button-checkbox">
                                            <button type="button" class="btn btn-success" data-color="success"><i class="state-icon glyphicon glyphicon-check"></i>&nbsp;استقبال الطلبات</button>
                                            <input type="checkbox" id="get_form" name="is_available" class="hidden" {{ $row->is_available == 1 ? 'checked' : '' }}>
                                        </span>
                                        <br/><br/>
                                    <button type="submit" class="btn btn-default">تعديل الاعدادات</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </section>
        
    </div>
@endsection



@push('js')
    <script>
        $(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});

    </script>
@endpush