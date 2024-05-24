@extends('mainviews.app')
@section("content")
<div class="page-inner pd-0-force">
    <div class="bg-white mg-b-30">
       <div class="media col-md-10 col-lg-8 col-xl-7  mx-auto">
          <img src="{{asset('assets/images/avatar-design.png')}}" height="200" alt="" class="d-block rounded-circle hidden-xs">
          <div class="media-body ml-0 ml-md-5">
             <h4 class="tx-semibold">{{$user->name}}</h4>
             </p>
             <div class="d-flex mg-b-25">
           {{-- <button class="btn btn-default">{{$user->balance}} ₼</button> --}}
               {{-- <button class="btn btn-primary mg-l-10">Follow</button> --}}
             </div>
    
          </div>
       </div>
       <hr class="m-0">
    </div>
    <div class="row clearfix mg-x-15-force">
       <div class="col">
          <!-- Info -->
          <div class="card mg-b-30">
             <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="tx-16 tx-semibold mg-b-0">Personal Information</h6>
                <nav class="nav nav-with-icon tx-13">
                  
                </nav>
             </div>
             <!-- card-header -->
             <div class="card-body">
              
                <h6 class="my-3">Contacts</h6>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Name:</div>
                   <div class="col-md-9">{{$user->name}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Username:</div>
                   <div class="col-md-9">{{$user->username}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Balance:</div>
                   <div class="col-md-9">{{$user->balance}} ₼</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Email:</div>
                   <div class="col-md-9">{{$user->email}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Password:</div>
                   <div class="col-md-9">{{$user->password}}</div>
                </div>
       
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Phone:</div>
                   <div class="col-md-9"> {{$user->phone}} </div>
                </div>
      

             <div class="card-footer text-center p-0">
                <div class="row no-gutters row-bordered row-border-light">
                   <a href="" class="d-flex col flex-column  py-3">
                      {{-- <div class="font-weight-bold">24</div>
                      <div class="text-muted small">posts</div> --}}
                   </a>
                   <a href="" class="d-flex col flex-column  py-3 bd-l bd-r">
                      {{-- <div class="font-weight-bold">51</div>
                      <div class="text-muted small">videos</div> --}}
                   </a>
                   <a href="" class="d-flex col flex-column  py-3">
                      {{-- <div class="font-weight-bold">215</div>
                      <div class="text-muted small">photos</div> --}}
                   </a>
                </div>
             </div>
          </div>
        









          
       </div>
    </div>
    
       <div class="col">
          <!-- Info -->
          <div class="card mg-b-30">
             <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="tx-16 tx-semibold mg-b-0">Personal Information</h6>
                <nav class="nav nav-with-icon tx-13">
                  
                </nav>
             </div>
             <!-- card-header -->
             <div class="card-body">
              
                <h6 class="my-3">Contacts</h6>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Name:</div>
                   <div class="col-md-9">{{$user->name}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Username:</div>
                   <div class="col-md-9">{{$user->username}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Balance:</div>
                   <div class="col-md-9">{{$user->balance}} ₼</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Email:</div>
                   <div class="col-md-9">{{$user->email}}</div>
                </div>
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Password:</div>
                   <div class="col-md-9">{{$user->password}}</div>
                </div>
       
                <div class="row mb-2">
                   <div class="col-md-3 tx-gray-500 tx-semibold">Phone:</div>
                   <div class="col-md-9"> {{$user->phone}} </div>
                </div>
      

             <div class="card-footer text-center p-0">
                <div class="row no-gutters row-bordered row-border-light">
                   <a href="" class="d-flex col flex-column  py-3">
                      {{-- <div class="font-weight-bold">24</div>
                      <div class="text-muted small">posts</div> --}}
                   </a>
                   <a href="" class="d-flex col flex-column  py-3 bd-l bd-r">
                      {{-- <div class="font-weight-bold">51</div>
                      <div class="text-muted small">videos</div> --}}
                   </a>
                   <a href="" class="d-flex col flex-column  py-3">
                      {{-- <div class="font-weight-bold">215</div>
                      <div class="text-muted small">photos</div> --}}
                   </a>
                </div>
             </div>
          </div>
        









          
       </div>
    </div>
    </div>
    
 </div>
@endsection