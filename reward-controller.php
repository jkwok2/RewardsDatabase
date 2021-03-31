<?php
require_once 'util.php';

function handleDisplayRequest() {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM Reward");
    // $result = executePlainSQL("SELECT * FROM Account1");

    printResult($result);
}

function handleInsertRequest() {
    global $db_conn;

    //Getting the values from user and insert data into the table
    $rewardToRemove = $_POST['rewardID'];

    executePlainSQL("DELETE FROM Reward WHERE rewardID = " . "'" . $rewardToRemove . "'");
    OCICommit($db_conn);
}


// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('deleteAccountRequest', $_POST)) {
            handleDeleteAccountRequest();
        } else if (array_key_exists('insertQueryRequest', $_POST)) {
            handleInsertRequest();
        }

        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('displayAccountDetails', $_GET)) {
            handleDisplayAccountDetailsRequest();
        } else if (array_key_exists('displayTuples', $_GET)) {
            handleDisplayRequest();
        } else if (array_key_exists('displayAccountMembers', $_GET)) {
            handleDisplayAccountMembersRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['deleteAccount']) || isset($_POST['insertSubmit'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayAccountRequest']) || isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>