<?php
  require"rb.php";
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
<title>Login</title>
<body>
  <header>
    <div class="headerlogo">
      <p><a href="index.html">MaksStef</a></p>
    </div>
    <nav>
      <div class="topnav" id="mytopnav">
        <a href="index.html">HOME</a>
        <a href="about.html">ABOUT</a>
        <a href="tests.html">TESTS</a>
        <a href="signup.php">SIGNUP</a>
        <a href="login.php">LOGIN</a>
        <a href="logout.php">EXIT</a>
        <a href="#" id="menu" class="icon">&#9776;</a>
      </div>
    </nav>
  </header>
  <main>
    <div class="types_of_tests">
      <h1>Введите ваши данные</h1>

      <?php
          $data = $_POST;
          if(isset($data['do_login']))
          {
            $errors=array();
            $user = R::findOne('users','login = ?',array($data['login']));

            if($user)
            {
              //login exist
              if (password_verify($data['password'],$user->password))
               {
                 //all good,user logged
                 $_SESSION['logged_user'] = $user;
                 echo '<div style="color:green;">you are authorized!You can go to the <a href="index.html">main</a> page!</div>';

               }
               else
               {
                 $errors[]='Wrong password';
               }

            }
            else
            {
              $errors[]='User not found';
            }



            if (!empty($errors))
            {
                echo '<div style="color:red;">'.array_shift($errors).'</div>';
            }


          }
      ?>

      <form action="login.php" method="post">

        <p>
            <p><strong>Login</strong>:</p>
            <input type="text" name="login" value="<?php echo @$data['login'];?>">
        </p>

        <p>
            <p><strong>Password</strong>:</p>
            <input type="password" name="password" value="<?php echo @$data['password'];?>">
        </p>

        <p>
            <button type="submit" name="do_login">Enter</button>
        </p>
      </form>



    </div>
  </main>

<footer>
  <div class="wrapper">
    <div class="social">
      <a href="https://vk.com"><img src="vk.png" width="50px" height="50px" alt=""></a>
      <a href="https://instagram.com"><img src="inst.png" width="50px" height="50px" alt=""></a>
      <a href="https://mail.ru"><img src="mail.png" width="50px" height="50px" alt=""></a>
      <a href="https://gmail.com"><img src="gmail.png" width="50px" height="50px" alt=""></a>
    </div>
  </div>
</footer>
<script src="script.js"></script>
</body>
</html>
