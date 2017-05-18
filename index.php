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
        <div class="container">

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            ?>
                <div class="container">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    </div>
                    <div class="col-xs-14 col-sm-4 col-md-4 col-lg-4">

                        <?php
                        $loadBook = Book::loadBookById($conn, $id);
                        echo " " . $loadBook->getId() . " <br>";
                        echo " " . $loadBook->getName() . " <br>";
                        echo " " . $loadBook->getAutor() . " <br>";
                        echo " " . $loadBook->getDescription() . " <br>";

                        echo "<a href='api/books.php?id=" . $loadBook->getId() . "&name=" . $loadBook->getName() . "&autor=" . $loadBook->getAutor() . "'> Edit</a><br>";
                        echo "<a href='api/books.php'>Return to main page</a><br>";
            }
                    ?>
                </div>
            </div>       


        </div>
        
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <form action="api/books.php" method="POST" role="form">
                        <legend>Books</legend>
                        <div class="form-group">
                            <label for="">Add new Book</label>
                            <input rows="4" cols="50" type="textarea" class="form-control" name="name" id="name"  placeholder="Title">
                            <input rows="4" cols="50" type="textarea" class="form-control" name="autor" id="autor" placeholder="Autor">
                            <input rows="4" cols="50" type="textarea" class="form-control" name="description" id="description" placeholder="Description" >
                        </div>
                        <button id="Book" type="submit" class="btn btn-primary">Add</button>
                    </form>

                </div>
            </div>
        
        
         <button id="showBook" type="submit" class="btn btn-primary">Show all books</button>   

     
    <ul class="listBooks"></ul>
           
  

            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
            <script src="api/src/app.js" type="text/javascript"></script>
    </body>
</html>
