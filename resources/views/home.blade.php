@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Home - {{ config('app.name') }}</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">archive</i>
                        </div>
                        <div class="content">
                            <div class="text text-uppercase">Dokumen Arsip</div>
                            <div class="number count-to" data-from="0" data-to="{{ $arsip }}" data-speed="2000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_outline</i>
                        </div>
                        <div class="content">
                            <div class="text text-uppercase">Users Register</div>
                            <div class="number count-to" data-from="0" data-to="{{ $users_register }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text text-uppercase">Data Pegawai</div>
                            <div class="number count-to" data-from="0" data-to="{{ $pegawai }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            @hasrole('administrator')
            <div class="row clearfix">
                <div class="col-sm-12">
                    <h2>Selamat Datang {{ ucwords(Auth::user()->getRoleNames()[0]) }}</h2>
                </div>
            </div>
            @endhasrole
            @hasrole('data-informasi|bidang-mutasi')
            <div class="row clearfix">
                <div class="col-sm-12">
                    <h2>Selamat Datang {{ ucwords(Auth::user()->getRoleNames()[0]) }}</h2>
                </div>
            </div>
            @endhasrole
            @hasrole('pegawai')
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>Detail Login</h2>
                        </div>
                        <div class="body">
                            <table width="100%">
                                <tr>
                                    <td><strong>Username</strong></td>
                                    <td>: {{ Auth::user()->username }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td>: {{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>: {{ Auth::user()->getRoleNames() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endhasrole
        </div>
    </section>
@endsection
@push('plugins-js')
    <script src="{{ asset('public/adminBSB') }}/plugins/jquery-countto/jquery.countTo.js"></script>
@endpush

@push('scripts')
    <script>
        $('.count-to').countTo();
    </script>
@endpush
