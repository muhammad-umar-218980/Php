<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Muhammad Umar</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
*{margin:0;padding:0;box-sizing:border-box}

body{
background:#0a0a0f;
color:#e2e8f0;
font-family:system-ui,-apple-system,sans-serif;
transition:.3s
}

body.light{
background:#f1f5f9;
color:#0f172a
}

.wrap{
max-width:960px;
margin:0 auto;
padding:0 20px
}

.box{
background:#13131f;
border:1px solid #1e293b;
border-radius:14px;
padding:24px;
margin-bottom:28px
}

.light .box{
background:#fff;
border-color:#d1d5db
}

.btn-theme{
position:fixed;
top:20px;
right:20px;
width:44px;
height:44px;
border-radius:50%;
border:1px solid #1e293b;
background:#13131f;
color:#e2e8f0;
font-size:22px;
cursor:pointer;
z-index:99;
display:flex;
align-items:center;
justify-content:center
}
.light .btn-theme{
background:#fff;
border-color:#d1d5db;
color:#0f172a
}

.av{
width:100px;
height:100px;
border-radius:50%;
background:linear-gradient(135deg,#3b82f6,#a855f7);
color:#fff;
font-size:42px;
font-weight:700;
display:flex;
align-items:center;
justify-content:center;
flex-shrink:0
}

.tt{
border-right:3px solid #3b82f6;
animation:blink .8s step-end infinite
}
@keyframes blink{50%{border-color:transparent}}

.skills{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(180px,1fr));
gap:20px
}

