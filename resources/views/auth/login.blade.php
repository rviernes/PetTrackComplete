<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <link rel="stylesheet" href="/fonts/icomoon/style.css">

        <link rel="stylesheet" href="/css/owl.carousel.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- Style -->
        <link rel="stylesheet" href="/css/style.css">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- <script>
            function preventBack(){ window.history.forward() };
            setTimeout("preventBack()",.00000);
                window.onunload=function(){null;}
        </script> -->


        <title>LogIn</title>
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="/styles.css">

        <div class="row no-gutters">
            <div class="col-md-6 no-gutters">
                <div class="rightside d-flex justify-content-center align-items-center">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7" style=" border-radius: 30px; padding: 50px;">
                            <div class="mb-4">
                                @if(Session::has('success')) 
                                    <div class="alert alert-warning" role="alert" id="messageModal">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif 
                                <h3>Sign In</h3>
                            </div>
                                <form action="{{ route('/') }}" method="POST">
                                    @csrf
                                    <span class="text-danger" id="messageID">
                                        @error('email')
                                            <div class="alert alert-danger" role="alert" id="messageModal">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </span>
                                    
                                    <div class="form-group first">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" require>
                                    </div>

                                    <div class="form-group last">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" >
                                    </div>
                                    <div class="d-flex mb-5 align-items-center">
                                        <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked"/>
                                        <div class="control__indicator"></div>
                                        </label>
                                        <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                                    </div>
                                    
                                    <input type="submit" value="Log In" class="btn btn-block btn-primary">
                                    <span>Don't have an account?</span>
                                    <a href="register">Sign up here!</a>
                                </form>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-6 no-gutters">
                <div class="leftside d-flex justify-content-center align-items-center">
                    <div class="" id="pet_name_id">{{ __('Login') }}</div>
                </div>
            </div>
        </div>
    </body>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main2.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script>
        $("document").ready(function() {
            setTimeout(function() {
            $("#messageID").remove();
            }, 3000);
        });
        </script>
        <style>

            .btnbtn {
                background-image: url('vendors/dist/img/halfWP.jpg');
            }
        </style>

</html>