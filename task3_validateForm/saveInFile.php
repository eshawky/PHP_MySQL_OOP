<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>Input Form</title>
    
    </head>

	<body>

        <div class="container">

                <form method="post" class="main-form form"  id="form">

                    <input type="text" name="name" class="form-control" placeholder="Please enter ur name">
                    <input type="text" name="mail" class="form-control" placeholder="Please enter ur e-mail" >
                    <input type="text" name="age" class="form-control" placeholder="Please enter ur age" >
                    
                    <input type="submit" class = 'btn submit' name ="save" value="Save in File">
                </form>

                <style>
                    .error 
                    {
                        color: #FF0000;
                    }
                </style>

                <?php
                    include("config.php");
                    
                    function test_input($input) 
                    {
                        $input = trim($input); 
                        $input = stripslashes($input); 
                        $input = htmlspecialchars($input); 
                        return $input;
                    }

                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    
                    if ( isset( $_POST['save'] ) )
                    {    

                            // Define the error messages
                            $nameErr = $mailErr = $ageErr = "";
                            
                            $name   = $_POST["name"];
                            $mail   = $_POST["mail"];
                            $age    = $_POST["age"];
                            
                            if (empty($name))
                            {
                               $nameErr = "Name is required";

                            } else 
                            {
                               $name = test_input($name);
                            
                               if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) 
                               {
                                   $nameErr = "Only letters and white space allowed";
                               }
                            }
                            
                            
                           if (empty($mail)) 
                           {
                               $mailErr = "Email is required";
                           } else 
                           {
                               $mail = test_input($mail);

                               if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                               {
                                   $mailErr = "Invalid email format";
                               }
                           }                
                       
                           if (empty($age)) 
                           {
                               $ageErr = "Age is required";

                           } else 
                           {
                               $age = test_input($age);

                               if (!preg_match("/^[0-9]*$/", $age)) 
                               {
                                   $ageErr = "Only numbers are allowed";
                               }
                               
                               if ($age<=0) 
                               {
                                   $ageErr = "Please enter a valid age";
                               }
                           }

                           echo "<br>";
                           echo "<br>";
                           echo "<br>";

                           if (strlen($nameErr>0) ||strlen($mailErr>0)|| strlen($ageErr>0))
                           {
                            
                            echo "<h2>Please correct below errors:</h2>";
                            echo "<span class='error'>" . $nameErr . "</span><br />";
                            echo "<span class='error'>" . $mailErr . "</span><br />";                            
                            echo "<span class='error'>" . $ageErr . "</span><br />";
 
                           }else
                           {

                            echo "<h2>Your data is saved in the file successfully</h2>";

                            #Once the validation is done, Start saving the inputs in the file
                            $content = $name.",".$mail.",".$age."\n";
                            
                            #check the length of the content to be greater than 4 since
                            #the last line has length=0,and 
                            #if the user enter empty data, the length will be 3
                            if (strlen($content)>3)
                            {                                    
                                    if(!is_file($file))// check if the file is not created yet, create it if yes
                                    {
                                        file_put_contents($file, $content);

                                    }else //else, append data if the file is already exist
                                    {                                
                                        $append_file = fopen($file, 'a');
                                        fwrite($append_file, $content);
                                        fclose($append_file);
                                    }
                                
                            }

                        }
                                 
                    }
            ?>
        </div>

	</body>
</html>


