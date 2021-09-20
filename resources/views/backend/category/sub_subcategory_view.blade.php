@extends('admin.admin_master')

@section('admin')

{{-- jquery CDN --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-8">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Sub->SubCategory List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Category</th>
                            <th>Sub Category Name </th>
                            <th>Sub SubCategory English</th>
                            
                            <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($subsubcategory as $item)
            
                          <tr>
                              <td>{{ $item->category->category_name_en }}</td>
                              <td>{{ $item->subcategory->subcategory_name_en }}</td>
                              <td>{{$item->subsubcategory_name_en}}</td>
                              
                              
                              <td width="50%">
                              <a href="{{route('subsubcategory.edit', $item->id)}}" class="btn btn-info">Edit</a>
                              <a href="{{route('subsubcategory.delete', $item->id)}}" id="delete" class="btn btn-danger ">Delete</a>
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
                <h3 class="box-title">Add Sub SubCategory</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('subsubcategory.store') }}" >
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                    <div class="form-group">
                            <h5>Select Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" class="form-control">
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
                        <h5>Select SubCategory <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subcategory_id"  class="form-control">
                                <option selected="" disabled="" value="">Select SubCategory</option>
                                
                                
                                
                            </select>

                            @error('subcategory_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                       
                    </div>
                </div>

                        <div class="form-group">
                                <h5>Sub SubCategory Name English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subsubcategory_name_en" class="form-control">

                                @error('subsubcategory_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                                <h5>Sub SubCategory Name Spanish <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="text" name="subsubcategory_name_es" class="form-control">

                                @error('subsubcategory_name_es')
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

<script type="text/javascript">

    $(document).ready(function(){
        $('select[ name="category_id" ]').on('change', function(){
            var category_id = $(this).val();
            if(category_id)
            {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key,value){
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                    });
                },
            });
        }else {
            alert('danger');
        }
    });
});

</script>

@endsection