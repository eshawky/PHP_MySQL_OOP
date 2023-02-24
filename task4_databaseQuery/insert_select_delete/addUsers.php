<?php

        if (isset($_POST['addUser'])) 
        {
            $name     = $_POST['name'];
            $email    = $_POST['email'];
            $phone    = $_POST['phone'];
            $password = $_POST['password'];

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

        </div>

    </body>

</html>
