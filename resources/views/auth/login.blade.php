<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/fonts/icomoon/style.css">

        <link rel="stylesheet" href="/css/owl.carousel.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- Style -->
        <link rel="stylesheet" href="/css/style.css">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script>
            function preventBack(){ window.history.forward() };
            setTimeout("preventBack()",.00000);
                window.onunload=function(){null;}
        </script>


        <title>LogIn</title>
    </head>
    <body>
        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2 btnbtn"></div>
            <div class="contents order-2 order-md-1">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
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
                                </form>
                            
                        </div>
                    </div>
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