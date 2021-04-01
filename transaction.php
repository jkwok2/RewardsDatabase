<html>
<?php
require 'util.php';
?>
<link rel="stylesheet" href="style.css">
<div class="header">
    <h1>Transaction Analyzer</h1>
</div>
<?php
require 'backButton.php';
?>

<h2>View Transaction Details</h2>
<form method="get" action="transaction.php">
    <input type="hidden" id="displayTransactionRequest" name="displayTransactionRequest">
    <p>Use the options below to filter your result<br/>
        <b>Instructions: values are case-sensitive! Multiple filters on this form can be applied at once. Blank values are ignored.</b></p>
    <p>Filter by account id:
    <input type="text" size="40" name="accountIDFilter"></p>
    <p>Filter by merchant name:
    <input type="text" size="40" name="merchantNameFilter"></p>
    <p>Filter by transaction type:
        <select name="transactionTypeFilter" id="transactionTypeFilter">
            <option value=""></option>
            <option value="purchase">purchase</option>
            <option value="refund">refund</option>
            <option value="exchange">exchange</option>
            <option value="other">other</option>
        </select>
    </p>
    <input type="submit" value="View transactions" name="displayTransactions">
</form>

<hr />

<h2>Advanced view and filter options</h2>
<form method="get" action="transaction.php">
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

<h2>View average purchase amount per account having at least x # of purchases</h2>
<form method="get" action="transaction.php">
    <input type="hidden" id="displayAvgPurchaseByAccRequest" name="displayAvgPurchaseByAccRequest">
        <p>Enter a number below to show only accounts that have made at least that many purchases<br/>
            <b>NOTE:</b> accounts with 0 purchases on record will not display in results <br/>
        <input type="text" size="40" name="averagePurchaseByAccFilter" value="1"></p>

    <input type="submit" value="View average purchases" name="averagePurchaseByAcc">
</form>

<hr />
<hr />
<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'transaction-controller.php';
?>

<br />


</html>
