<html>
<?php
require 'util.php';
?>
<link rel="stylesheet" href="style.css">
<div class="header">
    <h1>Account Administration</h1>
</div>
<?php
require 'backButton.php';
?>

<h2>Create New Account</h2>
<form method="POST" action="account.php"> <!--refresh page when submitted-->
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    AccountID: <input type="text" name="accountID"> <br /><br />
    Starting Points Balance: <input type="text" name="pointsBalance"> <br /><br />
    Street Address: <input type="text" name="streetAddress"> <br /><br />
    City: <input type="text" name="city"> <br /><br />
    Postal Code: <input type="text" name="postalCode"> <br /><br />
    Country: <input type="text" name="country"> <br /><br />
    Province/State: <input type="text" name="provinceState"> <br /><br />

    <input type="submit" value="Insert" name="insertSubmit"></p>
</form>

<hr />

<h2>Display Accounts</h2>
<form method="GET" action="account.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
</form>

<hr />

<h2>Determine the Average Points Balance of Accounts in the US and Canada with a non-Zero Balance (Are Active)</h2>
<form method="GET" action="account.php"> <!--refresh page when submitted-->
    <p>
        <input type="hidden" id="avgBalanceRequest" name="avgBalanceRequest">
        <input type="submit" name="avgPointsBalance"></p>
</form>

<hr />

<!-- <h2>Reset</h2>
    <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

<form method="POST" action="account.php">
    if you want another page to load after the button is clicked, you have to specify that page in the action parameter
    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
    <p><input type="submit" value="Reset" name="reset"></p>
</form> -->

<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'account-controller.php';
?>

<br />
</html>
