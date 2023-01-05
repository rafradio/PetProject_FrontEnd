<?php
$fareng = 900;
class SqlInsert {
    public $conn;
    function __construct() {
        $myfile1 = fopen("password.txt", "r") or die("Unable to open file!");
        $servername = "127.0.0.1";
        $username = "root";
        $password = trim(fgets($myfile1));
        fclose($myfile1);
        $dbname = "database3";

        $this->conn = new mysqli($servername, $username, $password, $dbname);
    }
    
    function close_conn() {
        $this->conn->close();
    }
    
    function send_toSql($name1, $name2) {
        $sql = "INSERT INTO tempconvert (celcii, farengeit) VALUES ('$name1', '$name2')";
        $this->conn->query($sql);
    }
    
}
?>

