@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-4" >
            <div class="card">
            <div class=" text-center" style="color:red;margin-top:14px;font-size:20px;">{{ __('Tailwebs') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username Label and Input Field with Icon -->
                        <div class="form-group row justify-content-center">
                            <label for="username" class="col-md-8 text-md-left">{{ __('Username') }}</label>
                            <div class="col-md-8 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-users"></i> <!-- Font Awesome Users Icon -->
                                    </span>
                                </div>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        <br>
                        <!-- Password Label and Input Field with Eye Icon -->
                        <div class="form-group row justify-content-center">
                            <label for="password" class="col-md-8 text-md-left">{{ __('Password') }}</label>
                            <div class="col-md-8 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i> <!-- Font Awesome Lock Icon -->
                                    </span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required>
                                
                                <!-- Eye Icon to Show/Hide Password -->
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i> <!-- Eye Icon -->
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8 text-right">
                                <a href="" class="text-primary" style="float:right">
                                    {{ __('Forgot Password?') }}
                                </a>
                            </div>
                        </div>
                        <br><br><br>
                        <!-- Submit Button -->
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-8 text-center">
                            <button type="submit" class="btn btn-block" style="background-color: black; color: white; ">
                            {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Handle errors -->
                    @if ($errors->has('login_error'))
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('login_error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- JavaScript to Toggle Password Visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        if (togglePassword) {
            togglePassword.addEventListener('click', function (e) {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle the eye / eye-slash icon
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>
