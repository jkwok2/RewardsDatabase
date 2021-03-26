<?php
require_once 'util.php';
function handleDisplayRequest() {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM demoTable");

    printResult($result);
}

function handleDisplayTransactionRequest() {
    echo "handleDisplayTransactionRequest";
}

function handleDisplayAdvancedTransactionRequest() {
    echo "handleDisplayAdvancedTransactionRequest";
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
//    if (connectToDB()) {
//        if (array_key_exists('deleteAccountRequest', $_POST)) {
//            handleDeleteAccountRequest();
//        }
//        disconnectFromDB();
//    }
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

if (isset($_POST['deleteAccount'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayAccountRequest']) || isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>