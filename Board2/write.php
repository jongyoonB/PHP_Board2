<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-24
 * Time: 오후 4:59
 */
    !isset($_SESSION) ? session_start() : null ;
    include "/DB/DB_CON.php";
    $conn = conn_DB("localhost",$_SESSION['id'],$_SESSION['passwd']);
    $DB_VALUE = user_info($conn,"user_info");
    $user_info = get_DBvalue($DB_VALUE);
    $nick = isset($user_info['nick_name']) ? $user_info['nick_name'] : null;
?>

<html>
    <head>
        <title>Write</title>
    </head>

    <body>
        <form action="list.php" method="post">
            닉네임<input type = "text" maxlength="20" name = "nick" value="<?php echo $nick ?>" contenteditable="false"><br>
            제목<input type = "text" maxlength="20" name = "subject" required><br>
            내용<br><textarea cols="15" rows="20" name = "contents"></textarea><br>
            <input type = "hidden" name="mode" value = "write">
            <input type = "submit" name = "write" value="POST">
            <input type = "button" name = "cancel" value="CANCEL" onclick="cancel_bt()">
        </form>

        <script>
            function cancel_bt(){
                history.go(-1);
            }
        </script>
    </body>
</html>
