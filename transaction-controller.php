<?php
require_once 'util.php';

function handleDisplayTransactionRequest() {
    global $db_conn;

    $cmdstr = "SELECT * FROM Transaction";
    $result = executePlainSQL($cmdstr);
    echo($result);
    printResult($result);
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
        if (array_key_exists('displayTransactions', $_GET)) {
            handleDisplayTransactionRequest();
        } else if (array_key_exists('displayAdvancedTransactions', $_GET)) {
            handleDisplayAdvancedTransactionRequest();
        } else if (array_key_exists('displayAccountMembers', $_GET)) {
            handleDisplayAccountMembersRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['deleteAccount'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayTransactionRequest']) || isset($_GET['displayAdvancedTransactionRequest'])) {
    handleGETRequest();
}
?>