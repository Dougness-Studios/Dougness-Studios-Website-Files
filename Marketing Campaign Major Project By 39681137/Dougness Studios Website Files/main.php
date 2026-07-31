<?php
// 1. Separate configuration variables for security
$host     = 'sql305.infinityfree.com'; 
$port     = '3306'; 
$dbname   = 'if0_41924791_main';
$username = 'if0_41924791';
$password = 'dj9ErQ6nWFbu'; // Note: It is best practice to move this to an environment file later
$charset  = 'utf8mb4';

// 2. Create the Data Source Name (DSN)
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

// 3. Set secure connection options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 4. Ensure the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    // Retrieve, trim, and sanitize form inputs
    $name    = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Basic server-side validation
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: Contact.html?status=empty");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Contact.html?status=invalidemail");
        exit;
    }

    try {
        // Establish database connection
        $pdo = new PDO($dsn, $username, $password, $options);
        
        // Prepare SQL query to insert data
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        
        // Execute the query safely using bound parameters
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':message' => $message
        ]);

        // Redirect back to Contact.html with a success message indicator
        header("Location: Contact.html?status=success");
        exit;

    } catch (PDOException $e) {
        // Log the actual error silently on the server, redirect user with error flag
        error_log("Database Error: " . $e->getMessage());
        header("Location: Contact.html?status=error");
        exit;
    }
} else {
    // If someone tries to access main.php directly without posting, send them back
    header("Location: Contact.html");
    exit;
}
?>
