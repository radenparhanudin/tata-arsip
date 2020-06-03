$(document).ready(function() {
	var
        base_url      = $("base").attr('href') + "/user",
        dataTableUser = $("base").attr('href') + "/table/user",
        tabel         = $('#tableUser'),
        form          = $('#defaultModal form'),
        formGenerate  = $('#generate form'),
        defaultModal  = $("#defaultModal");
		

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

	var tableUser = tabel.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: dataTableUser
        },
        columns: [
            {data: 'DT_RowIndex', name: 'id', className: 'cNumber'},
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'roles', name: 'roles' },
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

    formGenerate.submit(function(event) {
        event.preventDefault()
        action        = formGenerate.attr('action');
        method        = formGenerate.attr('method');
        data          = formGenerate.serialize();

        form.find('label.error').remove();
        form.find('.form-line').removeClass('error');

        $.ajax({
            url: action,
            type: method,
            data: data,
            beforeSend: function(){
                Swal.fire({
                    title: 'Mohon Menunggu ... .!',
                    html: 'Proses Generate data sedang berjalan ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(response){
                if (response.success) {
                    $('#generate').modal("hide");
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
                Swal.close()
                var res = xhr.responseJSON;
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

                $('#name').val(data.content.name)
                $('#username').val(data.content.username)
                $('#email').val(data.content.email)
                $('#roles').val(data.content.roles)
                $('#roles').selectpicker('refresh')
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
                        tableUser.ajax.reload(null,false);
                    }
                })
            }
        })
    });

    defaultModal.on('hidden.bs.modal', function () {
        form.attr('action',  base_url);
        form.attr('method', "POST");

        defaultModal.find('.modal-title').text('Create User');
        form.find('button[type=submit]').text('Create User')

        $('#roles').val(null)
        $('#roles').selectpicker('refresh')
        form.find('label.error').remove();
        form.find('.form-line').removeClass('error');
        tableUser.ajax.reload(null,false);
    });

    $('#generate').on('hidden.bs.modal', function () {
        $('#roles_generate').val(null)
        $('#roles_generate').selectpicker('refresh')
        formGenerate.find('label.error').remove();
        formGenerate.find('.form-line').removeClass('error');
        tableUser.ajax.reload(null,false);
    });
});

