<?php

class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Register a new user.
     */
    public function register($nombre, $apellido, $cedula, $correo, $password, $confirmPassword, $phone, $address, $gender, $birthdate)
    {
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = "Passwords do not match.";
            return false;
        }

        try {
            // Check if the user already exists
            $stmt = $this->pdo->prepare("SELECT * FROM people WHERE Document = :cedula OR Email = :correo");
            $stmt->execute(['cedula' => $cedula, 'correo' => $correo]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Document or email already exists.";
                return false;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into the database
            $stmt = $this->pdo->prepare(
                "INSERT INTO people (Document, Names, Lastname, Email, Phone, Address, Gender, Birthdate, Password) 
                 VALUES (:cedula, :nombre, :apellido, :correo, :phone, :address, :gender, :birthdate, :password)"
            );

            $stmt->execute([
                'cedula' => $cedula,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo' => $correo,
                'phone' => $phone,
                'address' => $address,
                'gender' => $gender,
                'birthdate' => $birthdate,
                'password' => $hashedPassword
            ]);

            $_SESSION['success'] = "Registration successful.";
            return true;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Login a user.
     */
    public function login($username, $password)
    {
        try {
            // Fetch user by email or document
            $stmt = $this->pdo->prepare("SELECT * FROM people WHERE Email = :username OR Document = :username");
            $stmt->execute(['username' => $username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['Password'])) {
                $_SESSION['user'] = $user;
                return true;
            }

            $_SESSION['error'] = "Invalid credentials.";
            return false;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        session_start();
        session_destroy();
    }
}
?>
