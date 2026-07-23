<html>
<head>
    <title>Loops</title>
</head>
<body>

<h1>For loop</h1>
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "<p>Number: $i</p>";
}
?>

<h1>While loop</h1>
<?php
$x = 1;
while ($x <= 5) {
    echo "<p>While: $x</p>";
    $x++;
}
?>

<h1>Do while loop</h1>
<?php
$y = 1;
do {
    echo "<p>Do: $y</p>";
    $y++;
} while ($y <= 5);
?>

<h1>Foreach with numbers</h1>
<?php
$nums = array(2, 4, 6, 8, 10);
foreach ($nums as $n) {
    $sq = $n * $n;
    echo "<p>$n squared is $sq</p>";
}
?>

<h1>Nested loop - table</h1>
<table border="1">
<?php
for ($row = 1; $row <= 3; $row++) {
    echo "<tr>";
    for ($col = 1; $col <= 3; $col++) {
        echo "<td>$row,$col</td>";
    }
    echo "</tr>";
}
?>
</table>

</body>
</html>
