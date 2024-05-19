<!DOCTYPE html>
<html lang="zxx">
   <head>
      <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keyword" content="">
      <meta name="author"  content=""/>
      <!-- Page Title -->
      <title>Password Reset | Avesta - Multipurpose Admin Dashboard Template</title>
      <!-- Main CSS -->	  
      <link type="text/css" rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
      <!-- Favicon -->	
      <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
  
   </head>
   <body>
      <!--================================-->
      <!-- Password Reset Start -->
      <!--================================-->			
      <div class="ht-100v d-flex">
         <div class="pd-20 mx-auto text-center bd-1 align-self-center">
            <div class="login-wrapper">
               <div class="loginbox">
                  <div class="login-left hidden-xs">
                     <img class="img-fluid" src="assets/images/logo-sm.png" alt="Logo">
                  </div>
                  <div class="login-right">
                     <div class="login-right-wrap wd-300">
                        <div class="lock-user">
                           <img class="img-fluid wd-50 rounded-circle" src="assets/images/lock.png" alt="User Image">
                           <h4 class="mg-b-30 tx-semibold">Password Recovery</h4>
                           <p class="tx-gray-500">Please enter your phone or email!</p>
                           @if ($errors->any())
                           <div class="alert alert-danger">
                               <ul>
                                   @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                        </div>
                        <!-- Form -->
                        <form action="/recoverpassword" method="POST">
                            @csrf
                           <div class="form-group">
                              <input name="username" class="form-control" type="text" placeholder="email or phone number" >
                           </div>
                           @include("auth::captcha")
                           <div class="form-group mb-0">
                              <button id="submitButton"    class="btn btn-brand btn-block" type="submit">Reset Password</button>
                           </div>
                        </form>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>  <script type="text/javascript">
                            function callback() {
                              const submitButton = document.getElementById("submitButton");
                              submitButton.removeAttribute("disabled");
                            }
                          </script>
                        <!-- /Form -->
                        <div class="tx-gray-500 mg-t-10">Sign in as a different user? <a href="aut-signin.html" class="tx-semibold">Login</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </body>
</html>