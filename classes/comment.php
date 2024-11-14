<?php
require_once __DIR__ . "/../autoload.php";

class Comment
{

    private $connection;
    private $user_id;
    private $book_id;
    private $description;
    private $is_approved;

    public function __construct($connection, $user_id, $book_id, $description, $is_approved = false)
    {
        $this->setConnection($connection);
        $this->setUser_id($user_id);
        $this->setBook_id($book_id);
        $this->setDescription($description);
        $this->setIs_approved($is_approved);
    }


    public function addComment()
    {
        $connection = $this->getConnection();
        $user_id = $this->getUser_id();
        $book_id = $this->getBook_id();
        $description = $this->getDescription();
        $is_approved = $this->getIs_approved();
        $sql = "INSERT INTO comments (user_id, book_id, description, is_approved) VALUES (:user_id,:book_id, :description, :is_approved)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":is_approved", $is_approved, PDO::PARAM_BOOL);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function checkIfCommented($user_id, $book_id)
    {
        $connection = $this->getConnection();

        $sql = "SELECT * FROM comments WHERE user_id = :user_id AND book_id = :book_id";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result !== false;
    }

    public function getApprovedComments($book_id)
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM comments WHERE is_approved = 1 AND book_id = :book_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllComments()
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM comments";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserComments($user_id, $book_id)
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM comments WHERE user_id = :user_id AND book_id = :book_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":book_id", $book_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id)
    {
        $connection = $this->getConnection();
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


    public function approveComment($id)
    {
        $connection = $this->getConnection();
        $sql = "UPDATE comments SET is_approved =  true WHERE id=:id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function disApproveComment($id)
    {
        $connection = $this->getConnection();
        $sql = "UPDATE comments SET is_approved =  false WHERE id=:id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
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
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of is_approved
     */
    public function getIs_approved()
    {
        return $this->is_approved;
    }

    /**
     * Set the value of is_approved
     *
     * @return  self
     */
    public function setIs_approved($is_approved)
    {
        $this->is_approved = $is_approved;

        return $this;
    }

    /**
     * Get the value of book_id
     */
    public function getBook_id()
    {
        return $this->book_id;
    }

    /**
     * Set the value of book_id
     *
     * @return  self
     */
    public function setBook_id($book_id)
    {
        $this->book_id = $book_id;

        return $this;
    }
}
