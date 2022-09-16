<?php
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg = '';

// Check that the Record ID exists
if (isset($_GET['record_id'])) {

    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM records WHERE record_id = ?');
    $stmt->execute([$_GET['record_id']]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$record) {
        exit('Violation doesn\'t exist with that Violation ID!');
    }
    // Confirms before deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            
            // Clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM records WHERE record_id = ?');
            $stmt->execute([$_GET['record_id']]);
            $msg = 'You have deleted the record details!';
        } else {
            // Clicked the "No" button, redirect them back to the viewRecords page
            header('Location: viewRecords.php');
            exit;
        }
    }
} else {
    exit('No RECORD ID specified!');
}
?>

<section class="container-xl bg-light py-5 px-3 height">
    <div class="delete text-center">
        <h5 class="text-muted">Delete Record #: <?=$record['record_id']?></h5>
    <?php if ($msg): ?>
            <p><?=$msg?></p>
    <?php else: ?>
        <p>Are you sure you want to delete record # <?=$record['record_id']?>?</p>
        <div class="yesno pt-4">
            <a class="bg-danger rounded p-3" href="deleteRecord.php?record_id=<?=$record['record_id']?>&confirm=yes">Yes</a>
            <a class="bg-info rounded p-3" href="deleteRecord.php?record_id=<?=$record['record_id']?>&confirm=no">No</a>
        </div>    
    <?php endif; ?>
    </div>
</section>


<?php include "template/footer.php"?>