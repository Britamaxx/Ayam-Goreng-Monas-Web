<?php
session_start();
include "conn2.php";

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: Admin/dashboard/dashboard_admin.php");
    exit();
}

$error = "";


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ayam Goreng Monas</title>
    <script src="https://unpkg.com/feather-icons">
    </script>
    <script
        src="https://challenges.cloudflare.com/turnstile/v0/api.js"
        async
        defer
        ></script>
    <link rel="preconnect" href="https://challenges.cloudflare.com">
    <script src="login.js" defer></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: #ffffff;
            border-radius: 20px;
            border: 2px solid #E5E7EB;
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #DC2626 0%, #F97316 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.95;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input:focus {
            border-color: #F97316;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            pointer-events: none;
        }

        .input-wrapper input:focus + .input-icon {
            color: #F97316;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #DC2626 0%, #F97316 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            background: #FEE2E2;
            color: #DC2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .login-footer {
            text-align: center;
            padding: 20px 30px 30px;
            font-size: 13px;
            color: #6B7280;
        }

        .login-footer a {
            color: #F97316;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Ayam Goreng Monas</h1>
            <p>Login Admin Dashboard</p>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                    <span><?= htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="validasiogin.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            placeholder="Masukkan username"
                            required
                            autofocus
                        >
                        <i data-feather="user" class="input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password"
                            required
                        >
                        <i data-feather="lock" class="input-icon"></i>
                    </div>
                </div>
                <div class="cf-turnstile" data-sitekey="0x4AAAAAACD8dRUDmBb53ykT" style="text-align: center"></div>
                <button type="submit" class="btn-login">
                    Masuk Dashboard
                </button>
            </form>
        </div>

        <div class="login-footer">
            Belum punya akun? <a href="#">Hubungi Administrator</a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>