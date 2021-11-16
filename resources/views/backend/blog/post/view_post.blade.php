@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Posts List</h3>
              <a class="btn btn-success" style="float:right"; href="{{route('add-post')}}">Add Post</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Post Category</th>
                            <th>Post Image</th>
                            <th>Post Title En</th>
                            <th>Post Title Es</th>
                            
                            <th> Action </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($blogPost as $item)
            
                          <tr>
                              <td>{{$item->category->blog_category_name_en}}</td>
                              <td><img src="{{asset($item->post_image) }}" style="width:60px; height:60px" alt=""></td>
                              <td>{{$item->post_title_en}}</td>
                              <td>{{$item->post_title_es}}</td>
                              
                              <td>
                              <a href="{{route('category.edit', $item->id)}}" class="btn btn-info">Edit</a>
                              <a href="{{route('category.delete', $item->id)}}" id="delete" class="btn btn-danger ">Delete</a>
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


  </div>

</div>


@endsection