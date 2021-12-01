@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Edit Admin User </h4>
             
           </div>
           <!-- /.box-header -->
           <div class="box-body">
                <div class="row">
                    <div class="col">
                    <form method="POST" action="{{ route('update-admin-user')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value= {{$admin->id}}>
                <input type="hidden" name="oldimage" value= {{$admin->profile_photo_path}}>

            <div class="row">
                <div class="col-12">	
                           
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                    <h5>Admin UserName <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="name" class="form-control" value="{{$admin->name}}"></div>
                            </div>
                    </div>
                {{-- end col-md-6 --}}
                
                   
                    <div class="col-md-6">
                            <div class="form-group">
                                    <h5>Admin email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required="" value={{$admin->email}}></div>
                            </div>
                    </div>
                                {{-- end col-md-6 --}}
                </div>
                            {{-- end-row --}}

                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                    <h5>Admin User Phone <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" name="phone" class="form-control" value={{$admin->phone}}></div>
                            </div>
                    </div>
                {{-- end col-md-6 --}}
                         
                </div>
                           
                          
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                <h5>Admin User Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                <input type="file" name="profile_photo_path" class="form-control" id="image"></div>
                            </div>
                    </div>

                    <div class="col-md-6">
                        <img id="showImage" 
                        src="
                        {{ ($admin->profile_photo_path == null)
                        ? url('upload/no_image.jpg')
                        : asset($admin->profile_photo_path)
                         }}" style="width:100px; height:100px;" alt=""
                         >
                    </div>
                </div>
                {{-- end row --}}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    
                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" value="1" name="brand" 
                            {{ ($admin->brand == 1) ? 'Checked' : ''  }} >
                            <label for="checkbox_2">Brand</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" value="1" name="category" 
                            {{ ($admin->category == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_3">Category</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_4" value="1" name="product" 
                            {{ ($admin->product == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_4">Product</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_5" value="1" name="slider"
                            {{ ($admin->slider == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_5">slider</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_6" value="1" name="coupons"
                            {{ ($admin->coupons == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_6">Coupons</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_7" value="1" name="shipping"
                            {{ ($admin->shipping == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_7">Shipping</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_8" value="1" name="blog"
                            {{ ($admin->blog == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_8">Blog</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_9" value="1" name="setting"
                            {{ ($admin->setting == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_9">Setting</label>
                            </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_10" value="1" name="returnorder"
                            {{ ($admin->returnorder == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_10">Return Order</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_11" value="1" name="review"
                            {{ ($admin->review == 1) ? 'Checked' : ''  }}>
                            <label for="checkbox_11">Review</label>
                        </fieldset>
                        
                    </div>
                </div>
            </div>
                <div class="col-md-4">
                        <div class="form-group">
                            
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_12" value="1" name="orders"
                                    {{ ($admin->orders == 1) ? 'Checked' : ''  }}>
                                    <label for="checkbox_12">Orders</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_13" value="1" name="stock"
                                    {{ ($admin->stock == 1) ? 'Checked' : ''  }}>
                                    <label for="checkbox_13">Stock </label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_14" value="1" name="reports"
                                    {{ ($admin->reports == 1) ? 'Checked' : ''  }}>
                                    <label for="checkbox_14">Reports </label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_15" value="1" name="alluser"
                                    {{ ($admin->alluser == 1) ? 'Checked' : ''  }}>
                                    <label for="checkbox_15">All User Deals</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_16" value="1" name="adminuserrole"
                                    {{ ($admin->adminuserrole == 1) ? 'Checked' : ''  }}>
                                    <label for="checkbox_16">Admin User Role </label>
                                </fieldset>
                            </div>
                        </div>
                    </div>

        </div>
                        
                           
                       <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Admin User">
                       </div>
                   </form>
                </div>   
               
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->

       </section>
    <!-- /.content -->
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>


    @endsection