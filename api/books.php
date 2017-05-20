<?php

require_once ('src/connection.php');
require_once ('src/book.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {  // single book
        $id = $_GET['id'];
        $loadBook = Book::loadBookById($conn, $id);
        echo json_encode($loadBook);
        
    } else {
        $loadAllBooks = Book::loadFromDB($conn);    // all books
        echo json_encode($loadAllBooks);
    }
} 


else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (isset($_POST['name']) || isset($_POST['autor']) || isset($_POST['description'])) {        // new book
        $book1 = new Book();
        $book1->setName($_POST['name']);
        $book1->setAutor($_POST['autor']);
        $book1->setDescription($_POST['description']);
        $book1->Create($conn);
        $conn->close();
        $conn = null;
    }
} 


else if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){     // delete book
        
        parse_str(file_get_contents("php://input"), $del_vars);
        $id = $del_vars['id'];
        $deleteBook = Book::loadBookById($conn, $id);
        $deleteBook->deleteFromDB($conn);
        $conn->close();
        $conn = null; 
        
}


else if ($_SERVER['REQUEST_METHOD'] == 'PUT'){     // edit book
     
        parse_str(file_get_contents("php://input"), $put_vars);
        print_r($put_vars);
        echo 'ok';
        
        $id = $put_vars['id'];
        $name = $put_vars['name'];
        $autor = $put_vars['autor'];
        $description = $put_vars['description'];
      
        
       $putBook = Book::loadBookById($conn, $id);
        
        if(isset($put_vars['name'])){
            $putBook->setName($name);
        }
        
        if(isset($put_vars['autor'])){
        $putBook->setAutor($autor);
        }
        
        if(isset($put_vars['description'])){
        $putBook->setDescription($description);
        }
        
        
        $putBook->update($conn);
        $conn->close();
        $conn = null; 
      

}