.tag{
background:#1e293b;
color:#e2e8f0;
padding:4px 14px;
border-radius:20px;
font-size:13px;
display:inline-block;
margin:3px 3px 0 0
}
.light .tag{background:#e2e8f0;color:#0f172a}

.gr{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
gap:20px
}

.pcard{
background:#0a0a0f;
border:1px solid #1e293b;
border-radius:12px;
padding:20px
}
.light .pcard{
background:#f8fafc;
border-color:#d1d5db
}

.hot{
border:2px solid #3b82f6;
position:relative
}
.hotbadge{
position:absolute;
top:-11px;
right:14px;
background:#3b82f6;
color:#fff;
font-size:11px;
font-weight:700;
padding:2px 12px;
border-radius:20px
}

input,textarea{
width:100%;
padding:10px 14px;
border-radius:8px;
border:1px solid #1e293b;
background:#0a0a0f;
color:#e2e8f0;
margin-bottom:12px
}
.light input,.light textarea{
background:#f8fafc;
color:#0f172a;
border-color:#d1d5db
}
input:focus,textarea:focus{
outline:none;
border-color:#3b82f6
}

.btn{
background:#3b82f6;
color:#fff;
padding:10px 28px;
border-radius:8px;
border:none;
font-weight:600;
cursor:pointer;
display:inline-block
}
.btn:hover{opacity:.85}

.q{
font-style:italic;
font-size:17px;
color:#64748b;
text-align:center;
padding:10px 0
}

.foot{
text-align:center;
padding:30px 0 40px;
color:#64748b;
font-size:14px
}
</style>
</head>
<body>

<?php
$n = "Muhammad Umar";
$t = "Junior MERN & PERN Stack Developer";
$city = "Karachi, Pakistan";
$edu = "CSIT at NED University, 3rd Year";
$mail = "muhammadumar@gmail.com";
$intern = "Web Dev Intern at SSGC";

$hr = date('H');
if($hr < 12){
$greet = "Good Morning";
} elseif($hr < 17){
$greet = "Good Afternoon";
} else {
$greet = "Good Evening";
}

$skills = [
"Frontend" => ["HTML","CSS","JS","TypeScript","Tailwind","Bootstrap","React"],
"Backend" => ["Node.js","Express.js","PHP"],
"Database" => ["MongoDB","PostgreSQL"],
"More" => ["Next.js","Supabase","Git","Gemini API","Groq API"]
];

$projects = [
["title"=>"Sticky Bits","desc"=>"MERN notes app with auth and full CRUD","tech"=>"MongoDB, Express, React, Node"],
["title"=>"ChatZee","desc"=>"Chatbot using Gemini, OpenRouter & Groq APIs for real-time AI responses","tech"=>"MERN + AI APIs"],
["title"=>"PayMint-verse","desc"=>"Bill splitter & expense manager with Next.js, Supabase auth, PostgreSQL","tech"=>"Next.js, TS, Supabase, PG"]
];

$hi = array_rand($projects);

$quotes = [
"Code is like humor. When you have to explain it, its bad.",
"First solve the problem. Then write the code.",
"Talk is cheap. Show me the code.",
"The best way to predict the future is to create it.",
"Make it work, make it right, make it fast.",
"Any fool can write code that a computer understands."
];
$qotd = $quotes[array_rand($quotes)];
?>

<button class="btn-theme" onclick="document.body.classList.toggle('light');this.textContent=document.body.classList.contains('light')?'☀️':'🌙'">🌙</button>

<div class="wrap" style="padding-top:60px">

<div class="box">
<div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap">
<div class="av">U</div>
<div style="flex:1;min-width:220px">
<p style="color:#3b82f6;font-weight:600"><?php echo $greet; ?>!</p>
<h1 style="font-size:34px;font-weight:800;margin:2px 0">I'm <span class="tt" id="ty"></span></h1>
<p style="font-size:17px;color:#64748b"><?php echo $t; ?></p>
<div style="display:flex;gap:14px;margin-top:14px">
<a href="https://github.com/muhammad-umar-218980" target="_blank" style="color:#64748b">
<svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>
</a>
<a href="https://www.linkedin.com/in/muhammad-umar-05760a35a/" target="_blank" style="color:#64748b">
<svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
</a>
</div>
</div>
</div>
</div>

<div class="box">
<h2 style="font-size:20px;font-weight:700;margin-bottom:10px">👤 About</h2>
<p style="color:#64748b">📍 <?php echo $city; ?></p>
<p style="color:#64748b">🎓 <?php echo $edu; ?></p>
<p style="color:#64748b;margin-top:4px">💼 <?php echo $intern; ?></p>
</div>

<div class="box">
<h2 style="font-size:20px;font-weight:700;margin-bottom:16px">⚡ Skills</h2>
<div class="skills">
<?php foreach($skills as $cat => $items): ?>
<div>
<p style="font-size:13px;font-weight:600;color:#64748b;margin-bottom:6px"><?php echo $cat; ?></p>
<div>
<?php foreach($items as $s): ?>
<span class="tag"><?php echo $s; ?></span>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
</div>
</div>

<div class="box">
<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-bottom:16px">
<h2 style="font-size:20px;font-weight:700">📁 Projects</h2>
<span style="font-size:12px;color:#3b82f6;font-weight:600">🔥 Random pick: <?php echo $projects[$hi]["title"]; ?></span>
</div>
<div class="gr">
<?php foreach($projects as $i => $p): ?>
<div class="pcard <?php echo $i===$hi?"hot":""; ?>">
<?php if($i===$hi): ?>
<span class="hotbadge">✨</span>
<?php endif; ?>
<h3 style="font-size:17px;font-weight:700"><?php echo $p["title"]; ?></h3>
<p style="color:#3b82f6;font-size:12px;margin:4px 0"><?php echo $p["tech"]; ?></p>
<p style="color:#64748b;font-size:13px;margin-top:6px"><?php echo $p["desc"]; ?></p>
</div>
<?php endforeach; ?>
</div>
</div>

<div class="box">
<h2 style="font-size:20px;font-weight:700;margin-bottom:10px;text-align:center">💬 Quote</h2>
<p class="q">"<?php echo $qotd; ?>"</p>
</div>

<div class="box">
<h2 style="font-size:20px;font-weight:700;margin-bottom:14px">📧 Contact</h2>
<p style="color:#64748b;margin-bottom:14px"><?php echo $mail; ?></p>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<textarea rows="4" placeholder="Message" required></textarea>
<button type="submit" class="btn">Send</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
echo '<p style="color:#3b82f6;margin-top:12px">✅ Thanks! Ill reply soon.</p>';
}
?>
</div>

</div>

<footer class="foot">
<p>&copy; <?php echo date('Y'); ?> <?php echo $n; ?></p>
</footer>

<script>
let txt = "<?php echo $n; ?>";
let i = 0;
let el = document.getElementById('ty');
function ty(){
if(i <= txt.length){
el.textContent = txt.slice(0,i);
i++;
setTimeout(ty, 110);
}
}
ty();
</script>

</body>
</html>
