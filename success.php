<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'registration'; // Replace with your actual database name
$username = 'root'; // Replace with your actual database username
$password = ''; // Replace with your actual database password

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Fetch registration data for the unique ID
if (isset($_GET['unique_id'])) {
    $unique_id = htmlspecialchars($_GET['unique_id']); // Sanitize input

    $sql = "SELECT * FROM registrations WHERE unique_id = :unique_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':unique_id', $unique_id, PDO::PARAM_STR);
    $stmt->execute();
    $registration = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$registration) {
        echo "No registration found for the provided unique ID.";
        exit;
    }
} else {
    echo "No unique ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Load html2canvas library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0/html2canvas.min.js"></script>

    <style>
        .id-card-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .id-card {
            border: 2px solid #fc843b;
            border-radius: 10px;
            width: 270px;
            background: linear-gradient(to bottom, #ffffff 40%, #fc843b 40%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            height: 50vh;
        }

        .id-card img.logo {
            width: 190px;
            height: 100px;
            border-radius: 25px;
        }

        .id-card .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid #fc843b;
        }

        .id-card button {
            margin-top: 20px;
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .id-card button:hover {
            background-color: #138496;
        }

        p {
            margin-bottom: 0rem;
            font-size: 13px;
        }

        .adress {
            font-size: 10px;
        }

        hr {
            margin: 5px;
        }
        .a-blue{
            color: blue;
        }
    </style>
</head>

<body>

    <div class="id-card-container">
        <div class="id-card" id="idCard">
            <!-- Company Logo -->
            <div class="d-flex justify-content-center">
                <img src="cnclogo.png" alt="Company Logo" class="logo">
            </div>

            <!-- User Photo -->
            <div class="d-flex justify-content-center">
                <img src="profile.png" alt="User Photo" class="photo">
            </div>

            <!-- Unique ID -->
            <p class="unique-id">Unique ID: <span class="a-blue"><?php echo htmlspecialchars($registration['unique_id']); ?></span></p>

            <!-- Name, Qualification, and Course -->
            <p>Name: <span class="a-blue"> <?php echo htmlspecialchars($registration['name']); ?></span></p>
            <p>Qualification: <span class="a-blue"> <?php echo htmlspecialchars($registration['specialization']); ?></span></p>
            <p>Course: <span class="a-blue"><?php echo htmlspecialchars($registration['course']); ?></span></p>
            <hr>
            <h6 class="adress">Address: S-3, Second Floor, Alankar Residency, near Narayana Jr. College, Danavai Peta, Rajamahendravaram, Andhra Pradesh 533103</h6>

            <!-- Button to Download as Image -->
            <button id="downloadBtn">Download as Image</button>
        </div>
    </div>
        <p class="d-none" id="name"><?php echo htmlspecialchars($registration['name']); ?></p>
        <p class="d-none" id="email"><?php echo htmlspecialchars($registration['email']); ?></p>
        <p class="d-none" id="phone"><?php echo htmlspecialchars($registration['phone']); ?></p>
        <p class="d-none" id="city"><?php echo htmlspecialchars($registration['city']); ?></p>
        <p class="d-none" id="specialization"><?php echo htmlspecialchars($registration['specialization']); ?></p>
        <p class="d-none" id="college"><?php echo htmlspecialchars($registration['college']); ?></p>
        <p class="d-none" id="passout"><?php echo htmlspecialchars($registration['passout']); ?></p>
        <p class="d-none" id="status"><?php echo htmlspecialchars($registration['status']); ?></p>
        <p class="d-none" id="course"><?php echo htmlspecialchars($registration['course']); ?></p>
        <p class="d-none" id="availability"><?php echo htmlspecialchars($registration['availability']); ?></p>
        <p class="d-none" id="source"><?php echo htmlspecialchars($registration['source']); ?></p>
        <p class="d-none" id="registration_date"><?php echo htmlspecialchars($registration['registration_date']); ?></p>




    <script>
       var name = document.getElementById('name').innerHTML;
        var email = document.getElementById('email').innerHTML;
        var phone = document.getElementById('phone').innerHTML;
        var city = document.getElementById('city').innerHTML;
        var specialization = document.getElementById('specialization').innerHTML;
        var college = document.getElementById('college').innerHTML;
        var passout = document.getElementById('passout').innerHTML;
        var status = document.getElementById('status').innerHTML;
        var course = document.getElementById('course').innerHTML;
        var availability = document.getElementById('availability').innerHTML;
        var source = document.getElementById('source').innerHTML;
        var registration_date = document.getElementById('registration_date').innerHTML;

        // Print values to the console or use them as needed
        console.log("Name: " + name);
        console.log("Email: " + email);
        console.log("Phone: " + phone);
        console.log("City: " + city);
        console.log("Specialization: " + specialization);
        console.log("College: " + college);
        console.log("Pass Out Year: " + passout);
        console.log("Status: " + status);
        console.log("Course: " + course);
        console.log("Availability: " + availability);
        console.log("Source: " + source);
        console.log("Registration Date: " + registration_date);
     
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const idCard = document.getElementById('idCard');

            // Use html2canvas to capture the ID card as an image
            html2canvas(idCard).then(canvas => {
                const link = document.createElement('a');
                link.download = 'id-card.png'; // File name for the download
                link.href = canvas.toDataURL(); // Convert canvas to image URL
                link.click(); // Trigger the download
            });
        });


        const scriptURL = 'https://script.google.com/macros/s/AKfycbzZ45YeYgaJWFRwlxfeupPYJMx6W7IEF-b318sgPNE6bE-7bZ7hv3ISRMbh0pwte-cAaA/exec'; // Replace with your Google Apps Script URL

        function sendDataToGoogleSheets() {
        const formData = new FormData();
        formData.append('name', name); 
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('city', city);
        formData.append('specialization', specialization);
        formData.append('college', college);
        formData.append('passout', passout);
        formData.append('status', status);
        formData.append('course', course);
        formData.append('availability', availability);
        formData.append('source', source);
        formData.append('registration_date', registration_date);

        // Sending data to Google Sheets
        fetch(scriptURL, { method: 'POST', body: formData })
            .then(response => alert('Data saved successfully!'))
            .catch(error => alert('Error: ' + error.message));
    }

    // Execute the function when the page is loaded
    window.onload = function() {
        sendDataToGoogleSheets();  // Call the function to send data
    };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>