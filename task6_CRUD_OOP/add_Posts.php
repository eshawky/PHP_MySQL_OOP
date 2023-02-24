<?php

        require 'db.php';
        require 'validation.php';
        
        //select all categories names, and ids in variable categories
        $stmt = $conn->prepare("SELECT id, name FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();

        //select all user names, and ids in variable users
        $stmt  = $conn->prepare("SELECT id, name FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll();

        // Define the error messages            
        $titleErr     = $contentErr = $dateErr = $categoryIdErr = $userIdErr = [];
        $category_id  = $user_id ="";

        if (isset($_POST['addPost'])) 
        {
            $title       = $_POST['title'];
            $content     = $_POST['content'];
            $date        = $_POST['date'];
            $category_id = $_POST['category_id'];
            $user_id     = $_POST['user_id'];
            
            $valid_title  =  new validation($title);
            $valid_title->required();
            if (!$valid_title->valid) 
            {
                $titleErr = $valid_title->messages; 
            }else 
            {
               $valid_title->test_input();
               $valid_title->is_name();
            
               if (!$valid_title->valid) 
               {
                   $titleErr = $valid_title->messages; 
               }
            }

            $valid_content  =  new validation($content);
            $valid_content->required();
            if (!$valid_content->valid) 
            {
                $contentErr = $valid_content->messages; 
            }else 
            {
               $valid_content->test_input();
            }
    

            $valid_date  =  new validation($date);
            $valid_date->required();
            if (!$valid_date->valid)
            {
               $dateErr = $valid_date->messages; 
            }else 
            {
               $valid_date->test_input();
            } 

            $valid_category_id  =  new validation($category_id);
            $valid_category_id->required();
            if (!$valid_category_id->valid)
            {
               $categoryIdErr = $valid_category_id->messages; 
            }else 
            {
               $valid_category_id->test_input();
            } 

            $valid_user_id  =  new validation($user_id);
            $valid_user_id->required();
            if (!$valid_user_id->valid)
            {
               $userIdErr = $valid_user_id->messages; 
            }else 
            {
               $valid_user_id->test_input();
            } 
            
           echo "<br>";
           echo "<br>";
           echo "<br>";

           $valid_flag = true;

           if (count($titleErr)>0){
                echo $titleErr[0]  ." for title  <br/><br/>"; 
                $valid_flag = false;
           }

           if (count($contentErr)>0){
                echo $contentErr[0]  ." for content <br/><br/>"; 
                $valid_flag = false;
           }

           if (count($dateErr)>0){
                echo $dateErr[0]  ." for date <br/><br/>";  
                $valid_flag = false; 
           }
        
           if( count($categoryIdErr) >0){              
                echo $categoryIdErr[0] ." for category Id <br/><br/>";  
                $valid_flag = false;          
           }

           if(count($userIdErr)>0){
                echo $userIdErr[0] ." for user Id <br/><br/>"; 
                $valid_flag = false;            
           }
           
           if ($valid_flag) //if any value if not valid
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

                <input type="text" name="title"        placeholder="please enter the title here"         class="form-control">
                <input type="text" name="content"      placeholder="please enter the content here"       class="form-control">
                <input type="date" name="date"         placeholder="please enter the date here"          class="form-control">
                
                <select name="category_id" id="category_id" class="form-control">
                
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option <?= ($category['id'] == $category_id) ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                
                </select>

                <select name="user_id" id="user_id" class="form-control">
                
                    <option value="">Select User</option>
                    <?php foreach ($users as $user) : ?>
                        <option <?= ($user['id'] == $user) ? 'selected' : '' ?> value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                    <?php endforeach; ?>
                
                </select>

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
