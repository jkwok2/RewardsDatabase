<?php
require_once 'util.php';

function handleDisplayTransactionRequest() {
    global $db_conn;

    $whereFilterArray = array();

    $accountIDFilter = $_GET['accountIDFilter'];
    if(!empty($accountIDFilter)) {
        $whereFilterArray[] = 'ACCOUNTID=\'' . $accountIDFilter . '\'';
    }
    $merchantNameFilter = $_GET['merchantNameFilter'];
    if(!empty($merchantNameFilter)) {
        $whereFilterArray[] = 'MERCHANTNAME=\'' . $merchantNameFilter . '\'';
    }
    $transactionTypeFilter = $_GET['transactionTypeFilter'];
    if(!empty($transactionTypeFilter)) {
        $whereFilterArray[] = 'TYPE=\'' . $transactionTypeFilter . '\'';
    }

    $cmdstr = "SELECT * FROM Transaction";

    if (!empty($whereFilterArray)) {
        $cmdstr .= ' WHERE ' . $whereFilterArray[0];

        for($i=1; $i < count($whereFilterArray); $i++) {
            $cmdstr .= ' AND ' . $whereFilterArray[$i];
        }
    }
//    echo $cmdstr;

    $result = executePlainSQL($cmdstr);
    printResult($result);
}

function handleDisplayAdvancedTransactionRequest() {
    global $db_conn;

    $whereFilterArray = array();

    $accountNationFilter = $_GET['accountNationFilter'];
    echo $accountNationFilter;
    if(!empty($accountNationFilter)) {
        $whereFilterArray[] = 'COUNTRY=\'' . $accountNationFilter . '\'';
    }
    $promotionRateFilterValue = $_GET['promotionRateFilterValue'];
    echo $promotionRateFilterValue;

    echo $promotionRateFilterValue;
    if(!empty($promotionRateFilterValue)) {
        $promotionRateFilterEquality = $_GET['promotionRateFilterEquality'];
        echo $promotionRateFilterEquality;
        $whereFilterArray[] = "PROMOTIONRATE" . $promotionRateFilterEquality . "'" . $promotionRateFilterValue . '\'';
    }

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