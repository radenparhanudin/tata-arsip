$(document).ready(function() {
	var
        base_url       = $("base").attr('href') + "/uploadsk",
        get_data       = $("base").attr('href') + "/data",
        datatableArsip = $("base").attr('href') + "/table/uploadsk",
        tabel          = $('#tableArsip'),
        form           = $('#defaultModal form'),
        defaultModal   = $("#defaultModal");
		

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

	const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 2000
    });

	var tableArsip = tabel.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: datatableArsip
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id', className: 'cNumber'},
            { data: 'sk_id', name: 'sk_id' },
            { data: 'sk_id', name: 'sk_id' },
            { data: 'pegawai_id', name: 'pegawai_id' },
            { data: 'pegawai_id', name: 'pegawai_id' },
            { data: 'pegawai_id', name: 'pegawai_id' },
            { data: 'pegawai_id', name: 'pegawai_id' },
            { data: 'action', name: 'action', className: 'cAction'},
        ],
    });

	form.submit(function(event) {
        event.preventDefault();
        action        = form.attr('action');
		method        = form.attr('method');
		data          = form.serialize();

        form.find('label.error').remove();
    	form.find('.form-line').removeClass('error');

        $.ajax({
            url: action,
            type: method,
            data: data,
            success: function(response){

                if (response.success) {
                    defaultModal.modal("hide");
                    Toast.fire({
                        type: 'success',
                        title: response.message
                    })
                }

                 if (response.errors) {
                    Toast.fire({
                        type: 'error',
                        title: response.message
                    })
                }
                
            },
            error : function (xhr) {
	            var res = xhr.responseJSON;
	            console.log(res)
	            if ($.isEmptyObject(res) == false) {
	                $.each(res.errors, function (key, value) {
	                    $('#' + key)
	                        .closest('.form-line')
	                        .addClass('error')
	                        .append('<label class="error">' + value + '</label>');
	                });
	            }
	        }
        })
    });

    tabel.on('click', '.btn-edit', function(event) {
        event.preventDefault();
        var urlEdit = $(this).attr('href');
        $.ajax({
            url: urlEdit,
        })
        .done(function(data) {
            if(data.errors){
                console.log(data);
            }
            if(data.success){

                defaultModal.find('.modal-title').text('Update User');
                form.find('button[type=submit]').text('Update User')
                defaultModal.modal('show');


                form.attr('action', base_url + '/' + data.content.id);
                form.attr('method', "PUT");

                // $('#tentang').val(data.content.tentang)
                // $('#nomor').val(data.content.nomor)
                // $('#tanggal_sk').val(data.content.tanggal_sk)
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        })
    });

    tabel.on('click', '.btn-delete', function(event) {
        event.preventDefault();
        var urlDelete = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan lagi!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: urlDelete,
                    type: 'DELETE',
                })
                .done(function(data) {
                    if(data.errors){
                        Toast.fire({
                            type: 'error',
                            title: data.message
                        })
                    }
                    if(data.success){
                        Toast.fire({
                            type: 'success',
                            title: data.message
                        })
                        tableArsip.ajax.reload(null,false);
                    }
                })
            }
        })
    });

    $('.btn-upload-sk').on('click', function(event) {
        event.preventDefault();
        $.post(get_data + '/nomorsk' , function(nomorsk) {
            $('#sk_id').empty();
            $('#sk_id').append('<option selected disabled hidden>Nomor SK</option>');
            $.each(nomorsk, function(index, val) {
                $('#sk_id').append('<option value="'+val.id+'">'+val.nomor+'</option>');
            });
            $('#sk_id').selectpicker('refresh');
        });

        $.post(get_data + '/jabatan' , function(jabatan) {
            $('#jabatan_id').empty();
            $('#jabatan_id').append('<option selected disabled hidden>Nomor Jabatan</option>');
            $.each(jabatan, function(index, val) {
                $('#jabatan_id').append('<option value="'+val.id+'">'+val.nama_jabatan+'</option>');
            });
            $('#jabatan_id').selectpicker('refresh');
        });

        $.post(get_data + '/unitkerja' , function(unitkerja) {
            $('#unit_kerja_id').empty();
            $('#unit_kerja_id').append('<option selected disabled hidden>Unit Kerja</option>');
            $.each(unitkerja, function(index, val) {
                $('#unit_kerja_id').append('<option value="'+val.id+'">'+val.unit_kerja+'</option>');
            });
            $('#unit_kerja_id').selectpicker('refresh');
        });

        defaultModal.modal('show');
    });

    defaultModal.on('hidden.bs.modal', function () {
        form.attr('action',  base_url);
        form.attr('method', "POST");

        form.trigger('reset')
        defaultModal.find('.modal-title').text('Create Nomor SK');
        form.find('button[type=submit]').text('Create Nomor SK')

        form.find('label.error').remove();
        form.find('.form-line').removeClass('error');
        tableArsip.ajax.reload(null,false);
    });

});

