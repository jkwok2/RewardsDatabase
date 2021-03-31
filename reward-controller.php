<?php
require_once 'util.php';

function handleUpdateMemberRequest() {
    echo "handleUpdateMemberRequest";
}

function handleDisplayRewardsRequest() {
    echo "handleDisplayRewardsRequest";
    $cmdstr = "SELECT * FROM Rewards";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('updateMemberRequest', $_POST)) {
            handleUpdateMemberRequest();
        }
        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('displayRewardsRequest', $_GET)) {
            handleDisplayRewardsRequest();
        } else if (array_key_exists('displayTuples', $_GET)) {
            handleDisplayRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['updateMemberRequest'])) {
    handlePOSTRequest();
}
else if (isset($_GET['displayRewards']) || isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>