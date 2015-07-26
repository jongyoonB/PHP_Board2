<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-26
 * Time: 오후 10:48
 */
    !isset($_SESSION) ? session_start() : null ;
    include "/DB/DB_CON.php";
    $conn = conn_DB(null,$_SESSION['id'],$_SESSION['passwd']);
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $pid = isset($_GET['pid']) ? $_GET['pid'] : null;
    $response = select($conn,$_SESSION['board'],$pid);
    $DBvalue = mysqli_fetch_array($response);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>View!</title>
        <meta charset = "utf-8">
        <style>
            table{
                width: 1200px;
                border-collapse: collapse;

            }
            tr.bg{
                background-color: lightgray;
            }
            th{
                background-color: blanchedalmond;
                width: 150px;
            }
            td, th{
                border : 1px solid;
                text-align: center;
            }
            a{
                text-decoration: none;
                color: black;
            }
            p{
                text-align: center;
            }

            form{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <table align="center">
            <tr id="bg">
                <td>글 번호</td>
                <td>제목</td>
                <td>글쓴이</td>
                <td>작성 일자</td>
                <?php
                    $date = substr($DBvalue['reg_date'],2,2)."년 ".substr($DBvalue['reg_date'],5,2)."월 ".substr($DBvalue['reg_date'],8,2)."일&nbsp&nbsp".(int)substr($DBvalue['reg_date'],-8,2)."시 ".substr($DBvalue['reg_date'],-5,2)."분";
                    echo "<tr>";
                    echo "<td>$DBvalue[board_id]</td>";
                    echo "<td>$DBvalue[subject]</td>";
                    echo "<td>$DBvalue[user_name]</td>";
                    echo "<td>$date</td>";
                    echo "</tr>";
                ?>
            </tr>
        </table>
    </body>
</html>
