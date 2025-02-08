<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'helper.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi | ACBOZ Panel</title>
    <link rel="stylesheet" href="admin/assets/css/styles.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            color: #2A3547;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #DFE5EF;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #5D87FF;
            box-shadow: 0 0 0 0.2rem rgba(93, 135, 255, .25);
        }

        .btn-login {
            background: #1976d2;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #1565c0;
            transform: translateY(-1px);
        }

        .login-image {
            background: linear-gradient(rgba(13, 71, 161, 0.7), rgba(25, 118, 210, 0.8)),
                url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80') center/cover;
            border-radius: 1rem 0 0 1rem;
            min-height: 500px;
            position: relative;
            overflow: hidden;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(25, 118, 210, 0.3) 0%, rgba(13, 71, 161, 0.1) 100%);
        }

        .login-image-content {
            position: relative;
            z-index: 1;
            padding: 2rem;
        }

        .login-logo {
            width: 180px;
            height: auto;
            margin-bottom: 2.5rem;
            filter: brightness(0) invert(1);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0 0;
            text-align: left;
        }

        .feature-list li {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 15px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            margin-bottom: 15px;
            transform: translateX(0);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            color: #fff;
            font-size: 1.1rem;
        }

        .feature-list i {
            margin-right: 10px;
            color: #1976d2;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px;
            border-radius: 50%;
            font-size: 1rem;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .brand-logo {
            width: 120px;
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #5A6A85;
        }

        .footer-links {
            margin-top: 2rem;
        }

        .footer-links a {
            color: #5A6A85;
            text-decoration: none;
            margin-right: 1rem;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: #5D87FF;
        }

        img {
            mix-blend-mode: exclusion;
        }

        .feature-list li:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.15);
        }
    </style>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-xl-10">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block login-image">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="login-image-content text-white">
                                    <div class="text-center">
                                        <img src="admin/images/logo.png"
                                            alt="Admin Logo" class="align-self-center " height="200">

                                    </div>
                                    <h2 class="mb-4">ACBOZ Yönetim Paneli</h2>
                                    <p class="mb-4">Profesyonel web site yönetim araçlarıyla işinizi kolaylaştırın</p>

                                    <ul class="feature-list">
                                        <li>
                                            <i class="fas fa-rocket"></i>
                                            Hızlı ve Kolay Yönetim
                                        </li>
                                        <li>
                                            <i class="fas fa-chart-line"></i>
                                            Detaylı İstatistikler
                                        </li>
                                        <li>
                                            <i class="fas fa-shield-alt"></i>
                                            Güvenli Altyapı
                                        </li>
                                        <li>
                                            <i class="fas fa-headset"></i>
                                            7/24 Teknik Destek
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-5">
                                <?php if (isset($_SESSION['error'])): ?>
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['success'])): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <?php
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <div class="text-center mb-4">
                                    <img src="admin/images/logo.png" alt="" class="brand-logo">
                                    <h4 class="login-title">Admin Girişi</h4>

                                </div>


                                <form method="POST" action="<?= Helper::routers("login") ?>">
                                    <div class="mb-4">
                                        <label class="form-label" for="username">
                                            <i class="fas fa-user me-2"></i>Kullanıcı Adı
                                        </label>
                                        <input type="text" id="username" name="username"
                                            class="form-control" required
                                            placeholder="Kullanıcı adınızı girin" />
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="password">
                                            <i class="fas fa-lock me-2"></i>Şifre
                                        </label>
                                        <input type="password" id="password" name="password"
                                            class="form-control" required
                                            placeholder="Şifrenizi girin" />
                                    </div>

                                    <button type="submit" class="btn btn-login text-white w-100">
                                        Giriş Yap
                                    </button>

                                    <div class="footer-links text-center">
                                        <a href="#"><i class="fas fa-shield-alt me-1"></i>Gizlilik Politikası</a>
                                        <a href="#"><i class="fas fa-file-contract me-1"></i>Kullanım Koşulları</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>