@extends('mainviews.app')
@section('content')
<div class="table-responsive">
    <table class="table table-hover mb-0">
       <tbody>

         @foreach ($notifications as $notification )
             @if ($notification->status == 0)
                      
          <tr>
            <td class="wd-5p">
               <div class="mg-l-15 d-flex custom-control custom-checkbox">
                  <input checked disabled type="checkbox" class="custom-control-input" id="customCheck21">
                  <label class="custom-control-label" for="customCheck21"></label>
               </div>
            </td>
            <td class="wd-5p"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star wd-16"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></a></td>
            <td class="wd-15p"><b> SISTEM  </b></td>
            <td><a href="/read_notification/{{$notification->id}}"><span class="badge badge-outline-warning mr-2">Yeni</span> <b> {{$notification->title}} </b></a></td>
            <td class="wd-15p">
               <p class="mb-0 tx-10 tx-gray-500">{{$notification->created_at}}</p>
            </td>
         </tr>
             
             @else
             <tr>
               <td class="wd-5p">
                  <div class="mg-l-15 d-flex custom-control custom-checkbox">
                     <input checked disabled type="checkbox" class="custom-control-input" id="customCheck21">
                     <label class="custom-control-label" for="customCheck21"></label>
                  </div>
               </td>
               <td class="wd-5p"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star wd-16"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></a></td>
               <td class="wd-15p"><b> SISTEM  </b></td>
               <td><a href="/read_notification/{{$notification->id}}"> <span class="badge badge-outline-info mr-2">oxundu</span> <b> {{$notification->title}} </b></a></td>
               <td class="wd-15p">
                  <p class="mb-0 tx-10 tx-gray-500">{{$notification->created_at}}</p>
               </td>
            </tr>


             @endif
         @endforeach

   
       </tbody>
    </table>
 </div>
 {{ $notifications->links('mainviews.helper.paginator') }}
@endsection