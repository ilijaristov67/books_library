<?php
require_once __DIR__ . "/../autoload.php";

class Book
{
    private $connection;
    private $title;
    private $number_of_pages;
    private $author_id;
    private $published;
    private $photo;
    private $category_id;


    public function __construct($connection, $title, $number_of_pages, $author_id, $published, $photo, $category_id)
    {

        $this->setConnection($connection);
        $this->setTitle($title);
        $this->setNumber_of_pages($number_of_pages);
        $this->setAuthor_id($author_id);
        $this->setPublished($published);
        $this->setPhoto($photo);
        $this->setCategory_id($category_id);
    }

    public function saveBook()
    {
        $connection = $this->getConnection();
        $title = $this->getTitle();
        $number_of_pages = $this->getNumber_of_pages();
        $author_id = $this->getAuthor_id();
        $published = $this->getPublished();
        $photo = $this->getPhoto();
        $category_id = $this->getCategory_id();
        $sql = "INSERT INTO books (title, number_of_pages, author_id, published, photo, category_id) VALUES (:title, :number_of_pages, :author_id, :published, :photo, :category_id)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':number_of_pages', $number_of_pages, PDO::PARAM_INT);
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindParam(':published', $published, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function checkBook()
    {
        $connection = $this->getConnection();
        $title = $this->getTitle();
        $sql = 'SELECT * FROM books WHERE title = :title';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllBooks()
    {
        $connection = $this->getConnection();
        $sql = "SELECT 
                    b.id, 
                    b.title, 
                    b.number_of_pages, 
                    b.author_id, 
                    CONCAT(a.first_name, ' ', a.last_name) AS author_name, 
                    b.published, 
                    b.photo, 
                    b.category_id, 
                    c.title AS category_title
                FROM 
                    books b
                INNER JOIN 
                    authors a ON b.author_id = a.id
                INNER JOIN 
                    categories c ON b.category_id = c.id";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSingleBook($id)
    {
        $connection = $this->getConnection();
        $sql = "SELECT 
                    b.id, 
                    b.title, 
                    b.number_of_pages, 
                    b.author_id, 
                    CONCAT(a.first_name, ' ', a.last_name) AS author_name, 
                    b.published, 
                    b.photo, 
                    b.category_id, 
                    c.title AS category_title
                FROM 
                    books b
                INNER JOIN 
                    authors a ON b.author_id = a.id
                INNER JOIN 
                    categories c ON b.category_id = c.id
                WHERE 
                    b.id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function editBook($id, $title, $number_of_pages, $author_id, $published, $photo, $category_id)
    {
        $connection =  $this->getConnection();
        $sql = "UPDATE books SET title = :title, number_of_pages = :number_of_pages, author_id = :author_id, published=:published, photo = :photo, category_id=:category_id WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':number_of_pages', $number_of_pages, PDO::PARAM_INT);
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindParam(':published', $published, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function deleteBook($id)
    {
        $connection = $this->getConnection();
        $sql = "DELETE FROM books WHERE id = :id";
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
     * Get the value of number_of_pages
     */
    public function getNumber_of_pages()
    {
        return $this->number_of_pages;
    }

    /**
     * Set the value of number_of_pages
     *
     * @return  self
     */
    public function setNumber_of_pages($number_of_pages)
    {
        $this->number_of_pages = $number_of_pages;

        return $this;
    }

    /**
     * Get the value of author_id
     */
    public function getAuthor_id()
    {
        return $this->author_id;
    }

    /**
     * Set the value of author_id
     *
     * @return  self
     */
    public function setAuthor_id($author_id)
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Get the value of published
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set the value of published
     *
     * @return  self
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

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
