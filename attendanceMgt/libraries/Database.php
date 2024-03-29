<?php

class Database {

    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;
    public $link;
    public $error;

    public function __construct() {
        /* call connect function */
        $this->connect();
    }

    /* connect method to db */

    private function connect() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if (!$this->link) {
            $this->error = "Connection Failed: " . $this->link->connect_error;
            return false;
        }
    }

    /* select */

    public function select($query) {
        $result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    /* insert */

    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($insert_row) {
            header("location:index.php?msg=" . urlencode('Record added'));
            exit();
        } else {
            die("Error : ('.$this->link->errno.')" . $this->link->error);
        }
    }

    /* update */

    public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($update_row) {
            header("location:index.php?msg=" . urlencode('Record updated'));
            exit();
        } else {
            die("Error : ('.$this->link->errno.')" . $this->link->error);
        }
    }

    /* delete */

    public function delete($query) {
        $update_row = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($update_row) {
            header("location:index.php?msg=" . urlencode('Record deleted'));
            exit();
        } else {
            die("Error : ('.$this->link->errno.')" . $this->link->error);
        }
    }

}
