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
                <h3 class="box-title">Product Stock List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>image</th>
                            <th>Product En</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Status</th>
                            
                          
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($products as $item)
            
                          <tr>
                          <td><img src="{{ asset($item->product_thumbnail) }}" style="width:60px; height:50px; "alt=""></td>
                            <td>{{$item->product_name_en}}</td>
                            <td>${{$item->selling_price}}</td>
                            <td>{{$item->product_qty}}pc</td>
                            <td>
                                @if ($item->discount_price == null)
                                    <span class="badge badge pillbadge-danger">No Discount</span> 
                                @else
                                    @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/$item->selling_price) * 100;
                                    @endphp

                            <span class="badge badge-pill badge-danger">{{round($discount) }}%</span> 
                                @endif

                            </td>

                          <td>
                            @if ($item->status == 1)
                                <span class="badge badge-pill badge-success">Active</span>
                            @else
                            <span class="badge badge-pill badge-danger">Inactive</span>
                                
                            @endif
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

        </div>
      </section>
    </div>


@endsection