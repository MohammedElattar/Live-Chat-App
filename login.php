<?php 
    $title = "Login";
    require_once("init.php");
    if(session_id() == '')session_start();
    if(isset($_SESSION["username"])){header(("Location:index.php"));die;}
?>
<body class="d-flex
            justify-content-center
            align-items-center
            vh-100
            ">
    <div class="w-400 p-5 rounded shadow rounded">
    <form action="index.php" method="POST" id="login_form">
        <div class="d-flex
                    justify-content center
                    align-items-center
                    text-center
                    ">
                    <img src="inc/imgs/logo.png" alt="logo">
                    <h1 class="display-4 fs-1 text-center">LOGIN</h1>
                    <div id="wrong" style="display: none;" class="alert alert-danger" role="alert">User Name Or Password Are Wrong</div>
        </div>
        <div class="mb-3 mr-auto"> 
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" placeholder="User Name" name="username" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Your Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" style="margin:10px 0;">Login</button>
            <a href="register.php" class="btn btn-success">Sign Up</a>
        </div>
        
    </form>
    </div>
</body>
<?php require_once("footer.php") ?>

<script src="inc/js/main.js"></script>
