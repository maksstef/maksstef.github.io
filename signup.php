<?php
  require"rb.php";
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
<title>Signup</title>
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
      <h1>Введите данные</h1>

      <?php
          $data = $_POST;
          if (isset($data['do_signup']))
          {
              //registration

              $errors = array();
              if(trim($data['login']) == '' )
              {
                  $errors[] = 'Enter login';
              }

              if(trim($data['email']) == '' )
              {
                  $errors[] = 'Enter @mail';
              }

              if($data['password'] == '' )
              {
                  $errors[] = 'Enter password';
              }

              if($data['password_2'] != $data['password'])
              {
                  $errors[] = 'Writing password wrong';
              }





              if(R::count('users',"login = ?",array($data['login'])) > 0)
              {
                  $errors[] = 'This login exists';
              }
              if(R::count('users',"email = ?",array($data['email'])) > 0)
              {
                  $errors[] = 'This email exists';
              }

              if (empty($errors))
              {
                  //all good,started registration
                  $user = R::dispense('users');
                  $user->login = $data['login'];
                  $user->email = $data['email'];
                  $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                  R::store($user);
                  echo '<div style="color:green;">you registered!</div>';

              }
              else
              {
                  echo '<div style="color:red;">'.array_shift($errors).'</div>';
              }


          }
      ?>





      <form action="signup.php" method="POST">
          <p>
              <p><strong>Your login</strong>:</p>
              <input type="text" name="login" value="<?php echo @$data['login'];?>">
          </p>

          <p>
              <p><strong>Your @mail</strong>:</p>
              <input type="email" name="email"  value="<?php echo @$data['email'];?>">
          </p>

          <p>
              <p><strong>Your password</strong>:</p>
              <input type="password" name="password"  value="<?php echo @$data['password'];?>">
          </p>

          <p>
              <p><strong>Return password</strong>:</p>
              <input type="password" name="password_2"  value="<?php echo @$data['password_2'];?>">
          </p>

          <p>
              <button type="submit" name="do_signup">Finish</button>
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
