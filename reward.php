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

<h2>Advanced view and filter options</h2>
<form method="get" action="reward.php">
    <input type="hidden" id="displayAdvancedTransactionRequest" name="displayAdvancedTransactionRequest">
    <p>Use the options below to filter your result based on values from other tables<br/>
        <b>Instructions: values are case-sensitive! Multiple filters on this form can be applied at once. Blank values are ignored.</b></p>
    <p>Filter by account nationality:
        <input type="text" size="40" name="accountNationFilter"></p>
    <p>Filter by promotion rate % (enter number):
        <input type="text" size="40" name="promotionRateFilterValue">
        <br/>
        <input type="radio" value="<=" name="promotionRateFilterEquality">less than or equal
        <input type="radio" value="=" name="promotionRateFilterEquality" checked>equal
        <input type="radio" value=">=" name="promotionRateFilterEquality">greater than or equal</p>
    <input type="submit" value="View transactions" name="displayAdvancedTransactions">
</form>

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
