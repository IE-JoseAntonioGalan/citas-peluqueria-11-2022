<?php
class Database {
    private $dbConnect =  null;

    private $DB_HOST = 'localhost';
    private $DB_PORT = 3306;
    private $DB_DATABASE = 'hairdressers';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = 'password';

    public function __construct()
    {
        $host     = $this->DB_HOST;
        $port     = $this->DB_PORT;
        $db       = $this->DB_DATABASE;
        $user     = $this->DB_USERNAME;
        $password = $this->DB_PASSWORD;        

        try {
            $this->dbConnect = new PDO('mysql:host='.$host.';dbname='.$db.';port='.$port, $user, $password, array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ));
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function sql_sentence(String $sentence, Array $data = null)
    {
        $conn = $this->dbConnect;
        $stmt = $conn->prepare($sentence);

        $stmt->execute($data);
        $conn = null;

        return $stmt;
    }

    public function get_last_insert_id()
    {
        $id = $this->dbConnect->lastInsertId();

        return $id;
    }
}