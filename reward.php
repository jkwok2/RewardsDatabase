<html>
<?php
require 'util.php';
?>
<h1>Manage Rewards</h1>

<h2>Delete Reward</h2>
<form method="POST" action="reward.php"> <!--refresh page when submitted-->
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    RewardID: <input type="text" name="rewardID"> <br /><br />

    <input type="submit" value="Delete Reward" name="insertSubmit"></p>
</form>

<hr />

<h2>Display Available Rewards</h2>
<form method="GET" action="reward.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
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
