@extends('layouts.app')

@section('title', 'Category Edit')


@section('content')

 <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('category.update', $category->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category Name</label>
                          <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                        </div>
                      </div>
                      <div class="col-md-12">
                          <label class="bmd-label-floating">Image</label>
                          <input type="file" name="image" class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">Update</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
