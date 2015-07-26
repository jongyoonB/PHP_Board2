<?php
    !isset($_SESSION) ? session_start() : null ;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            List
        </title>
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
        <h2 align="center"><?php echo $_SESSION['board'] ?></h2>
        <table align="center">
            <tr id="bg">
                <td>글 번호</td>
                <td>제목</td>
                <td>글쓴이</td>
                <td>작성 일자</td>
            </tr>
            <tr>
                <?php
                    include "DB/DB_CON.php";

                    $conn = conn_DB(null,$_SESSION['id'],$_SESSION['passwd']);
                    switch($_SESSION['board']){
                        case "board":{
                            $_SESSION['board_id'] = 1;
                            break;
                        }
                        default :{
                            $_SESSION['board_id'] = 1;
                            break;
                        }
                    }

                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $mode = isset($_GET['mode']) ? $_GET['mode'] : isset($_POST['mode']) ? $_POST['mode'] : null;
                    //echo "<script>alert('$mode')</script>";

                    if($mode ==="search"){
                        $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : null;
                        $DBvalue = select_page_nation($conn, $board, $mode, $keywords);
                        $numbOfArticle = get_numb_rows($DBvalue);
                    }
                    else{
                        if($mode ==="write"){
                            $date = date("Y:m:d H:i:s");
                            $nick = isset($_POST['nick']) ? $_POST['nick'] : null;
                            $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
                            $contents = isset($_POST['contents']) ? $_POST['contents'] : null;
                            /*echo "<script>alert('$_SESSION[id]')</script>";
                            echo "<script>alert('$nick')</script>";
                            echo "<script>alert('$date')</script>";
                            echo "<script>alert('$subject')</script>";
                            echo "<script>alert('$contents')</script>";*/
                            $rq_query = "insert into $_SESSION[board] (board_id, user_id, user_name, subject, contents, reg_date)";
                            $rq_query .=  " values ('$_SESSION[board_id]', '$_SESSION[id]','$nick','$subject','$contents','$date')";
                            //echo "<script>alert('$rq_query')</script>";
                            transmit_query($conn, $rq_query);
                        }

                        if($mode ==="delete"){

                        }

                        if($mode ==="modify"){

                        }
                        $rq_query = select_page_nation($conn, $_SESSION['board'], null, null, null);
                        $numbOfArticle = get_numb_rows(select($conn, $_SESSION['board'], null));
                    }





                    while($DBvalue = mysqli_fetch_array($rq_query)) {
                        $date = substr($DBvalue['reg_date'],2,2)."년 ".substr($DBvalue['reg_date'],5,2)."월 ".substr($DBvalue['reg_date'],8,2)."일&nbsp&nbsp".(int)substr($DBvalue['reg_date'],-8,2)."시 ".substr($DBvalue['reg_date'],-5,2)."분";
                        echo "<tr>";
                            echo "<td>$DBvalue[contents_id]</td>";
                            echo "<td><a href ='view.php?page=".$page."&pid=".$DBvalue['contents_id']."'>".$DBvalue['subject']."</a></td>";
                            echo "<td>$DBvalue[user_name]</td>";
                            echo "<td>$date</td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
        </table>
        <br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <input type ="text" name = "keywords">
            <input type = "submit" name = "mode" value = "search">
        </form>

    </body>
</html>