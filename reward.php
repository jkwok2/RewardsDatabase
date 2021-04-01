<html>
<?php
require 'util.php';
?>
<link rel="stylesheet" href="style.css">
<div class="header">
    <h1>Rewards Manager</h1>
</div>
<?php
require 'backButton.php';
?>

<h2>Delete Reward</h2>
<form method="POST" action="reward.php"> <!--refresh page when submitted-->
    <b>WARNING: deleting a reward will also delete all redeem records associated with that reward</b>
    <input type="hidden" id="deleteReward" name="deleteReward">
    RewardID: <input type="text" name="rewardID"> <br /><br />

    <input type="submit" value="Delete Reward" name="deleteReward"></p>
</form>

<hr />

<h2>Display Available Rewards</h2>
<form method="GET" action="reward.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
</form>

<hr />

<h2>View records of redeemed rewards</h2>
<form method="get" action="reward.php">
    <input type="hidden" id="displayRedeemedRequest" name="displayRedeemedRequest">
    <input type="submit" value="View rewards" name="displayRedeemed">
</form>

<hr />

<h2>View reward categories redeemed by accounts</h2>
<form method="get" action="reward.php">
    <input type="hidden" id="displayRedeemedByAllRequest" name="displayRedeemedByAllRequest">
    <input type="submit" value="View rewards" name="displayRedeemedByAll">
</form>

<hr />
<hr />

<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'reward-controller.php';
?>

<br />


</html>
