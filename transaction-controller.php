<?php
require_once 'util.php';

function handleDisplayTransactionRequest() {
    global $db_conn;


//    $postKeys = array_keys($_GET);
//
//    echo $postKeys;
//
//    foreach($postKeys as $postKey) {
//        echo $postKey . '/n';
//    }
//
//    echo 'echoing post keys';
//    foreach($_GET as $key=>$value)
//    {
//        echo "$key=$value /n";
//    }

    $whereFilterArray = array();

    $accountIDFilter = $_GET['accountIDFilter'];
    echo 'accountID input is ' . $accountIDFilter . '<br/>';
    if(!empty($accountIDFilter)) {
//        echo 'accountID input NOT EMPTY is ' . $accountIDFilter . '<br/>';
        $whereFilterArray[] = 'accountID=' . $accountIDFilter;
    }
    $merchantNameFilter = $_GET['merchantNameFilter'];
    echo 'merchantNameFilter input is ' . $merchantNameFilter . '<br/>';
    if(!empty($merchantNameFilter)) {
//        echo 'merchantNameFilter NOT EMPTY input is ' . $merchantNameFilter . '<br/>';
        $whereFilterArray[] = 'merchantName=' . $merchantNameFilter;
    }
    $transactionTypeFilter = $_GET['transactionTypeFilter'];
    echo 'transactionTypeFilter input is ' . $transactionTypeFilter . '<br/>';
    if(!empty($transactionTypeFilter)) {
//        echo 'transactionTypeFilter NOT EMPTY input is ' . $transactionTypeFilter . '<br/>';
        $whereFilterArray[] = 'type=' . $transactionTypeFilter;
    }
//    echo "calling handleDisplayTransactionRequest";
//    echo "";
    $result = executePlainSQL("SELECT * FROM Transaction");

    if (!empty($whereFilterArray)) {
        $result .= ' WHERE ' . $whereFilterArray[0];

        for($i=1; $i < count($whereFilterArray); $i++) {
            $result .= ' AND ' . $whereFilterArray[$i];
        }
    }


    printResult($result);
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