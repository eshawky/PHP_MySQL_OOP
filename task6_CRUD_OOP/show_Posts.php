<?php

        require 'db.php';

        $stmt = $conn->prepare("select * from posts order by id");

        $stmt->execute();

        $posts = $stmt->fetchAll();

        if (isset($_POST['edit'])) 
        {
            header("location:edit_Posts.php");
        }

        if (isset($_POST['delete'])) 
        {
            $id     = $_POST['id'];

            $stmt = $conn->prepare("delete from posts where id = :id");

            #$stmt->execute();
            $stmt->execute
            ([
                ':id' => $id,
            ]);

            header("location:show_Posts.php");
        }

        if (isset($_POST['search'])) 
        {
            $search_by_title     = $_POST['search_by_title'];

            $query1 = $conn->prepare("select * from posts where title = :search_by_title");

            #$stmt->execute();
            $query1->execute
            ([
                ':search_by_title' => $search_by_title,
            ]);

            $posts = $query1->fetchAll();

        }

?>

    <form action="" method="post" class="form">
        <input type="text" name="search_by_title">
        <input type="submit" name="search" value="search" class = 'btn submit'>
    </form>

    <table border="1">
        
        <tr>
            <th>Id</th>
            <th>title</th>
            <th>content</th>
            <th>date</th>
            <th>category_id</th>
            <th>user_id</th>            
        </tr>

        <?php

            foreach ($posts as $post) : ?>

                <tr>
                    <td><?= $post['id'] ?></td>
                    <td><?= $post['title'] ?></td>
                    <td><?= $post['content'] ?></td>
                    <td><?= $post['date'] ?></td>
                    <td><?= $post['category_id'] ?></td>                    
                    <td><?= $post['user_id'] ?></td>
                 
                    <td>
                        <a href="edit_Posts.php?edit_id=<?= $post['id'] ?>" class="btn submit">Edit</a>
                    </td>

                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?=$post['id']?>">
                            <input type="submit" value="Delete" name="delete" class = 'btn submit'>
                        </form>
                    </td>

                </tr>


        <?php
            endforeach;
        ?>

    </table>
