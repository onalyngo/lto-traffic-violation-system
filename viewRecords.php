<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Number of records to show on each record page
$records_per_page = 5;

// Prepare the SQL statement and get data from the records table, LIMIT will determine the page
$stmt = $pdo->prepare(
    'SELECT d.first_name, d.last_name, d.license_no, 
    v.code, v.name, v.penalty, 
    r.record_id, r.created_at, r.ticket_no, r.enforcer_id, r.enforcer_name, r.status 
    FROM records r, drivers d, violations v 
    WHERE
        d.driver_id = r.driver_id
    AND r.violation_id = v.violation_id
    ORDER BY r.created_at 
    DESC LIMIT :current_page, :record_per_page');

$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records to display them in the viewRecords page.
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of records, this is to determine whether there should be a next and previous button
$num_records = $pdo->query('SELECT COUNT(*) FROM records')->fetchColumn();

?>

<section class="container-xl bg-light py-4 px-3 height">
    <h5 class=" text-center pb-3">View Records List</h5>
    <hr>
    <a href="addRecord.php" class="btn btn-success mb-3">Create New Record</a>
    <div class="">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th scope="col" width="17%">Incident Date</th>
                    <th scope="col" width="15%">Ticket Number</th>
                    <th scope="col" width="15%">License Number</th>
                    <th scope="col" width="25%">Officer</th>
                    <th scope="col" width="10%">Status</th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?=date( "d-m-Y h:i A",strtotime($record['created_at']))?></td>
                    <td><?=$record['ticket_no'] ?></td>
                    <td><?=$record['license_no']?></td>
                    <td><?=$record['enforcer_name']?></td>
                    <td>
                        <?php if ( $record ['status'] == 1): ?>
                            <span class="text-success">Paid</span>
                        <?php else: ?>
                            <span class="text-danger">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="viewRecordDetails.php?record_id=<?=$record['record_id']?>" type="submit" class="btn btn-secondary"><i class="fas fa-eye fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="updateRecord.php?record_id=<?=$record['record_id']?>" type="submit" class="btn btn-info "><i class="fas fa-pen fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="deleteRecord.php?record_id=<?=$record['record_id']?>" type="button" class="btn btn-danger"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>

        <div class="pr-2">
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a  href="viewRecords.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                <?php endif; ?>
                <?php if ($page*$records_per_page < $num_records): ?>
                <a href="viewRecords.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php include "template/footer.php"?>