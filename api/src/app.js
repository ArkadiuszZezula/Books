
$(function () {



//$("#showBook").click(function (event) {

    $.ajax({type: 'GET', url: 'http://localhost/Books/api/books.php'})
            .done(function (data) {
                var obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    $('.listBooks').append("<li class='title' id='" + obj[i].id + "'>" + obj[i].name + "<div class='description hide' id='" + obj[i].id + "' >" + obj[i].description + "</div></li>");
                }
                ;
            })
            .fail(function () { })
            .always(function () { });
//});





    $(document).on('click', 'li', function (e) {
        console.log(this);
        var id = this.id;
        $("#" + id + "").children("#" + id + "").toggle();
        console.log(id);
    });





    $("#Book").click(function (event) {
        $.ajax({
            url: 'api/books.php',
            dataType: 'json',
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify({"name": $('#name').val(), "last-name": $('#autor').val(), "description": $('#description').val()}),
            processData: false,
            success: function (data, textStatus, jQxhr) {
                $('#app').html(JSON.stringify(data));
            },

        });
        event.preventDefault();

    });





});
















/*
 * $('input[type="submit"]').on('click', function (e) {
 var addUser = $('#addUser').val();
 var age = $('#age').val();
 
 var li = $("<li data-age='" + age + "'>" + addUser + "</li>");
 li = colorizeLi(li);
 $('.main').append(li);
 
 })
 */
