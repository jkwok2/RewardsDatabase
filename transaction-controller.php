<?php
require_once 'util.php';

function handleDisplayTransactionRequest() {
    global $db_conn;

    if(empty($_POST['accountIDFilter'])) {
        echo 'accountID input is ' . $_POST['accountIDFilter'];
    }
    if(empty($_POST['merchantNameFilter'])) {
        echo 'transactionTypeFilter input is ' . $_POST['merchantNameFilter'];
    }
    if(empty($_POST['transactionTypeFilter'])) {
        echo 'transactionTypeFilter input is ' . $_POST['transactionTypeFilter'];
    }
//    echo "calling handleDisplayTransactionRequest";
//    echo "";
//    $result = executePlainSQL("SELECT * FROM Transaction");
//    printResult($result);
//    echo "";
//    echo "called handleDisplayTransactionRequest";
//    echo "";
//    $result = executePlainSQL("SELECT * FROM demoTable");
//    printResult($result);
//    echo "";
//    echo "calling projected table";
//    echo "";
//    $result = executePlainSQL("SELECT memberName, email, phone FROM Member");
//    printResult($result);
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