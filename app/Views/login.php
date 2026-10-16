<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SMAN 8 Bandung | Sistem Kedisiplinan</title>
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6.5.2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient background circles */
        .ambient-shape-1 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(99, 102, 241, 0) 70%);
            top: -100px;
            right: -100px;
            pointer-events: none;
        }

        .ambient-shape-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.2) 0%, rgba(14, 165, 233, 0) 70%);
            bottom: -150px;
            left: -150px;
            pointer-events: none;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
            max-width: 440px;
            width: 100%;
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        .login-header {
            padding: 2.25rem 2rem 1.25rem;
            text-align: center;
        }

        .login-badge-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        .login-body {
            padding: 1rem 2rem 2.25rem;
        }

        .form-floating > .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding-left: 2.75rem;
        }

        .form-floating > .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .floating-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            z-index: 4;
        }

        .btn-login {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            color: #ffffff;
            padding: 0.85rem;
            font-weight: 700;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.35);
            transition: all 0.25s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
            transform: translateY(-1px);
            color: #ffffff;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            z-index: 4;
        }
    </style>
</head>
<body>
    <div class="ambient-shape-1"></div>
    <div class="ambient-shape-2"></div>

    <div class="login-card">
        <div class="login-header">
            <div class="login-badge-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">SMAN 8 Bandung</h4>
            <p class="text-muted small mb-0">Sistem Poin Pelanggaran & Sanksi Siswa</p>
        </div>

        <div class="login-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 small py-2 px-3 mb-3 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <div><?= esc(session()->getFlashdata('error')) ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 small py-2 px-3 mb-3 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    <div><?= esc(session()->getFlashdata('success')) ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login/validasiLogin') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="position-relative mb-3">
                    <i class="fa-regular fa-user floating-icon"></i>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        <label for="username" style="padding-left: 2.75rem;">Username / NIP / NIS</label>
                    </div>
                </div>

                <div class="position-relative mb-3">
                    <i class="fa-solid fa-lock floating-icon"></i>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password" style="padding-left: 2.75rem;">Kata Sandi</label>
                    </div>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label text-muted small" for="rememberMe">
                            Ingat saya
                        </label>
                    </div>
                    <span class="badge bg-light text-primary border rounded-pill px-2 py-1 small">v2.0 Modern</span>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk ke Sistem
                </button>
            </form>

            <div class="text-center text-muted small mt-4 pt-2 border-top">
                &copy; <?= date('Y') ?> SMAN 8 Bandung &bull; All Rights Reserved
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (toggleBtn && passwordInput && eyeIcon) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                eyeIcon.classList.toggle('fa-eye', !isPassword);
                eyeIcon.classList.toggle('fa-eye-slash', isPassword);
            });
        }
    </script>
</body>
</html>
