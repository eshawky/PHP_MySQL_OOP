<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

	<body>
        <p>if age less than 18, print unauthorized else authorized</p>
		<form method="post" class="form" id="form">
			<input type="number" name="age" placeholder="Please enter ur age">
			<input type="submit" name ="submit" value="submit">
		</form>

		<?php
        	  if ( isset( $_POST['submit'] ) )
              {    

                    $age = $_POST['age'];

                    if ($age>18)
                    {
                        echo "<p>Authorized</p>";

                        echo '<script type="text/javascript">
                            document.getElementById("form").style.display = "none";
                        </script>';

                    }elseif ($age>0 && $age<=18)
                    {
                        echo "<p>Un-authorized</p>";

                        echo '<script type="text/javascript">
                            document.getElementById("form").style.display = "none";
                        </script>';
                    }else
                    {
                        echo "<p>Please enter a valid age</p>";
                    }
              }
    ?>

	</body>
</html>