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
                    <input type="text" name="mail" class="form-control" placeholder="Please enter ur e-mail">
                    <input type="number" name="age" class="form-control" placeholder="Please enter ur age">
                    
                    <input type="submit" class = 'btn submit' name ="check" value="Add in File">
                </form>

                <?php
                    include("config.php");

                    if ( isset( $_POST['check'] ) )
                    {    

                            $name = $_POST['name'];
                            $mail = $_POST['mail'];
                            $age  = $_POST['age'];

                            $content = $name.",".$mail.",".$age."\n";
                            
                            #the last line has length=0, 
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
            ?>
        </div>

	</body>
</html>