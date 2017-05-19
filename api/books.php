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
} else if ($_SERVER['REQUEST_METHOD'] == 'POST'){

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