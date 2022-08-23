<?php 
    $title = "Sign Up";
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
    <form action="index.php" method="POST" enctype="multipart/form-data" id="signup_form">
        <div class="d-flex
                    justify-content center
                    align-items-center
                    text-center
                    " id="register_dv">
                    <img src="inc/imgs/logo.png" alt="logo">
                    <h1 class="display-4 fs-1 text-center">SIGN UP</h1>
        </div>
        <div class="alert alert-danger" role="alert" style="display: none;" id="user">
            This UserName Is Already Exists
        </div>
        <div class="alert alert-danger" role="alert" style="display: none;" id="pass">
            Password Must Be More Than 6 Characters
        </div>
        <div class="alert alert-danger" role="alert" style="display: none;" id="img">
            Please Select A Valid Photo
        </div>
        <div class="alert alert-success" role="alert" style="display: none;" id="success">
            Account Created Successfully
        </div>
        <div class="mb-3 mr-auto"> 
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" placeholder="User Name" name="username" required>
        </div>
        <div class="mb-3 mr-auto"> 
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" placeholder="Your Name" name="name" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Your Password</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="photo" class="form-label">Your Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success" style="margin: 10px 0;">Sign Up</button>
            <a href="login.php" class="btn btn-primary">Login</a>
        </div>
        
    </form>
    </div>
</body>
<?php require_once("footer.php") ?>
<script src="inc/js/main.js"></script>
