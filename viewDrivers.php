<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Number of records to show on each driver page
$records_per_page = 5;

// Prepare the SQL statement and get data from the drivers table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM drivers ORDER BY driver_id DESC LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the data to display them in the viewDrivers page.
$drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of drivers, this is to determine whether there should be a next and previous button
$num_drivers = $pdo->query('SELECT COUNT(*) FROM drivers')->fetchColumn();

?>

<section class="container-xl bg-light py-4 px-3 height">
    <h5 class=" text-center pb-3">View Drivers List</h5>
    <hr>
    <a href="addDriver.php" class="btn btn-success mb-3">Add New Driver</a>
    <div class="view">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col" width="15%">Date Added</th>
                    <th scope="col" width="15%">License #</th>
                    <th scope="col" width="15%">License Type</th>
                    <th scope="col" width="25%">Full Name</th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drivers as $driver): ?>
                <tr>
                <td><?=date( "d-m-Y h:i A",strtotime($driver['created_at']))?></td>
                    <td><?=$driver['license_no']?></td>
                    <td><?=$driver['license_type']?></td>
                    <td><?=$driver['first_name']. ' '. $driver['last_name']?></td>
                    
                    <td>
                        <a href="viewDriverDetails.php?driver_id=<?=$driver['driver_id']?>" type="submit" class="btn btn-secondary"><i class="fas fa-eye fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="updateDriver.php?driver_id=<?=$driver['driver_id']?>" type="submit" class="btn btn-info"><i class="fas fa-pen fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="deleteDriver.php?driver_id=<?=$driver['driver_id']?>" type="button" class="btn btn-danger"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pr-2">
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a  href="viewDrivers.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                <?php endif; ?>
                <?php if ($page*$records_per_page < $num_drivers): ?>
                <a href="viewDrivers.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php include "template/footer.php"?>