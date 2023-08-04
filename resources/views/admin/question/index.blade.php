@extends('layouts.app')

@section('title', 'User Questions')

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
                                        <th>User Name</th>
                                        <th>Item Name</th>
                                        <th>Question</th>
                                        <th>Read/Unread</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @if ($questions->count() > 0)
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $question->user->name }}</td>
                                                    <td>{{ $question->item->name }}</td>
                                                    <td>{{ $question->question }}</td>
                                                    <td>
                                                        @if ($question->is_read == 0)
                                                        <span class="badge badge-primary">Unread</span>
                                                        @else
                                                        <span class="badge badge-secondary">Read</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user.question.show', $question->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('user.questions.destory', $question->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
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
