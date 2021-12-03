@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="/styles.css">

<div class="row no-gutters">
    <div class="col-md-6 no-gutters">
        <div class="leftside d-flex justify-content-center align-items-center">
            <div class="" id="pet_name_id">{{ __('Register Customer') }}</div>
        </div>
    </div>
    <div class="col-md-6 no-gutters">
        <div class="rightside d-flex justify-content-center align-items-center">
            <form method="POST" action="{{ route('register') }}" style=" border-radius: 30px; padding: 50px;">
                @csrf

                <div class="form-group row">

                    <div class="col-md-4">
                    <label for="username">Username: </label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                    <label for="phone" >Phone: </label>
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                    <label for="email">Email Address: </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-4" hidden>
                    <label for="email">usertype: </label>
                        <input id="usertype" type="text" class="form-control @error('usertype') is-invalid @enderror" name="usertype" value="customer" required autocomplete="usertype" hidden>

                        @error('usertype')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    

                <div class="form-group row">

                    <div class="col-md-4">
                    <label for="password" >Password: </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="password-confirm" >Confirm:</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                <!-- #CUSTOMEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEER -->

                    <div class="col-md-4">
                    <label for="customer_fname">First Name: </label>
                        <input id="customer_fname" type="text" class="form-control @error('customer_fname') is-invalid @enderror" name="customer_fname" value="{{ old('customer_fname') }}" required autofocus>

                        @error('customer_fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-4">
                    <label for="customer_lname">Last Name: </label>
                        <input id="customer_lname" type="text" class="form-control @error('customer_lname') is-invalid @enderror" name="customer_lname" value="{{ old('customer_lname') }}" required autofocus>

                        @error('customer_lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="customer_mname">Middle Name: </label>
                        <input id="customer_mname" type="text" class="form-control @error('customer_mname') is-invalid @enderror" name="customer_mname" value="{{ old('customer_mname') }}" autofocus>

                        @error('customer_mname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="customer_mobile">Phone #: </label>
                        <input id="customer_mobile" type="text" class="form-control @error('customer_mobile') is-invalid @enderror" name="customer_mobile" value="{{ old('customer_mobile') }}" required autofocus>

                        @error('customer_mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                    <label for="customer_tel">Tel #: </label>
                        <input id="customer_tel" type="text" class="form-control @error('customer_tel') is-invalid @enderror" name="customer_tel" value="{{ old('customer_tel') }}" required autofocus>

                        @error('customer_tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-md-4">
                    <label for="customer_gender">Gender: </label>
                        <div>
                        <select id="customer_gender" class="form-control custom-select regClass" id="customer_gender" name="customer_gender" required>
                            <option selected disabled>Choose Gender:</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        </div>

                        @error('customer_gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="customer_birthday">Birthday: </label>
                        <input id="customer_birthday" type="date" class="form-control @error('customer_birthday') is-invalid @enderror" name="customer_birthday" value="{{ old('customer_birthday') }}" required autofocus min="1945-12-31" max="2009-01-02">

                        @error('customer_birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-4">
                    <label for="customer_blk">Block/House/Bldg. #: </label>
                        <input id="customer_blk" type="text" class="form-control @error('customer_blk') is-invalid @enderror" name="customer_blk" value="{{ old('customer_blk') }}" required  autofocus>

                        @error('customer_blk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="customer_street">Street: </label>
                        <input id="customer_street" type="text" class="form-control @error('customer_street') is-invalid @enderror" name="customer_street" value="{{ old('customer_street') }}" required autofocus>

                        @error('customer_street')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                    <label for="customer_subdivision">Subdivision: </label>
                        <input id="customer_city" type="text" class="form-control @error('customer_subdivision') is-invalid @enderror" name="customer_subdivision" value="{{ old('customer_subdivision') }}" required  autofocus>

                        @error('customer_subdivision')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                    <label for="customer_barangay">Barangay: </label>
                        <input id="customer_barangay" type="text" class="form-control @error('customer_barangay') is-invalid @enderror" name="customer_barangay" value="{{ old('customer_barangay') }}" required autofocus>

                        @error('customer_barangay')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                    <label for="customer_zip">ZIP: </label>
                        <input id="customer_zip" type="number" class="form-control @error('customer_zip') is-invalid @enderror" name="customer_zip" value="{{ old('customer_zip') }}" required autofocus>

                        @error('customer_zip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                    <label for="customer_city">City: </label>
                        <input id="customer_city" type="text" class="form-control @error('customer_city') is-invalid @enderror" name="customer_city" value="{{ old('customer_city') }}" required autofocus>

                        @error('customer_city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- END CUSTOMER -->

                <div class="form-group">
                    <div style="">
                        <button type="submit" class="btn btn-primary btn-lg">Register
                        </button>
                        <span>Already have an account?</span>
                        <a href="/">Sign In here!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection