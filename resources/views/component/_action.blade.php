@if (isset($url_show))
	<a href="{{ $url_show }}" class="btn-show" title="Detail: {{ $model->name }}"><i class="material-icons">remove_red_eye</i></a> 
@endif
@if ($url_edit)
	<a href="{{ $url_edit }}" class="btn-edit" title="Edit Data {{ $model->name }}"><i class="material-icons">mode_edit</i></a> 
@endif
@if ($url_destroy)
	<a href="{{ $url_destroy }}" class="btn-delete" title="Hapus Data {{ $model->name }}"><i class="material-icons">close</i></a>
@endif