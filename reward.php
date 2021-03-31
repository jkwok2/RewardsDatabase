<html>
<?php
require 'util.php';
?>
<h1>Rewards Administrator and Analyzer</h1>

<h2>View redeemable rewards</h2>
<form method="get" action="reward.php">
    <input type="hidden" id="displayRewardsRequest" name="displayRewardsRequest">
    <input type="submit" value="View rewards" name="displayRewards">
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
<hr />
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
