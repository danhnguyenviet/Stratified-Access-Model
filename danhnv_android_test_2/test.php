<?php

echo "Hello,World <br>";

require_once "pdo-user-detail.php";

$userDetailObject = new UserDetail();

$userDetailInfo = $userDetailObject->getUserDetailInfo(1);

echo json_encode($userDetailInfo);

