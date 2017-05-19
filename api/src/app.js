
$(function () {

    $.ajax({type: 'GET',
        url: 'http://localhost/Books/api/books.php',
        success: function (data) {
            var obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                $('.listBooks').append("<div class='booksname title' id='" + obj[i].id + "'>" + obj[i].name + "<div class='description' ></div></div>");
            }
            ;
        },
        error: function (xhr, status, errorThrown) {
            alarm(status);
        },
        complete: function (xhr, status) {
        }

    });



    $("div").on('click', '.booksname', function (e) {
        var id = this.id;
        $.ajax({type: 'GET',
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            success: function (data) {
                var obj = JSON.parse(data);
                $("#" + id + "").toggleClass('booksname');
                $("#" + id + "").children('div').append("by " + obj.autor + "<br>" + obj.description + "").toggle();
            },
            error: function (xhr, status, errorThrown) {
                alarm(status)
            },
            complete: function (xhr, status) {
            }
        })
    });



    $("div").on('click', '.title', function (e) {
        $(this).children('div').toggle();
        $(this).children('div').css('color', 'blue');
    });




    $("#sub").click(function (event) {
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

});
