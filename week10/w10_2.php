<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Checker - PHP Implementation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        select, button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            font-weight: bold;
        }
        .error {
            background-color: #ffecec;
            color: #ff4d4d;
        }
        .success {
            background-color: #e7f5e7;
            color: #2c7a2c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Visa Requirement Checker</h1>
        
        <form action="process.php" method="post">
            <label for="country">Select your country:</label>
            <select id="country" name="country">
                <option value="">--Select a country--</option>
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="India">India</option>
                <option value="UK">UK</option>
                <option value="Australia">Australia</option>
            </select>
            
            <button type="submit">Check Visa</button>
        </form>
        
        <?php if (isset($_GET['message']) && isset($_GET['status'])): ?>
            <div class="result <?php echo $_GET['status']; ?>">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    
    if (empty($country)) {
        header("Location: index.php?message=Invalid country selection.&status=error");
        exit;
    }
    
    $message = '';
    
    switch ($country) {
        case 'USA':
            $message = 'Visa required for most applicants.';
            break;
        case 'Canada':
            $message = 'Visa required unless you have an eTA.';
            break;
        case 'India':
            $message = 'Visa required before travel.';
            break;
        case 'UK':
            $message = 'Visa depends on the duration of stay.';
            break;
        case 'Australia':
            $message = 'eVisa available for eligible travelers.';
            break;
        default:
            header("Location: index.php?message=Invalid country selection.&status=error");
            exit;
    }
    
    header("Location: index.php?message=" . urlencode($message) . "&status=success");
    exit;
}

header("Location: index.php");
exit;
?>