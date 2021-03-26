<html>
<?php
require 'util.php';
?>
<h1>Member Administration</h1>

<h2>Edit Member Details</h2>
<form method="POST" action="member.php"> <!--refresh page when submitted-->
    <input type="hidden" id="updateMemberRequest" name="updateMemberRequest">
    <p>Enter the ID of the member you wish to edit:
        <input type="text" size="40" name="accountID"></p>
    <p>Enter the member's new information (blank values are ignored)</p>
    <p>New email address:
        <input type="text" size="40" name="accountID"></p>
    <p>New phone number:
        <input type="text" size="40" name="accountID"></p>
    <p>New :
        <input type="text" size="40" name="accountID"></p>

    <input type="submit" value="Update" name="updateSubmit"></p>
</form>

<hr />

<h2>Delete Account</h2>
<form method="post">
    <p><b>WARNING: this will delete ALL associated member, credit card, and transaction data</b></p>
    <p>Enter account ID to delete:
        <input type="hidden" id="deleteAccountRequest" name="deleteAccountRequest">
        <input type="text" size="40" name="accountID"></p>
    <input type="submit" value="Delete account and ALL associated data" name="deleteAccount">
</form>
<hr />
<hr />
<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'account-controller.php';
?>

<br />
<br />
<br />

<?php
require 'backButton.php';
?>
</html>
