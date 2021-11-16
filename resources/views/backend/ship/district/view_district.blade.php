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
                <h3 class="box-title">District List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Division Name</th>
                            <th>District Name</th>
                            
                            <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($districts as $item)
            
                        <tr>
                            <td>{{$item->division->division_name}}</td>
                            <td>{{$item->district_name}}</td>
                              
                        

                              <td width = "40%">
                              <a href="{{route('edit.district', $item->id)}}" class="btn btn-info">Edit</a>
                              <a href="{{route('delete.district', $item->id)}}" id="delete" class="btn btn-danger ">Delete</a>
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

          {{-- Add District Page  --}}

        <div class="col-4">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Add District</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('store.district') }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                        
                <div class="form-group">
                        <h5>Select Division <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id" id="select"  class="form-control">
                                <option selected="" disabled="" value="">Select Division</option>
                            @foreach ($divisions as $item)

                            <option value="{{$item->id}}">{{$item->division_name}}</option>

                            @endforeach
                                
                                
                            </select>

                            @error('division_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        
                    </div>
                </div>
                        
                        <div class="form-group">
                            <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name" class="form-control">
                                    
                                    @error('district_name')
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