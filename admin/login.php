<!DOCTYPE html>
<html>

<body>
    <?php
				$pesan="";
				require('config.php');
				session_start();
				// If form submitted, insert values into the database.
				if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($koneksi,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($koneksi,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `admin` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($koneksi,$query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['username'] = $username;
			header("Location: index.php"); // Redirect user to index.php
            }else{
				?>
    <script language="JavaScript">
    alert('Oops! Username atau Password tidak sesuai ...');
    document.location = 'login.php';
    </script>
    <?php
			}
		
    }else{
?>


    <body bgcolor="#00ffee ">

        <head>

            <meta charset="utf-8">
            <title>Login</title>
            <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                background-color: #6abadeba;
                font-family: 'Arial';
            }

            .login {
                width: 382px;
                overflow: hidden;
                margin: auto;
                margin: 20 0 0 450px;
                padding: 80px;
                background: #23463f;
                border-radius: 15px;

            }

            h2 {
                text-align: center;
                color: #277582;
                padding: 20px;
            }

            label {
                color: #08ffd1;
                font-size: 17px;
            }

            #Uname {
                width: 300px;
                height: 30px;
                border: none;
                border-radius: 3px;
                padding-left: 8px;
            }

            #Pass {
                width: 300px;
                height: 30px;
                border: none;
                border-radius: 3px;
                padding-left: 8px;

            }

            #log {
                width: 300px;
                height: 30px;
                border: none;
                border-radius: 17px;
                padding-left: 7px;
                color: blue;


            }

            span {
                color: white;
                font-size: 17px;
            }

            a {
                float: center;
                background-color: grey;
            }
            </style>
        </head>

        <body>
            <h2>Login Admin</h2><br>
            <div class="login">
                <form id="login" method="post" action="">
                    <label><b>Username
                        </b>
                    </label>
                    <input type="text" name="username" placeholder="Username" required />
                    <br><br>
                    <label><b>Password
                        </b>
                    </label>
                    <input type="Password" name="password" id="" placeholder="Password" required />
                    <br><br>
                    <input type="submit" name="submit" id="" value="Login">
					<a href="/pakarlol">Kembali</a>
                </form>
            </div>
            <?php } ?>
        </body>

</html>