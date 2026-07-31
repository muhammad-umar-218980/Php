<?php
$submitted = false;
$formData = [];
$passwordErrors = [];

function validatePassword($password) {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one number";
    }

    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        $errors[] = "Password must contain at least one special character";
    }
    
    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    $formData['fullName'] = $_POST['fullName'] ?? '';
    $formData['email'] = $_POST['email'] ?? '';
    $formData['password'] = $_POST['password'] ?? '';
    $formData['mode'] = $_POST['mode'] ?? 'login';

    if ($formData['mode'] === 'signup' && !empty($formData['password'])) {
        $passwordErrors = validatePassword($formData['password']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PayMint Verse · Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Space Grotesk', sans-serif; }
        body {
            background: #F5F7F4;
            color: #062E23;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        .grid-pattern {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: 
                linear-gradient(rgba(6,46,35,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(6,46,35,0.06) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(circle at center, black 40%, transparent 120%);
            -webkit-mask-image: radial-gradient(circle at center, black 40%, transparent 120%);
        }
        .auth-container {
            background: white;
            border: 1px solid rgba(6,46,35,0.1);
            border-radius: 2rem;
            box-shadow: 0 40px 80px -30px rgba(6,46,35,0.15);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 480px;
            position: relative;
            z-index: 10;
            transition: all 0.7s ease;
        }
        .panel {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            transition: all 0.7s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem 2rem;
        }
        .panel-left {
            left: 0;
            z-index: 20;
        }
        .panel-right {
            left: 50%;
            z-index: 10;
            opacity: 0;
            pointer-events: none;
            transform: translateX(100%);
        }
        .auth-container.signup-active .panel-left {
            transform: translateX(-100%);
            opacity: 0;
            pointer-events: none;
            z-index: 10;
        }
        .auth-container.signup-active .panel-right {
            transform: translateX(0);
            opacity: 1;
            pointer-events: auto;
            z-index: 50;
        }
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            z-index: 100;
            transition: transform 0.7s ease-in-out;
        }
        .auth-container.signup-active .overlay-container {
            transform: translateX(-100%);
        }
        .overlay-bg {
            background: linear-gradient(135deg, #0C4F3C, #059669, #047857);
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.7s ease-in-out;
        }
        .auth-container.signup-active .overlay-bg {
            transform: translateX(50%);
        }
        .overlay-panel {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem 2rem;
            text-align: center;
            transition: transform 0.7s ease-in-out;
        }
        .overlay-left {
            left: 0;
            transform: translateX(0);
        }
        .auth-container.signup-active .overlay-left {
            transform: translateX(0);
        }
        .overlay-right {
            right: 0;
            transform: translateX(0);
        }
        .auth-container.signup-active .overlay-right {
            transform: translateX(20%);
        }
        .auth-input {
            width: 100%;
            background: #F5F7F4;
            border: 1px solid rgba(6,46,35,0.1);
            padding: 0.6rem 1rem;
            border-radius: 0.75rem;
            color: #062E23;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.2s;
        }
        .auth-input:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 1px #059669;
        }
        .auth-input::placeholder {
            color: #94a3b8;
        }
        .auth-input.error {
            border-color: #dc2626;
            box-shadow: 0 0 0 1px #dc2626;
        }
        .btn-primary {
            border-radius: 0.75rem;
            border: 1px solid #062E23;
            background: #062E23;
            color: #F5F7F4;
            font-weight: 700;
            font-size: 12px;
            padding: 0.6rem;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(6,46,35,0.2);
        }
        .btn-primary:hover {
            background: #059669;
            border-color: #059669;
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-primary:disabled {
            opacity: 0.5;
            pointer-events: none;
        }
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(6,46,35,0.15);
            background: white;
            color: #062E23;
            font-weight: 600;
            font-size: 13px;
            padding: 0.6rem;
            width: 100%;
            transition: all 0.2s;
        }
        .btn-google:hover {
            background: #f8fafc;
        }
        .btn-google:active {
            transform: scale(0.98);
        }
        .btn-outline-light {
            border-radius: 0.75rem;
            border: 1px solid rgba(255,255,255,0.8);
            background: transparent;
            color: white;
            font-weight: 700;
            font-size: 12px;
            padding: 0.6rem 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.2s;
            width: 100%;
            max-width: 160px;
        }
        .btn-outline-light:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }
        .btn-outline-light:active {
            transform: scale(0.95);
        }
        .divider {
            display: flex;
            align-items: center;
            width: 100%;
            margin: 1rem 0;
            opacity: 0.6;
        }
        .divider-line {
            flex: 1;
            border-top: 1px solid rgba(6,46,35,0.1);
        }
        .divider-text {
            padding: 0 0.75rem;
            font-size: 12px;
            color: rgba(6,46,35,0.6);
            font-weight: 500;
        }
        .error-msg, .success-msg {
            width: 100%;
            max-width: 320px;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-size: 12px;
            margin-bottom: 0.75rem;
            text-align: left;
        }
        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #dc2626;
        }
        .success-msg {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #059669;
        }
        .password-requirements {
            width: 100%;
            max-width: 320px;
            font-size: 11px;
            color: #64748b;
            margin: 0.25rem 0 0.5rem 0;
            padding-left: 0.25rem;
        }
        .password-requirements .req {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin: 0.1rem 0;
        }
        .password-requirements .req i {
            font-size: 10px;
        }
        .password-requirements .req.valid {
            color: #059669;
        }
        .password-requirements .req.invalid {
            color: #dc2626;
        }
        .back-home {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            color: rgba(6,46,35,0.6);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 200;
            transition: color 0.2s;
        }
        .back-home:hover {
            color: #062E23;
        }
        .back-home:hover i {
            transform: translateX(-4px);
        }
        @media (max-width: 640px) {
            .panel { width: 100%; left: 0 !important; padding: 1.5rem; }
            .panel-left { z-index: 20; }
            .panel-right { left: 0; transform: translateX(100%); }
            .auth-container.signup-active .panel-left { transform: translateX(-100%); }
            .auth-container.signup-active .panel-right { transform: translateX(0); }
            .overlay-container { display: none; }
            .auth-container { min-height: 560px; }
        }
    </style>
</head>
<body>

    <div class="auth-container" id="authContainer">
        <div class="panel panel-left" id="panelLogin">
            <div class="flex flex-col items-center justify-center w-full max-w-[320px]">
                <div class="flex items-center gap-3 mb-2">
                    <img src="green logo.png" alt="Logo" class="w-12 h-12"  />
                    <span class="font-space text-3xl font-bold text-[#062E23]">Pay<span class="text-[#059669]">Mint</span> Verse</span>
                </div>
                <h1 class="font-space font-bold text-xl text-[#062E23] tracking-tight mb-1">Login</h1>
                <p class="text-[12px] text-[#062E23]/60 mb-4 font-medium">Split expenses with friends effortlessly</p>
                <?php if ($submitted && $formData['mode'] === 'login'): ?>
                    <?php if (!empty($formData['email']) && !empty($formData['password'])): ?>
                        <div class="success-msg"><i class="fas fa-check-circle mr-1"></i> Login successful</div>
                    <?php else: ?>
                        <div class="error-msg"><i class="fas fa-exclamation-circle mr-1"></i> Please fill all fields</div>
                    <?php endif; ?>
                <?php endif; ?>
                <form method="POST" class="w-full max-w-[320px] flex flex-col items-center" id="loginForm">
                    <input type="hidden" name="mode" value="login" />
                    <input type="email" name="email" placeholder="Email" class="auth-input mb-3" required />
                    <div class="relative w-full mb-1">
                        <input type="password" name="password" placeholder="Password" class="auth-input" id="loginPassword" required />
                        <button type="button" onclick="togglePassword('loginPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#062E23] transition"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="w-full text-right mb-4"><a href="#" class="text-[11px] text-[#062E23]/60 hover:text-[#059669] transition font-medium">Forgot Password?</a></div>
                    <button type="submit" class="btn-primary">Login</button>
                    <div class="divider"><div class="divider-line"></div><span class="divider-text">OR</span><div class="divider-line"></div></div>
                    <button type="button" class="btn-google" onclick="alert('Google OAuth placeholder')">
                        <svg viewBox="0 0 24 24" class="w-4 h-4"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                        Continue with Google
                    </button>
                </form>
            </div>
        </div>

        <div class="panel panel-right" id="panelSignup">
            <div class="flex flex-col items-center justify-center w-full max-w-[320px]">
                <div class="flex items-center gap-3 mb-2">
                    <img src="green logo.png" alt="Logo" class="w-12 h-12" />
                    <span class="font-space text-3xl font-bold text-[#062E23]">Pay<span class="text-[#059669]">Mint</span> Verse</span>
                </div>
                <h1 class="font-space font-bold text-xl mb-3 text-[#062E23] tracking-tight">Create your account</h1>
                
                <?php if ($submitted && $formData['mode'] === 'signup'): ?>
                    <?php if (!empty($formData['fullName']) && !empty($formData['email']) && !empty($formData['password'])): ?>
                        <?php if (empty($passwordErrors)): ?>
                            <div class="success-msg"><i class="fas fa-check-circle mr-1"></i> Account created successfully!</div>
                        <?php else: ?>
                            <div class="error-msg"><i class="fas fa-exclamation-circle mr-1"></i> Please fix the password issues</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="error-msg"><i class="fas fa-exclamation-circle mr-1"></i> Please fill all fields</div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <form method="POST" class="w-full max-w-[320px] flex flex-col items-center" id="signupForm">
                    <input type="hidden" name="mode" value="signup" />
                    <input type="text" name="fullName" placeholder="Full Name" class="auth-input mb-2" required />
                    <input type="email" name="email" placeholder="Email" class="auth-input mb-2" required />
                    <div class="relative w-full mb-1">
                        <input type="password" name="password" placeholder="Password" class="auth-input <?php echo (!empty($passwordErrors)) ? 'error' : ''; ?>" id="signupPassword" required />
                        <button type="button" onclick="togglePassword('signupPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#062E23] transition"><i class="fas fa-eye"></i></button>
                    </div>
                    
                    <div class="password-requirements">
                        <div class="req <?php echo (isset($formData['password']) && strlen($formData['password']) >= 8) ? 'valid' : 'invalid'; ?>">
                            <i class="fas fa-<?php echo (isset($formData['password']) && strlen($formData['password']) >= 8) ? 'check-circle' : 'circle'; ?>"></i>
                            At least 8 characters
                        </div>
                        <div class="req <?php echo (isset($formData['password']) && preg_match('/[0-9]/', $formData['password'])) ? 'valid' : 'invalid'; ?>">
                            <i class="fas fa-<?php echo (isset($formData['password']) && preg_match('/[0-9]/', $formData['password'])) ? 'check-circle' : 'circle'; ?>"></i>
                            At least one number
                        </div>
                        <div class="req <?php echo (isset($formData['password']) && preg_match('/[^a-zA-Z0-9]/', $formData['password'])) ? 'valid' : 'invalid'; ?>">
                            <i class="fas fa-<?php echo (isset($formData['password']) && preg_match('/[^a-zA-Z0-9]/', $formData['password'])) ? 'check-circle' : 'circle'; ?>"></i>
                            At least one special character
                        </div>
                    </div>
                    
                    <?php if (!empty($passwordErrors)): ?>
                        <div class="error-msg" style="margin-top: 0.25rem;">
                            <?php foreach ($passwordErrors as $error): ?>
                                <div><i class="fas fa-times-circle mr-1"></i> <?php echo $error; ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="relative w-full mb-4">
                        <input type="password" name="confirmPassword" placeholder="Confirm Password" class="auth-input" id="confirmPassword" required />
                        <button type="button" onclick="togglePassword('confirmPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#062E23] transition"><i class="fas fa-eye"></i></button>
                    </div>
                    <button type="submit" class="btn-primary">Create Account</button>
                    <div class="divider"><div class="divider-line"></div><span class="divider-text">OR</span><div class="divider-line"></div></div>
                    <button type="button" class="btn-google" onclick="alert('Google OAuth placeholder')">
                        <svg viewBox="0 0 24 24" class="w-4 h-4"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                        Continue with Google
                    </button>
                </form>
            </div>
        </div>

        <div class="overlay-container">
            <div class="overlay-bg">
                <div class="overlay-panel overlay-left">
                    <h1 class="font-space font-bold text-3xl mb-3 text-white tracking-tight leading-tight">Welcome Back!</h1>
                    <p class="text-white/90 text-[13px] mb-6 leading-[1.6] font-medium max-w-[250px]">Already have an account? Login to keep connected with your groups.</p>
                    <button class="btn-outline-light" onclick="switchToLogin()">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="font-space font-bold text-3xl mb-3 text-white tracking-tight leading-tight">Hello, Friend!</h1>
                    <p class="text-white/90 text-[13px] mb-6 leading-[1.6] font-medium max-w-[250px]">Don't have an account? Sign up to start tracking shared expenses with us.</p>
                    <button class="btn-outline-light" onclick="switchToSignup()">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchToSignup() {
            document.getElementById('authContainer').classList.add('signup-active');
        }
        function switchToLogin() {
            document.getElementById('authContainer').classList.remove('signup-active');
        }
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                btn.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
        

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('signupPassword');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const requirements = document.querySelectorAll('.password-requirements .req');

                    if (requirements.length >= 3) {

                        const req1 = requirements[0];
                        const isValid1 = password.length >= 8;
                        req1.className = 'req ' + (isValid1 ? 'valid' : 'invalid');
                        req1.innerHTML = '<i class="fas fa-' + (isValid1 ? 'check-circle' : 'circle') + '"></i> At least 8 characters';
                        
                        const req2 = requirements[1];
                        const isValid2 = /[0-9]/.test(password);
                        req2.className = 'req ' + (isValid2 ? 'valid' : 'invalid');
                        req2.innerHTML = '<i class="fas fa-' + (isValid2 ? 'check-circle' : 'circle') + '"></i> At least one number';

                        const req3 = requirements[2];
                        const isValid3 = /[^a-zA-Z0-9]/.test(password);
                        req3.className = 'req ' + (isValid3 ? 'valid' : 'invalid');
                        req3.innerHTML = '<i class="fas fa-' + (isValid3 ? 'check-circle' : 'circle') + '"></i> At least one special character';
                    }
                });
            }
        });
        
        (function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('mode') === 'signup') switchToSignup();
        })();
        <?php if ($submitted && $formData['mode'] === 'signup'): ?>
        document.addEventListener('DOMContentLoaded', function() { switchToSignup(); });
        <?php endif; ?>
    </script>
</body>
</html>