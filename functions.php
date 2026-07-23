<html>
<head>
    <title>Functions</title>
</head>
<body>

<?php

function greet($name) {
    return "Hello $name!";
}

function add($a, $b) {
    return $a + $b;
}

function square($n) {
    return $n * $n;
}

function is_even($num) {
    if ($num % 2 == 0) {
        return "Even";
    } else {
        return "Odd";
    }
}

function get_full_name($first, $last) {
    return "$first $last";
}
?>

<h1>Functions</h1>

<p><?php echo greet("Umar"); ?></p>
<p><?php echo greet("Ali"); ?></p>

<p>5 + 3 = <?php echo add(5, 3); ?></p>
<p>10 + 20 = <?php echo add(10, 20); ?></p>

<p>Square of 7 is <?php echo square(7); ?></p>
<p>Square of 12 is <?php echo square(12); ?></p>

<p>9 is <?php echo is_even(9); ?></p>
<p>10 is <?php echo is_even(10); ?></p>

<p>Full name: <?php echo get_full_name("John", "Doe"); ?></p>

</body>
</html>
