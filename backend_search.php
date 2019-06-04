<?php 
    try{
        $conn=new PDO("mysql:host=localhost;dbname=search_demo","root","");

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){

        die("ERROR: Could not connect.".$e->getMessage());

    }

    try{
        if(isset($_REQUEST["term"])){

            //Query for selecting proper rows
            $query="SELECT * FROM users WHERE name LIKE :term";

            //Preparing statements and binding
            $stmt=$conn->prepare($query);
            $term=$_REQUEST["term"].'%';
            $stmt->bindParam(":term",$term);
            
            //Execute prepared statement
            $stmt->execute();

            //Check if we recovered data from db
            if($stmt->rowCount()>0){

                //Iterating through and printing
                while($row=$stmt->fetch()){

                    echo "<p>".$row['name']."</p>";
                }
            }else{
                echo "<p>No matches found!!!</p>";
            }
    

        }

    } catch(PDOException $e){

    die("ERROR: Could not able to execute $sql. " . $e->getMessage());

    }

    unset($stmt);

    unset($conn);

?>