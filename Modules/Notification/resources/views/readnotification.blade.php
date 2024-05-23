@extends('mainviews.app')
@section('content')
<div class="card-body">

   <div class="pd-y-15 mg-t-15 bd-b">
      <div class="row">
         <div class="col-md-6 toolbar-left">
            <!--Sender Information-->
            <div class="d-flex">
               <span class="mg-r-10">
               <img src="{{asset('assets/images/avatar-design.png')}}" class="img-fluid wd-40 rounded-circle" alt="">
               </span>
               <div class="text-left">
                  <div class="tx-semibold">Admin</div>
               </div>
            </div>
         </div>
         <div class="col-md-6 text-md-right hidden-xs">
          
         </div>
      </div>
   </div>
   <div class="row mg-t-20 mg-b-15">
      <div class="col-md-12">
         <div class="mg-b-20 bd-b">
            Salam {{Auth::user()->name}}
            <p> {{$notification->content}}</p>
     
         </div>
      </div>
    
   </div>
</div>
 @endsection