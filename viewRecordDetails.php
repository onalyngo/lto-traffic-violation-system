<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Check if the record id exists, for example viewRecordDetails.php?id=1 will get the driver with the id of 1
if (isset($_GET['record_id'])) {
    // Prepare the SQL statement and get the data from the records table
    $stmt = $pdo->prepare(
        'SELECT d.first_name, d.last_name, d.license_no, 
        v.code, v.name, v.penalty, 
        r.record_id, r.created_at, r.ticket_no, r.enforcer_id, r.enforcer_name, r.status 
        FROM records r, drivers d, violations v 
        WHERE
            d.driver_id = r.driver_id
        AND r.violation_id = v.violation_id
        AND record_id = ?'
    );
    
    $stmt->execute([$_GET['record_id']]);

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$record) {
        exit('Record doesn\'t exist with that VIOLATION ID!');
    }
} else {
    exit('No RECORD ID specified!');
}
?>

<section class="container-xl bg-light py-4 px-5 height" >
    <h3 class="text-center pb-3">View Record Details # <?=$record['record_id']?></h3>
    <div class="row ">
        <div class="col-2"></div>
        <div class="col-8">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="50%">Data Type</th>
                        <th scope="col" width="50%">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Incident Date:</td>
                        <td><?=date( "d-m-Y h:i A",strtotime($record['created_at']))?></td>
                    </tr>
                    <tr>
                        <td>Ticket Number:</td>
                        <td><?=$record['ticket_no']?></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <?php if ( $record ['status'] == 1): ?>
                                <span class="text-success">Paid</span>
                            <?php else: ?>
                                <span class="text-danger">Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Enforcer ID:</td>
                        <td><?=$record['enforcer_id']?></td>
                    </tr>
                    <tr>
                        <td>Enforcer Name:</td>
                        <td><?=$record['enforcer_name']?></td>
                    </tr>
                    <tr>
                        <td>Driver's License Number:</td>
                        <td><?=$record['license_no']?></td>
                    </tr>
                    <tr>
                        <td>Driver's Name:</td>
                        <td><?=$record['first_name']." ".$record['last_name']?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="col-2"></div>
    </div>
    <hr>
    <div class="col">
        <h5>List of Violation</h5>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" width="">Code</th>
                    <th scope="col" width="">Name</th>
                    <th scope="col" width="">Penalty</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td><?=$record['code']?></td>
                    <td><?=$record['name']?></td>
                    <td><?=number_format($record['penalty'],2)?></td>
                </tr>
            
            </tbody>
        </table>
    </div>
    
    <div class="col pt-5">
        <a class="btn btn-info px-5" href="viewRecords.php">Go Back</a>
    </div>

</section>


<?php include "template/footer.php"?>