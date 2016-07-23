<?php
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "DaD";
        // Create connection
        $connection = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

    //fetch table rows from mysql db
     $sql = "SELECT Age,Count(Age) As `NO` FROM tbl_name GROUP BY Age";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
    //create an array
    $emparray = array();
    
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    echo json_encode($emparray);
    
    mysqli_close($connection); 

?>
