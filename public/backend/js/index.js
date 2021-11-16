$(function(){
    $(document).on('click', '#delete', function(e){
      e.preventDefault();
      var link = $(this).attr("href");
  
            Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
    });
  });

//   confirmed
$(function(){
    $(document).on('click', '#confirmed', function(e){
      e.preventDefault();
      var link = $(this).attr("href");
  
            Swal.fire({
          title: 'Are you sure to Confirm?',
          text: "Once Confirm you can't revert this action!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, confirm it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Confirm!',
              'Order Confirmed',
              'success'
            )
          }
        })
    });
  });
//   processing
  $(function(){
    $(document).on('click', '#processing', function(e){
      e.preventDefault();
      var link = $(this).attr("href");
  
            Swal.fire({
          title: 'Are you sure to Process?',
          text: "Once Process you can't revert this action!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Process it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Process!',
              'Order Processed',
              'success'
            )
          }
        })
    });
  });