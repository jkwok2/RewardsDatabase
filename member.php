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
        <input type="text" size="40" name="emailAddress"></p>
    <p>New phone number:
        <input type="text" size="40" name="phoneNumber"></p>

    <input type="submit" value="updateMember" name="Update member details"></p>
</form>

<hr />
<hr />
<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'member-controller.php';
?>

<br />

<?php
require 'backButton.php';
?>
</html>
