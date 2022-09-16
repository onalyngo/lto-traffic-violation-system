<?php
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg = '';

// Check that the Driver ID exists
if (isset($_GET['violation_id'])) {

    // Select the data that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM violations WHERE violation_id = ?');
    $stmt->execute([$_GET['violation_id']]);
    $violation = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$violation) {
        exit('Violation doesn\'t exist with that Violation ID!');
    }
    // Confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            
            // Clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM violations WHERE violation_id = ?');
            $stmt->execute([$_GET['violation_id']]);
            $msg = 'You have deleted the violation details!';
        } else {
            // Clicked the "No" button, redirect them back to the view page
            header('Location: viewViolations.php');
            exit;
        }
    }
} else {
    exit('No VIOLATION ID specified!');
}
?>

<section class="container-xl bg-light py-5 px-3 height">
    <div class="delete text-center">
        <h5 class="text-muted">Delete Violation Code: <?=$violation['code']?></h5>
        <?php if ($msg): ?>
            <p><?=$msg?></p>
        <?php else: ?>

        <p>Are you sure you want to delete violation # <?=$violation['violation_id']?>?</p>
        
        <div class="yesno pt-4">
            <a class="bg-danger rounded p-3" href="deleteViolation.php?violation_id=<?=$violation['violation_id']?>&confirm=yes">Yes</a>
            <a class="bg-info rounded p-3" href="deleteViolation.php?violation_id=<?=$violation['violation_id']?>&confirm=no">No</a>
        </div>
        
        <?php endif; ?>
    </div>
</section>


<?php include "template/footer.php"?>