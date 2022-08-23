<?php
require_once("../../connect.php");
session_start();
if (isset($_SESSION['username']))
    header("Location:../../../../index.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (isset($_POST['name'])) {

        $errors = [];

        $name = htmlspecialchars($_POST['name']);
        $stmt = $db->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->execute([$username]);


        if ($stmt->rowCount())
            $errors['user'] = "This User Name Is Already Exists";
        if (strlen($password) < 6)
            $errors['pass'] = "Password Must Be More Than 6 Characters";

        $extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $cn = true;
        foreach ($extensions as $i) {
            if ($i == strtolower(pathinfo($photo_name, PATHINFO_EXTENSION))) {
                $cn = false;
                break;
            }
        }
        if ($cn)
            $errors['avatar'] = "Please Select A Valid Image";

        if ($errors)
            echo json_encode($errors);

        if (!$errors) {

            $tmp_name = $_FILES['photo']['tmp_name'];
            $img_name = "" . rand(1, 10000000) . $photo_name;
            $stmt = $db->prepare("INSERT INTO users (username , password ,Name, `date` , avatar) values (?,?,?,?,?)");
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), htmlspecialchars($_POST['name']), date("Y:m:d H:i:s"), $img_name]);
            $_SESSION['username'] = $username;
            move_uploaded_file($tmp_name, "../../uploads/" . $img_name);
            echo "0";
        }
    }

    else {

        $stmt = $db->prepare("SELECT userid,password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount()) {
            $dta = $stmt->fetch();
            if (password_verify($password, $dta['password'])) {
                echo '1';
                $_SESSION['username'] = $username;
            }
            else
                echo '0';
        }
        else
            echo '0';
    }
}
else
    header("Location:../../login.php");
?>