<?php

/**
 * Dit is de database class.
 */

class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;
    private $dbHandler;
    private $statement;
    private $error;  

    public function  __get($property) 
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __construct()
    {
        $conn = "mysql:host=$this->dbHost;dbname=$this->dbName";

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        }       catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
          }
    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }
    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch ($value) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        try {
            return $this->statement->execute();
        } catch (PDOException $e) {
            error_log("Failed to execute");
            die("Failed to execute" . $e->getMessage());
        }
        
    }

    public function resultSet() : array
    {
        try {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Failed to set results in an array");
            die("Failed to set results in an array" . $e->getMessage());
        }

    }

    public function single() : object
    {
        try {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Failed to get single object");
            die("Failed to get single object" . $e->getMessage());
        }
    }

    public function rowCount()
    {
        try {
            $this->statement->rowCount();
        } catch (PDOException $e) {
            error_log("Failed to get row count");
            die("Failed to get row count" . $e->getMessage());
        }
        
    }

    // this method begins a new transaction for the database connection
    public function beginTransaction()
    {
        try {
            return $this->dbHandler->beginTransaction();
        } catch (PDOException $e) {
            error_log("Failed to begin transaction");
            die("Failed to begin transaction" . $e->getMessage());
        }
        
    }

    // This method returns the Id of the last row inserted in a table
    public function lastInsertId()
    {
        try {
            return $this->dbHandler->lastInsertId();
        } catch (PDOException $e) {
            error_log("Failed to get last inserted Id");
            die("Failed to get last inserted Id" . $e->getMessage());
        }
        
    }

    // This method commits the current transaction
    public function commit()
    {
        try {
            return $this->dbHandler->commit();
        } catch (PDOException $e) {
            error_log("Failed to commit");
            die("Failed to commit" . $e->getMessage());
        }
        
    }

    public function prepare($query, $params = [])
    {
        try {
            $stmt = $this->dbHandler->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            return $stmt;
        } catch (PDOException $e) {
            error_log("Failed to prepare");
            die("Failed to prepare" . $e->getMessage());
        }

    }
}
