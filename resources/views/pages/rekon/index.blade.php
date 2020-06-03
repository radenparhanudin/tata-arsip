@extends('layouts.app')
@section('app-section')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2><strong>Rekon Data</strong> - {{ config('app.name') }}</h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Rekon Data
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tableRekon" width="100%">
                                <thead>
                                    <tr>
                                        <th class="cNumber">No</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Import Data Pegawai</td>
                                        <td class="text-center" style="width: 350px">
                                            <div>
                                                <a href="{{ route('rekon.import', ['params' => 'pegawai']) }}" title="Data Pegawai" class="btn bg-deep-orange btn-lg waves-effect btn-import">Import Data</a>
                                                <a href="{{ url('/download/template/pegawai') }}" target="_blank" class="btn bg-teal btn-lg waves-effect btn-download-template">Download Template</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Import Data Unit Kerja</td>
                                        <td class="text-center" style="width: 350px">
                                            <div>
                                                <a href="{{ route('rekon.import', ['params' => 'unit-kerja']) }}" title="Data Unit Kerja" class="btn bg-deep-orange btn-lg waves-effect btn-import">Import Data</a>
                                                <a href="{{ url('/download/template/unit-kerja') }}" target="_blank" class="btn bg-teal btn-lg waves-effect btn-download-template">Download Template</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Import Data Jenis Jabatan</td>
                                        <td class="text-center" style="width: 350px">
                                            <div>
                                                <a href="{{ route('rekon.import', ['params' => 'jenis-jabatan']) }}" title="Data Jenis Jabatan" class="btn bg-deep-orange btn-lg waves-effect btn-import">Import Data</a>
                                                <a href="{{ url('/download/template/jenis-jabatan') }}" target="_blank" class="btn bg-teal btn-lg waves-effect btn-download-template">Download Template</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Import Data Jabatan</td>
                                        <td class="text-center" style="width: 350px">
                                            <div>
                                                <a href="{{ route('rekon.import', ['params' => 'jabatan']) }}" title="Data Jabatan" class="btn bg-deep-orange btn-lg waves-effect btn-import">Import Data</a>
                                                <a href="{{ url('/download/template/jabatan') }}" target="_blank" class="btn bg-teal btn-lg waves-effect btn-download-template">Download Template</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.rekon.modal-rekon-import')
@endsection

@push('plugins-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endpush

@push('scripts')
<script src="{{ asset('public/js/pages/rekon.js') }}"></script>
@endpush
