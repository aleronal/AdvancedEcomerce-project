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
                <h3 class="box-title">Blog Category List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            
                            <th>Blog Category Name English</th>
                            <th>Blog Category Spanish</th>
                            
                            <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($blogCategory as $item)
            
                          <tr>
                              <td>{{$item->blog_category_name_en}}</td>
                              <td>{{$item->blog_category_name_es}}</td>
                              
                              <td>
                              <a href="{{route('blog-category-edit', $item->id)}}" class="btn btn-info">Edit</a>
                              <a href="{{route('blog-category-delete', $item->id)}}" id="delete" class="btn btn-danger ">Delete</a>
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

          {{-- Add Blog Category Page  --}}

        <div class="col-4">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Add Blog Category</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('blog-category-store') }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                                <div class="form-group">
                                        <h5>Blog Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="blog_category_name_en" class="form-control">

                                        @error('blog_category_name_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Blog Category Name Spanish <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="blog_category_name_es" class="form-control">

                                        @error('blog_category_name_es')
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

  </div>

</div>


@endsection