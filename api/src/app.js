
$(function () {

    $.ajax({type: 'GET',
        url: 'http://localhost/Books/api/books.php', // loading all books
        success: function (data) {
            var obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                $('.listBooks').append("<div class='booksname title' id='" + obj[i].id + "'><h3>" + obj[i].name + "</h3>\n\
                <div class='description' ></div></div>\n\
                <form class='hide putEdit' id=" + obj[i].id + " role='form'>Edit\n\
                <input type='text'  name='name' id='name'  placeholder='title'>\n\
                <input type='text'  name='autor' id='autor'  placeholder='autor'>\n\
                <input type='text'  name='description' id='description'  placeholder='description'>\n\
                <button class='subEdit' id=" + obj[i].id + " type='submit' >Edit</button> \n\
                </form>");
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


    $('.listBooks').on('click', '.delete', function (e) {
        var id = this.id;
        console.log(this.id);
        $.ajax({
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            type: 'DELETE',
            data: "id=" + id + "",
            success: function () {
                alert('DELETE completed');
            }
        });
    });










    $("div").on('click', '.booksname', function (e) {    // loading description
        var id = this.id;
        $.ajax({type: 'GET',
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            success: function (data) {
                var obj = JSON.parse(data);
                $("#" + id + "").toggleClass('booksname');
                $("#" + id + "").children('div').append("by " + obj.autor + "<br>" + obj.description + " \n\
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
        $(this).next('.putEdit').toggleClass('hide');
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
    
    $(document).on('click', ".subEdit", ".putEdit", function (event) {      //edit new book
        
        console.log(event);
        $.ajax({
            url: "http://localhost/Books/api/books.php",
            type: 'put',
            data: { "id": this.id, "name": 'arel', "autor": $('#autor').val(), "description": $('#description').val()},
            success: function (data, textStatus, jQxhr) {
                alert(textStatus);
            },
            error: function (xhr, status, errorThrown) {
            },
            complete: function (xhr, status) {
            }
        }); 
        event.preventDefault();
    });
    
 

});
