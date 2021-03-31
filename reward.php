<html>
<?php
require 'util.php';
?>
<h1>Manage Rewards</h1>

<h2>Delete Reward</h2>
<form method="POST" action="reward.php"> <!--refresh page when submitted-->
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    RewardID: <input type="text" name="rewardID"> <br /><br />

    <input type="submit" value="Insert" name="insertSubmit"></p>
</form>

<hr />

<h2>Display Rewards</h2>
<form method="GET" action="reward.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
</form>

<hr />

<h2>Reset</h2>
    <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

<form method="POST" action="reward.php">
    <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
    <p><input type="submit" value="Reset" name="reset"></p>
</form>

<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'reward-controller.php';
?>

<br />

<?php
require 'backButton.php';
?>
</html>
