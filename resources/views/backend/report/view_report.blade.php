@extends('admin.admin_master')

@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->
     

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
          {{-- Add Search Page  --}}

        <div class="col-4">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Search By Date</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                        <form method="POST" action="{{ route('search-by-date') }}">
                            @csrf
                <div class="row">
                    <div class="col-12">	
                            
                                <div class="form-group">
                                        <h5>Select Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                        <input type="date" name="date" class="form-control">

                                        @error('date')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>
     
                           <div class="text-xs-right">
                              <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
              <!-- /.box-body -->
            </div>
                    
          </div>
    <!-- /.row -->

    <div class="col-4">

        <div class="box">
           <div class="box-header with-border">
             <h3 class="box-title">Search By Month</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
               <div class="table-responsive">
                     <form method="POST" action="{{ route('search-by-month') }}">
                         @csrf
             <div class="row">
                 <div class="col-12">	
                         
    <div class="form-group">
            <h5>Select Month <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="month" class="form-control" id="">
                        <option label="Choose One"></option>
                        <option name="January">January</option>
                        <option name="February">February</option>
                        <option name="March">March</option>
                        <option name="April">April</option>
                        <option name="May">May</option>
                        <option name="June">June</option>
                        <option name="July">July</option>
                        <option name="August">August</option>
                        <option name="September">September</option>
                        <option name="October">October</option>
                        <option name="November">November</option>
                        <option name="December">December</option>
                    </select>

            @error('month')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
    </div>

    <div class="form-group">
            <h5>Select Year <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="year_name" class="form-control" id="">
                        <option label="Choose One"></option>
                        <option name="2020">2020</option>
                        <option name="2021">2021</option>
                        <option name="2022">2022</option>
                        <option name="2023">2023</option>
                        <option name="2024">2024</option>
                        <option name="2025">2025</option>
                        <option name="2026">2026</option>
                    </select>

            @error('year_name')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
    </div>
      
                        <div class="text-xs-right">
                           <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                        </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
           <!-- /.box-body -->
         </div>
                 
       </div>
 <!-- /.row -->

 <div class="col-4">

    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Select Year</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
                 <form method="POST" action="{{ route('search-by-year') }}">
                     @csrf
         <div class="row">
             <div class="col-12">	
                     
            <div class="form-group">
                    <h5>Search Year <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="year" class="form-control" id="">
                                <option label="Choose One"></option>
                                <option name="2020">2020</option>
                                <option name="2021">2021</option>
                                <option name="2022">2022</option>
                                <option name="2023">2023</option>
                                <option name="2024">2024</option>
                                <option name="2025">2025</option>
                                <option name="2026">2026</option>
                            </select>
        
                    @error('year')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
        
                </div>
            </div>
            
                        
                    <div class="text-xs-right">
                       <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                    </div>
                 </div>
             </div>
         </form>
     </div>
 </div>
       <!-- /.box-body -->
     </div>
             
   </div>
<!-- /.row -->
        </div>
       
   
      </section>
    </div>
      <!-- /.content -->
    
   



@endsection