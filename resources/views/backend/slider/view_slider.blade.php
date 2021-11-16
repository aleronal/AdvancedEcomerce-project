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
                <h3 class="box-title">Slider List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Slider Image </th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($slider as $item)
            
                          <tr>
                              <td>                            
                                <img src="{{asset($item->slider_image)}}" style = " width:70px; height=40px" alt=""></td>
                              <td>{{$item->slider_title}}</td>
                              <td>{{$item->slider_description}}</td>
                            <td>
                              @if ($item->status == 1)
                                <span class="badge badge-pill badge-success">Active</span>
                              @else
                                <span class="badge badge-pill badge-danger">Inactive</span>
                              @endif
                            </td>

                            <td width= 30%>
                              @if ($item->status == 1)
                                <a href="{{route('inactive.slider', $item->id)}}"class="btn btn-sm btn-danger" title="Inactive now"><i class="fa fa-arrow-down"></i></a>
                              @else 
                                <a href="{{route('active.slider', $item->id)}}"class="btn btn-sm btn-success" title="Active now"><i class="fa fa-arrow-up"></i></a>
                              @endif
                              <a href="{{route('edit.slider', $item->id)}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                              <a href="{{route('delete.slider', $item->id)}}" id="delete" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i></a>


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

          {{-- Add Slider Page  --}}

        <div class="col-4">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Add Slider</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('store.slider') }}" enctype="multipart/form-data">
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                                <div class="form-group">
                                        <h5>Slider Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="slider_title" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <h5>Slider Description <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="text" name="slider_description" class="form-control">
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