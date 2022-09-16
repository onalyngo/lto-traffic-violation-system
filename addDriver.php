<?php
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root", [PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8;SET time_zone = 'Europe/Berlin'"]);

$msg= "";
// Check if POST data is not empty
if( !empty( $_POST ) ){
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $driver_id = isset($_POST["driver_id"]) && !empty($_POST["driver_id"]) && $_POST["driver_id"] ? $_POST["driver_id"] : null;

    // Check if POST variables license_no exists, if not default the value to blank, basically the same for all variables
    $license_no = isset($_POST["license_no"]) ? trim($_POST["license_no"]) : null;
    $license_type = isset($_POST["license_type"]) ? trim($_POST["license_type"]) : null;
    $first_name = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : null;
    $last_name = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : null;
    $birth_date = isset($_POST["birth_date"]) ? trim($_POST["birth_date"]) : null;
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : null;
    $email = isset($_POST["email"]) ? filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) : null;
    $street_name = isset($_POST["street_name"]) ? trim($_POST["street_name"]) : null;
    $village_name = isset($_POST["village_name"]) ? trim($_POST["village_name"]) : null;
    $barangay = isset($_POST["barangay"]) ? trim($_POST["barangay"]) : null;
    $city = isset($_POST["city"]) ? trim($_POST["city"]) : null;
    $region = isset($_POST["region"]) ? trim($_POST["region"]) : null;

    // Insert new record into the driver table
    $stmt = $pdo->prepare( " INSERT INTO drivers (license_no, license_type, first_name, last_name, birth_date, phone, email, street_name, village_name, barangay, city, region) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) " );

    $stmt->execute( [ $license_no, $license_type, $first_name, $last_name, $birth_date, $phone, $email, $street_name, $village_name, $barangay, $city, $region ] );
    
    // $msg = "Added driver successfully!";
    // Redirect to viewDriverDetails page
    header('Location: viewDriverDetails.php?driver_id=' . $pdo->lastInsertID());
}

?>

<section class="container-xl bg-light py-4 px-5 height">
    <h5 class=" text-center">Add new driver</h5>
    <hr>
    <form action="addDriver.php" method="post">
        <div class="form-group row ">
            <div class="col-4">
                <label for="license_no">License Number</label>
                <input type="text" class="form-control" name="license_no" id="license_no" placeholder="N10-02-001234" required>
            </div>
            <div class="col-4">
                <label for="license_type">License Type</label>
                <input type="text" class="form-control" name="license_type" id="license_type" placeholder="Professional" required>
            </div>
        </div>    
        <div class="form-group row ">
            <div class="col-4">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
            </div>
        </div>

        <div class="form-group row "> 
            <div class="col-4">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Birth Date" required>
            </div>
            <div class="col-4">
                <label for="phone">Contact Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="09123456789" required>
            </div>
            <div class="col-4">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="janesmith@gmail.com" required>
            </div>
        </div>
        <h5>Address</h5>
        <div class="form-group row ">
            <div class="col-2">
                <input type="text" class="form-control" name="street_name" id="street_name" placeholder="Street Name" required>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="village_name" id="village_name" placeholder="Village Name" required>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" required>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="region" id="region" placeholder="Region" required>
            </div>
        </div>

        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-5">Add Driver</button>
                <a class="btn btn-danger px-5" href="viewDrivers.php">Cancel</a>
            </div>
        </div>
    </form>

    <?php if ($msg): ?>
    <div class="pt-5">
        <p class="text-success font-weight-bold "><?=$msg?></p>
    </div>
    <?php endif; ?>

</section>


<?php include "template/footer.php"?>