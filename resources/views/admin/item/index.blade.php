@extends('layouts.app')

@section('title','Item')

@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

@endpush

@section('content')

 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('item.create') }}" class="btn btn-info">Add New</a>
               @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">All Item</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table">
                      <thead class="text-primary">
                        <th>SL</th>
                        <th>Name</th>
                        <th>Images</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach($items as $key=>$item)
                           <tr>
                             <td>{{ $key + 1 }}</td>
                             <td>{{ $item->name }}</td>
                              <td><img src="{{ asset('uploads/item/'.$item->image) }}" alt="" style="height:100px; width:150px;"></td>
                              <td>{{ $item->category->name }}</td>
                              <td>{{ $item->description }}</td>
                              <td>{{ $item->price }}</td>
                              <td>{{ $item->quantity }}</td>

                               <td>
                                 <a href="{{ route('item.edit', $item->id) }}" class="btn btn-info"><i class="material-icons">edit</i></a>

                                 <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id) }} " method="POST">
                                   @csrf
                                   @method('DELETE')
                                 </form>
                                 <button class="btn btn-danger" type="button" onclick="if(confirm('Are you sure? Want to delete this?')){
                                   event.preventDefault();
                                   document.getElementById('delete-form-{{ $item->id }}').submit();
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
