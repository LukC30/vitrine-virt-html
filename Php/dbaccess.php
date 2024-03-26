<?php
include 'env.php';

class DbConnect
{

    private $server = DB_Host;
    private $dbname = DB_Name;
    private $user = DB_User;
    private $pass = DB_Password;

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
