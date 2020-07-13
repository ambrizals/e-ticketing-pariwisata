
var pageuri = window.location.href;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

(function($) {
    "use strict";

    /*================================
    Preloader
    ==================================*/
    var preloader = $('#preloader');
    $(window).on('load', function() {
        preloader.fadeOut('slow', function() { $(this).remove(); });
    });

    /*================================
    sidebar collapsing
    ==================================*/
    $('.nav-btn').on('click', function() {
        $('.page-container').toggleClass('sbar_collapsed');
    });

    /*================================
    Start Footer resizer
    ==================================*/
    var e = function() {
        var e = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 5;
        (e -= 67) < 1 && (e = 1), e > 67 && $(".main-content").css("min-height", e + "px")
    };
    $(window).ready(e), $(window).on("resize", e);

    /*================================
    sidebar menu
    ==================================*/
    $("#menu").metisMenu();

    /*================================
    slimscroll activation
    ==================================*/
    $('.menu-inner').slimScroll({
        height: 'auto'
    });
    $('.nofity-list').slimScroll({
        height: '435px'
    });
    $('.timeline-area').slimScroll({
        height: '500px'
    });
    $('.recent-activity').slimScroll({
        height: 'calc(100vh - 114px)'
    });
    $('.settings-list').slimScroll({
        height: 'calc(100vh - 158px)'
    });

    /*================================
    stickey Header
    ==================================*/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop(),
            mainHeader = $('#sticky-header'),
            mainHeaderHeight = mainHeader.innerHeight();

        // console.log(mainHeader.innerHeight());
        if (scroll > 1) {
            $("#sticky-header").addClass("sticky-menu");
        } else {
            $("#sticky-header").removeClass("sticky-menu");
        }
    });

    /*================================
    form bootstrap validation
    ==================================*/
    $('[data-toggle="popover"]').popover()

    /*------------- Start form Validation -------------*/
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    /*================================
    datatable active
    ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true
        });
    }
    if ($('#dataTable2').length) {
        $('#dataTable2').DataTable({
            responsive: true
        });
    }
    if ($('#dataTable3').length) {
        $('#dataTable3').DataTable({
            responsive: true
        });
    }


    /*================================
    Slicknav mobile menu
    ==================================*/
    $('ul#nav_menu').slicknav({
        prependTo: "#mobile_menu"
    });

    /*================================
    login form
    ==================================*/
    $('.form-gp input').on('focus', function() {
        $(this).parent('.form-gp').addClass('focused');
    });
    $('.form-gp input').on('focusout', function() {
        if ($(this).val().length === 0) {
            $(this).parent('.form-gp').removeClass('focused');
        }
    });

    /*================================
    slider-area background setting
    ==================================*/
    $('.settings-btn, .offset-close').on('click', function() {
        $('.offset-area').toggleClass('show_hide');
        $('.settings-btn').toggleClass('active');
    });

    /*================================
    Owl Carousel
    ==================================*/
    function slider_area() {
        var owl = $('.testimonial-carousel').owlCarousel({
            margin: 50,
            loop: true,
            autoplay: false,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 2
                },
                1360: {
                    items: 1
                },
                1600: {
                    items: 2
                }
            }
        });
    }
    slider_area();

    /*================================
    Fullscreen Page
    ==================================*/

    if ($('#full-view').length) {

        var requestFullscreen = function(ele) {
            if (ele.requestFullscreen) {
                ele.requestFullscreen();
            } else if (ele.webkitRequestFullscreen) {
                ele.webkitRequestFullscreen();
            } else if (ele.mozRequestFullScreen) {
                ele.mozRequestFullScreen();
            } else if (ele.msRequestFullscreen) {
                ele.msRequestFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var exitFullscreen = function() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else {
                console.log('Fullscreen API is not supported.');
            }
        };

        var fsDocButton = document.getElementById('full-view');
        var fsExitDocButton = document.getElementById('full-view-exit');

        fsDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            requestFullscreen(document.documentElement);
            $('body').addClass('expanded');
        });

        fsExitDocButton.addEventListener('click', function(e) {
            e.preventDefault();
            exitFullscreen();
            $('body').removeClass('expanded');
        });
    }
})(jQuery);
// AJAX Component
$('#button-li').on('click', function(){
    window.location = $(this).data('url');
})
function warningAlert(msg){
    Swal({
        type: 'error',
        title: 'Pesan Kesalahan',
        text: msg,
        showConfirmButton: false,
        timer: 1500
    });
}
$(document).on('submit', '#tambahWahana form', function(e) {
    $('#tambahWahana').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#tambahWahana form').attr('action');
    var token = $('#tambahWahana form').find("input[name=_token]").val();
    var formdata = $('#tambahWahana form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "POST",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            wahanaTable.ajax.reload();
            $('#tambahWahana form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            wahanaTable.ajax.reload();
        }
    });
});
function hapusWahana(id){
    token = $('#wahanaTable').data('csrf');
    swal({
        title: 'Apa anda yakin ?',
        text: "Sistem akan menghapus wahana, jika wahana memiliki transaksi maka wahana ini tidak dapat dihapus. Ingin melanjutkan ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/'+id;
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
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Data berhasil dihapus!'
                });
                wahanaTable.ajax.reload();
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}
$('#galeri-wahana-tab').on('shown.bs.tab', function (e) {
    $('#galleryGambar').load($('#galleryGambar').data('wahana'));
})
$('#upload_gambar').on('hidden.bs.modal', function(e){
    $('#galleryGambar').load($('#galleryGambar').data('wahana'));
})
function removeGambar_wahana($id){
    swal({
        title: 'Apa anda yakin ?',
        text: "Sistem akan menghapus gambar, ingin melanjutkan ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/gambar/'+ $id;
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': $('#gambar-token').data('token')
                },  
                method: "DELETE",
                url: url,
                data: {
                    _token : $('#gambar-token').data('token')
                },
                datatype: 'json',
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Gambar berhasil dihapus!'
                });
                $('#galleryGambar').load($('#galleryGambar').data('wahana'));
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}
function removeGambar_all(){
    swal({
        title: 'Apa anda yakin ?',
        text: "Sistem akan menghapus gambar, ingin melanjutkan ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/deletegambar';
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': $('#gambar-token').data('token')
                },  
                method: "DELETE",
                url: url,
                data: {
                    _token : $('#gambar-token').data('token')
                },
                datatype: 'json',
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Seluruh Gambar berhasil dihapus!'
                });
                $('#galleryGambar').load($('#galleryGambar').data('wahana'));
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}
$('#ambilgambar').on('shown.bs.modal', function(e){
    $('.overlay').css('display','block');
    var id = $(e.relatedTarget).data('id');
    $('#ambilgambar_body').html("");
    $('#ambilgambar_body').load(pageuri+'/gambar/'+ id + '/show');
});
$('#ambilgambar').on('hide.bs.modal', function(){
    $('#galleryGambar').load($('#galleryGambar').data('wahana'));
    $('#ambilgambar_body').html('<p class="loading">Sedang mengambil gambar</p>');
})
$('body').on('click', '#gallery_paginate .pagination a', function(e){
    e.preventDefault();
    $('#galleryGambar').load($(this).attr('href'));
    $('body').on('click', '#gallery_paginate .pagination a', function(e){
        e.preventDefault();
        $('#galleryGambar').load($(this).attr('href'));
    });
});
$(document).on('submit', '#tambahKaryawan form', function(e) {
    $('#tambahKaryawan').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#tambahKaryawan form').attr('action');
    var token = $('#tambahKaryawan form').find("input[name=_token]").val();
    var formdata = $('#tambahKaryawan form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "POST",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            karyawanTable.ajax.reload();
            $('#tambahKaryawan form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            karyawanTable.ajax.reload();
        }
    });
});
$('#ubahKaryawan').on('shown.bs.modal', function(e){
    var form = $('#ubahKaryawan form');
    form.find('#alamat').froalaEditor('destroy');
    var id = $(e.relatedTarget).data('id');
    form.attr('action', pageuri+'/'+ id);
    $.get(pageuri+'/'+id, function(data){
        form.find('#nama_karyawan').val(data.nama_karyawan);
        form.find('#nomor_telepon').val(data.no_telepon);
        form.find('#alamat').val(data.alamat);
        form.find('#alamat').froalaEditor({
            toolbarSticky: false,
            toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html'],
              toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline']
        });
    });
});
$(document).on('submit', '#ubahKaryawan form', function(e) {
    $('#ubahKaryawan').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#ubahKaryawan form').attr('action');
    var token = $('#ubahKaryawan form').find("input[name=_token]").val();
    var formdata = $('#ubahKaryawan form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "PUT",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            karyawanTable.ajax.reload();
            $('#ubahKaryawan form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            karyawanTable.ajax.reload();
        }
    });
});
function hapusKaryawan(id){
    token = $('#karyawanTable').data('csrf');
    swal({
        title: 'Apa anda yakin ?',
        text: "Ingin menghapus karyawan yang dipilih?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/'+id;
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
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Data berhasil dihapus!'
                });
                karyawanTable.ajax.reload();
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}
$(document).on('submit', '#tambahBank form', function(e) {
    $('#tambahBank').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#tambahBank form').attr('action');
    var token = $('#tambahBank form').find("input[name=_token]").val();
    var formdata = $('#tambahBank form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "POST",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            bankTable.ajax.reload();
            $('#tambahBank form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            bankTable.ajax.reload();
        }
    });
});
$('#ubahBank').on('shown.bs.modal', function(e){
    var form = $('#ubahBank form');
    var id = $(e.relatedTarget).data('id');
    form.attr('action', pageuri+'/'+ id);
    $.get(pageuri+'/'+id, function(data){
        form.find('#nama_bank').val(data.nama_bank);
        form.find('#nama_rekening').val(data.nama_rekening);
        form.find('#nomor_rekening').val(data.nomor_rekening);
    });
});
$(document).on('submit', '#ubahBank form', function(e) {
    $('#ubahBank').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#ubahBank form').attr('action');
    var token = $('#ubahBank form').find("input[name=_token]").val();
    var formdata = $('#ubahBank form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "PUT",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            bankTable.ajax.reload();
            $('#ubahBank form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            bankTable.ajax.reload();
        }
    });
});
function hapusBank(id){
    token = $('#bankTable').data('csrf');
    swal({
        title: 'Apa anda yakin ?',
        text: "Bank yang telah memiliki transaksi tidak dapat dihapus, ingin menghapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/'+id;
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
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Data berhasil dihapus!'
                });
                bankTable.ajax.reload();
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}
$(document).on('submit', '#tambahUser form', function(e) {
    $('#tambahUser').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#tambahUser form').attr('action');
    var token = $('#tambahUser form').find("input[name=_token]").val();
    var formdata = $('#tambahUser form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "POST",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil disimpan!'
            });
            penggunaTable.ajax.reload();
            $('#tambahUser form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            penggunaTable.ajax.reload();
        }
    });
});
$('#ubahUser').on('shown.bs.modal', function(e){
    var id = $(e.relatedTarget).data('id');
    var form = $('#ubahUser form');
    $.get(pageuri+'/'+id, function(data){
        form.attr('action', pageuri+'/'+id);
        form.find('#name').val(data.name);
        form.find('#email').val(data.email);
    });
});
$(document).on('submit', '#ubahUser form', function(e) {
    $('#ubahUser').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#ubahUser form').attr('action');
    var token = $('#ubahUser form').find("input[name=_token]").val();
    var formdata = $('#ubahUser form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "PUT",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Data berhasil diubah!'
            });
            penggunaTable.ajax.reload();
            $('#ubahUser form')[0].reset();
        },
        error : function(){
            toast({
                type: 'error',
                title: 'Perubahan Tidak Disimpan!'
            });
            penggunaTable.ajax.reload();
        }
    });
});
$('#passwordUser').on('shown.bs.modal', function(e){
    var id = $(e.relatedTarget).data('id');
    var form = $('#passwordUser form');
    $.get(pageuri+'/'+id, function(data){
        form.attr('action', pageuri+'/'+id+'/updatepw');
    });
});
$(document).on('submit', '#passwordUser form', function(e) {
    $('#passwordUser').modal('hide');
    $('.overlay').css('display','block');
    var form_action = $('#passwordUser form').attr('action');
    var token = $('#passwordUser form').find("input[name=_token]").val();
    var formdata = $('#passwordUser form').serialize();
    e.preventDefault();
    $.ajax({
        header: {
            'X-CSRF-TOKEN': token
        },   
        method: "PUT",
        url : form_action,
        data : formdata,
        datatype : 'json',
        success : function(){
            toast({
                type: 'success',
                title: 'Password berhasil diubah!'
            });
            penggunaTable.ajax.reload();
            $('#passwordUser form')[0].reset();
        },
        error : function(xhr){
            if(xhr.responseJSON == 'UNREGISTER_PHONE') {
                warningAlert('Pengguna belum mendaftarkan nomor handphone, penggantian password dibatalkan!');
            } else if(xhr.responseJSON == 'CONFIRM_FAIL') {
                warningAlert('Kedua password yang anda masukkan tidak sama');
            } else {
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            }
            $('#passwordUser form')[0].reset();
            penggunaTable.ajax.reload();
        }
    });
});
function hapusUser(id){
    token = $('#penggunaTable').data('csrf');
    swal({
        title: 'Apa anda yakin ?',
        text: "User yang telah memiliki transaksi atau memiliki daftar belanjaan tidak dapat dihapus, ingin menghapus ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data'
    }).then((result) => {
        if (result.value) {
            url = pageuri+'/'+id;
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
            }).done(function(){
                toast({
                    type: 'success',
                    title: 'Data berhasil dihapus!'
                });
                penggunaTable.ajax.reload();
            }).fail(function(){
                toast({
                    type: 'error',
                    title: 'Perubahan Tidak Disimpan!'
                });
            });
        } else {
            toast({
                type: 'error',
                title: 'Aksi dibatalkan!'
            });
        }
    })
}