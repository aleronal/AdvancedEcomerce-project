@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          {{-- Add State Page  --}}

        <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Edit State</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('update.state', $states->id) }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                        
                <div class="form-group">
                        <h5>Select Division <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id" id="select"  class="form-control">
                                <option selected="" disabled="" value="">Select Division</option>
                            @foreach ($divisions as $item)

                            <option value="{{$item->id}}" {{$item->id == $states->division_id ? 'selected' : '' }}>{{$item->division_name}}</option>

                            @endforeach
                                
                                
                            </select>

                            @error('division_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        
                    </div>
                </div>
                <div class="form-group">
                    <h5>Select District <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="district_id" id="select"  class="form-control">
                            <option selected="" disabled="" value="">Select District</option>
                        @foreach ($districts as $item)

                        <option value="{{$item->id}}"  {{$item->id == $states->district_id ? 'selected' : '' }}>{{$item->district_name}}</option>

                        @endforeach
                            
                            
                        </select>

                        @error('district_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    
                </div>
            </div>
                        
                        <div class="form-group">
                            <h5>State Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="state_name" class="form-control" value= {{$states->state_name}}>
                                    
                                    @error('state_name')
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