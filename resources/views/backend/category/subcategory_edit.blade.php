@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          {{-- Add Brand Page  --}}

        <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Edit SubCategory</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                  <form method="POST" action="{{route('subcategory.update', $subcategory->id )}}" enctype="multipart/form-data">
                            @csrf


                <div class="row">
                    <div class="col-12">	

                            <div class="form-group">
                                    <h5>Select Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="select"  class="form-control">
                                        <option selected="" disabled="" value="">Select Category</option>
                                            @foreach ($categories as $item)
        
                                        <option value="{{$item->id}}" {{$item->id == $subcategory->category_id ? 'selected' :'' }}>{{$item->category_name_en}}</option>
        
                                            @endforeach
                                            
                                            
                                        </select>
        
                                        @error('category_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                   
                                </div>
                            </div>
                            
                                <div class="form-group">
                                        <h5>SubCategory Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="subcategory_name_en" class="form-control" 
                                        value="{{$subcategory->subcategory_name_en}}">

                                        @error('subcategory_name_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>SubCategory Name Spanish <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="subcategory_name_es" class="form-control"
                                        value="{{$subcategory->subcategory_name_es}}">

                                        @error('subcategory_name_es')
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


@endsection