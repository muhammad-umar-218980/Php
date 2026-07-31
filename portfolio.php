<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#f4f4f4;
            color:#333;
        }

        .container{
            width:80%;
            max-width:900px;
            margin:30px auto;
        }

        section{
            background:white;
            padding:20px;
            margin-bottom:20px;
            border-radius:8px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        h1,h2{
            color:#2563eb;
            margin-bottom:10px;
        }

        ul{
            margin-left:20px;
        }

        li{
            margin:5px 0;
        }

        input,textarea{
            width:100%;
            padding:10px;
            margin:10px 0;
        }

        button{
            padding:10px 20px;
            background:#2563eb;
            color:white;
            border:none;
            cursor:pointer;
        }

        button:hover{
            background:#1d4ed8;
        }

        footer{
            text-align:center;
            padding:20px;
            color:#666;
        }

        #message{
            color:green;
            margin-top:15px;
            display:none;
        }
    </style>
</head>
<body>

<?php

$name = "Muhammad Umar";
$title = "Junior MERN & PERN Stack Developer";
$city = "Karachi, Pakistan";
$email = "muhammadumar@gmail.com";

$skills = [
    "HTML",
    "CSS",
    "JavaScript",
    "React",
    "Node.js",
    "PHP",
    "MongoDB",
    "PostgreSQL",
    "Git"
];

$projects = [
    "Sticky Bits",
    "ChatZee",
    "PayMint-Verse"
];

?>

<div class="container">

    <section>
        <h1><?php echo $name; ?></h1>
        <p><?php echo $title; ?></p>
        <p><?php echo $city; ?></p>
    </section>

    <section>
        <h2>About Me</h2>
        <p>
            I am a CSIT student at NED University and a Junior MERN & PERN Stack
            Developer. I enjoy building modern web applications and learning new
            technologies.
        </p>
    </section>

    <section>
        <h2>Skills</h2>

        <ul>
            <?php
            foreach($skills as $skill){
                echo "<li>$skill</li>";
            }
            ?>
        </ul>
    </section>

    <section>
        <h2>Projects</h2>

        <ul>
            <?php
            foreach($projects as $project){
                echo "<li>$project</li>";
            }
            ?>
        </ul>
    </section>

    <section>
        <h2>Contact</h2>

        <p>Email: <?php echo $email; ?></p>

        <form onsubmit="showMessage(event)">

            <input
                type="text"
                placeholder="Enter your name"
                required
            >

            <input
                type="email"
                placeholder="Enter your email"
                required
            >

            <textarea
                rows="5"
                placeholder="Enter your message"
                required
            ></textarea>

            <button type="submit">Send</button>

        </form>

        <p id="message">
            Thank you! Your message has been received.
        </p>

    </section>

</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> <?php echo $name; ?></p>
</footer>

<script>
function showMessage(event){
    event.preventDefault();
    document.getElementById("message").style.display = "block";
}
</script>

</body>
</html>