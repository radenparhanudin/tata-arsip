<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Nomor SK</h4>
            </div>
            <form action="{{ route('nosk.store') }}" method="POST">
           	 	<div class="modal-body">
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="tentang" name="tentang" class="form-control" placeholder="Tentang SK" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="nomor" name="nomor" class="form-control" placeholder="Nomor SK" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="tanggal_sk" name="tanggal_sk" class="form-control" placeholder="Tanggal SK" autocomplete="off" />
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-primary waves-effect">Create Nomor SK</button>
	                <button type="button" class="btn bg-pink waves-effect" data-dismiss="modal">Tutup</button>
	            </div>
			</form>
        </div>
    </div>
</div>
				