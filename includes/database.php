<?php

namespace Portfolio;

use PDO;

class Database
{
public function query(string $query, array $bindings = [])
    {
        $connection = $this->connect();
        $statement = $connection->prepare($query);
        foreach ($bindings as $key => $value) {
            // var_dump([$key => $value]);
            $statement->bindValue(":$key", $value);
            //$statement->bindParam(":$key", $value, PDO::PARAM_STR); //":" . $key - js syntax `hello_${myVar}`
        }
        $statement->execute();
        // $status = $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
public function connect()
    {
        $config = $this->getConfig();
        $dsn = $this->getDsn();

        $username = $config['username'];
        $password = $config['password'];

        try {
            // We add PDO::ERRMODE_EXCEPTION to force PDO to report errors clearly
            $connection = new PDO($dsn, $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
            
        } catch (\PDOException $e) {
            // If the connection fails, print the error to the screen and stop the script
            echo "Database Connection Failed: " . $e->getMessage();
            die(); 
        }
    }

public function getConfig()
    {
        return [
        'username' => 'root',
        'password' => 'root',
        'host' => 'localhost',
        'database' => 'portfolio_main',
        'port' => '8889'
        ];
    }

public function getDsn()
    {
        $config = $this->getConfig();
        $host = $config['host'];
        $database = $config['database'];
        $port = $config['port'];

        return 'mysql:host=' . $host . ';dbname=' . $database . ';port=' . $port . ';';
    }
}

?>