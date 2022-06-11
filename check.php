<?
    require_once('header.php');
        $n= $_GET['Qid'];
        $id = $int = (int) filter_var($n, FILTER_SANITIZE_NUMBER_INT);
        //echo $id;

        $q = mysqli_query($connect,"SELECT `type` FROM `Quizes` WHERE `id` = '$id'");
        $row = mysqli_fetch_assoc($q);
        $type= intval($row['type']);

        echo $type;


?>