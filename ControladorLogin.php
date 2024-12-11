<?php
session_start(); // Inicia la sesión para gestionar la autenticación del usuario

// Incluir la configuración de la base de datos y el modelo de usuario
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/Config/Database.php';
require_once 'C:/xampp/htdocs/Proyectos/Sistema_De_Inventario_Pecosol/App/Models/Users.php';

class ControladorLogin {
    private $userModel; // Variable para almacenar la instancia del modelo de usuario

    public function __construct($userModel) {
        $this->userModel = $userModel; // Asigna el modelo de usuario proporcionado al controlador
    }

    public function login() {
        // Comprueba si la solicitud es POST (es decir, si se ha enviado el formulario de inicio de sesión)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoge los datos de inicio de sesión del formulario
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Llama al método login del modelo para obtener los datos del usuario
            $user = $this->userModel->login($username, $password);

            // Verifica que el usuario exista y que la contraseña sea correcta
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user; // Guarda la información del usuario en la sesión
                header('Location: ..\Views\Panel_Navegacion.php'); // Redirige al panel de navegación
                exit(); // Finaliza el script después de redirigir
            } else {
                $error = "Datos incorrectos"; // Define un mensaje de error
                include '..\Views\Login.php'; // Muestra la vista de login con el mensaje de error
            }
        } else {
            // Si el método no es POST, muestra la vista de inicio de sesión
            include '..\Views\Login.php';
        }
    }

    // Método para cerrar sesión
    public function logout() {
        session_destroy(); // Destruye la sesión del usuario
        header('Location: ..\public\Index.php'); // Redirige al inicio de sesión
        exit(); // Finaliza el script después de redirigir
    }
}
?>
