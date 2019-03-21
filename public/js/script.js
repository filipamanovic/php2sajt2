const BASE_URL = "http://localhost:8000";

//Registracija Korisnika
$(document).ready(function () {
    $('#nameReg').hide();
    $('#lastNReg').hide();
    $('#emailReg').hide();
    $('#passReg').hide();
    $('#telReg').hide();
    $('#cityReg').hide();
    $('#odgovorBaze').hide();
    //Registracija korisnika //
    $('#btnReg').click(function () {
        var ime = $('#firstName').val();
        var prezime = $('#lastName').val();
        var email = $('#email').val();
        var pass = $('#password').val();
        var tel = $('#tel').val();
        var city = $('#grad').val();

        var regIme = /^[A-ZŽĐŠĆČ][a-zžđšćč]{1,19}$/;
        var regPrezime = /^[A-ZŽĐŠĆČ][a-zžđšćč]{1,19}(\s[A-ZŽĐŠĆČ][a-zžđšćč]{1,19})*$/;
        var regPassord = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        var regEmail = /^.{1,30}\@.{2,10}\..{1,5}$/;
        var regTel = /^[+][\d]{0,3}\/[\d]{4,7}\-[\d]{3}$/;

        var nizGreske = [];

        if (!regPrezime.test(city)) {
            $('#cityReg').show();
            $('#cityReg').css('border', '1px solid crimson');
            nizGreske.push('City format bad.');
        } else {
            $('#cityReg').hide();
            $('#cityReg').css('border', '');
        }

        if (!regIme.test(ime)) {
            $('#nameReg').show();
            $('#firstName').css('border', '1px solid crimson');
            nizGreske.push('First name incorect!');
        } else {
            $('#nameReg').hide();
            $('#firstName').css('border', '');
        }

        if (!regPrezime.test(prezime)) {
            $('#lastNReg').show();
            $('#lastName').css('border', '1px solid crimson');
            nizGreske.push('Last name incorect!');
        } else {
            $('#lastNReg').hide();
            $('#lastName').css('border', '');
        }

        if (!regEmail.test(email)) {
            $('#emailReg').show();
            $('#email').css('border', '1px solid crimson');
            nizGreske.push('Email incorect!');
        } else {
            $('#emailReg').hide();
            $('#email').css('border', '');
        }

        if (!regPassord.test(pass)){
            $('#passReg').show();
            $('#password').css('border', '1px solid crimson');
            nizGreske.push('Password incorect!');
        } else {
            $('#passReg').hide();
            $('#password').css('border', '');
        }

        if (!regTel.test(tel)) {
            $('#telReg').show();
            $('#tel').css('border', '1px solid crimson');
            nizGreske.push('Concat tel incorect!');
        } else {
            $('#telReg').hide();
            $('#tel').css('border', '');
        }

        if (nizGreske.length == 0){
            var data = {
                "_token": $('#token').val(),
                'ime' : ime,
                'prezime' : prezime,
                'email' : email,
                'pass' : pass,
                'tel' : tel,
                'city': city,
                'success' : true
            };
            $.ajax({
                method : 'post',
                url : '/register',
                data : data,
                success : function (data) {
                    // console.log(data);
                    $('#odgovorBaze').show();
                    $("#odgovorBaze").html("<p>"+data['data']+"</p>");
                },
                error : function (xhr, status, error) {
                    switch(xhr.status) {
                        case 404 :
                            poruka = "Stranica nije pronadjena.";
                            break;
                        case 409:
                            poruka = "Username ili email vec postoji.";
                            break;
                        case 422:
                            poruka = "Podaci nisu validni.";
                            console.log(xhr.responseText);
                            break;
                        case 500:
                            poruka = "Greska.";
                            break;
                    }
                }
            })
        }
    });

    //Update poduct
    $('.updateAd').click(function (e) {
        // e.preventDefault();
        var proizvodId = $(this).data('id');
        var imageId = $(this).data('id2');
        var data = {
            '_token' : $("#csrfToken").val(),
            'product_id': proizvodId,
            'success': true
        };

        $.ajax({
            method: 'post',
            url: '/productInfo',
            data: data,
            success: function (data) {
                // console.log(data);
                $('#upName').val(data['naziv']);
                $('#upPrice').val(data['cena']);
                $('#upDesc').val(data['opis']);
                $('#imageId').val(imageId);
                $('#upProizvod').val(proizvodId);
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
            }
        });
    });

    //Delete product
    $('.deleteAd').click(function (e) {
        // e.preventDefault();
       var potvrda = confirm('Are you sure you want to delete that product?');
       if(potvrda == true) {
           var product_id = $(this).data('id');
           var data = {
               '_token': $('#csrfToken').val(),
               'product_id': product_id
           }
           $.ajax({
               method: 'post',
               url: '/productDelete',
               data: data,
               success: function () {
                   
               },
               error: function () {
                   
               }
           });
       }
    });

    //Pregledi
    $('.viewsUpdate').click(function (e) {
        // e.preventDefault();
        var id = $(this).data('id');
        var data = {
            "_token" : $('#tokenViews').val(),
            "id" : id,
        };
        $.ajax({
            method: 'post',
            url: '/updateViews',
            data: data,
            success: function () {

            },
            error: function () {

            }
        });
    });

});