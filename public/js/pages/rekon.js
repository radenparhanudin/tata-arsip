$(document).ready(function() {
	var
		tableRekon       = $('#tableRekon'),
		modalRekonImport = $('#modalRekonImport'),
		formRekon        = $('#modalRekonImport form');

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

	const Toast = Swal.mixin({
        toast: true,
        position: 'middle-center',
        showConfirmButton: false,
        timer: 9000
    });

	tableRekon.on('click', '.btn-import', function(event) {
		event.preventDefault();
		var 
			me           = $(this),
			url          = me.attr('href'),
			title        = 'Import ' + me.attr('title');

		modalRekonImport.find('.modal-title').text(title)
		formRekon.find('button[type=submit]').text(title)
		formRekon.attr({
			action: url,
			method: 'POST'
		});

		modalRekonImport.modal('show');
	});

	formRekon.submit(function(event) {
		event.preventDefault();
		event.preventDefault();
        action = formRekon.attr('action');
        method = formRekon.attr('method');
        data   = new FormData(formRekon[0]);

        formRekon.find('label.error').remove();
    	formRekon.find('.form-line').removeClass('error');

        $.ajax({
            url: action,
            type: method,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function(){
                Swal.fire({
                    title: 'Mohon Menunggu ... .!',
                    html: 'Proses Import data sedang berjalan ... .',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success:function (response) {
				Swal.close()
            	if (response.success) {
                    modalRekonImport.modal("hide");
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
	                Swal.close()
	                $.each(res.errors, function (key, value) {
	                    $('#' + key)
	                        .closest('.form-line')
	                        .addClass('error')
	                        .append('<label class="error">' + value + '</label>');
	                });
	            }
	        }
        })
        .done(function (data) {
            console.log(data)
         })
	});
});