<html>
<?php
require 'util.php';
?>
<h2>Display the Tuples in DemoTable</h2>
<form method="GET" action="account.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
</form>

<h2>View Account Details</h2>
<form method="get">
    <p>Enter account ID:
    <input type="hidden" id="displayAccountRequest" name="displayAccountRequest">
    <input type="text" size="40" name="accountID"></p>
    <input type="submit" value="View account info" name="displayAccountDetails">
    <input type="submit" value="View account members" name="displayAccountMembers">
</form>
<?php
require 'account-controller.php';
?>
    <?php
    require 'backButton.php';
    ?>
</html>
