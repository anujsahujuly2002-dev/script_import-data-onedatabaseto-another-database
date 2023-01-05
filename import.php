<?php
// Db connection 1 Created 
$host ='localhost';
$user = 'root';
$pass ='';
$db ='cars360_co';

$conn = mysqli_connect($host,$user,$pass,$db);
if($conn){
    echo "Connection Created ".$db."\n";
}else{
    echo "Connection not created ".$db."\n";
}
// Db connection 2 Created 
$host1 ='localhost';
$user1 = 'root';
$pass1 ='';
$db1 ='cars360_crm';

$conn1 = mysqli_connect($host1,$user1,$pass1,$db1);
if($conn1){
    echo "Connection Created ".$db1."\n";
}else{
    echo "Connection not create ".$db1."\n";
}
$brand =[];
$model =[];
$varients =[];
$last_brand_id ='';
$last_model_id;
$sql = "SELECT  id,name FROM brand";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $insertBrndSql = "INSERT INTO brands (name) VALUES('".$row['name']."')";
        echo $insertBrndSql."\n";
        if (mysqli_query($conn1, $insertBrndSql)) {
            $last_brand_id = mysqli_insert_id($conn1);
            echo "New brand created successfully. Last inserted ID is: " . $last_brand_id."\n";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        $sql1 = "SELECT * FROM `model` WHERE `brand_id`='".$row['id']."'";
     
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            echo "Total Models".mysqli_num_rows($result1)."\n";
           while ($row = mysqli_fetch_assoc($result1)) {
            $insertmodelSql = "INSERT INTO car_models (name,brand_id) VALUES('".$row['model']."','".$last_brand_id."')";
            echo $insertmodelSql."\n";
            if (mysqli_query($conn1, $insertmodelSql)) {
                $last_model_id = mysqli_insert_id($conn1);
                echo "New model created successfully. Last Model inserted ID is: " . $last_model_id."\n";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn1);
            }
            $sql2 = "SELECT * FROM `variant` WHERE `model_id`='".$row['id']."'";
            $result2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2) > 0){
                echo "Total Varients".mysqli_num_rows($result2)."\n";
                while ($row = mysqli_fetch_assoc($result2)) {
                    $insertvarientsSql = "INSERT INTO varients (name,brand_id,model_id) VALUES('".$row['title']."','".$last_brand_id."','".$last_model_id."')";
                    echo $insertvarientsSql."\n";
                    if (mysqli_query($conn1, $insertvarientsSql)) {
                        $last_varients_id = mysqli_insert_id($conn1);
                        echo "New Varients created successfully. Last Model inserted ID is: " . $last_varients_id."\n";
                      } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn1);
                    }
                }

            }else{
                echo "0";
            }

           }
        }else{
            echo "0";
        }

    }
} else {
    echo "0 results";
}


?>