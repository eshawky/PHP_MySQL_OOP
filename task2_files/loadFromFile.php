<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <title>Output Form</title>
    </head>

	<body>

        <div class="container">

                <div class="form"  id="data">

                    <?php
                        include("config.php");
                                                        
                        $append_file = fopen($file, 'r');
                        
                        echo '<table border="1">';
                        
                        echo '<tr> 
                                <td> Name</td> 
                                <td>E-mail</td> 
                                <td>Age</td> 
                             </tr>';

                        while(!feof($append_file))
                        {
                            $content = fgets($append_file);

                            if( strlen($content)>0 )//Since the last line in the file is empty
                            {
                                #split name, mail, age
                                $str_arr = preg_split ("/\,/", $content); 
                                $name    = $str_arr[0];
                                $mail    = $str_arr[1];
                                $age     = $str_arr[2];
                                
                                echo '<tr> 
                                <td>'.$name.'</td> 
                                    <td>'.$mail.'</td> 
                                    <td>'.$age.'</td> 
                                </tr>';

                            }
                        }

                        echo ('</table>');

                        fclose($append_file);
                    ?>
                
                </div>

                
        </div>

	</body>
</html>