    <?php

    class Database
    {
        // public $host = 'localhost';
        // public $user = 'root';
        // public $pass = 123456;
        // public $dbname = 'duanweb2';
        // public $port = '3306';
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbname = DB_NAME;
        public $port = DB_PORT;


        public $link;
        public $error;
        public function __construct()
        {

            $this->connectDB();
        }

        public function getConnection(){
            return $this->link;
        }

        public function  connectDB()
        {
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname,$this->port);
            if ($this->link->connect_errno) {
                $this->error = 'connection fail' . $this->link->connect_error;
                return false;
            }
        }
        public function select($query)
        {
            $result = $this->link->query($query) or
                die($this->link->error . __LINE__);
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }

        public function insert($query)
        {
            $insert_row = $this->link->query($query) or
                die($this->link->error . __LINE__);
            if ($insert_row) {
                return $insert_row;
            } else {
                return false;
            }
        }

        public function update($query)
        {
            $update_row = $this->link->query($query) or
                die($this->link->error . __LINE__);
            if ($update_row) {
                return $update_row;
            } else {
                return false;
            }
        }

        public function delete($query)
        {

            try {
                $delete_row = $this->link->query($query);

                if ($delete_row) {

                    return $delete_row;
                } else {

                    return false;
                }
            } catch (Exception $e) {

                return false;
            }
        }
    }

    ?>