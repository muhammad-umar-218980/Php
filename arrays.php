<html>
<head>
    <title>Arrays</title>
</head>
<body>

<?php
$colors = array("Red", "Green", "Blue", "Yellow", "Black");
$student = array(
    "name" => "Umar",
    "age" => 20,
    "city" => "Karachi",
    "course" => "PHP"
);
$numbers = [5, 12, 8, 20, 3];
?>

<h1>Indexed Array</h1>
<p>First color: <?php echo $colors[0]; ?></p>
<p>Second color: <?php echo $colors[1]; ?></p>
<p>Last color: <?php echo $colors[4]; ?></p>
<p>Total colors: <?php echo count($colors); ?></p>

<h1>Associative Array</h1>
<p>Name: <?php echo $student["name"]; ?></p>
<p>Age: <?php echo $student["age"]; ?></p>
<p>City: <?php echo $student["city"]; ?></p>
<p>Course: <?php echo $student["course"]; ?></p>

<h1>Loop through indexed array</h1>
<ul>
<?php
foreach ($colors as $c) {
    echo "<li>$c</li>";
}
?>
</ul>

<h1>Loop through associative array</h1>
<ul>
<?php
foreach ($student as $key => $val) {
    echo "<li>$key: $val</li>";
}
?>
</ul>

<h1>Sort array</h1>
<?php
sort($numbers);
echo "<p>" . implode(", ", $numbers) . "</p>";
?>

</body>
</html>
