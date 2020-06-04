@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Download SK</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Data SK
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableDownloadSKSingle" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nomor SK</th>
                                        <th>Tentang</th>
                                        <th>Tanggal</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($arsips as $r)
                                		<tr>
	                                		<td>{{ $r->nomor }}</td>
	                                		<td>{{ $r->tentang }}</td>
	                                		<td>{{ $r->tanggal_sk }}</td>
	                                		<td>{{ $r->nama_jabatan }}</td>
	                                		<td>{{ $r->unit_kerja }}</td>
	                                		<td class="text-center" style="width: 150px">
                                            <div>
                                                <a href="{{ url('/download/sk/single') . '/' . $r->id }}" target="_blank" class="btn bg-teal btn-lg waves-effect">Download SK</a>
                                            </div>
                                        </td>
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
        table.table-bordered.dataTable th,
        table.table-bordered.dataTable td
        {
            vertical-align: middle !important;
            word-wrap: normal;
        }
    </style>
@endpush

@push('plugins-css')
<link href="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="{{ asset('public/adminBSB') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@push('plugins-js')
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/adminBSB') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endpush

@push('scripts')
<script>
	$('#tableDownloadSKCollective').DataTable();
</script>
@endpush

