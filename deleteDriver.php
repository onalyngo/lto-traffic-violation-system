<?php
require_once "template/header.php";
require_once "classes/DBCon.php";

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg = '';

// Check that the Driver ID exists
if (isset($_GET['driver_id'])) :

    // Select the data that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM drivers WHERE driver_id = ?');
    $stmt->execute([$_GET['driver_id']]);
    $driver = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$driver) :
        exit('Driver doesn\'t exist with that DRIVER ID!');
    endif;
    // Confirms before deletion
    if (isset($_GET['confirm'])) :
        if ($_GET['confirm'] == 'yes') :
            
            // Clicked the "Yes" button, delete data
            $stmt = $pdo->prepare('DELETE FROM drivers WHERE driver_id = ?');
            $stmt->execute([$_GET['driver_id']]);
            $msg = 'You have deleted the driver details!';
        else:
            // Clicked the "No" button, redirect them back to the read page
            header('Location: viewDrivers.php');
            exit;
        endif;
    endif;
else:
    exit('No DRIVER ID specified!');
endif;
?>

<section class="container-xl bg-light py-5 px-3  height">
    <div class="delete text-center">
        <h3 class="text-muted">Delete Driver: <?=$driver['first_name']. ' ' . $driver['last_name']?> with License Number: <?=$driver['license_no']?></h3>
    <?php if ($msg): ?>
            <p><?=$msg?></p>
    <?php else: ?>

        <p>Are you sure you want to delete driver # <?=$driver['driver_id']?>?</p>
        
        <div class="yesno pt-4">
            <a class="bg-danger rounded p-3" href="deleteDriver.php?driver_id=<?=$driver['driver_id']?>&confirm=yes">Yes</a>
            <a class="bg-info rounded p-3" href="deleteDriver.php?driver_id=<?=$driver['driver_id']?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
    </div>
</section>


<?php include "template/footer.php"?>