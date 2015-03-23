<?php

    $name=$_FILES['uploadfile']['name'];  
    $size=$_FILES['uploadfile']['size'];  
    $date=date("d-m-Y");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_db";

    $conn=mysql_connect("test.ua", "root", "");
    mysql_select_db("test_db"); 

    function formatSizeUnits($size)
    {
        if ($size >= 1073741824)
        {
            $size = number_format($size / 1073741824, 2) . ' GB';
        }
        elseif ($size >= 1048576)
        {
            $size = number_format($size / 1048576, 2) . ' MB';
        }
        elseif ($size >= 1024)
        {
            $size = number_format($size / 1024, 2) . ' KB';
        }
        elseif ($size > 1)
        {
            $size = $size . ' bytes';
        }
        elseif ($size == 1)
        {
            $size = $size . ' byte';
        }
        else
        {
            $size = '0 bytes';
        }

        return $size;
    }
    
    $size_correct = formatSizeUnits($size);
        
    mysql_query("INSERT INTO `files` VALUES ('$name', '$size_correct', '$date')");  
    
    $sql="SELECT name, size, date FROM files ORDER BY `date` DESC"; 
    $result=mysql_query($sql); 
    
     echo '<link href="css/style.css" rel="stylesheet">';

     echo " <div class='button'>
                <b>Upload</b>
                
                <form action=index.php method=post enctype=multipart/form-data>
                    <input type='file' name='uploadfile' onchange='this.form.submit()' class='upload'/> 
                </form>
            </div>
            
            <ul>
                <li class='main'>
                    <p class='name'><b>Name</b></p>
                    <p class='size'><b>Size</b></p>
                    <p class='date'><b>Date of Uploading</b></p>
                </li>
            </ul>";

    while($rows=mysql_fetch_array($result, MYSQL_ASSOC)){
        
        echo "<ul>
                <li class='table'>
                    <p class='name'>".$rows['name']."</p>
                    <p class='size'>".$rows['size']."</p>
                    <p class='date'>".$rows['date']."</p>
                </li>
        </ul>"; 
 
    }

?>