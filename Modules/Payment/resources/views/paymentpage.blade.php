@extends('mainviews.app')
@section('content')
  
    <div class="col-md-12 col-lg-12">
        <div class="card mg-b-30">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-header-title tx-13 mb-0">Odenis Formasi</h6>
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
                <form action="/make_manual_payment" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input disabled value=" {{$bankdetails->bank_name}}: {{$bankdetails->card_number}}" class="form-control form-control-sm" placeholder="Input box"
                            type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input disabled value="{{$bankdetails->customer}}" class="form-control form-control-sm" placeholder="Input box"
                            type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input disabled value="Musteri: {{$customer->name}}" class="form-control form-control-sm" placeholder="Input box"
                            type="text">
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input name="amount" class="form-control form-control-sm" placeholder="mebleq" type="text">
                    </div>
                </div>
                @php
                    date_default_timezone_set('Asia/Baku');
                    // Get the current date and time formatted as required
                    $date = date('e d.m.Y H:i');
                @endphp
                  <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <input value="{{$date}}" class="form-control form-control-sm" placeholder="mebleq" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mg-b-15">
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">qebz daxil et</label>
                        </div>
                        <button type="submit" class="btn btn-success">Odenis et</button>
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
