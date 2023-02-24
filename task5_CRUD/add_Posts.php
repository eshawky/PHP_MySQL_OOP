<?php

        require 'db.php';
                
        function test_input($input) 
        {
            $input = trim($input); 
            $input = stripslashes($input); 
            $input = htmlspecialchars($input); 
            return $input;
        }

        if (isset($_POST['addPost'])) 
        {
            $title       = $_POST['title'];
            $content     = $_POST['content'];
            $date        = $_POST['date'];
            $category_id = $_POST['category_id'];
            $user_id     = $_POST['user_id'];

            // Define the error messages
            
            $titleErr = $contentErr = $dateErr = $categoryIdErr = $userIdErr = "";
            
            if (empty($title))
            {
               $titleErr = "title is required";

            } else 
            {
               $title = test_input($title);
            
               if (!preg_match("/^[a-zA-Z-' ]*$/", $title)) 
               {
                   $titleErr = "in title: only letters and white space allowed";
               }
            }
                        
            if (empty($content))
            {
               $contentErr = "content is required";

            }               
       
            if (empty($date))
            {
               $dateErr = "date is required";

            }

            if (empty($category_id))
            {
               $categoryIdErr = "category id is required";

            } 

            if (empty($user_id))
            {
               $userIdErr = "user id is required";

            } 
           
           
           echo "<br>";
           echo "<br>";
           echo "<br>";

           if (strlen($titleErr>0) ||strlen($contentErr>0)|| strlen($dateErr>0)|| strlen($categoryIdErr>0)|| strlen($userIdErr>0))
           {
            
                echo "<h2>Please correct below errors:</h2>";
                echo "<span class='error'>" . $titleErr . "</span><br />";
                echo "<span class='error'>" . $contentErr . "</span><br />";
                echo "<span class='error'>" . $dateErr . "</span><br />";                            
                echo "<span class='error'>" . $categoryIdErr . "</span><br />";
                echo "<span class='error'>" . $userIdErr . "</span><br />";

           }else
           {
                
                $stmt = $conn->prepare("insert into posts (title, content, date, category_id, user_id) values 
                                                          (:title, :content, :date, :category_id, :user_id)");

                $stmt->execute
                ([
                    ':title'       => $title,
                    ':content'     => $content,
                    ':date'     => $date,                    
                    ':category_id' => $category_id,
                    ':user_id'     => $user_id,                    
                ]);
                
                header("location:add_Posts.php");

            }

        }

?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>add posts</title>
    </head>

    <body>

        <div class="container">

            <h2>
                Add this post details into mysql database.
            </h2>

            <form method="post" class="main-form form">

                <input type="text" name="title"        placeholder="please the title here"         class="form-control">
                <input type="text" name="content"      placeholder="please the content here"       class="form-control">
                <input type="date" name="date"         placeholder="please the date here"          class="form-control">
                <input type="text" name="category_id"  placeholder="please select the category id" class="form-control">
                <input type="text" name="user_id"      placeholder="please select the user id"     class="form-control">
                
                <input type="submit" value="Add post" name="addPost" class = 'btn submit'>

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
