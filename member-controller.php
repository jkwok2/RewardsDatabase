<?php
require_once 'util.php';
function handleDisplayRequest() {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM demoTable");

    printResult($result);
}

function handleUpdateMemberRequest() {
    echo "handleUpdateMemberRequest";
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
//    if (connectToDB()) {
//        if (array_key_exists('displayAccountDetails', $_GET)) {
//            handleDisplayAccountDetailsRequest();
//        } else if (array_key_exists('displayTuples', $_GET)) {
//            handleDisplayRequest();
//        }
//
//        disconnectFromDB();
//    }
}

if (isset($_POST['updateMember'])) {
    handlePOSTRequest();
}
//else if (isset($_GET['displayAccountRequest']) || isset($_GET['displayTupleRequest'])) {
//    handleGETRequest();
//}
?>