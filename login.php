<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: Home.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>TechFinds</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <h1>TechFinds</h1>
      <img class="searchR" src="searchR.png">
      <img class="searchL" src="searchL.png">
      <div class="login-form">
         <div class="text">
            LOGIN
         </div>
         <form method="post">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" id="email" name="email" placeholder="Email"
                      value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <button>LOGIN</button>
            <div class="link">
               Not a member?
               <a href="signup.html">Signup now</a><br>
               <?php if ($is_invalid): ?>
                  <em>Invalid login</em>
               <?php endif; ?>
            </div>
         </form>
      </div>
   </body>
</html>