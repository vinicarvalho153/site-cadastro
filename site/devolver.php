<?php
    include('index2.php');
    if (isset($_POST['devolvido'])) {
        $sql = "UPDATE `item` SET `devolvido` = ('false') WHERE `usuario` = '$usuario'";
        
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
