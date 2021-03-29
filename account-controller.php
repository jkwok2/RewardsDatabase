<?php
require_once 'util.php';

function handleDisplayRequest() {
    global $db_conn;

    // $result = executePlainSQL("SELECT * FROM Account1 a1, Account2 a2 WHERE a1.postalCode = a2.postalCode");
    $result = executePlainSQL("SELECT * FROM Account1");

    printResult($result);
}

function handleDisplayAccountDetailsRequest() {
    echo "handleDisplayAccountDetailsRequest";
}

function handleDisplayAccountMembersRequest() {
    echo "handleDisplayAccountMembersRequest";
}

function handleDeleteAccountRequest() {
    echo "handleDeleteAccountRequest";
}

function addAccount() {
    global $db_conn;

    $accountOneTuple = array (
        "accountID" => $_POST['accountID'],
        "bind2" => $_POST['pointBalance'],
        "bind3" => $_POST['streetAddress'],
        "bind4" => $_POST['city'],
        "bind5" => $_POST['postalCode'],
        "bind6" => $_POST['country']
    );

    $alltuples = array (
        $accountOneTuple
    );

    // executeBoundSQL("insert into Account1 values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
    // executePlainSQL(
    //     "INSERT INTO Account1 
    //     VALUES ($accountOneTuple[accountID], $accountOneTuple[bind2], $accountOneTuple[bind3], $accountOneTuple[bind4], $accountOneTuple[bind5], $accountOneTuple[bind6])");
    executePlainSQL(
        "INSERT INTO Account1 (accountID, pointBalance, streetAddress, city, postalCode, country)
        VALUES ('A1006', 0, 'v', 'v', 'v', 'v')");
    echo "foo";
    OCICommit($db_conn);
}


// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('deleteAccountRequest', $_POST)) {
            handleDeleteAccountRequest();
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
        } else if (array_key_exists('addAccount', $_GET)) {
            addAccount();
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