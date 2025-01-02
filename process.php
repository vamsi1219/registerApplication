<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'registration'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $specialization = $_POST['specialization'];
    $college = $_POST['college'];
    $passout = $_POST['passout'];
    $status = $_POST['status'];
    $course = $_POST['course'];
    $availability = $_POST['availability'];
    $source = $_POST['source'];

    // Function to generate unique ID
    function generateUniqueId($pdo) {
        do {
            $unique_id = 'cncst_' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

            // Check if the ID already exists in the database
            $sql = "SELECT COUNT(*) FROM registrations WHERE unique_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$unique_id]);
            $count = $stmt->fetchColumn();
        } while ($count > 0);

        return $unique_id;
    }

    // Check if email or phone already exists
    function isUnique($pdo, $email, $phone) {
        $sql = "SELECT COUNT(*) FROM registrations WHERE email = ? OR phone = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $phone]);
        return $stmt->fetchColumn() == 0;
    }

    // Check if the email and phone are unique
    if (!isUnique($pdo, $email, $phone)) {
        // Redirect back to the registration page with an error message
        header("Location: index.php?error=Email or phone number is already registered. Please use a different one.");
        exit;
    }

    // Generate a unique ID
    $unique_id = generateUniqueId($pdo);

    // Insert registration data with the unique ID into the database
    $sql = "INSERT INTO registrations (unique_id, name, email, phone, city, specialization, college, passout, status, course, availability, source) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$unique_id, $name, $email, $phone, $city, $specialization, $college, $passout, $status, $course, $availability, $source]);

    // Redirect to the success page with the unique ID
    header("Location: success.php?unique_id=" . $unique_id);
    exit;
}
?>
