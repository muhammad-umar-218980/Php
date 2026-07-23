<html>
<head>
    <title>Data Types</title>
</head>
<body>

<?php
$a = "Hello";
$b = 10;
$c = 3.14;
$d = true;
$e = array("red", "green", "blue");
$f = null;
?>

<h1>Data Types</h1>
<p>String: <?php echo $a; ?></p>
<p>Integer: <?php echo $b; ?></p>
<p>Float: <?php echo $c; ?></p>
<p>Boolean: <?php echo $d; ?></p>
<p>Array: <?php echo $e[0] . ", " . $e[1] . ", " . $e[2]; ?></p>
<p>Null: <?php echo $f; ?></p>

</body>
</html>
