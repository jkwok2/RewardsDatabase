<html>
<?php
require 'util.php';
?>
<h1>Transaction Analyzer</h1>

<h2>Filter and View Transactions</h2>
<form method="get" action="transaction.php">
    <input type="hidden" id="displayTransactionRequest" name="displayTransactionRequest">
    <p>Use the following options below to filter your result</p>
    <p>Instructions: values are case-sensitive! Multiple filters can be applied at once. Blank values are ignored)</p>
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
    <input type="submit" value="View filtered transactions" name="displayTransactions">
</form>

<hr />

<h2>Advanced filter options</h2>
<form method="get" action="transaction.php">
        <input type="hidden" id="displayAdvancedTransactionRequest" name="displayAdvancedTransactionRequest">
    <p><b>//TODO: determine what kinds of filters to add here for join, division, etc</b></p>
    <input type="submit" value="View filtered transactions" name="displayAdvancedTransactions">
</form>

<hr />
<hr />
<!--resulting output from forms will appear here-->
<h3>Output</h3>
<?php
require 'transaction-controller.php';
?>

<br />

<?php
require 'backButton.php';
?>
</html>
