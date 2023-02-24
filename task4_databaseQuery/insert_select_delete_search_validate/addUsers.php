<?php

        function test_input($input) 
        {
            $input = trim($input); 
            $input = stripslashes($input); 
            $input = htmlspecialchars($input); 
            return $input;
        }

        if (isset($_POST['addUser'])) 
        {
            $name     = $_POST['name'];
            $email    = $_POST['email'];
            $phone    = $_POST['phone'];
            $password = $_POST['password'];

            // Define the error messages
            $nameErr = $emailErr = $phoneErr = $passwordErr = "";
            
            if (empty($name))
            {
               $nameErr = "Name is required";

            } else 
            {
               $name = test_input($name);
            
               if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) 
               {
                   $nameErr = "in Name: only letters and white space allowed";
               }
            }
                        
            if (empty($email)) 
            {
               $emailErr = "Email is required";
            } else 
            {
               $email = test_input($email);

               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
               {
                   $emailErr = "in Email: invalid email format";
               }
            }                
       
            if (empty($phone))
            {
               $phoneErr = "phone is required";

            } else 
            {
               $phone = test_input($phone);
            
               if (!preg_match("/^[0-9'+]*$/", $phone)) 
               {
                   $phoneErr = "in phone: only numbers and + are allowed";
               }
            }

            if (empty($password))
            {
               $passwordErr = "password is required";

            } else 
            {
               $password = test_input($password);
            
               if (preg_match("/^[ ]*$/", $password)) 
               {
                   $passwordErr = "in password: white spaces are not allowed";
               }
            }

           echo "<br>";
           echo "<br>";
           echo "<br>";

           if (strlen($nameErr>0) ||strlen($emailErr>0)|| strlen($phoneErr>0)|| strlen($passwordErr>0))
           {
            
            echo "<h2>Please correct below errors:</h2>";
            echo "<span class='error'>" . $nameErr . "</span><br />";
            echo "<span class='error'>" . $emailErr . "</span><br />";                            
            echo "<span class='error'>" . $phoneErr . "</span><br />";
            echo "<span class='error'>" . $passwordErr . "</span><br />";

           }else
           {
                require 'db.php';

                $stmt = $conn->prepare("insert into users (name, email, phone, password) values (:name, :email, :phone, :password)");

                $stmt->execute
                ([
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':password' => $password,
                ]);

                header("location:addUsers.php");

            }

        }

?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>add users</title>
    </head>

    <body>

        <div class="container">

            <h2>
                Add data into mysql database
            </h2>

            <form method="post" class="main-form form">

                <input type="text" name="name"  placeholder="please enter ur name" class="form-control">
                <input type="text" name="email"  placeholder="please enter ur email" class="form-control">
                <input type="text" name="phone" placeholder="please enter ur phone" class="form-control">
                <input type="text" name="password"  placeholder="please enter ur password" class="form-control">
                <input type="submit" value="Add user" name="addUser" class = 'btn submit'>

            </form>


            
        <style>
            .error 
            {
                color: #FF0000;
            }
        </style>


        </div>

    </body>

</html>
