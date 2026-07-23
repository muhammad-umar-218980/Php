<html>
<head>
    <title>If Else</title>
</head>
<body>

<?php
$marks = 75;
$grade = "";

if ($marks >= 80) {$grade = "A+";
} elseif ($marks >= 70) {$grade = "A";
} elseif ($marks >= 60) {$grade = "B";
} elseif ($marks >= 50) {$grade = "C";
} else {$grade = "Fail";}
?>

<h1>If Else Example</h1>
<p>Marks: <?php echo $marks; ?></p>
<p>Grade: <?php echo $grade; ?></p>

</body>
</html>
