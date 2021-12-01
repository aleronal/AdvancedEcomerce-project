@extends('admin.admin_master')

@section('admin')

    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">SubCategory List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Category</th>
                            <th>Sub Category Name English</th>
                            <th>Sub Category Spanish</th>
                            
                            <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($subcategory as $item)
            
                          <tr>
                              <td>{{ $item->category->category_name_en }}</td>
                              <td>{{$item->subcategory_name_en}}</td>
                              <td>{{$item->subcategory_name_es}}</td>
                              
                              <td width="50%">
                              <a href="{{route('subcategory.edit', $item->id)}}" class="btn btn-info">Edit</a>
                              <a href="{{route('subcategory.delete', $item->id)}}" id="delete" class="btn btn-danger ">Delete</a>
                              </td>
                              
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
                    
          </div>
          <!-- /.col -->

          {{-- Add Category Page  --}}

        <div class="col-4">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Add Sub Category</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('subcategory.store') }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                    <div class="form-group">
                            <h5>Select Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" id="select"  class="form-control">
                                    <option selected="" disabled="" value="">Select Category</option>
                                    @foreach ($categories as $item)

                                <option value="{{$item->id}}">{{$item->category_name_en}}</option>

                                    @endforeach
                                    
                                    
                                </select>

                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                           
                        </div>
                    </div>

                        <div class="form-group">
                                <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subcategory_name_en" class="form-control">

                                @error('subcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                                <div class="form-group">
                                        <h5>Sub Category Name Spanish <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="subcategory_name_es" class="form-control">

                                        @error('subcategory_name_es')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                                
                                
                               
                           <div class="text-xs-right">
                              <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                           </div>
                       </form>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
                    
          </div>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>


@endsection