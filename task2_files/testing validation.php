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

                    <div class="div_class" id="div_error">
                         <p  id="p_error"></p>
                    </div>

                    <input type="text" name="name" class="form-control" placeholder="Please enter ur name">
                    <p class="ifValid" id="ifvalid_name"></p>

                    <input type="text" name="mail" class="form-control" placeholder="Please enter ur e-mail">
                    <p class="ifValid" id="ifvalid_mail"></p>

                    <input type="number" name="age" class="form-control" placeholder="Please enter ur age">
                    <p class="ifValid" id="ifvalid_age"></p>

                    
                    <input type="submit" class = 'btn submit' name ="check" value="check">
                </form>

                <?php
                    include("config.php");

                    if ( isset( $_POST['check'] ) )
                    {    

                            $name = $_POST['name'];
                            $mail = $_POST['mail'];
                            $age  = $_POST['age'];
                            
                            $valid_name = true;
                            $valid_mail = true;
                            $valid_age  = true;

                            #Apply validation first: check if not empty fields
                            if (strlen($name)==0)
                            {
                                echo '<script type="text/javascript">
                                        document.getElementById(`ifvalid_name`).innerHTML  = "Please enter a valid name";
                                        document.getElementById(`ifvalid_name`).style.color= "red";
                                      </script>';
                                $valid_name =false;

                            }
                            if (strlen($mail)==0)
                            {
                                echo '<script type="text/javascript">
                                        document.getElementById(`ifvalid_mail`).innerHTML  = "Please enter a valid mail";
                                        document.getElementById(`ifvalid_mail`).style.color= "red";
                                      </script>';
                                $valid_mail =false;

                            }
                            if (strlen($age)==0)
                            {
                                echo '<script type="text/javascript">
                                            document.getElementById(`ifvalid_age`).innerHTML  = "Please enter a valid age";
                                            document.getElementById(`ifvalid_age`).style.color= "red";
                                       </script>';
                                $valid_age =false;
                            }

                            if ($valid_name==true && $valid_mail==true&& $valid_age==true)
                            {
                                    $content = $name.",".$mail.",".$age."\n";

                                    #the last line has length=0, 
                                    if (strlen($content)>0)
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
                            }else
                            {
                                return false;
                            }          
                    }
            ?>
        </div>

	</body>
</html>