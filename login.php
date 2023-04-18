<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
        
            $host = "host=127.0.0.1";
            $port = "port=5432";
            $dbname = "dbname = postgres";
            $credentials = "user = postgres password=postgres";
            $db = pg_connect("$host $port $dbname $credentials");
        
            $query = "SELECT * FROM login WHERE email='" . $email . "' AND pass='" . $pass . "'";
            $result = pg_query($db, $query);
        
            if (pg_num_rows($result) > 0) {
                header("Location: myaccount.php");
            exit;
        } else {
            echo "Please try again. Username or Password incorrect .1234";
        }
        
            pg_close($db);
        }
    ?>