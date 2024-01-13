<?php
$servername = "localhost";
$username = "root";
$password = "neko7399";
$database = "login";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "";
$name1 = "";
$pass = "";
$pass1 = "";
$class = "BD";
$class1 = "BD1";
$ip = "ip";
$ip1 = "ip";
$ip2 = "ip";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["singup"])) {
        $newUsername = $_POST["n_uname"];
        $newPassword = $_POST["n_pw"];
        
        $stmt = $conn->prepare("SELECT username FROM user_info WHERE username = ?");
        $stmt->bind_param("s", $newUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $class = "BD1";
            $class1 = "BD";
            $name1 = "Username already exists.";
            $ip2 = "ip_";
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO user_info (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $newUsername, $hashedPassword);
            
            if ($stmt->execute()) {
            } else {
            }
        }

    } elseif (isset($_POST["login"])) {
        $username = $_POST["uname"];
        $password = $_POST["pw"];
    
        $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];
        
            if (password_verify($password, $hashedPassword)) {
                session_start();
            
                $_SESSION['username'] = $username;
            
                header("Location: index.php");
                exit();
            } else {
                $class = "BD";
                $class1 = "BD1";
                $pass = "Incorrect password.";
                $ip1 = "ip_";
            }
        } else {
            $class = "BD";
            $class1 = "BD1";
            $ip = "ip_";
            $name = "Username not found.";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NEKO Network</title>
    <link rel="icon" type="jpg" href="icon.jpg">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="LH">
        <div class=<?php if(!empty($class)) {echo $class;}?> id="BD">
            <h1 class="LHD">Login</h1><br>
            <form method="POST" action="index.php">
            <div class="LM">
                <span class="er" id="vu"><?php if(!empty($name)) {echo $name;}?></span>
                <input class=<?php if(!empty($ip)) {echo $ip;}?> type="text" id="uname" name="uname"
                placeholder="Username" onfocus="focus_n()" 
                value="<?php echo isset($_POST['uname']) ? htmlspecialchars($_POST['uname']) : ''; ?>"
                required><br>
                <span class="er" id="vp"><?php if(!empty($pass)) {echo $pass;}?></span>
                <div class="ipss"><input style="width: 277.78px;" 
                    class=<?php if(!empty($ip1)) {echo $ip1;}?> 
                    type="password" id="pw" name="pw" placeholder="Password"
                    onfocus="focus_p()" required>
                    <div class="pas">
                        <i onclick="eye()" id="eye" class="fa fa-eye-slash"></i>
                    </div>
                </div>
            <br><br>
            </div>
            <div class="LoS">
                <input type="submit" class="LoS_L" value="Login" name="login"><br>
                <span class="or">or</span><br>
                <input type="button" onclick="log_sing()" class="LoS_R" value="Sing Up">
            </div>
            <br>
            <br>
            <div class="FFP">
                <span class="FP0">Forgot</span>
                <a class="FP" href="#">Username / Password?</a>
            </div>
            </form>
        </div>
        <div class=<?php if(!empty($class1)) {echo $class1;}?> id="BD1">
            <h1 class="LHD">Sing Up</h1><br>
            <form method="POST" action="index.php">
            <div class="LM">
                <span class="er" id="vu_n"><?php if(!empty($name1)) {echo $name1;}?></span>
                <input class=<?php if(!empty($ip2)) {echo $ip2;}?> type="text" id="n_uname" name="n_uname"
                placeholder="Username" onfocus="focus_nw()"
                value="<?php echo isset($_POST['n_uname']) ? htmlspecialchars($_POST['n_uname']) : ''; ?>"
                required><br>
                <span class="er" id="vp_n"></span>
                <div class="ipss"><input style="width: 277.78px;" class="ip" 
                    type="password" id="n_pw" name="n_pw" placeholder="Password" required>
                    <div class="pas">
                        <i onclick="eye_s()" id="eye_" class="fa fa-eye-slash"></i>
                    </div>
                </div>
            <br><br>
            </div>
            <div class="LoS">
                <input type="submit" class="LoS_L" value="Sing Up" name="singup"><br>
                <span class="or">or</span><br>
                <input type="button" onclick="log_sing()" class="LoS_R" value="Login">
            </div>
            <br>
            </form>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>