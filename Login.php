<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Inventario</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            animation: fadeIn 1s;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
        }
        .btn-login {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: bold;
            background: linear-gradient(to right, #2980b9, #8e44ad);
            border: none;
            transition: transform 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="login-container p-5">
                    <div class="text-center mb-4">
                        <img src="../../Assets/img/Pecosol_logo.jpg" alt="Logo" class="logo">
                        <h2 class="mb-3">Bienvenido</h2>
                    </div>
                    
                    <form action="" method="POST">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="username" class="form-control border-start-0" 
                                       placeholder="Usuario" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-start-0" 
                                       placeholder="Contraseña" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-login">
                                Iniciar Sesión
                            </button>
                        </div>

                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger mt-3 text-center" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
