<?php
require_once 'util.php';

function handleDisplayRequest() {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM Reward");

    printResult($result);
}

function deleteReward() {
    global $db_conn;

    //Getting the values from user and insert data into the table
    $rewardToRemove = $_POST['rewardID'];

    executePlainSQL("DELETE FROM Reward WHERE rewardID = " . "'" . $rewardToRemove . "'");
    OCICommit($db_conn);
}

function handleDisplayRedeemedRequest() {
    $cmdstr = "SELECT * FROM Redeems";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

function handleDisplayRedeemedByAllRequest() {
    $cmdstr = "SELECT * FROM Reward rwd WHERE NOT EXISTS (SELECT a.accountID FROM Account1 a MINUS (SELECT rdm.accountID FROM Redeems rdm WHERE rdm.rewardID=rwd.rewardID))";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('deleteReward', $_POST)) {
            deleteReward();
        }

        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('displayTuples', $_GET)) {
            handleDisplayRequest();
        } else if (array_key_exists('displayRedeemedRequest', $_GET)) {
            handleDisplayRedeemedRequest();
        } else if (array_key_exists('displayRedeemedByAllRequest', $_GET)) {
            handleDisplayRedeemedByAllRequest();
        }
        disconnectFromDB();
    }
}

if (isset($_POST['deleteAccount']) || isset($_POST['deleteReward'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayRedeemed']) || isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>