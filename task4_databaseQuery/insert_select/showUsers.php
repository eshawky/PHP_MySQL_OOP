<?php

        require 'db.php';

        $stmt = $conn->prepare("select * from users order by name");

        $stmt->execute();

        $users = $stmt->fetchAll();

?>

    <table border="1">
        
        <tr>    
            <th>user id</th>
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

                </tr>

        <?php
            endforeach;
        ?>

    </table>
