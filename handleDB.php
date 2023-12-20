<?php
class HandleDB
{
    const HOST = "localhost";
    const USER = "admin";
    const PASSWORD = "anhquan";
    const DATABASE = "MovieTicket";

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function update($table, $data, $where, $key)
    {
        /**
         * Updates a record in the specified table based on the given condition.
         *
         * @param string $table The name of the table to update.
         * @param mixed $data The new data to be set for the field.
         * @param string $where The condition to match for updating the record.
         * @param string $key The primary key of the record to update.
         * @return void
         */
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "UPDATE $table SET $columns = $values WHERE $where = '$key'";
        // echo $sql;
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function update_movie($table, $data, $where, $k)
    {

        /**
         * Updates a record in the specified table based on the given condition.
         *
         * @param string $table The name of the table to update.
         * @param string $data The column-value pairs to update in the format "column1=value1, column2=value2, ...".
         * @param string $where The condition to match for updating the record.
         * @param string $key The value to match in the specified column for updating the record.
         * @return bool Returns true if the record is successfully updated, false otherwise.
         */


        $string = "";
        foreach ($data as $key => $value) {
            $string .= "$key = '$value', ";
        }

        $string = substr($string, 0, -2);

        $sql = "UPDATE $table SET $string WHERE $where = '$k'";

        // echo '<script>alert("' . $sql . '")</script>';
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function update_one($table, $field, $data, $where, $key)
    {
        $sql = "UPDATE $table SET $field = '$data' WHERE $where = '$key'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $where, $key)
    {
        $sql = "DELETE FROM $table WHERE $where = '$key'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }




    public function find_data($table, $column, $data)
    {
        $sql = "SELECT * FROM $table WHERE $column = '$data'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }

    }

    public function find_last_row($table, $column)
    {
        $sql = "SELECT * FROM $table ORDER BY $column DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }

    }

    #set auto increment to last row + 1
    public function set_auto_increment($table, $column)
    {
        $last_row = $this->find_last_row($table, $column);
        $last_row = $last_row[$column];
        $last_row++;
        $sql = "ALTER TABLE $table AUTO_INCREMENT = $last_row";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function find_one($table, $column, $data)
    {
        $sql = "SELECT * FROM $table WHERE $column LIKE '%$data%'";
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

    public function find_by_data($table, $data)
    {

        $sql = "SELECT * FROM $table WHERE Name LIKE '%$data%' OR performer LIKE '%$data%'OR director LIKE '%$data%' ";
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

    public function find_by_array($table, $array)
    {
        $sql = "SELECT * FROM $table WHERE ";
        foreach ($array as $key => $value) {
            $sql .= "$key = '$value' AND ";
        }
        $sql = substr($sql, 0, -4);
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

    public function find_movie($table, $column, $data)
    {
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

    public function findAll($table)
    {
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

    public function __destruct()
    {
        $this->conn->close();
    }


    public function add_data($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function update_infor($table, $data, $where, $key) {
        $field = implode(", ", array_keys($data));
        echo "$field\n";
        echo "$table($field)";
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "UPDATE $table SET $field = $values WHERE $where = '$key'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>