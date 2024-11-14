<?php
require_once __DIR__ . "/../autoload.php";


class User
{
    private $connection;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $role;

    public function __construct($connection, $firstName, $lastName, $email, $password, $role = 2)
    {
        $this->setConnection($connection);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setRole($role);
    }

    public function saveUser()
    {
        $connection = $this->getConnection();
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();
        $email = $this->getEmail();
        $passwordHashed = password_hash($this->getPassword(), PASSWORD_BCRYPT);
        $role = $this->getRole();
        $sql = 'INSERT INTO users (first_name, last_name, email, password, role_id) VALUES (:firstName, :lastName, :email, :password, :role)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordHashed, PDO::PARAM_STR);
        $stmt->bindParam("role", $role, PDO::PARAM_INT);
        $user = $stmt->execute();
    }

    public function checkUser()
    {
        $connection = $this->getConnection();
        $email = $this->getEmail();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return true;
        }
        return false;
    }

    public function authenticateUser()
    {
        $connection = $this->getConnection();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    public function getUser()
    {
        $connection = $this->getConnection();
        $email = $this->getEmail();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
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
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
