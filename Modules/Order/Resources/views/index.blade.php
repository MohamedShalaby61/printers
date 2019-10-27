@extends('common::layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                الطلبات
                <small>لوحة التحكم</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">الطلبات</li>
            </ol>
        </section>

        <section style="height: 600px" class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'جدول الطلبات' }}</h3>
                        </div>

                        <div class="box-body">
                            @include('common::partials._session')
                            @if($rows->count() > 0)
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            
                                            <th>اسم الطابعة</th>
                                            
                                            <th>حالة الطلب</th>
                                            <th>نوع الطلب</th>
                                            <th>نوع الخدمة</th>
                                            <th>صاحب الطلب</th>
                                            <th>العمليات</th>
                                        </tr>
                                        <tr class="good">
                                            <th>#</th>
                                            
                                            <th>اسم الطابعة</th>
                                            
                                            <th>حالة الطلب</th>
                                            <th>نوع الطلب</th>
                                            <th>نوع الخدمة</th>
                                            <th>صاحب الطلب</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    @foreach($rows as $index=>$row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            
                                                <td>{{ $row->printer_details->name }}</td>
                                            
                                            <td>{{ $row->order_status->status }}</td>
                                            <td>{{ $row->order_type->type }}</td>
                                            <td>{{ $row->service_type->name }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>
                                                <form action="{{ route('orders.destroy',$row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                        <a href="{{route('orders.show',$row->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('orders.edit',$row->id) }}" class="btn btn-success btn-sm"
                                                            data-toggle="modal" data-target="#edit-modal"
                                                        ><i class="fa fa-edit"></i></a>
                                                        <button type="submit" onclick="return confirm('هل انت متأكد من حذف هذا الطلب')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h1 style="font-family: 'Cairo', sans-serif;">للاسف لا يوجد طلبات حتي الان</h1>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

@endpush

@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/w/bs/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>
    <script type="text/javascript">
    
        $(document).ready( function () {
            $('#table_id').DataTable({
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo( $(column.header()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
         
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
         
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                },
                "columnDefs": [
                    
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 4 },
                    { "orderable": false, "targets": 5 },
                    { "orderable": false, "targets": 6 },

                ]
            });
            

            $('.sorting_asc select').addClass('hidden');
            $('.sorting_disabled').last().addClass('hidden');

            //$('.good').eq(2).addClass('hidden');

            //jQuery('.good').find('th:eq(2)').addClass('hidden').attr('hidden','hidden');
        });

        

    </script>
@endpush