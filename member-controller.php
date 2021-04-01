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
    echo 'Member information has been updated successfully.';
    OCICommit($db_conn);
}

function handleMemberProjectionRequest() {

    $userInputs = $_GET["columns"];
    $inputString = "";

    if (!isset($_GET["columns"])) {
        echo 'No columns selected. Please select columns that you want to display.';
    } else {
        foreach($userInputs as $col) {
            $inputString .= $col . "," ;
        }
        $inputString = substr($inputString, 0, -1);
        $result = executePlainSQL("SELECT $inputString FROM Member");
        printResult($result);
    }

}

function handleCountMemberRequest() {
    $result = executePlainSQL("SELECT accountID, COUNT(*) FROM Member GROUP BY accountID");
    echo "<table><tr><th>Account ID</th><th># of Members in Account</th></tr></table>";
    printResult($result);
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
        if (array_key_exists('countMembers', $_GET)) {
            handleCountMemberRequest();
        } else if (array_key_exists('displayColumns', $_GET)) {
            handleMemberProjectionRequest();
        }
        disconnectFromDB();
    }
}
if (isset($_POST['updateMember'])) {
    handlePOSTRequest();
}
else if (isset($_GET['countMemberRequest']) || isset($_GET['memberProjectionRequest'])) {
    handleGETRequest();
}
?>


