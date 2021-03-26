<html>
<?php
require 'util.php';
?>
<h1>Transaction Analyzer</h1>

<h2>Filter and View Transactions</h2>
<form method="get">
    <input type="hidden" id="displayAccountRequest" name="displayAccountRequest">
    <p>Use the following options below to filter your result (blank values are ignored)</p>
    <p>Filter by account id:
    <input type="text" size="40" name="accountIDFilter"></p>
    <p>Filter by merchant name:
    <input type="text" size="40" name="merchantNameFilter"></p>
    <p>Filter by transaction type</p>
    <select name="transactionType" id="transactionTypeFilter">
        <option value=""></option>
        <option value="purchase">purchase</option>
        <option value="return">return</option>
        <option value="exchange">exchange</option>
        <option value="other">other</option>
    </select>
    <p>Filter by transaction date</p>
    <input type="text" size="40" name="dateFilterInput"></p>
    <input type="radio" name="dateFilter" value="On exact date">
    <input type="radio" name="dateFilter" value="Before date">
    <input type="radio" name="dateFilter" value="After date">
</form>

<hr />

<h2>Advanced filter options</h2>
<form method="post">
    <p><b>WARNING: this will delete ALL associated member, credit card, and transaction data</b></p>
    <p>Enter account ID to delete:
        <input type="hidden" id="deleteAccountRequest" name="deleteAccountRequest">
        <input type="text" size="40" name="accountID"></p>
    <input type="submit" value="Delete account and associated data" name="deleteAccount">
</form>

<hr />
<hr />
<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'transaction-controller.php';
?>

<br />
<br />
<br />

<?php
require 'backButton.php';
?>
</html>
