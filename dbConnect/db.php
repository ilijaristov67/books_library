<?php
class dbConnect
{
    private $dbType;
    private $dbHost;
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    private $connection;

    public function __construct($dbType, $dbHost, $dbName, $dbUsername = 'root', $dbPassword = '')
    {
        $this->setDbType($dbType);
        $this->setDbHost($dbHost);
        $this->setDbName($dbName);
        $this->setDbUsername($dbUsername);
        $this->setDbPassword($dbPassword);
    }
    public function dbConnect()
    {
        $dbType = $this->getDbType();
        $dbHost = $this->getDbHost();
        $dbName = $this->getDbName();
        $dbUsername = $this->getDbUsername();
        $dbPassword = $this->getDbPassword();
        $connection = $this->getConnection();
        try {
            $connection = new PDO("$dbType:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

            $this->setConnection($connection);
        } catch (PDOException $error) {
            echo $error->getMessage();
            die;
        }
    }


    public function getDbType()
    {
        return $this->dbType;
    }

    /**
     * Set the value of dbType
     *
     * @return  self
     */
    public function setDbType($dbType)
    {
        $this->dbType = $dbType;

        return $this;
    }

    /**
     * Get the value of dbHost
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * Set the value of dbHost
     *
     * @return  self
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;

        return $this;
    }

    /**
     * Get the value of dbName
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Set the value of dbName
     *
     * @return  self
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * Get the value of dbUsername
     */
    public function getDbUsername()
    {
        return $this->dbUsername;
    }

    /**
     * Set the value of dbUsername
     *
     * @return  self
     */
    public function setDbUsername($dbUsername)
    {
        $this->dbUsername = $dbUsername;

        return $this;
    }

    /**
     * Get the value of dbPassword
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * Set the value of dbPassword
     *
     * @return  self
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;

        return $this;
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
}
