<?php
require_once __DIR__ . "/../autoload.php";


class Category
{
    private $connection;
    private $title;
    private $isDeleted;

    public function __construct($connection, $title, $isDeleted = false)
    {
        $this->setConnection($connection);
        $this->setTitle($title);
        $this->setIsDeleted($isDeleted);
    }

    public function addCategory()
    {
        $connection = $this->getConnection();
        $title = $this->getTitle();
        $isDeleted = $this->getIsDeleted();
        $sql = "INSERT INTO categories (title, is_deleted) VALUES (:title, :isDeleted)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":isDeleted", $isDeleted, PDO::PARAM_BOOL);
        $stmt->execute();
    }

    public function checkCategory()
    {
        $connection = $this->getConnection();
        $title = $this->getTitle();
        $sql = "SELECT * FROM categories WHERE title = :title AND is_deleted = false";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($category) {
            if ($category['is_deleted'] == false) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function getCategories()
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM categories WHERE is_deleted = 0";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $allCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $allCategories;
    }


    public function deleteCategory($id)
    {
        $connection = $this->getConnection();
        $isDeleted = $this->getIsDeleted();
        $sql = "UPDATE categories SET is_deleted = 1 WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editCategory($id, $title)
    {
        $connection = $this->getConnection();
        $sql = "UPDATE categories SET title = :title WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set the value of isDeleted
     *
     * @return  self
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
