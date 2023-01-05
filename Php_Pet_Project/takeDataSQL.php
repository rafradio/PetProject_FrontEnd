<?php
    class takeDataSQL {
        public $conn;
        public $suppliers;
        public $idSupplier;
        public $servises;
        public $telephones;
        function __construct() {
            $myfile1 = fopen("password.txt", "r") or die("Unable to open file!");
            $servername = "127.0.0.1";
            $username = "root";
            $password = trim(fgets($myfile1));
            fclose($myfile1);
            $dbname = "database3";
           
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            
        }
        
        function closeConn() {
            $this->conn->close();
        }
        
        function takeData($name1) {
            
            $sql = "SELECT * FROM suppliers WHERE Name = '$name1'";
//          $sql = "INSERT INTO tempconvert (celcii, farengeit) VALUES ('$name1', '$name2')";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->idSupplier = $row["id"];
                    return $row["Shops"];

                }
            }
        }
        
        function findSuppliers() {
            $sql = "SELECT Name FROM suppliers";
            $this->suppliers = $this->conn->query($sql);
//            while ($Name = $this->suppliers->fetch_column(0)) {
//                echo "<script>console.log('Температура: " . $Name . "' );</script>";
//            }
        }
        
        function findServices() {
            $sql = "SELECT Servises FROM servises WHERE idSuppliers=$this->idSupplier";
            $this->servises = $this->conn->query($sql);
        }
        
        function findTelephones() {
            $sql = "SELECT telephones FROM telephones WHERE idSuppliers=$this->idSupplier";
            $this->telephones = $this->conn->query($sql);
        }
    }
?>


