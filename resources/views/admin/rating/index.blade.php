@extends('layouts.app')

@section('title', 'Users Rating')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title ">Users Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table">
                                    <thead class=" text-primary">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Item Name</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Read/Unread</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @if ($ratings->count() > 0)
                                            @foreach ($ratings as $rating)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $rating->user->name }}</td>
                                                    <td>{{ $rating->item->name }}</td>
                                                    <td>{{ $rating->rating }}</td>
                                                    <td>
                                                        @if ($rating->user->status == 'admin')
                                                        <span class="badge badge-warning">Admin</span>
                                                        @else
                                                        <span class="badge badge-primary">User</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($rating->is_read == 0)
                                                        <span class="badge badge-secondary">Unread</span>
                                                        @else
                                                        <span class="badge badge-dark">Read</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user.rating.show', $rating->id) }}"
                                                            class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('user.rating.destroy', $rating->id) }}"
                                                            class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" style="text-align: center;">User Not Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
