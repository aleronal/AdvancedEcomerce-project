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
              <h3 class="box-title">Total Users<span class="badge badge-pill badge-success">{{ $users->count() }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Status</th>
                              <th>Status</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($users as $user)
            
                          <tr>
                            <td>                           
                            <img src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" style=" width:50px; height=50px" alt="">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>

                            @if($user->userOnline())
                              <td><span class="badge badge-pill badge-success">Active Now</span></td>
                              <td>
                            @else
                              <td><span class="badge badge-pill badge-danger">{{Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span></td>
                              <td>
                            @endif

                           
                            <a href="" class="btn btn-info">Edit</a>
                            <a href="" id="delete" class="btn btn-danger">Delete</a>
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

      


@endsection