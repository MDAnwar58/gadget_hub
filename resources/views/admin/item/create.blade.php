@extends('layouts.app')

@section('title', 'Item Create')


@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Add New</h4>
          </div>
          <div class="card-body">
            @include('layouts.partial.msg')
            <form action="{{ route('item.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating pb-3">Category</label>
                  <select class="form-control" name="category">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Name</label>
                  <input type="text" name="name" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
             <div class="col-md-6">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Price</label>
                    <input type="number" name="price" class="form-control">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Quantity</label>
                    <input type="number" name="quantity" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label class="bmd-label-floating">Image</label>
              <input type="file" name="image" class="form-control">
            </div>
          </div>
          <div class="row">
           <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Description</label>
              <textarea class="form-control" name="description"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-info pull-right">Create</button>
        <div class="clearfix"></div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>

@endsection
