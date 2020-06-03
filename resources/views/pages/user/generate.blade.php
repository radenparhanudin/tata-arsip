<div class="modal fade" id="generate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Generate User</h4>
            </div>
	            <form action="{{ route('generate.user') }}" method="POST">
	           	 	<div class="modal-body">
						<p class="text-danger">Generate data user dari data pegawai</p>
						<hr>
						<div class="form-group">
							<div class="form-line">
								<select multiple id="roles_generate"  name="roles_generate[]" class="form-control show-tick">
					                <option value="administrator">Administrator</option>
					                <option value="data-informasi">Data Informasi</option>
					                <option value="bidang-mutasi">Bidang Mutasi</option>
					                <option value="pegawai">Pegawai</option>
					            </select>
							</div>
						</div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-primary waves-effect">Generate User</button>
	                <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal">Tutup</button>
	            </div>
			</form>
        </div>
    </div>
</div>
				