<?php

class Book implements JsonSerializable {

    public $id;
    public $name;
    public $autor;
    public $description;

    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->autor = "";
        $this->description = "";
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'autor' => $this->autor,
            'description' => $this->description
        ];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function Create(mysqli $connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Book (name, autor, description) VALUES "
                    . "('$this->name','$this->autor','$this->description')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        }
    }

    public function update(mysqli $connection) {
        if ($this->id !== -1) {
            $sql = "UPDATE Book SET name = '$this->name', autor = '$this->autor',"
                    . " description = '$this->description'"
                    . "WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $sql = "INSERT INTO Book (name, autor, description) VALUES "
                    . "('$this->name','$this->autor','$this->description')";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Book SET name = '$this->name', autor = '$this->autor',"
                    . " description = '$this->description'"
                    . "WHERE id = $this->id";
            $result = $connection->query($sql);
            echo $connection->error;
            var_dump($result);
            if ($result == true) {
                return true;
            }
        }
        return false;
    }

    public function deleteFromDB(mysqli $connection) {
        if ($this->id != -1) {
            $sql = "DELETE FROM Book WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result == true) {
                $this->id = -1;
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    static public function loadFromDB(mysqli $connection) {
        $sql = "SELECT * FROM Book";
        $ret = array();
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows > 0) {
            foreach ($result as $row) {
                $loadedBook = new Book();
                $loadedBook->id = $row['id'];
                $loadedBook->name = $row['name'];
                $loadedBook->autor = $row['autor'];
                $loadedBook->description = $row['description'];
                $ret[] = $loadedBook;
            }
        }

        return $ret;
    }

    static public function loadBookById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Book WHERE id=$id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $loadedBook = new Book();
            $loadedBook->id = $row['id'];
            $loadedBook->name = $row['name'];
            $loadedBook->autor = $row['autor'];
            $loadedBook->description = $row['description'];

            return $loadedBook;
        }
        return null;
    }
    
    


}
