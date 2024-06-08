@extends('mainviews.app')
@section('content')

<div class="col-md-12 col-lg-12">
    <div class="card mg-b-30">
       <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
             <div>
                <h6 class="card-header-title tx-13 mb-0">Striped Table</h6>
             </div>
         <form action="/notificationmodule/settings" method="POST">
             <div class="text-right">
               <select name="default_provider">
                  <option {{($defaultProvider == 'telegram')?'selected':''}} value="telegram"> telegram</option>
                  <option {{($defaultProvider == 'whatsapp')?'selected':''}} value="whatsapp"> whatsapp</option>
                  <option {{($defaultProvider == 'sms')?'selected':''}} value="sms"> sms</option>
                  <option {{($defaultProvider == 'email')?'selected':''}} value="email"> email</option>
               </select>
          </div>
       </div>
       <div class="card-body pd-0">
       <div class="table-responsive">
          <table class="table table-striped">
             <thead>
                <tr>
                   <th>Servis</th>
                   <th>Definition</th>
                   <th> <center> Status </center> </th>
             
                </tr>
             </thead>
             <tbody>
          
            @csrf
          @foreach ($notifications as $notification)
          <tr>
            <td>{{$notification->type}}</td>
            <td>{{$notification->definition}}</td>
            {{-- <input name="notification_ids[]" value="{{$notification->id}}" type="hidden"> --}}
            <td> <center> <input name="notification_ids[]" value="{{$notification->id}}" type="checkbox" {{($notification->status)?'checked':'' }}> </center>   </td>
         </tr>
          @endforeach
             </tbody>
         </table>
         <button type="submit"> save </button>
         </form>

       </div>
       </div>
    </div>
    </div>
 </div>
@endsection