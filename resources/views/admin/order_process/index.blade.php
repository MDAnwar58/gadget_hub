@extends('layouts.app')

@section('title','User Order Process')

@push('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


@endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">All Item</h4>
                        </div>
                        <div class="card-body">
                            <div class="order_process-load">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="order-process-table">
                                    <thead class="text-primary">
                                    <th>SL</th>
                                    <th>User Name</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Order Status</th>
                                    <th>Order Read/Unread</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($order_items as $key=>$order_item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order_item->user->name }}</td>
                                            <td>{{ $order_item->item->name }}</td>
                                            <td>{{ $order_item->price * $order_item->quentity }}</td>
                                            <td>{{ $order_item->quentity }}</td>
                                            <td>
                                                @if($order_item->order_status == 0)
                                                    <span class="badge badge-warning badge-sm">Pendding</span>
                                                    <a href="{{ route('order.process.status', $order_item->id) }}" class="badge badge-info badge-sm status-change" data-url="" style="cursor: pointer;">Processing</a>
                                                @elseif ($order_item->order_status == 1)
                                                    <span class="badge badge-primary badge-sm">Processing</span>
                                                    <a href="{{ route('order.process.status', $order_item->id) }}" class="badge badge-info badge-sm status-change" data-url="" style="cursor: pointer;">Confirm</a>
                                                @else
                                                <span class="badge badge-success badge-sm">Complete</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order_item->is_read == 0)
                                                    <span class="badge badge-danger">unread</span>
                                                @else
                                                    <span class="badge badge-secondary">read</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('order.process.info.show', $order_item->id) }}" class="btn btn-info btn-sm">view</a>
                                                <button type="button" data-url="{{ route('order.process.destroy', $order_item->id) }}" class="btn btn-danger btn-sm order_process_delete">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

    <script src="{{ asset('backend/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#order-process-table').DataTable();
        } );
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // order status change
        $(document).on('click', '.status-change', function () {
           let url = $(this).data('url');

           $.ajax({
              type:"GET",
              url:url,
              success: function (data) {
                  if (data.status == 200)
                  {
                      // var data = JSON.parse(myData);
                      // var myTable = $('#order-process-table').DataTable().clear().rows.add(data).draw();
                      // $('#order-process-table').DataTable().ajax.reload();
                      // var table = $('#order-process-table').DataTable();
                      // table.ajax.reload();
                      // $("#order-process-table").dataTable().fnReloadAjax();
                      // $('.order_process-load').load(location.href+' .order_process-load');
                      // // $('#order_process-load').load(document.URL +  ' #order_process-load');
                      location.reload();
                      toastr.success(data.success);
                  }
              }
           });
        });

        // order process delete
        $(document).on('click', '.order_process_delete', function () {
            let url = $(this).data('url');

            $.ajax({
               type: "GET",
               url:url,
               success: function (data) {
                   if (data.status)
                   {
                       location.reload();
                       toastr.success(data.success);
                   }
               }
            });
        });
    </script>

@endpush
