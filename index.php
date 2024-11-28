<?php
# App initialization
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Auth.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

# Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$auth = new Auth($pdo);
session_start();

# Handle routing
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['fullname'];
            $apellido = $_POST['lastname'];
            $cedula = $_POST['document'];
            $correo = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $phone = $_POST['phone'] ?? null;
            $address = $_POST['address'] ?? null;
            $gender = $_POST['gender'] ?? null;
            $birthdate = $_POST['birthdate'] ?? null;

            if ($auth->register($nombre, $apellido, $cedula, $correo, $password, $confirmPassword, $phone, $address, $gender, $birthdate)) {
                header("Location: /login?registered=success");
                exit;
            } else {
                include __DIR__ . '/views/register.php';
            }
        } else {
            include __DIR__ . '/views/register.php';
        }
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($auth->login($username, $password)) {
                header("Location: /dashboard");
                exit;
            } else {
                include __DIR__ . '/views/login.php';
            }
        } else {
            include __DIR__ . '/views/login.php';
        }
        break;

    case '/dashboard':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        include __DIR__ . '/views/dashboard.php';
        break;

    case '/vacation':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        include __DIR__ . '/views/vacation.php';
        break;

    case '/incapacity':
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        include __DIR__ . '/views/incapacity.php';
        break;

    case '/logout':
        $auth->logout();
        header("Location: /login");
        exit;

    default:
        header("HTTP/1.0 404 Not Found");
        include __DIR__ . '/views/404.php';
        exit;
}
?>
