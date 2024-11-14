<?php
require_once __DIR__ . "/../autoload.php";

class Author
{
    private $connection;
    private $first_name;
    private $last_name;
    private $biography;
    private $is_deleted;

    public function __construct($connection, $first_name, $last_name, $biography, $is_deleted = false)
    {
        $this->setConnection($connection);
        $this->setFirst_name($first_name);
        $this->setLast_name($last_name);
        $this->setBiography($biography);
        $this->setIs_deleted($is_deleted);
    }


    public function saveAuthor()
    {
        $connection = $this->getConnection();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $biography = $this->getBiography();
        $is_deleted = $this->getIs_deleted();
        $sql = "INSERT INTO authors (first_name, last_name, biography, is_deleted) VALUES (:first_name, :last_name, :biography, :is_deleted)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":biography", $biography, PDO::PARAM_STR);
        $stmt->bindParam(":is_deleted", $is_deleted, PDO::PARAM_BOOL);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function checkIfAuthorExists()
    {
        $connection = $this->getConnection();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $biography = $this->getBiography();
        $sql = "SELECT * FROM authors WHERE first_name = :first_name AND last_name = :last_name AND biography = :biography AND is_deleted = 0";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":biography", $biography, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAuthors()
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM authors WHERE is_deleted = false";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editAuthor($id, $first_name, $last_name, $biography)
    {
        $connection =  $this->getConnection();
        $sql = "UPDATE authors SET first_name = :first_name, last_name = :last_name, biography = :biography WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':biography', $biography, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


    public function deleteAuthor($id)
    {
        $connection = $this->getConnection();
        $sql = "UPDATE authors SET is_deleted = 1 WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get the value of first_name
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of biograpy
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set the value of biograpy
     *
     * @return  self
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get the value of is_deleted
     */
    public function getIs_deleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set the value of is_deleted
     *
     * @return  self
     */
    public function setIs_deleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }
}
