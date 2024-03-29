@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-full">
      <!-- Content Header (Page header) -->
     	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Product</h4>
          
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
              <form method="POST" action="{{route('store.product')}}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                      <div class="col-12">	


                        {{-- First Row --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h5>Select Brand <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="brand_id"  class="form-control" required="">
                        <option selected="" disabled="" value="">Select Category</option>
                            @foreach ($brands as $brand)

                        <option value="{{$brand->id}}">{{$brand->brand_name_en}}</option>

                            @endforeach
                                                      
                        </select>

                        @error('brand_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                 </div>
            </div>

        <div class="col-md-4">
            <div class="form-group">
                <h5>Select Category <span class="text-danger">*</span></h5>
                <div class="controls">
                <select name="category_id" id="select"  class="form-control" required="">
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
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <h5>Select Sub-Category <span class="text-danger">*</span></h5>
                        <div class="controls">
                        <select name="subcategory_id" class="form-control" required="">
                        <option selected="" disabled="" value="">Select Sub Category</option>
                        
                                
                        </select>

                        @error('subcategory_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        
                    </div>
                </div>
                </div>
            </div>

                        {{-- End firts row --}}


                        {{-- second row --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Sub Sub Category Select  <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subsubcategory_id"  class="form-control" required="">
                            <option selected="" disabled="" value="">Select Category</option>
                            
                                
                                
                            </select>

                            @error('subsubcategory_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Name En <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_name_en" class="form-control" required=""></div>

                                @error('product_name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                </div>

                    <div class="col-md-4">
                        <div class="form-group">
                                <h5>Product Name ES <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="product_name_es" class="form-control" required=""></div>
            
                                @error('product_name_es')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
             </div>

             {{-- end second row --}}

             {{-- Third Row --}}

             <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Code <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_code" class="form-control" required=""></div>
        
                            @error('product_code')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                                <h5>Product Qty<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="product_qty" class="form-control" required=""></div>
    
                                    @error('product_qty')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                    </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                    <h5>Product Tags En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_en" class="form-control" value="Small,Medium,Large" data-role="tagsinput" required=""></div>
                
                                    @error('product_tags_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
            </div>

             {{-- End third row --}}

             {{-- Fourth Row --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Tags ES <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_tags_es" class="form-control" value="Small,Medium,Large" data-role="tagsinput" required=""></div>
        
                            @error('product_tags_es')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
    
                    <div class="col-md-4">
                        <div class="form-group">
                                <h5>Product Size En <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="product_size_en" class="form-control" value="Small,Medium,Large" data-role="tagsinput" required=""></div>
            
                                @error('product_size_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                    <h5>Product Size Es <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_es" class="form-control" value="Pequeño,Mediano,Grande" data-role="tagsinput" required=""></div>
                
                                    @error('product_size_es')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
            </div>
             {{-- End fourth row --}}

             {{-- fifth row --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Color En <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_color_en" class="form-control" value="red, blue, black" data-role="tagsinput" required=""></div>
        
                            @error('product_color_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
            </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Color Es <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="product_color_es" class="form-control" value="Amarillo, rojo, Verde" data-role="tagsinput" required=""></div>
        
                            @error('product_color_es')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
        
                <div class="col-md-4">
                        <div class="form-group">
                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="selling_price" class="form-control" required=""></div>
            
                                @error('selling_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                </div>
            </div>

            {{-- end fifth row --}}

            {{-- Sixth row --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                            <h5>Product Discount price <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="discount_price" class="form-control" required="" ></div>
        
                            @error('discount_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
            </div>
        
                <div class="col-md-4">
                        <div class="form-group">
                            <h5>Main Thumbnail <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)" required="">
                            </div>
                            @error('product_thumbnail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <img src="" id="mainThumb" alt="">
                        </div>
                </div>
        
                <div class="col-md-4">
                        <div class="form-group">
                                <h5>Multiple Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" id="multiImg" name="multi_img[]" class="form-control" multiple="" required=""> </div>
                            @error('multi_img')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="row" id="preview_img">

                            </div>
                            </div>
                </div>
            </div>

                {{-- end Sixth row --}}
    
                {{-- seventh row --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                <h5>Short Description En <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea name="short_description_en" id="textarea" class="form-control" required placeholder="short Description"></textarea>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                            <div class="form-group">
                                    <h5>Short Description Es <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_description_es" id="textarea" class="form-control" required placeholder="Description Corta"></textarea>
                                    </div>
                                </div>
                    </div>
                   
                </div>

                {{-- end seventh row --}}

                {{-- Eight Row --}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                                <h5>Description En <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <textarea id="editor1" name="description_en" rows="10" cols="80">
                                    </textarea>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                            <div class="form-group">
                                    <h5>Description Es <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="description_es" rows="10" cols="80">
                                        </textarea>
                                    </div>
                            </div>
                    </div>
                </div>

                {{-- End eight row --}}
                          
                <hr>

            <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_2"  name="hot_deals"  value="1">
                                    <label for="checkbox_2">Hot Deals</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_3" value="1" name="featured">
                                    <label for="checkbox_3">Featured</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_4" value="1" name="special_offer">
                                    <label for="checkbox_4">Special Offer</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_5" value="1" name="special_deals">
                                    <label for="checkbox_5">Special Deals</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
            </div>

        <div class="col-md-6">
                <div class="form-group">
                    <h5>Digital Product <span class="text-danger">pdf,xlx,csv*</span></h5>
                    <div class="controls">
                        <input type="file" name="file" class="form-control" required="">
                    </div>
                </div>
        </div>
                      
                      <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
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
        $('select[ name="category_id" ]').on('change', function(){
            var category_id = $(this).val();
            if(category_id)
            {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="subsubcategory_id"]').html('');
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

    $('select[ name="subcategory_id" ]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id)
            {
                $.ajax({
                    url: "{{ url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key,value){
                        $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                    });
                },
            });
        }else {
            alert('danger');
        }
    });
});

</script>

<script type="text/javascript">

    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
                reader.readAsDataURL(input.files[0]);
            }
        }
    

</script>

<script type="text/javascript">

    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src', e.target.result).width(80).height(80);
            };
                reader.readAsDataURL(input.files[0]);
            }
        }
    

</script>


{{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>



@endsection