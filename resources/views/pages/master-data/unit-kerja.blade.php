@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Master Data Unit Kerja</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Unit Kerja
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unit Kerja</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    @foreach ($unit_kerja as $uk)
                                        <tr>
                                            <td>{{ $uk->unit_kerja }}</td>
                                            <td>{{ $uk->no_hp }}</td>
                                            <td>{{ $uk->alamat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .table-bordered thead tr th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endpush

@push('plugins-css')
<link href="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush

@push('plugins-js')
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endpush
