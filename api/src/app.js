
$(function () {




    // $("#showBook").click(function (event) {

    $.ajax({type: 'GET',
        url: 'http://localhost/Books/api/books.php',
        success: function (data) {
            var obj = JSON.parse(data);
            for (i = 0; i < obj.length; i++) {
                $('.listBooks').append("<li class='title' id='" + obj[i].id + "'>" + obj[i].name + "<div class='description hide' ></div></li>");
                //  $('.listBooks').append("<li class='title' id='" + obj[i].id + "'>" + obj[i].name + "<div class='description hide' id='" + obj[i].id + "' >by " + obj[i].autor + "<br>" + obj[i].description + "</div></li>");
            }
            ;
        },
        error: function (xhr, status, errorThrown) {
            alarm(status);
        },
        complete: function (xhr, status) {
        }

    })

    /*   $(document).on('click', 'li', function (e) {
     console.log(this);
     var id = this.id;
     $("#" + id + "").children("#" + id + "").toggle();
     console.log(id);
     }); */

    $(document).on('click', 'li', function (e) {
        var id = this.id;
        $.ajax({type: 'GET',
            url: "http://localhost/Books/api/books.php?id=" + id + "",
            success: function (data) {
                var obj = JSON.parse(data);
                des = 0;
                if(des<1){
                des = $("#"+id+"").children('div').append("by " + obj.autor + "<br>" + obj.description + "").toggleClass();
                } else {
                des.remove(); 
                }
            },
            error: function (xhr, status, errorThrown) {
                alarm(status)
            },
            complete: function (xhr, status) {
            }

        })
    });

    //});




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
