<?php
class DbConnect
{
    private $server = 'localhost:3306';
    private $dbname = 'db_loja';
    private $user = 'root';
    private $pass = 'admin';

    public function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\Exception $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }
}
