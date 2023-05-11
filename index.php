<?php
include 'includes/sortable-list.html';
require_once('common/config.php');
require_once('common/db.php');
// display the list
$sql = "SELECT id, `name`, `tekst`,`position`  FROM customers WHERE active =1 ORDER BY `position`";
$result = mysqli_query($DBCONNECTION, $sql);

echo "<h2 class='item-text'>Priorities of tasks</h2>";
echo "<ul id='sortable' class='connectedSortable'>";
while ($row = mysqli_fetch_assoc($result)) {
    $position = $row['position'];
    echo "<li class='ui-state-default' id='" . $row['id'] . "'><span class='position'>" . $position++ . ".</span> " . $row['name'] . $row['tekst'] . "</li>";
}
echo "</ul>";

?>

</html>
