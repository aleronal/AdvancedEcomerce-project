@php
    $user = App\Models\User::findOrFail(Auth::id());
@endphp

<div class="col-md-2"><br>
    <img  class="card-img-top" style="border-radius:50%" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg') }}" height="100%" width="100%" ><br><br>
    <ul class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
        <a href="{{ route('user.orders') }}" class="btn btn-primary btn-sm btn-block">My Orders</a>
        <a href="{{ route('returned.orders.list') }}" class="btn btn-primary btn-sm btn-block">Returned Orders</a>
        <a href="{{ route('cancelled.orders.list') }}" class="btn btn-primary btn-sm btn-block">Cancelled Orders</a>
        <a href="{{route('user.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Log Out</a>
       
    </ul>
</div>