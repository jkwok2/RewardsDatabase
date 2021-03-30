<?php
require_once 'util.php';

function handleUpdateMemberRequest() {
    global $db_conn;

    $memberID = $_POST['memberID'];
    echo 'memberID is ' . $memberID . '<br/>';
    $new_email = $_POST['email'];
    echo 'email is ' . $new_email . '<br/>';
    $new_phone = $_POST['phone'];
    echo 'phone is ' . $new_phone . '<br/>';

    $cmdstr = "UPDATE Member SET email='" . $new_email . "', 
    phone='" . $new_phone . "' 
    WHERE memberID='" . $memberID ."'";
    executePlainSQL($cmdstr);
    OCICommit($db_conn);
}

function handleMemberProjectionRequest() {
    global $db_conn;
    $cmdstr = "SELECT * FROM Member";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

function handleCountMemberRequest() {
    printResult(executePlainSQL("SELECT accountID, Count(*) FROM Member GROUP BY accountID"));
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
    if (connectToDB()) {
        if (array_key_exists('displayColumns', $_GET)) {
            handleMemberProjectionRequest();
        } else if (array_key_exists('countMembers', $_GET)) {
            handleCountMemberRequest();
        }

        disconnectFromDB();
    }
}
if (isset($_POST['updateMember'])) {
    handlePOSTRequest();
}
else if (isset($_GET['memberProjectionRequest']) || isset($_GET['countMemberRequest'])) {
    handleGETRequest();
}
?>


