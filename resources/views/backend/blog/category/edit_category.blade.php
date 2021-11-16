@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
        
          {{-- Add Blog Category Page  --}}

        <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Blog Category</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('blog-category-update', $blogCategory->id) }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                                <div class="form-group">
                                        <h5>Blog Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="blog_category_name_en" class="form-control" value="{{$blogCategory->blog_category_name_en}}">

                                        @error('blog_category_name_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Blog Category Name Spanish <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="blog_category_name_es" class="form-control"
                                        value="{{$blogCategory->blog_category_name_es}}">

                                        @error('blog_category_name_es')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                            
                                
                               
                           <div class="text-xs-right">
                              <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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