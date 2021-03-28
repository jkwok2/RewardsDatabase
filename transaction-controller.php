<?php
require_once 'util.php';

function handleDisplayTransactionRequest() {
    global $db_conn;
    $accountIDFilter = $_POST['accountIDFilter'];
    echo 'accountID input is ' . $accountIDFilter;
    if(!empty($accountIDFilter)) {
        echo 'accountID input NOT EMPTY is ' . $accountIDFilter;
    }
    $merchantNameFilter = $_POST['merchantNameFilter'];
    echo 'transactionTypeFilter input is ' . $merchantNameFilter;
    if(!empty($merchantNameFilter)) {
        echo 'transactionTypeFilter NOT EMPTY input is ' . $merchantNameFilter;
    }
    $transactionTypeFilter = $_POST['transactionTypeFilter'];
    echo 'transactionTypeFilter input is ' . $transactionTypeFilter;
    if(!empty($transactionTypeFilter)) {
        echo 'transactionTypeFilter NOT EMPTY input is ' . $transactionTypeFilter;
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