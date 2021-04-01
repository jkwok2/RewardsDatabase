<?php
require_once 'util.php';

function handleDisplayAvgPurchaseByAccRequest() {
    global $db_conn;
    $minPurchaseNum = $_GET['averagePurchaseByAccFilter'];

    echo "handleDisplayAvgPurchaseByAccRequest";
    $cmdstr = "SELECT accountID, AVG(transactionAmount) FROM Transaction WHERE type='purchase' GROUP BY accountID HAVING COUNT(*) >= $minPurchaseNum";
    $result = executePlainSQL($cmdstr);

    echo "<table><tr><th>Account ID</th><th>Purchase Average ($)</th></tr></table>";
    printResult($result);

}

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
    $whereFilterMatchArray = array();

    $accountNationFilter = $_GET['accountNationFilter'];
    if(!empty($accountNationFilter)) {
        $whereFilterArray[] = "COUNTRY='" . $accountNationFilter . "'";
        $whereFilterMatchArray[] = "t.accountID=a.accountID";
    }

    $promotionRateFilterValue = $_GET['promotionRateFilterValue'];
    if(!empty($promotionRateFilterValue)) {
        $promotionRateFilterEquality = $_GET['promotionRateFilterEquality'];
        $whereFilterArray[] = "PROMOTIONRATE" . $promotionRateFilterEquality . $promotionRateFilterValue;
        $whereFilterMatchArray[] = "t.promotionID=p.promotionID";
    }


    $cmdstr = "SELECT t.transactionID, t.merchantName, t.type, t.transactionAmount";

    if (!empty($whereFilterArray)) {
        if (!empty($accountNationFilter)) {
            $cmdstr .= ", a.accountID, a.country";
        }
        if (!empty($promotionRateFilterValue)) {
            $cmdstr .= ", p.promotionID, p.promotionRate";
        }
    }

    $cmdstr .= " FROM Transaction t";

    if (!empty($whereFilterArray)) {
        if(!empty($accountNationFilter)) {
            $cmdstr .= ", ACCOUNT1 a";
        }
        if(!empty($promotionRateFilterValue)) {
            $cmdstr .= ", PROMOTIONOFFERS p";
        }

        $cmdstr .= " WHERE ";

        $cmdstr .= $whereFilterMatchArray[0];
        for($i=1; $i < count($whereFilterArray); $i++) {
            $cmdstr .= ' AND ' . $whereFilterMatchArray[$i];
        }

        for($i=0; $i < count($whereFilterArray); $i++) {
            $cmdstr .= ' AND ' . $whereFilterArray[$i];
        }
    }
//    echo $cmdstr;

    $result = executePlainSQL($cmdstr);
    printResult($result);
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
        } else if (array_key_exists('displayAvgPurchaseByAccRequest', $_GET)) {
            handleDisplayAvgPurchaseByAccRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['deleteAccount'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayTransactionRequest']) || isset($_GET['averagePurchaseByAcc']) || isset($_GET['displayAdvancedTransactionRequest'])) {
    handleGETRequest();
}
?>