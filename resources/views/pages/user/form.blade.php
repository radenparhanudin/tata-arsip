<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create User</h4>
            </div>
	            <form action="{{ route('user.store') }}" method="POST">
	           	 	<div class="modal-body">
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="name" name="name" class="form-control" placeholder="Nama User" autocomplete="off" />
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" />
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="email" name="email" class="form-control" placeholder="Email User" />
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password" />
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" />
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<select multiple id="roles"  name="roles[]" class="form-control show-tick">
					                <option value="administrator">Administrator</option>
					                <option value="data-informasi">Data Informasi</option>
					                <option value="bidang-mutasi">Bidang Mutasi</option>
					                <option value="pegawai">Pegawai</option>
					            </select>
							</div>
						</div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-primary waves-effect">Create User</button>
	                <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal">Tutup</button>
	            </div>
			</form>
        </div>
    </div>
</div>
				