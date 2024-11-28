<?php
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

// Obtener los datos del usuario
$user = $_SESSION['user'];

// Manejo de solicitudes POST para agregar o eliminar incapacidades
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Agregar nueva incapacidad
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $reason = $_POST['reason'];

        // Calcular días totales
        $totalDays = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24) + 1;

        // Insertar la incapacidad en la base de datos
        $stmt = $pdo->prepare(
            "INSERT INTO incapacity (startDate, endDate, totalDays, reason, idUser) 
             VALUES (:startDate, :endDate, :totalDays, :reason, :idUser)"
        );
        $stmt->execute([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalDays' => $totalDays,
            'reason' => $reason,
            'idUser' => $user['idPerson']
        ]);
        header("Location: /incapacity");
        exit;
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Eliminar una incapacidad
        $idIncapacity = $_POST['idIncapacity'];

        $stmt = $pdo->prepare("DELETE FROM incapacity WHERE idIncapacity = :idIncapacity AND idUser = :idUser");
        $stmt->execute([
            'idIncapacity' => $idIncapacity,
            'idUser' => $user['idPerson']
        ]);
        header("Location: /incapacity");
        exit;
    }
}

// Obtener todas las incapacidades del usuario
$stmt = $pdo->prepare("SELECT * FROM incapacity WHERE idUser = :idUser");
$stmt->execute(['idUser' => $user['idPerson']]);
$incapacities = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incapacity - WellBeingHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">WellBeingHub</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/vacation">Vacation</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/incapacity">Incapacity</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario para Solicitar Incapacidad -->
    <div class="container mt-5">
        <h2>Request Your Incapacity</h2>
        <form action="/incapacity" method="POST">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <textarea id="reason" name="reason" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <!-- Lista de Incapacidades -->
    <div class="container mt-5">
        <h2>Your Incapacity Records</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Days</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incapacities as $incapacity): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($incapacity['startDate']); ?></td>
                        <td><?php echo htmlspecialchars($incapacity['endDate']); ?></td>
                        <td><?php echo htmlspecialchars($incapacity['totalDays']); ?></td>
                        <td><?php echo htmlspecialchars($incapacity['reason']); ?></td>
                        <td>
                            <!-- Botón para Eliminar -->
                            <form action="/incapacity" method="POST" class="d-inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="idIncapacity" value="<?php echo $incapacity['idIncapacity']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
