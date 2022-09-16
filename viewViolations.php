<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get violations from the violations table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM violations ORDER BY created_at DESC LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the violations to display them in the violation page.
$violations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of violations, this is to determine whether there should be a next and previous button
$num_violations = $pdo->query('SELECT COUNT(*) FROM violations')->fetchColumn();
?>

<section class="container-xl bg-light py-4 px-3 height" >
    <h5 class=" text-center pb-3">View Violations List</h5>
    <hr>
    <a href="addViolation.php" class="btn btn-success mb-3">Create New Violation</a>
    <div class="view">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th scope="col" width="17%">Date Created</th>
                    <th scope="col" width="25%">Name</th>
                    <th scope="col" width="35%">Description</th>
                    <th scope="col" width="10%">Penalty</th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                    <th scope="col" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($violations as $violation): ?>
                <tr>
                    <td><?=date( "d-m-Y h:i A",strtotime($violation['created_at']))?></td>
                    <td><?=$violation['code']. ' - '.$violation['name'] ?></td>
                    <td><?=$violation['description']?></td>
                    <td><?=number_format($violation['penalty'],2)?></td>
                    <td>
                        <a href="viewViolationDetails.php?violation_id=<?=$violation['violation_id']?>" type="submit" class="btn btn-secondary"><i class="fas fa-eye fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="updateViolation.php?violation_id=<?=$violation['violation_id']?>" type="submit" class="btn btn-info "><i class="fas fa-pen fa-xs"></i></a>
                    </td>
                    <td>
                        <a href="deleteViolation.php?violation_id=<?=$violation['violation_id']?>" type="button" class="btn btn-danger"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pr-2">
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a  href="viewViolations.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                <?php endif; ?>
                <?php if ($page*$records_per_page < $num_violations): ?>
                <a href="viewViolations.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php include "template/footer.php"?>