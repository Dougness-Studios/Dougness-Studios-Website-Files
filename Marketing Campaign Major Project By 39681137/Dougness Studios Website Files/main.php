<?php
// 1. Separate configuration variables for security
$host     = 'sql305.byetcluster.com'; 
$port     = '3306'; 
$dbname   = 'if0_41924791_main';
$username = 'if0_41924791';
$password = 'dj9ErQ6nWFbu'; 
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// FIXED: Only check for POST request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name    = htmlspecialchars(strip_tags(trim($_POST['name'] ?? '')));
    $email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));

    if (empty($name) || empty($email) || empty($message)) {
        header("Location: Contact.html?status=empty");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Contact.html?status=invalidemail");
        exit;
    }

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':message' => $message
        ]);

        header("Location: Contact.html?status=success");
        exit;

    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: Contact.html?status=error");
        exit;
    }
} else {
    header("Location: Contact.html");
    exit;
}
?>
