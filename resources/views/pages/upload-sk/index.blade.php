@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Upload SK</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data SK
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" class="btn-upload-sk">Upload SK</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableArsip" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Tanggal SK</th>
                                        <th rowspan="2">Nomor SK</th>
                                        <th colspan="2">Pegawai</th>
                                        <th rowspan="2">Jabatan</th>
                                        <th rowspan="2">Unit Kerja</th>
                                        <th rowspan="2">Actions</th>
                                    </tr>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
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
    @include('pages.upload-sk.form')
@endsection

@push('style')
    <style>
        table.table-bordered.dataTable th,
        table.table-bordered.dataTable td
        {
            vertical-align: middle !important;
            text-align: center;
        }
    </style>
@endpush

@push('plugins-css')
<link href="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="{{ asset('public/adminBSB') }}/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="{{ asset('public/adminBSB') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@push('plugins-js')
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@endpush

@push('scripts')
<script src="{{ asset('public/js/pages/upload-sk.js') }}"></script>
<script>
    var path = "{{ route('data.pegawai') }}";
    $('#pegawai_id').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endpush

