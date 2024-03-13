
<?php
// connecting with the database connection 
require 'data.php';
// looking if the form is submitted ot not
if(isset($_POST['cate'])){
    $delCat = $_POST['cate']; // getting the category ide from the form

    if(!empty($delCat)){
        // checking the category id exits or not 
        $chcS = $connection->prepare("SELECT COUNT(*) FROM aCategories WHERE cId = :delCat");
            $chcS->bindParam(':delCat', $delCat); // bind the parameneters
            $chcS->execute(); // declaring the query
            $exeCat = $chcS->fetchColumn(); // fetching the count of categories with the gievn id
// connectin with database and deleting for optins
            if($chcS){
                $delS =$connection->prepare("DELETE FROM aCategories WHERE cId= :delCat");// using delete for the category
                $delS->bindParam (':delCat', $delCat); // binding the id of the category
// giving the message if the id match
                if($delS ->execute()){
                    echo "Delete has been successful :" .htmlspecialchars($delCat); // display message if Delete successful
                   
                    // if the category id is not matched the it wil not be deleted 
                }else{
                    echo "Unable to deleting the category";
                }
                // also if the category id is not macthed then it will ot find the id fo teh category 
            }else{
                echo "This id category" .htmlspecialchars($delCat). "not exist in list";

            }
        }else{
                echo "id is not null"; // value cannot be null in order to be deleted
            }

    }


?>
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        /* giving the css to form and making it stlyish  */
        form{

            margin: 4px;
            padding:5px;
            border:solid black 2px;
            align-items:center;
            text-align:center;
            width: 205px;
            height: 175px;
            display:flex;
            flex-direction: column;
            margin:auto;
            margin-top: 50px;
            border-radius: 12px;
            background-color:powderblue;


        }
        label{
            margin-bottom: 9px;
        }
        input[type="text"]{
            padding: 6px;
            margin-bottom: 13px;
        }
 

        
body{
    /* adding different styles to make it more stylish */

background-image: url('images/c1.jpg');
        background-repeat:no-repeat;
        background-position:center;
        background-size:cover;
}

input[type="submit"]{
    background-color:skyblue;
    color:white;
    border-radius:4px;
}

input[type="submit"]:hover{
    background-color:blue;
    color:white;

}


        

</style>
</head>
<!-- creating form of id and delete-->
<body>
    <form action="deletCategory.php" method="post">
    <label for=>Deleting the category:</label></br></br>
    <label for="cate">Enter category id:</label></br>
    <input type="text" name="cate" id="cats">

</br></br>
<input type="submit" value="Delete" require>
    </br>
    
<!-- it helps to go back to category section after clicking the go back -->
<a href="addCategory.php" style="color: white;">Go back?</a>
</form>


<script>
        // Checking if the variables is set up or not
        var smsm = "<?php echo isset($exeCat) ? $exeCat : ''; ?>";
        if (smsm) {
            // if the given condition is good it will show the alreat sms
            alert(smsm);
        }
    </script>

</body>
</html>