<html>
<head>
    <title>Strings</title>
</head>
<body>

<?php
$text = "  Hello World!  ";
$name = "John Doe";
?>

<h1>String Functions</h1>

<p>Original: <?php echo $text; ?></p>
<p>Length: <?php echo strlen($text); ?></p>
<p>Uppercase: <?php echo strtoupper($text); ?></p>
<p>Lowercase: <?php echo strtolower($text); ?></p>
<p>Trimmed: <?php echo trim($text); ?></p>
<p>Replace World with PHP: <?php echo str_replace("World", "PHP", $text); ?></p>
<p>First 5 chars: <?php echo substr($text, 0, 5); ?></p>
<p>Reverse: <?php echo strrev($name); ?></p>
<p>Word count: <?php echo str_word_count(trim($text)); ?></p>

</body>
</html>
