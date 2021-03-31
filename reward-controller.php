<?php
require_once 'util.php';

function handleDisplayRedeemedRequest() {
    echo "handleUpdateMemberRequest";
    $cmdstr = "SELECT * FROM Redeems";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

function handleDisplayRewardsRequest() {
    echo "handleDisplayRewardsRequest";
    $cmdstr = "SELECT * FROM Reward";
    $result = executePlainSQL($cmdstr);
    printResult($result);
}

function handleDisplayRedeemedByAllRequest() {
    echo "handleDisplayRedeemedByAllRequest";
    $cmdstr = "SELECT * FROM Reward rwd WHERE NOT EXISTS (SELECT a.accountID FROM Account1 a EXCEPT (SELECT rdm.accountID FROM Redeems rdm WHERE rdm.rewardID=rwd.rewardID))
";
    $result = executePlainSQL($cmdstr);
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
        if (array_key_exists('displayRewardsRequest', $_GET)) {
            handleDisplayRewardsRequest();
        } else if (array_key_exists('displayRedeemedRequest', $_GET)) {
            handleDisplayRedeemedRequest();
        } else if (array_key_exists('displayRedeemedByAllRequest', $_GET)) {
            handleDisplayRedeemedByAllRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['updateMemberRequest'])) {
    handlePOSTRequest();
}
else if (isset($_GET['displayRewards']) || isset($_GET['displayRedeemed']) || isset($_GET['displayRedeemedByAll'])) {
    handleGETRequest();
}
?>