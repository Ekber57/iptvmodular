
@extends('mainviews.app')
@section('content')
  
    <div class="col-md-12 col-lg-12">
        <div class="card mg-b-30">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-header-title tx-13 mb-0">Bank melumatlari</h6>
                    </div>

                </div>
            </div>

            
            @if (session()->has('data'))
                @php
                    $data = session()->get('data');
                @endphp

                {{-- Access your data here --}}

                <div class="alert alert-success alert-bordered pd-y-15" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close tx-16"></i></span>
                    </button>
                    <div class="d-sm-flex align-items-center justify-content-start">
                        <i class="ti-crown alert-icon tx-50 mg-r-20 tx-success"></i>
                        <div class="mg-t-20 mg-sm-t-0">
                            <h5 class="mg-b-2 tx-success"> {{ $data}}</h5>
                            <p class="mg-b-0 tx-gray">.</p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="/usermodule/useredit" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input name="name"   class="form-control form-control-sm" value="@if (!is_null($user)){{$user->name}}@else Ad @endif" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input name="password" class="form-control form-control-sm" value="@if (!is_null($user)){{$user->password}}@else Sifre @endif" type="string">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input name="phone" class="form-control form-control-sm" value="@if (!is_null($user)){{$user->phone}}@else Telefon @endif" type="number">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input name="email" class="form-control form-control-sm"  value="@if (!is_null($user)){{$user->email}}@else Email @endif" type="text">
                            <button type="submit" class="btn btn-success mg-t-15">Daxil et</button>
                    </div>
                  
                </div>

            </form>


            </div>
        </div>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
