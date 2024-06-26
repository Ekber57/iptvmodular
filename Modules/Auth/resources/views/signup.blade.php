

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
    <title>Signup | Avesta - Multipurpose Admin Dashboard Template</title>
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
                        <a href="/signin" class="btn btn-outline-primary"><span class="tx-gray-200">Sign
                                In</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 bg-light">
                <div class="ht-100v d-flex align-items-center justify-content-center">
                    <div class="">
                        <a href="/change_lang/tr">Turk Dili</a>
                        <a href="/change_lang/az">AZ Dili</a>
                        <h3 class="tx-dark mg-b-5 tx-left">{{ __('messages.create_new_account') }}</h3>

                        {{-- <p class="tx-gray-500 tx-15 mg-b-40">Welcome back! Please signin to continue.</p> --}}
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
                       
                         
                        </p>
                        <form action="/signup" method="POST">
                            @csrf
                            <div class="form-group tx-left">
                                <label class="tx-gray-500 mg-b-5">{{ __('messages.mail') }}</label>
                                <input name="mail" type="email" class="form-control" placeholder="">
                            </div>
                            <div class="form-group tx-left">
                                <label class="tx-gray-500 mg-b-5">{{ __('messages.name') }}</label>
                                <input name="name" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group tx-left">
                                <label class="tx-gray-500 mg-b-5">{{ __('messages.phone') }}</label>
                                <input name="phone" type="number" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="tx-gray-500 mg-b-0">{{ __('messages.username') }}</label>
                                </div>
                                <input name="username" type="text" class="form-control"
                                    placeholder="{{ __('messages.username') }} ">
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="tx-gray-500 mg-b-0">{{ __('messages.password') }}</label>
                                </div>
                                <input name="password" type="password" class="form-control" placeholder="{{ __('messages.password') }}">
                            </div>
                            

                     <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}" data-callback="callback"></div>
                    </div>
                
           


                            <button id="submitButton" disabled type="submit" class="btn btn-brand btn-block"> {{ __('messages.sign_in') }}</button>
                        </form>

                        {{-- <div class="pd-y-20 tx-uppercase tx-gray-500">or</div>
                        <button class="btn bg-facebook">Facebook</button>
                        <button class="btn bg-twitter">Twitter</button>
                        <button class="btn bg-linkedin">Linkedin</button> --}}
                        {{-- <div class="tx-13 mg-t-20 tx-center tx-gray-500">Already have an account? <a
                                href="aut-signin.html" class="tx-semibold">Sign In</a></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Page Content End -->
    <!-- jQuery  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  <script type="text/javascript">
        function callback() {
          const submitButton = document.getElementById("submitButton");
          submitButton.removeAttribute("disabled");
        }
      </script>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/feather-icon/feather.min.js"></script>
    <script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- App JS -->
    <script src="assets/js/app.js"></script>
</body>

</html> 
