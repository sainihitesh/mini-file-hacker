<?php   
 session_start();
 if (!empty($_SESSION["PASSWORD"])) 
 {
   header("Location:index.php");
 }
 ?>

<html><title>LOGIN TO BIN</title><head>
<link rel="stylesheet" href="js/bt.css">
<script src='js/bt.js' type="text/javascript"></script>
</head><body>
    <div class="container">

     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      
        <h2 class="form-signin-heading">LOGIN TO BIN</h2>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        
      </form><br>
      <center><ul class="nav nav-pills">
        
        </ul>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    
  </body>
</html>
<?php 
  if (!empty($_POST["password"])) 
  {
       if ($_POST["password"]=="neverbackdown007") 
       {
         $_SESSION["PASSWORD"]=1;

       }
  }
?>