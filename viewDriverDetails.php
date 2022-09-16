<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Check if the driver id exists, for example viewViolationDetails.php?id=1 will get the driver with the id of 1
if (isset($_GET['driver_id'])) {
    // Get the driver from the drivers table
    $stmt = $pdo->prepare('SELECT * FROM drivers WHERE driver_id = ?');
    
    $stmt->execute([$_GET['driver_id']]);

    $driver = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$driver) {
        exit('Driver doesn\'t exist with that DRIVER ID!');
    }
} else {
    exit('No DRIVER ID specified!');
}
?>

<section class="container-xl bg-light py-4 px-5 height" >
    <h3 class="text-center pb-3">View Driver Details # <?=$driver['driver_id']?></h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="20%">Data Type</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>License Number:</td>
                <td><?=$driver['license_no']?></td>
            </tr>
            <tr>
                <td>License Type:</td>
                <td><?=$driver['license_type']?></td>
            </tr>
            <tr>
                <td>Full Name:</td>
                <td><?=$driver['first_name'] . " " . $driver['last_name']?></td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td><?=$driver['birth_date']?></td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td><?=$driver['phone']?></td>
            </tr>
            <tr>
                <td>Email Address:</td>
                <td><?=$driver['email']?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?=$driver['street_name'] . ", " . $driver['village_name'] . ", " .  $driver['barangay'] . ", " .  $driver['city'] . ", " .  $driver['region']?></td>
            </tr>
        </tbody>
    </table>

    <div class="col pt-5">
        <a class="btn btn-info px-5" href="viewDrivers.php">Go Back</a>
    </div>

</section>


<?php include "template/footer.php"?>