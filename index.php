<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Query the SQL statement and get the count of todays record of violation from our records table
$records = $pdo->query("SELECT COUNT(*) FROM records WHERE CAST(created_at as DATE) = CAST(NOW() AS DATE) ")->fetchColumn();
$records_pend = $pdo->query("SELECT COUNT(*) FROM records WHERE status = 0 ")->fetchColumn();
$records_paid = $pdo->query("SELECT COUNT(*) FROM records WHERE status = 1 ")->fetchColumn();

// Query the SQL statement and get the count of data from our drivers table
$drivers = $pdo->query('SELECT COUNT(*) FROM drivers')->fetchColumn();
$driver_new = $pdo->query("SELECT COUNT(*) FROM drivers WHERE CAST(created_at as DATE) = CAST(NOW() AS DATE) ")->fetchColumn();
// Query the SQL statement and get the count of data from our violations table
$violations = $pdo->query('SELECT COUNT(*) FROM violations')->fetchColumn();
?>

<section class="container-xl bg-light py-5 px-5 height">
    <h3 class="text-center">Welcome to <?=Info::agency()?></h3>
    <br>
    <div class="card-deck">
        <div class="card h-100 py-3">
            <img src="src/calendar.jpeg" class="card-img-top w-50 mx-auto" alt="calendar">
            <div class="card-body mt-2 text-center">
                <h5 class="card-title">Today's Record of Traffic Violations</h5>
                <a href="viewRecords.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $records;?></h5></a>
            </div>
        </div>
        <div class="card h-100 py-3">
            <img src="src/directory.jpeg" class="card-img-top w-50 mx-auto" alt="directory">
            <div class="card-body text-center">
                <h5 class="card-title pt-3 pb-1">Total Driver's Listed</h5>
                <a href="viewDrivers.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $drivers;?></h5></a>
            </div>
        </div>
        <div class="card h-100 py-3">
            <img src="src/trafficLight.png" class="card-img-top w-25 my-3 mx-auto" alt="trafficLight">
            <div class="card-body text-center">
                <h5 class="card-title pt-3 pb-1">Total Traffic Violations</h5>
                <a href="viewViolations.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $violations;?></h5></a>
            </div>
        </div>
    </div>

    <div class="card-deck mt-3">
        <div class="card h-100 py-3">
            <img src="src/driver.png" class="card-img-top w-50 mx-auto mt-1" alt="driver">
            <div class="card-body mt-2 text-center">
                <h5 class="card-title">Today's New Driver Listed</h5>
                <a href="viewDrivers.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $driver_new;?></h5></a>
            </div>
        </div>
        <div class="card h-100 py-3">
            <img src="src/pending.jpg" class="card-img-top w-50 mx-auto mt-2 mb-2" alt="calendar">
            <div class="card-body mt-2 text-center">
                <h5 class="card-title">Total Pending Record</h5>
                <a href="viewRecords.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $records_pend;?></h5></a>
            </div>
        </div>
        <div class="card h-100 py-3">
            <img src="src/paid.png" class="card-img-top w-50 mx-auto mt-2 mb-1" alt="directory">
            <div class="card-body text-center">
                <h5 class="card-title pt-3 pb-1">Total Paid Record</h5>
                <a href="viewRecords.php" class="text-decoration-none"><h5 class="font-weight-bold text-info card-text"><?php echo $records_paid;?></h5></a>
            </div>

        </div>
    </div>
</section>

<?php include "template/footer.php";?>