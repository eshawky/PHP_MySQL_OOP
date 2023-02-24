<?php

            require 'db.php';

            if (isset($_GET['edit_id'])) 
            {
                $edit_id       = $_GET['edit_id'];
    
                $posts = $conn->prepare("select * from posts WHERE id = :edit_id");
                
                $posts->execute
                ([
                    ':edit_id'       => $edit_id,                  
                ]);

                foreach ($posts as $post): 
                    
                    $title       = $post['title'];
                    $content     = $post['content'];
                    $date        = $post['date'];
                    $category_id = $post['category_id'];

                endforeach;
                
                $cat = $conn->prepare("SELECT id, name FROM categories");
                $cat->execute();
                $categories = $cat->fetchAll();
                
            }

            if (isset($_POST['editPost'])) 
            {
            
                $title       = $_POST['title'];
                $content     = $_POST['content'];
                $date        = $_POST['date'];
                $category_id = $_POST['category_id'];
                
                $stmt = $conn->prepare("UPDATE posts SET title = :title, content = :content, date = :date, category_id = :category_id WHERE id = :edit_id");
                
                $values = 
                [
                    'title'       => $title,
                    'content'     => $content,
                    'date'        => $date,
                    'category_id' => $category_id,
                    'edit_id'     => $edit_id
                ];
            
                
                if ($stmt->execute($values)) 
                {
                    echo($title. "\n");
                    var_dump($stmt->execute($values));
                    //die;
                }
                
                
            }
?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>edit posts</title>
    </head>

    <body>
    <div class="container">

    <h2>
        edit this post details.
    </h2>

    <form method="post" class="main-form form">

        <input type="text" name="title"       value="<?= $title ?>"       class = "form-control">
        <input type="text" name="content"     value="<?= $content ?>"     class = "form-control">
        <input type="date" name="date"        value="<?= $date ?>"        class = "form-control">

        <select name="category_id" id="category_id" class="form-control">
                <?php foreach ($categories as $category) : ?>
                    <option <?= ($category['id'] == $category_id) ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
        </select>

        <input type="submit" value="edit post" name="editPost" class = 'btn submit'>

    </form>


    </div>

</body>

</html>
