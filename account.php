<html>
<?php
require 'util.php';
require 'account-controller.php';
?>
<h2>Display the Tuples in DemoTable</h2>
<form method="GET" action="oracle-test-h2s8.php"> <!--refresh page when submitted-->
    <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
    <input type="submit" name="displayTuples"></p>
</form>
    <?php
    require 'backButton.php';
    ?>
</html>
