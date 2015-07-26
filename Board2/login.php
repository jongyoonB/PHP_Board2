<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-24
 * Time: 오후 3:27
 *
 * page nation
 * modify
 * delete
 * view -> list, write, modify, delete
 */
    //session_set_cookie_params(300);
    session_start();

    include "/DB/DB_CON.php";
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : null;
    if(isset($_SESSION['login'])){
        echo "<script>alert('Already Signed in')</script>";
        echo "<script>location.replace('list.php?page=1')</script>";
    }
    else if($id){
        $conn = conn_DB(null, $id, $passwd);
        if ($conn) {
            $_SESSION['board'] = isset($_POST['board']) ? $_POST['board'] : "board";
            echo "<script>location.replace('list.php?page=1')</script>";
        }
    }


?>

<html>
    <head>
        <meta charset="utf-8">
        <title>LOGIN</title>

    </head>

    <body>

        <h2>Sign in</h2>
        <div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                ID : <input type="text" name="id" maxlength="10" required>
                PASSWD : <input type="password" name="passwd" maxlength="16" required>
                <input type ="hidden" name = "mode" value = "login">
                <input type = "submit" name = "login" value = "sign in">
            </form>
        </div>

    </body>

</html>