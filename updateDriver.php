<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg= "";

// Check if the driver id exists, for example updateDriver.php?id=1 will get the driver with the id of 1
if (isset($_GET['driver_id'])) {
    if( !empty( $_POST ) ){
        // Post data not empty update the existing data
        // Set-up the variables that are going to be updated, must check if the POST variables exist if not we can default them to blank
        $driver_id = isset($_POST["driver_id"]) ? $_POST["driver_id"] : null;
        $license_no = isset($_POST["license_no"]) ? trim($_POST["license_no"]) : null;
        $license_type = isset($_POST["license_type"]) ? trim($_POST["license_type"]) : null;
        $first_name = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : null;
        $last_name = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : null;
        $birth_date = isset($_POST["birth_date"]) ? trim($_POST["birth_date"]) : null;
        $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : null;
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
        $street_name = isset($_POST["street_name"]) ? trim($_POST["street_name"]) : null;
        $village_name = isset($_POST["village_name"]) ? trim($_POST["village_name"]) : null;
        $barangay = isset($_POST["barangay"]) ? trim($_POST["barangay"]) : null;
        $city = isset($_POST["city"]) ? trim($_POST["city"]) : null;
        $region = isset($_POST["region"]) ? trim($_POST["region"]) : null;

        // Update the data into drivers table
        $stmt = $pdo->prepare( " UPDATE drivers SET license_no = ?, license_type = ?, first_name = ?, last_name = ?, birth_date = ?, phone = ?, email = ?, street_name = ?, village_name = ?, barangay = ?, city = ?, region = ?  WHERE driver_id = ? " );
        
        $stmt->execute( [ $license_no, $license_type, $first_name, $last_name, $birth_date, $phone, $email, $street_name, $village_name, $barangay, $city, $region, $_GET["driver_id"]] );
        
        $msg = "Updated driver details successfully!";
    }

    // Get the driver from the drivers table
    $stmt = $pdo->prepare('SELECT * FROM drivers WHERE driver_id = ?');
    
    $stmt->execute([$_GET['driver_id']]);

    $driver = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo $driver["last_name"];
    if (!$driver) {
        exit('Driver doesn\'t exist with that DRIVER ID!');
    }
} else {
    exit('No DRIVER ID specified!');
}

?>

<section class="container-xl bg-light py-4 px-5 height">
    <h5 class="text-center pb-3">Update Driver #<?=$driver['driver_id']?></h5>
    <hr>
    <form action="updateDriver.php?driver_id=<?=$driver["driver_id"]?>" method="post">
        <div class="form-group row ">
            <div class="col-4">
                <label for="license_no">License Number</label>
                <input type="text" class="form-control"  name="license_no" id="license_no" value="<?=$driver['license_no']?>" required>
            </div>
            <div class="col-4">
                <label for="license_type">License Type</label>
                <input type="text" class="form-control" name="license_type" id="license_type" value="<?=$driver['license_type']?>" required>
            </div>
        </div>    
        <div class="form-group row ">
            <div class="col-4">
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$driver['first_name']?>" required>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$driver['last_name']?>" required>
            </div>
        </div>

        <div class="form-group row "> 
            <div class="col-4">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date" value="<?=$driver['birth_date']?>" required>
            </div>
            <div class="col-4">
                <label for="phone">Contact Number</label>
                <input type="tel" class="form-control" name="phone" id="phone" value="<?=$driver['phone']?>" required>
            </div>
            <div class="col-4">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?=$driver['email']?>" required>
            </div>
        </div>
        <h5>Address</h5>
        <div class="form-group row ">
            <div class="col-2">
                <input type="text" class="form-control" name="street_name" id="street_name" value="<?=$driver['street_name']?>" required>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="village_name" id="village_name" value="<?=$driver['village_name']?>" required>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="barangay" id="barangay" value="<?=$driver['barangay']?>" required>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="city" id="city" value="<?=$driver['city']?>" required>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" name="region" id="region" value="<?=$driver['region']?>" required>
            </div>
        </div>

        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-5">Save</button>
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