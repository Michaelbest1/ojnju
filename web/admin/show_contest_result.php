<?php
/**
 * Created by PhpStorm.
 * User: wlw
 * Date: 15-10-27
 * Time: 下午8:31
 */
require("admin-header.php");
if(isset($OJ_LANG)){
    require_once("../lang/$OJ_LANG.php");
}

require_once("../include/set_get_key.php");

if(isset($_GET["cid"]))
{
    $cid = $_GET['cid'];
    $sql = "SELECT user_id,problem_id,max(pass_rate) as p_rate FROM solution WHERE contest_id=".$cid." GROUP BY user_id,problem_id";
    $result = mysql_query($sql) or die(mysql_error());
    $arr = array();
    for(;$row=mysql_fetch_object($result);)
    {
        $uid = $row->user_id;
        if(!isset($arr[$uid]))
        {
            $arr[$uid] = array();
        }

        $arr[$uid][$row->problem_id] = $row->p_rate;
    }

    $sql = "SELECT p.problem_id,p.title from contest_problem AS c,problem AS p WHERE c.contest_id=".$cid." and p.problem_id=c.problem_id";
    $result = mysql_query($sql) or die(mysql_error());
    $problem_arr = array();
    $title_arr = array();
    for($i=0;$row=mysql_fetch_object($result);++$i)
    {
        $problem_arr[$i] = $row->problem_id;
        $title_arr[$i] = $row->title;
    }

    ?>
    <table class="table table-striped" width="90%" border="1">
        <tr>
            <th>学号</th>
            <?php
            foreach($title_arr as $title)
            {
                ?>
                <th>
                    <?=$title?>
                </th>
                <?php
            }
            ?>
        </tr>
        <?php
//        sort($arr);
        foreach($arr as $uid=>$score)
        {
            echo "<tr>";
            echo "<td>$uid</td>";
            foreach($problem_arr as $pid)
            {
                if(isset($score[$pid]))
                {
                    echo "<td>".$score[$pid]."</td>";
                }else{
                    echo "<td>0</td>";
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
    <?php
}else{
    echo "<p>You should tell system cid</p>";
//    echo $_GET["cid"];
}
?>

