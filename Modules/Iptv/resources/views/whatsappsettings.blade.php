@extends('mainviews.app')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card mg-b-30">
       <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
             <div>
                <h6 class="card-header-title tx-13 mb-0">Striped Table</h6>
             </div>
             <div class="text-right">

          </div>
       </div>
       <div class="card-body pd-0">
       <div class="table-responsive">
          <table class="table table-striped">
             <thead>
                <tr>
                   <th>Servis</th>
                   <th> <center> Status </center> </th>
             
                </tr>
             </thead>
             <tbody>
          
                <tr>
                   <td>Yeni istifadeci yardildiqda bildiris gelsin</td>
                   <td> <center> <input type="checkbox"> </center>   </td>
                </tr>
          
             </tbody>
          </table>
       </div>
       </div>
    </div>
    </div>
 </div>
@endsection