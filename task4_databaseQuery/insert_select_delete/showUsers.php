<?php

        require 'db.php';

        $stmt = $conn->prepare("select * from users order by name");

        $stmt->execute();

        $users = $stmt->fetchAll();

        if (isset($_POST['delete'])) 
        {
            $id     = $_POST['id'];

            require 'db.php';

            $stmt = $conn->prepare("delete from users where user_id = :id");

            #$stmt->execute();
            $stmt->execute
            ([
                ':id' => $id,
            ]);

            header("location:showUsers.php");
        }

?>

    <table border="1">
        
        <tr>
            <th>user Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            
        </tr>

        <?php

            foreach ($users as $user) : ?>

                <tr>
                    <td><?= $user['user_id'] ?></td>

                    <td><?= $user['name'] ?></td>

                    <td><?= $user['email'] ?></td>

                    <td><?= $user['phone'] ?></td>

                    <td><?= $user['password'] ?></td>
                    
                <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?=$user['user_id'] ?>">
                            <input type="submit" value="Delete" name="delete" class = 'btn submit'>
                        </form>
                </td>
                </tr>


        <?php
            endforeach;
        ?>

    </table>
