<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="" />
    <!-- Page Title -->
    <title>Signin | Avesta - Multipurpose Admin Dashboard Template</title>
    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css" />
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body>
    <!--================================-->
    <!-- Page Content Start -->
    <!--================================-->
    <div class="ht-100v text-center">
        <div class="row pd-0 mg-0">
            <div class="col-lg-6 bg-gradient hidden-sm">
                <div class="ht-100v d-flex">
                    <div class="align-self-center">
                        <img src="assets/images/logo-sm.png" class="img-fluid" alt="">
                        <h3 class="tx-20 tx-semibold tx-gray-100 pd-t-50">JOIN OUR GREAT COMMUNITY</h3>
                        <p class="pd-y-15 pd-x-10 pd-md-x-100 tx-gray-200">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                        <a href="aut-signup.html" class="btn btn-outline-primary"><span class="tx-gray-200">Get An
                                Account</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 bg-light">
                <div class="ht-100v d-flex align-items-center justify-content-center">
                    <div class="">
                        <h3 class="tx-dark mg-b-5 tx-left">Sign In</h3>
                        <p class="tx-gray-500 tx-15 mg-b-40">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </p>
                        <form action="/signin" method="POST">
                            @csrf
                            <div class="form-group tx-left">
                                <label class="tx-gray-500 mg-b-5">Email address or phone</label>
                                <input name="username" type="text" class="form-control"
                                    placeholder="email@domain.com">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="tx-gray-500 mg-b-0">Password</label>
                                    <a href="/passwordforget" class="tx-13 mg-b-0 tx-semibold">Forgot password?</a>
                                </div>
                                <input name="password" type="password" class="form-control"
                                    placeholder="Enter your password">
                            </div>










                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"
                                    data-callback="callback"></div>
                            </div>










                            <button id="submitButton" disabled class="btn btn-brand btn-block">Sign In</button>
                            {{-- <div class="pd-y-20 tx-uppercase tx-gray-500">or</div> --}}
                            {{-- <button class="btn bg-facebook">Facebook</button>
                     <button class="btn bg-twitter">Twitter</button>
                     <button class="btn bg-linkedin">Linkedin</button> --}}
                            <div class="tx-13 mg-t-20 tx-center tx-gray-500"> <a href="/signup"
                                    class="tx-dark tx-semibold">{{ __('messages.create_an_account_for_signin_view') }}</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Page Content End -->
    <!-- jQuery  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        function callback() {
            const submitButton = document.getElementById("submitButton");
            submitButton.removeAttribute("disabled");
        }
    </script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
