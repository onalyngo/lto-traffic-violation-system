<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Check if the violation id exists, for example viewViolationDetails.php?id=1 will get the driver with the id of 1
if (isset($_GET['violation_id'])) {
    // Get the driver from the violations table
    $stmt = $pdo->prepare('SELECT * FROM violations WHERE violation_id = ?');
    
    $stmt->execute([$_GET['violation_id']]);

    $violation = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$violation) {
        exit('Violation doesn\'t exist with that VIOLATION ID!');
    }
} else {
    exit('No VIOLATION ID specified!');
}
?>

<section class="container-xl bg-light py-4 px-5 height" >
    <h3 class="text-center pb-3">View Violation Details # <?=$violation['violation_id']?></h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col" width="20%">Data Type</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Date Created:</td>
                <td><?=date( "d-m-Y h:i A",strtotime($violation['created_at']))?></td>
            </tr>
            <tr>
                <td>Violation Code:</td>
                <td><?=$violation['code']?></td>
            </tr>
            <tr>
                <td>Violation Name:</td>
                <td><?=$violation['name']?></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><?=$violation['description']?></td>
            </tr>
            <tr>
                <td>Penalty:</td>
                <td><?=number_format($violation['penalty'],2)?></td>
            </tr>
        </tbody>
    </table>

    <div class="col pt-5">
        <a class="btn btn-info px-5" href="viewViolations.php">Go Back</a>
    </div>

</section>


<?php include "template/footer.php"?>