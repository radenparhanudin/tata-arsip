@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Nomor SK</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Nomor SK
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#defaultModal">Create Nomor SK</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableNoSK" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor SK</th>
                                        <th>Tentang</th>
                                        <th>Tanggal SK</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.nomor-sk.form')
@endsection

@push('style')
    <style>
        table.table-bordered.dataTable th,
        table.table-bordered.dataTable td
        {
            vertical-align: middle !important;
        }
    </style>
@endpush

@push('plugins-css')
<link href="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="{{ asset('public/adminBSB') }}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush

@push('plugins-js')
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endpush

@push('scripts')
<script src="{{ asset('public/js/pages/nomor-sk.js') }}"></script>
<script>
    $('#tanggal_sk').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endpush

