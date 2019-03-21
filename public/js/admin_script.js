$(document).ready(function () {

    //User update
   $('.adminUpdateUser').click(function (e) {
        // e.preventDefault();
        var userId = $(this).data('id');
        var data = {
            '_token' : $('#csrf').val(),
            'userId' : userId
        }
        $.ajax({
            method: 'post',
            url: '/admin/user/updatePodaci',
            data: data,
            success: function (data) {
                $('#first_name').val(data['ime']);
                $('#last_name').val(data['prezime']);
                $('#email').val(data['email']);
                $('#password').val(data['password']);
                $('#tel').val(data['kontakt']);
                $('#city').val(data['grad']);
                $('#user_id').val(data['id']);
                document.getElementById('adminUserRoleddl').value = data['uloga_id'];
                document.getElementById('adminUserAktivanddl').value = data['aktivan'];
            },
            error: function () {

            }
        });
   });
   //User delete
   $('.adminDeleteUser').click(function () {
       var potvrda = confirm('Are you sure you want to delete that user?');
       if(potvrda == true) {
           var user_id = $(this).data('id');
           var data = {
               '_token': $('#csrf').val(),
               'user_id': user_id
           }
           $.ajax({
               method: 'post',
               url: '/admin/user/deleteUser',
               data: data,
               success: function () {

               },
               error: function () {

               }
           });
       }
   });


   //Comment update
    $('.adminUpdateComment').click(function () {
        var comment_id = $(this).data('id');
        var data = {
            '_token' : $('#navToken').val(),
            'comment_id' : comment_id
        };
        $.ajax({
            method: 'post',
            url: '/admin/comment/updatePodaci',
            data: data,
            success: function (data) {
                $('#comment_text').val(data['text']);
                document.getElementById('adminProductddl').value = data['proizvod_id'];
                document.getElementById('adminUserddl').value = data['korisnik_id'];
                $('#comment_id').val(data['id']);
            },
            error: function () {

            }
        });
    });

    //Commment delete
    $('.adminDeleteComment').click(function () {
        var potvrda = confirm('Are you sure you want to delete this commnet?');
        if(potvrda == true) {
            var comment_id = $(this).data('id');
            var data = {
                '_token': $('#navToken').val(),
                'comment_id': comment_id
            }
            $.ajax({
                method: 'post',
                url: '/admin/comment/deleteComment',
                data: data,
                success: function (data) {
                    // console.log(data);
                },
                error: function () {

                }
            });
        }
    });

    //Product update
    $('.adminUpdateProduct').click(function (e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var data = {
            '_token' : $('#navToken').val(),
            'product_id' : product_id
        };
        $.ajax({
            method: 'post',
            url: '/admin/product/updatePodaci',
            data: data,
            success: function (data) {
                // console.log(data[0]['naziv']);
                $('#product_name').val(data['naziv']);
                $('#product_desc').val(data['opis']);
                $('#product_price').val(data['cena']);
                $('#product_checked').val(data['pregledano']);
                $('#product_id').val(data['id']);
                $('#slika_id').val(data['slika_id']);
                document.getElementById('user_id').value = data['korisnik_id'];
                document.getElementById('category_id').value = data['kategorija_id'];
                document.getElementById('manufacturer_id').value = data['proizvodjac_id'];
            },
            error: function () {

            }
        });
    });

    //Product delete
    $('.adminDeleteProduct').click(function (e) {
        e.preventDefault();
        var potvrda = confirm('Are you sure you want to delete this product?');
        if(potvrda == true) {
            var product_id = $(this).data('id');
            var data = {
                '_token': $('#navToken').val(),
                'product_id': product_id
            }
            $.ajax({
                method: 'post',
                url: '/admin/product/deleteProduct',
                data: data,
                success: function (data) {
                    // console.log(data);
                    window.location.reload();
                },
                error: function () {

                }
            });
        }
    });

});