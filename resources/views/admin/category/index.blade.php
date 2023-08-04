@extends('layouts.app')

@section('title','Category')

@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endpush

@section('content')

 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('category.create') }}" class="btn btn-info">Add New</a>
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">All Category</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table">
                      <thead class=" text-primary">
                        <th>SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach($categories as $key=>$category)
                           <tr>
                             <td>{{ $key + 1 }}</td>
                             <td>
                                <img src="{{ url('uploads/category', $category->image) }}" style="width: 50px;" alt="">
                             </td>
                             <td>{{ $category->name }}</td>
                              <td>{{ $category->slug }}</td>

                               <td>
                                 <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info"><i class="material-icons">edit</i></a>

                                 <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }} " method="POST">
                                   @csrf
                                   @method('DELETE')
                                 </form>
                                 <button class="btn btn-danger" type="button" onclick="if(confirm('Are you sure? Want to delete this?')){
                                   event.preventDefault();
                                   document.getElementById('delete-form-{{ $category->id }}').submit();
                                 }
                                 else{
                                   event.preventDefault();
                                 }"><i class="material-icons">delete</i></button>
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
@endsection


@push('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
</script>

@endpush
