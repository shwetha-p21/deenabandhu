<?php
    include_once("./core/init.php");
    include_once("./core/database.php");
    include_once("./core/functions.php");

    check_if_logged_in();

    if ($_SERVER ['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $emailid=$_POST['email'];
            $password=$_POST['password'];

            $stmt=$con->prepare("select * from login where emailid=?");
            $stmt->bind_param("s",$emailid);
            $stmt->execute();
            $stmt_result=$stmt->get_result();
            
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
                if($stmt_result->num_rows>0){
                    echo("Email already used!");
                } else {
                    $stmt = $con->prepare("insert into login (`emailid`, `password`, `type`) values (?, ?, ?)");
                    $type = "visitor";
                    $stmt->bind_param("sss", $emailid, $password, $type);
                    $stmt->execute();
                    echo "New user Registered!";
                }

            } else {
                if($stmt_result->num_rows>0){
                    $data=$stmt_result->fetch_assoc();
                    if($data['password']===$password){
                        echo"<h2>Login successfully</h2>";
                        $_SESSION['id'] = $data['emailid'];
                        $_SESSION['role'] = $data['type'];
                        check_if_logged_in();
                    }else{ 
                        echo "<h2>Invalid Email or password</h2>";
                    }   
                }else{
                    echo "<h2>Invalid Email or password</h2>";
                }
            }    
        }
        
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
	<link rel="stylesheet" type="text/css" href="./static/css/style.css" />
</head>
<body>
   
    <div class="hero">
        <div class="form-box">
            <div class="buttons">
            	<div id="btn"></div>
    	        <button type="button" class="toggle" onclick="login()">login</button>
    	        <button type="button" class="toggle" onclick="register()">register</button>
            </div>
            <div class="sicons">
        	<img src="C:\Users\my pc\Desktop\login\fb1.png">
        	<img src="C:\Users\my pc\Desktop\login\tw1.png">
        	<img src="C:\Users\my pc\Desktop\login\pg.png">
            </div> 
            <form id="login" class="input"action="login.php" method="Post">    
                <div class="input-group">
                    <i class="fas fa-envelope input-prefix-icon"></i>
                    <input type="text" name="email" class="input-field" placeholder="email id" required>
                </div>
                <div class="password-box">
                    <i class="fas fa-lock input-prefix-icon"></i>
            		<input type="password" name="password" id="password" class="input-field" placeholder="Enter password" required>
            		<span class="password-eye">
            			<i class="fas fa-eye" id="eye_icon"></i>
            		</span>
            	</div>
                
            	<input type="checkbox" name="remember" id="remember-password" class="checkbox"><label for
                ="remember-password">Remember me</label>
            	<div style="text-align: center; margin-bottom: 16px;">
                    <a href="forgot-password.php" style="color: #29717e; text-decoration: none;">Forgot Password?</a>
                </div>
            	<button type="submit" class="submit-btn">Log in</button>

              
            </form>
            <form id="register" class="input" action="login.php" method="post">
                <div class="input-group">
                    <i class="fas fa-user input-prefix-icon"></i>
                    <input type="text" name="username" class="input-field" placeholder="user name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope input-prefix-icon"></i>
                    <input type="text" name="email" class="input-field" placeholder="email id" required />    
                </div>
            	
                <div class="password-box">
                    <i class="fas fa-lock input-prefix-icon"></i>
                   	<input type="password" name="password" id="register_password" class="input-field" placeholder="Enter password" required>
                    <span class="password-eye">
                        <i class="fas fa-eye" id="register_eye_icon"></i>
                    </span>
                    </div>
            	<br><br>
        
            	<button type="submit" class="submit-btn">Register</button>
            </form>
        </div>   
    </div>
    <script>
    	var x = document.getElementById("login");
    	var y = document.getElementById("register");
    	var z = document.getElementById("btn");

    	function register(){
    		x.style.left ="-400px";
    		y.style.left ="50px";
    		z.style.left ="110px";
    	}
    	function login(){
    		x.style.left ="50px";
    		y.style.left ="450px";
    		z.style.left ="0px";
    	}
    	var password_visible = false;
        var register_password_visible = false;

    	var eye_icon = document.getElementById("eye_icon");
        var register_eye_icon = document.getElementById('register_eye_icon');

    	var password_input = document.getElementById('password');
        var register_passwrod = document.getElementById('register_password');

     	eye_icon.onclick = function() {
    		password_input.type = password_visible ? 'password': 'text';
    		eye_icon.className = password_visible ? "fas fa-eye": "fas fa-eye-slash";
    		password_visible = !password_visible;
    	}

        register_eye_icon.onclick = function() {
            register_passwrod.type = register_password_visible ? 'password': 'text';
            register_eye_icon.className = register_password_visible ? "fas fa-eye": "fas fa-eye-slash";
            register_password_visible = !register_password_visible;
        }
    </script>
</body>
</html>