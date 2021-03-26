<?php
require_once 'util.php';

function handleUpdateMemberRequest() {
    echo "handleUpdateMemberRequest";
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        echo "connect to db post";
        if (array_key_exists('updateMemberRequest', $_POST)) {
            echo "call updatememberrequest";
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

if (isset($_POST['updateMemberRequest'])) {
    handlePOSTRequest();
}
//else if (isset($_GET['displayAccountRequest']) || isset($_GET['displayTupleRequest'])) {
//    handleGETRequest();
//}
?>