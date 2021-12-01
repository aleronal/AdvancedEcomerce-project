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
                <h3 class="box-title">All Success Returned Orders List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                      
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $item)
            
                          <tr>
                              <td>{{$item->order_date}}</td>
                              <td>{{$item->invoice_number}}</td>
                              <td>${{$item->amount}}</td>
                              <td>{{$item->payment_method}}</td>

                              @if ($item->return_order == 1)
                                <td><span class="badge badge-pill badge-success">Pending</span></td>
                                  
                              @elseif($item->return_order == 2)
                                <td><span class="badge badge-pill badge-success">Success</span></td>
                              @endif

                            
                            
                            <td width="25%">
                           <span class="badge badge-success">Return Success</span>
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
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

  </div>

</div>


@endsection