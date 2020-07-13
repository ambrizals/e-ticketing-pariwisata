var pageuri = window.location.href;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
function warningAlert(msg){
    Swal({
        type: 'error',
        title: 'Notice',
        text: msg,
        showConfirmButton: false,
        timer: 1500
    });
}
function loadQuickCart(){
	$('#cartCount').load($('#cartCount').data('url'));
}
function contentQuickCart(){
	$('#cartModal #content').load($('#cartModal').data('url'));
}
$(document).ready(function() {
    $('#wahanaGallery').lightGallery({
        thumbnail:true
    }); 
	loadQuickCart();
	$('#cart_paymethod #bank').click(function(){
		$('#cart_bankmethod').removeAttr('disabled');
	});
	$('#cart_paymethod #upfront').click(function(){
		$('#cart_bankmethod').attr('disabled','disabled');
	});
});
$('#addCart form').on('submit', function (e) {
    e.preventDefault();
    if ($(this).find('input[name="qty"]').val() == 0){
    	warningAlert('Passenger cannot be zero');
    } else {
	    var form = $(this);
	    swal({
	        title: 'Confirmation',
	        text: 'Want to add this item to cart?',
	        type: 'info',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes',
	        cancelButtonText: 'No'
	    }).then((result) => {
	        if (result.value) {
	            url = $(this).attr('action');
	            token = $(this).find('input[name="_token"]').val();
	            data = $(this).serialize();
	            $.ajax({
	                header: {
	                    'X-CSRF-TOKEN': token
	                },
	                method: "POST",
	                url: url,
	                data: data,
	                datatype: 'json',
	            }).done(function () {
	                toast({
	                    type: 'success',
	                    title: 'Item has been added to cart!'
	                });
	                loadQuickCart();
	                $('#addCart form').find('input[name="qty"]').val('0');
	            }).fail(function (xhr) {
					if (xhr.status == 401){
						warningAlert(xhr.responseText);
					} else if (xhr.status == 300) {
						warningAlert('You need to register your identity first!');
						window.location.replace(xhr.responseJSON);
					} else {
						warningAlert('Something wrong!');
					}
	            });
	        } else {
	            toast({
	                type: 'error',
	                title: 'Action cancelled!'
	            });
	        }
	    })
    }
});
$('#cartModal').on('shown.bs.modal', function (e) {
	contentQuickCart();
});
function updateItem_cart(id){
	var item = {};
	var action = $('#updateCart-'+id+' form').attr('action');
	$.each($('#updateCart-'+id+' form').serializeArray(), function (i, field) {
		item[field.name] = field.value;
	});
	console.log(item);
	if (item.qty == 0){
		warningAlert('Passenger cannot be zero');
	} else {
	    // var form = $('#updateCart-'+id+' form');
	    swal({
	        title: 'Confirmation',
	        text: 'Want to add this item to cart?',
	        type: 'info',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes',
	        cancelButtonText: 'No'
	    }).then((result) => {
	        if (result.value) {
	            url = action;
	            token = item._token;
	            $.ajax({
	                header: {
	                    'X-CSRF-TOKEN': token
	                },
	                method: "POST",
	                url: url,
	                data: item,
	                datatype: 'json',
	            }).done(function () {
	                toast({
	                    type: 'success',
	                    title: 'Item qty has been updated!'
	                });
	                if (item.form_type == 'stc') {
	                	location.reload(true);
	                } else {
	                	loadQuickCart();
	                }
	            }).fail(function (xhr) {
					if (xhr.status == 401){
						warningAlert(xhr.responseText);
					} else {
						warningAlert('Something wrong!');
					}
	            });
	        } else {
	            toast({
	                type: 'error',
	                title: 'Action cancelled!'
	            });
	        }
	    })
	}
}
function destroyItem_cart(url,formType){
    swal({
        title: 'Confirmation',
        text: 'Want to delete this item from cart?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value) {
            url = url;
            token = $('#cartToken').val();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': token
                },
                method: "DELETE",
                url: url,
                data: {
                    _token : token
                },
                datatype: 'json',
            }).done(function () {
                toast({
                    type: 'success',
                    title: 'Item qty has been updated!'
                });
                if (formType == 'stc') {
                	location.reload(true);
                } else {
	            	loadQuickCart();
	            	contentQuickCart();
                }
            }).fail(function (xhr) {
				if (xhr.status == 401){
					warningAlert(xhr.responseText);
				} else {
					warningAlert('Something wrong!');
				}
            });
        } else {
            toast({
                type: 'error',
                title: 'Action cancelled!'
            });
        }
    })
}
$('#confirmTransfer').on('shown.bs.modal', function(e){
	var url = pageuri+'/confirmTransfer/'+$(e.relatedTarget).data('id');
	$.get(url, function(data){
		$('#confirmTransfer').find('form').attr('action',url);
		$('#confirmTransfer').find('#total_bayar').val(data.get_transaksi.total_bayar);
		$('#confirmTransfer').find('#bank').val(data.get_bank.nama_bank+' - '+data.get_bank.nama_rekening+' - '+data.get_bank.nomor_rekening);
	});
});
$('#confirmTransfer form').on('submit', function(e){
	e.preventDefault();
	var nominal = {
		'payment' : $('#confirmTransfer').find('#total_bayar').val(),
		'transfer' : $('#confirmTransfer').find('#jumlah_transfer').val()
	}
	if ((nominal['payment'] - nominal['transfer']) > 0){
		warningAlert('Your transfer amount must be same with total payment or more than total payment');
	} else {
		url = $(this).attr('action');
		token = $(this).find('input[name="_token"]').val();
		data = $(this).serialize();
		$.ajax({
			header: {
				'X-CSRF-TOKEN': token
			},
			method: "POST",
			url: url,
			data: data,
			datatype: 'json',
		}).done(function () {
			toast({
				type: 'success',
				title: 'Your confirmation transfer is waiting to accepted!'
			});
			location.reload(true);
		}).fail(function (xhr) {
			if (xhr.status == 401){
				warningAlert(xhr.responseText);
			} else {
				warningAlert('Something wrong!');
			}
		});
	}
});
$('#formconfirmTransfer').on('submit', function(e){
	e.preventDefault();
	var nominal = {
		'payment' : $('#formconfirmTransfer').find('#total_bayar').val(),
		'transfer' : $('#formconfirmTransfer').find('#jumlah_transfer').val()
	}
	console.log(nominal);
	if ((nominal['payment'] - nominal['transfer']) > 0){
		warningAlert('Your transfer amount must be same with total payment or more than total payment');
	} else {
		url = $(this).attr('action');
		token = $(this).find('input[name="_token"]').val();
		data = $(this).serialize();
		$.ajax({
			header: {
				'X-CSRF-TOKEN': token
			},
			method: "POST",
			url: url,
			data: data,
			datatype: 'json',
		}).done(function () {
			toast({
				type: 'success',
				title: 'Your confirmation transfer is waiting to accepted!'
			});
			location.reload(true);
		}).fail(function (xhr) {
			if (xhr.status == 401){
				warningAlert(xhr.responseText);
			} else {
				warningAlert('Something wrong!');
			}
		});
	}
});