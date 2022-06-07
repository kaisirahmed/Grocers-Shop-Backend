<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome To Grocers Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminAssets/images/logo.png') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('panelAssets/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-b-160 p-t-50">
                <form class="login100-form validate-form">
                    <span class="login100-form-title p-b-43">
                        Welcome To Grocers Panel
                    </span>
                    
                    <div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
                       <a href="{{ route('admin.login') }}"> <h3>Admin Login Panel</h3></a>
                    </div>
                    
                    
                    <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
                       <a href="{{ route('staff.login') }}"><h3>Staff Login Panel</h3></a>
                    </div>

                    <div class="container-login100-form-btn">
                        <a href="#" class="login100-form-btn">
                            Grocers Shop
                        </a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
    

    
    
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('panelAssets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('panelAssets/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{asset('panelAssets/js/main.js')}}"></script>

</body>
</html>