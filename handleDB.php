<?php 
class HandleDB {
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE = "movieticket";

    private $conn;

    public function __construct() {
        $this->conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
    
    public function update($table, $data, $where, $key) {

        // Create an array of column-value pairs
        $columnValuePairs = array();
        foreach ($data as $column => $value) {
            $columnValuePairs[] = "$column = '$value'";
        }

        // Join the column-value pairs into a comma-separated string
        $setClause = implode(', ', $columnValuePairs);

        // Construct the SQL query
        $sql = "UPDATE $table SET $setClause WHERE $where = '$key'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($table, $key, $value) {

        $sql = "DELETE FROM $table WHERE $key = '$value'";
        
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function find($table, $where) {
        $sql = "SELECT * FROM $table WHERE $where";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function find_data($table, $column, $data){
        $sql = "SELECT * FROM $table WHERE $column = '$data'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }

    }

    public function find_by_data($table, $data){

        $sql = "SELECT * FROM $table WHERE name LIKE '%$data%' OR describes LIKE '%$data%'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }

    }

    public function find_movie($table, $column, $data){
        $sql = "SELECT * FROM $table WHERE $column = '$data'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }

    }

    public function findAll($table) {
        $sql = "SELECT * FROM $table";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }
    }

    public function __destruct() {
        $this->conn->close();
    }


    public function add_data($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}


?>