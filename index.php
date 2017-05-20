<?php
session_start();
require_once ('api/src/connection.php');
require_once ('api/src/book.php');


?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Books</title>
        <link rel="stylesheet" href="css/style.css">
        <!--<link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    --></head>
    <body>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form id="myForm" action="" method="POST" role="form">
                        <legend><h1 align="center">Library</h1></legend>
                        <div class="form-group">
                            <label for="">Add new Book</label>
                            <input rows="4" cols="50" type="text" class="form-control" name="name" id="name"  placeholder="Title">
                            <input rows="4" cols="50" type="text" class="form-control" name="autor" id="autor" placeholder="Autor">
                            <input rows="4" cols="50" type="text" class="form-control" name="description" id="description" placeholder="Description" >
                        </div>
                        <button id="sub" type="submit" ">Add</button>
                    </form>
                   <!-- <form class="putEdit" id="editForm" action="" method="PUT" role="form">
                        
                            <label for="">Edit Book</label>
                            <input rows="4" cols="50" type="text" class="form-control" name="name" id="name"  placeholder="Title">
                            <input rows="4" cols="50" type="text" class="form-control" name="autor" id="autor" placeholder="Autor">
                            <input rows="4" cols="50" type="text" class="form-control" name="description" id="description" placeholder="Description" >
                        </div>
                        <button id="subEdit" type="submit" ">Edit</button>
                    --></form>
                    <div id="result"></div>
                </div>
            </div>
        
  
    <div class="listBooks"></div>       
    <div id="app"></div>
  

            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
            <script src="api/src/app.js" type="text/javascript"></script>
    </body>
</html>
