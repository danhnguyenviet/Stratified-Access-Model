<?php
    
    require_once 'pdo-user-detail.php';
    
    $user_id = "";
    
    if(isset($_POST['user_id'])){
        
        $user_id = $_POST['user_id'];
        
    }

    $userDetailObject = new UserDetail();

    if (!empty($user_id)) {

        $userDetailInfo = $userDetailObject->getUserDetailInfo($user_id);

        echo json_encode($userDetailInfo);
    }
?>