<?php
// 1. Define connection variables
$host     = 'sql305.infinityfree.com'; 
$port     = '3306'; // Default MySQL port is 3306
$dbname   = 'if0_41924791_main';
$username = 'if0_41924791';
$password = 'dj9ErQ6nWFbu';
$charset  = 'utf8mb4';

// 2. Create the Data Source Name (DSN) including the port
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

// 3. Set secure connection options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 4. Establish the connection & handle form submission
try {
    $pdo = new PDO($dsn, $username, $password, $options);
    
    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize form inputs
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Prepare SQL query to insert data (adjust 'contacts' to match your actual table name)
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        
        // Execute the query passing the data safely
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':message' => $message
        ]);

        echo "<p>Thank you, your message has been sent successfully!</p>";
    }

} catch (PDOException $e) {
    // Hide sensitive connection details in production, show error only if needed for debugging
    die("Database error: " . $e->getMessage());
}
?>