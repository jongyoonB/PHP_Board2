<?php
/**
 * Created by PhpStorm.
 * User: JongYoon
 * Date: 2015-07-24
 * Time: 오후 3:51
 */
    session_set_cookie_params(300);
    define("DB_NAME", "yjp_test");

    function conn_DB($argAddr, $argID, $argPASSWD)
    {
        if($argAddr){$argAddr = "localhost";}
        $conn = mysqli_connect($argAddr, "$argID", $argPASSWD);
        if(!$conn){
            echo "<script>alert('Login Faild')</script>";
            return null;
        }
        else{

            $db_conn = mysqli_select_db($conn, DB_NAME);

            if(!$db_conn){
                echo "<script>alert('There&apos"."s no DB named ".DB_NAME."')</script>";
            }
            else{
                $_SESSION['id'] = $argID;
                $_SESSION['passwd'] = $argPASSWD;
                if(!isset($_SESSION['login'])) {
                    echo "<script>alert('Welcome $argID')</script>";
                }
                $_SESSION['login'] = true;
                return $conn;
            }
        }


    }

    function transmit_query($argConn, $argQuery){
        //echo "<script>alert('$argQuery')</script>";
        $result = mysqli_query($argConn, $argQuery);
        if(!$result){
            echo "<script>alert('Query transmit Failed)'</script>";
        }
    }

    function select($argConn, $argTable, $argPid){
        $query = "select * from ".$argTable;
        if($argPid){
            $query .= " where contents_id = ".$argPid;
        }
        //echo "<script>alert('$query')</script>";
        $result = mysqli_query($argConn, $query);
        if(!$result){
            echo "<script>alert('Query transmit Failed')</script>";
        }
        else{
            return $result;
        }
    }

    function user_info($argConn, $argTable){
        $query = "select * from ".$argTable." where nick_name = '".$_SESSION['id']."'";
        //echo "<script>alert('$query')</script>";
        $result = mysqli_query($argConn, $query);
        if(!$result){
            echo "<script>alert('Query transmit Failed')</script>";
        }
        else{
            return $result;
        }
    }

    function select_page_nation($argConn, $argTable, $argMode, $keywords){

        if($argMode ==="search"){
            //+limit
            $query = "select * from ".$argTable." where subject like ('%".$keywords."%') OR contents like ('%".$keywords."%')";
            //echo $query."<br>";
        }
        else{
            //+limit
            $query = "select * from ".$argTable." ";
        }
        $result = mysqli_query($argConn, $query);
        if(!$result){
            echo "<script>alert('Query transmit Failed')</script>";
        }
        else{
            return $result;
        }
    }

    function get_numb_rows($argResult){
        return mysqli_num_rows($argResult);
    }

    function get_DBvalue($argResult){
        $result = mysqli_fetch_array($argResult);
        if(!$result){
            echo "<script>alert('No data')</script>";
        }
        else{
            return $result;
        }
    }
?>