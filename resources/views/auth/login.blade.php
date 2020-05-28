@extends('layouts.auth')
@section('auth-section')
    <body class="login-page">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);">Login <b>Aplikasi</b></a>
                <small>Tata Kelola Arsip BKD & PSDM Kab. Lombok Barat</small>
            </div>
            <div class="card">
                <div class="body">
                    <form id="sign_in" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="msg">Masukkan Username dan Password anda!</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons">person</i>
                            </span>
                            <div class="form-line  @error('email') error @enderror">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <label class="error" role="alert">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line @error('password') error @enderror">
                                <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">

                            </div>
                            @error('password')
                                <label class="error" role="alert">
                                    {{ $message }}
                                </label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Ingatkan Saya</label>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">LOGIN</button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-12">
                                <a href="#">Lupa Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.auth.foot')
    </body>
@endsection
