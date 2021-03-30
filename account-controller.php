<?php
require_once 'util.php';

function handleDisplayRequest() {
    global $db_conn;

    // $result = executePlainSQL("SELECT * FROM Account1 a1, Account2 a2 WHERE a1.postalCode = a2.postalCode");
    $result = executePlainSQL("SELECT * FROM Account1");

    printResult($result);
}

function handleInsertRequest() {
    global $db_conn;

    //Getting the values from user and insert data into the table
    $tuple = array (
        ":bind1" => $_POST['accountID'],
        ":bind2" => $_POST['pointsBalance'],
        ":bind3" => $_POST['streetAddress'],
        ":bind4" => $_POST['city'],
        ":bind5" => $_POST['postalCode'],
        ":bind6" => $_POST['country']
    );

    $alltuples = array (
        $tuple
    );

    executeBoundSQL("insert into Account1 values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
    OCICommit($db_conn);
}


// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('deleteAccountRequest', $_POST)) {
            handleDeleteAccountRequest();
        } else if (array_key_exists('insertQueryRequest', $_POST)) {
            handleInsertRequest();
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
        }

        disconnectFromDB();
    }
}

if (isset($_POST['deleteAccount']) || isset($_POST['insertSubmit'])) {
    handlePOSTRequest();
} else if (isset($_GET['displayAccountRequest']) || isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>