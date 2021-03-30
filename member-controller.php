<?php
require_once 'util.php';
function handleUpdateMemberRequest() {
    global $db_conn;
    $memberID = $_POST['memberID'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    if (!empty($memberID)) {
        if (!empty($new_email) && !empty($new_phone)) {
            $cmdstr = "UPDATE Member SET email='" . $new_email . "', phone='" . $new_phone . "' WHERE memberID='" . $memberID ."'";
            executePlainSQL($cmdstr);
        } else if (!empty($new_email)) {
            $cmdstr = "UPDATE Member SET email='" . $new_email . "' WHERE memberID='" . $memberID ."'";
            executePlainSQL($cmdstr);
        }
        else if (!empty($new_phone)) {
            $cmdstr = "UPDATE Member SET phone='" . $new_phone . "' WHERE memberID='" . $memberID ."'";
            executePlainSQL($cmdstr);
        }
    }
    OCICommit($db_conn);
}

function handleMemberProjectionRequest() {

    global $db_conn;
    $userInputs = $_POST["columns"];
    $inputString = "";

    foreach($_POST[columns] as $col) {
        $inputString .= $col . "," ;

    }
    $inputString = substr($inputString, 0, -1);
    $result = executePlainSQL("SELECT $inputString FROM Member");
    printResult($result);

}

function handleCountMemberRequest() {
    $result = executePlainSQL("SELECT accountID, COUNT(*) FROM Member GROUP BY accountID");
    printResult($result);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('updateMemberRequest', $_POST)) {
            handleUpdateMemberRequest();
        } else if (array_key_exists('memberProjectionRequest', $_POST)) {
            handleMemberProjectionRequest();
        }
        disconnectFromDB();
    }
}
// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('countMembers', $_GET)) {
            handleCountMemberRequest();
        }
        disconnectFromDB();
    }
}
if (isset($_POST['updateMember']) || isset($_POST['displayColumns'])) {
    handlePOSTRequest();
}
else if (isset($_GET['countMemberRequest'])) {
    handleGETRequest();
}
?>


