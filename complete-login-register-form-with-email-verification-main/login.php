<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    include 'config.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: welcome.php");
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />

           <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <style>
       .contact-main-nav{
         display: flex;
         align-items: center;
         justify-content: space-between;
         margin: 10px 10%
       }
       .contact-nav-right{
        display: flex;
         align-items: center;
       }
       .contact-nav-right div{
         margin: 0 20px
       }
       .list-item a{
         color: #000;
         text-decoration: none;
         font-weight: bold;
       }
       .contact-nav{
         background-color: #fff;
         margin-bottom: 20px
       }
       .mobile-nav{
         display: none;
       }
       .contact-active{
         border-bottom: 2px solid #000;
       }
       @media(max-width: 800px){
         .contact-nav{
           display: none;
         }
       }
       .mobile-nav{
         display: block;
       }

     </style>
</head>

<body>
  <div class="mobile-nav d-lg-none">
       <a href=""><img src="images/logo.png" alt="" width="150px";></a>
    </div>
    <div class="contact-nav">
        <div class="contact-main-nav ">
          <div class="contact-nav-left">
             <a href="IT/index.php"><img src="images/logo.png" alt=""></a>
          </div>
          <div class="contact-nav-right">
          <div class="list-item">
                       <a href="">Home</a> 
                   </div>
                   <div class="list-item">
                       <a href="about.php">About</a>
                   </div>
                   <div class="list-item">
                       <a href="blog.php" target="_blank">Blog</a>
                   </div>
                   <div class="list-item">
                       <a href="blog.php" target="_blank" class="contact-active">Account</a>
                   </div>
                   <div class="list-item">
                       <a href="contact-form/contact.php" >Contact</a>
                   </div>
          </div>
        </div>
    </div>

    <!-- form section start -->
   
    <section class="w3l-mockup-form" style="background-color:#fff4f4ff";>
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close text-white"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p><b>Login To Your Educon Account</b></p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn login-btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>