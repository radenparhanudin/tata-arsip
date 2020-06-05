<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" data-backdrop='false'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload SK</h4>
            </div>
            <form action="{{ route('uploadsk.store') }}" method="POST">
           	 	<div class="modal-body">
           	 		<div class="form-group">
						<div class="form-line">
							<select id="sk_id"  name="sk_id" class="form-control show-tick">
								<option selected disabled hidden>Nomor SK</option>
				            </select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="pegawai_id" name="pegawai_id" class="form-control" placeholder="NIP - Nama Pegawai" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<select id="jabatan_id"  name="jabatan_id" class="form-control show-tick">
								<option selected disabled hidden>Jabatan</option>
				            </select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<select id="unit_kerja_id"  name="unit_kerja_id" class="form-control show-tick">
								<option selected disabled hidden>Unit Kerja</option>
				            </select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<input type="file" name="file" id="file" class="form-control">
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-primary waves-effect">Upload SK</button>
	                <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal">Tutup</button>
	            </div>
			</form>
        </div>
    </div>
</div>
				