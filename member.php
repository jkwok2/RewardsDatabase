<html>
<?php
require 'util.php';
?>
<h1>Member Administration</h1>

<h2>Update Member Details</h2>
<form method="POST" action="member.php"> <!--refresh page when submitted-->
    <input type="hidden" id="updateMemberRequest" name="updateMemberRequest">
    <p>Enter ID of the member you wish to update:
        <input type="text" size="40" name="accountID"></p>
    <p>Enter member's new information (blank values are ignored)</p>
    <p>New email:
        <input type="text" size="40" name="email"></p>
    <p>New phone:
        <input type="text" size="40" name="phone"></p>

    <input type="submit" value="Update" name="updateMember">
</form>

<hr />

<h2>Display Selected Columns from the Member Table</h2>
<form method="POST" action="member.php"> <!--refresh page when submitted-->
    <input type="hidden" id="memberProjectionRequest" name="memberProjectionRequest">
    <p>Shift+click or ctrl+click (cmd+click for macs) to select multiple columns:</p>
    <p>Select columns to display:
        <select name="columns[]" id="columns" multiple>
            <option value="memberID">memberID</option>
            <option value="accountID">accountID</option>
            <option value="memberName">memberName</option>
            <option value="email">email</option>
            <option value="phone">phone</option>
            <option value="birthDate">birthDate</option>
            <option value="referralID">referralID</option>
        </select>
    </p>
    <input type="submit" value="Display" name="displayColumns">
</form>

<hr />

<h2>Count Number of Members per Account</h2>
<form method="GET" action="member.php"> <!--refresh page when submitted-->
    <p>
        <input type="hidden" id="countMemberRequest" name="countMemberRequest">
        <input type="submit" name="countMembers"></p>
</form>

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



