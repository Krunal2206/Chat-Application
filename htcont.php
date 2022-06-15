<?php
    //Get Parameter
    $room = $_POST["room"];

    //Connecting tothe database
    include 'db_connect.php';

    //Execute sql to check whether room exists
    $sql = "SELECT msg,stime,ip FROM `msgs` WHERE room='$room'";
    $result = mysqli_query($conn, $sql);

    $res = "";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $res = $res . '<div class="innercontainer">';
            $res = $res . $row['ip'];
            $res = $res . " says <p>". $row['msg'];
            $res = $res . '</p> <span class="time-right">' . $row["stime"] . '</span></div>';
        }
    }
    echo $res;

?>