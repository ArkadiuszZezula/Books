<?php
require_once ('src/connection.php');
require_once ('src/book.php');

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Books</title>
        <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>

        <?php
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        ?>  

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-14 col-sm-4 col-md-4 col-lg-4">

        <?php
            $loadBook = Book::loadBookById($conn, $id);
            echo " " . $loadBook->getId() . " <br>";
            echo " " . $loadBook->getName() . " <br>";
            echo " " . $loadBook->getAutor() . " <br>";
            echo " " . $loadBook->getDescription() . " <br>";

            echo "<a href='books.php?id=" . $loadBook->getId() . "&name=" . $loadBook->getName() . "&autor=" . $loadBook->getAutor() . "'> Edit</a><br>";
            echo "<a href='../index.php'>Return to main page</a><br>";
                
           
            if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['autor'])) {  // edycja
                    echo "Edycja";                             
        ?>

            <form action="books.php" method="POST" role="form">
                <legend>Books</legend>
                <div class="edit-group">
                    <label for="">Edit Book</label>
                    <input rows="4" cols="50" type="textarea" class="form-control" name="name" id="name"  placeholder="Edit Title">
                    <input rows="4" cols="50" type="textarea" class="form-control" name="autor" id="autor" placeholder="Edit Autor">
                    <input rows="4" cols="50" type="textarea" class="form-control" name="description" id="description" placeholder="Edit Description" >
                </div>
                <button id="BookEdit" type="submit" class="btn btn-primary">Save changes</button>
            </form>

        <?php
                                                                          
        // Edycja  
            if (isset($_POST['name']) || isset($_POST['autor']) || isset($_POST['description'])) {       
            
                $book2 = Book::loadBookById($conn,$_GET['id']);
                $book2->setName($_POST['name']);
                $book2->setAutor($_POST['autor']);
                $book2->setDescription($_POST['description']);
                $book2->update($conn);  
                $conn->close();
                $conn = null;
            }                      
            }
        }
        
            if (isset($_POST['name']) && isset($_POST['autor']) && isset($_POST['description'])) {        // wpis nowy
            $book1 = new Book();
            $book1->setName($_POST['name']);
            $book1->setAutor($_POST['autor']);
            $book1->setDescription($_POST['description']);
            $book1->Create($conn);  
            $serializedData = json_encode($book1);
            $conn->close();
            $conn = null;
            
            
            }        
        ?>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="src/app.js" type="text/javascript"></script>
    </body>
</html>
