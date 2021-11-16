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
                <h3 class="box-title">Edit Slider</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('update.slider', $slider->id) }}" enctype="multipart/form-data">
                            @csrf

                        <input type="hidden" name="id" value="{{ $slider->id }}">
                        <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
                <div class="row">
                    <div class="col-12">	
                            
                                <div class="form-group">
                                        <h5>Slider Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="slider_title" class="form-control" 
                                        value="{{$slider->slider_title}}">

                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Slider Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="slider_description" class="form-control"
                                        value="{{$slider->slider_description}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="file" name="slider_image" class="form-control">

                                        @error('slider_image')
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