@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Master Data Pegawai</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data Pegawai
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">NIP</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="2">Gelar</th>
                                        <th rowspan="2">Tgl. Lahir</th>
                                        <th rowspan="2">JK</th>
                                        <th rowspan="2">Nomor HP</th>
                                        <th rowspan="2">Alamat</th>
                                    </tr>
                                    <tr>
                                        <th>Depan</th>
                                        <th>Belakang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $p)
                                        <tr>
                                            <td>{{ $p->nip_baru }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->gelar_depan }}</td>
                                            <td>{{ $p->gelar_belakang }}</td>
                                            <td>{{ $p->tanggal_lahir }}</td>
                                            <td>{{ $p->jenis_kelamin }}</td>
                                            <td>{{ $p->nomor_hp }}</td>
                                            <td>{{ $p->alamat }}</td>
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
