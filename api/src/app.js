
$(function () {

    $.ajax({type: 'GET',
        url: 'http://localhost/Books/api/books.php', // loading all books
        success: function (data) {
            var obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                $('.listBooks').append("<div class='booksname title' id='" + obj[i].id + "'><h3>" + obj[i].name + "</h3>\n\
                <div class='description' ></div></div>\n\
                <div class='hide'><button class='editButton' id='" + obj[i].id + "' type='submit'>Edit</button></div>");
                $('.delete').css('color', 'red');
            }
            ;
        },
        error: function (xhr, status, errorThrown) {
            alarm(status);
        },
        complete: function (xhr, status) {
        }

    });


    $('.listBooks').on('click', '.delete', function (e) {           //delete book
        var id = this.id;
        $.ajax({
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            type: 'DELETE',
            data: "id=" + id + "",
            success: function () {
                alert('DELETE completed');
                $("div #" + id + "").remove();
            }
        });
    });


    $('div').on('click', '.editButton', function (e) {
        var id = this.id;
        console.log(id);
        $('.edi1').attr("id", "" + id + "");
        $('.edi1').toggleClass("hide");
        $('.listBooks').toggleClass("hide");
        $('.form-group').toggleClass("hide");
    });


    $("div").on('click', '.booksname', function (e) {    // loading description
        var id = this.id;
        $.ajax({type: 'GET',
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            success: function (data) {
                var obj = JSON.parse(data);
                $("#" + id + "").toggleClass('booksname');
                $("#" + id + "").children('div').append("by " + obj.autor + "<br>" + obj.description + "<br> \n\
                <button class='delete'id='" + id + "' type='submit'>Delete " + name + "</button>").toggle();
                $('.delete').css('color', 'red');
            },
            error: function (xhr, status, errorThrown) {
                alarm(status)
            },
            complete: function (xhr, status) {
            }
        })
        e.preventDefault();
    });


    $("div").on('click', '.title', function (e) {     //toggle description
        $(this).children('div').toggle();
        $(this).children('div').css('color', 'blue');
        $(this).next('div').toggleClass('hide');
        e.preventDefault();
    });


    $("#sub").click(function (event) {      //adding new book
        $.ajax({
            url: 'http://localhost/Books/api/books.php',
            type: 'post',
            data: {"name": $('#name').val(), "autor": $('#autor').val(), "description": $('#description').val()},
            success: function (data, textStatus, jQxhr) {
                alert(textStatus);
            },
            error: function (xhr, status, errorThrown) {
            },
            complete: function (xhr, status) {
            }
        });
    });


    $(".edi1").on('click', '.subEdit', '.putEdit', function (event) {      //edit new book
        $('.edi1').toggleClass("hide");
        $('.listBooks').toggleClass("hide");
        $('.form-group').toggleClass("hide");
        var id = $('.edi1').attr('id');
        console.log(id);
        $.ajax({
            url: "http://localhost/Books/api/books.php",
            type: 'put',
            data: {"id": id, "name": $('#fname').val(), "autor": $('#fautor').val(), "description": $('#fdescription').val()},
            success: function (data, textStatus, jQxhr) {
                alert(textStatus);
            },
            error: function (xhr, status, errorThrown) {
            },
            complete: function (xhr, status) {
            }
        });
    });

});
