<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";

date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg= "";
// Check if the violation id exists, for example updateViolation.php?id=1 will get the violation with the id of 1
if (isset($_GET['violation_id'])) {
    if( !empty( $_POST ) ){

        $violation_id = isset($_POST["violation_id"]) && !empty($_POST["violation_id"]) && $_POST["violation_id"] ? $_POST["violation_id"] : null;

        $code = isset($_POST["code"]) ? trim($_POST["code"]) : null;
        $name = isset($_POST["name"]) ? trim($_POST["name"]) : null;
        $description = isset($_POST["description"]) ? trim($_POST["description"]) : null;
        $penalty = isset($_POST["penalty"]) ? trim($_POST["penalty"]) : null;
        
        $stmt = $pdo->prepare( " UPDATE violations SET code = ?, name = ?, description = ?, penalty = ? WHERE violation_id = ? " );
        
        $stmt->execute( [ $code, $name, $description, $penalty, $_GET["violation_id"] ] );
        
        $msg = "Updated successfully!";
    }
    // Get the data from the violations table
    $stmt = $pdo->prepare('SELECT * FROM violations WHERE violation_id = ?');
    
    $stmt->execute([$_GET['violation_id']]);

    $violation = $stmt->fetch(PDO::FETCH_ASSOC);
//    echo $violation["description"];
   
    if (!$violation) {
        exit('Violation doesn\'t exist with that Violation ID!');
    }
} else {
    exit('No Violation ID specified!');
}
?>

<section class="container-xl bg-light py-4 px-5 height">
    <h3 class="text-center pb-3">Edit Violation Code: <?=$violation['code']?></h3>
    <hr>
    <form action="updateViolation.php?violation_id=<?=$violation["violation_id"]?>" method="post">
        <div class="form-group row ">
            <div class="col-4">
                <label for="code">Traffic Violation Code</label>
                <input type="text" class="form-control" name="code" id="code" value="<?=$violation["code"]?>" required>
            </div>
            <div class="col-8">
                <label for="name">Traffic Violation Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?=$violation["name"]?>" required>
            </div>
        </div>    
        <div class="form-group row">
            <div class="col-4">
                <label for="name">Penalty</label>
                <input type="number" class="form-control" name="penalty" id="penalty" value="<?=$violation["penalty"]?>" required>
            </div>
        </div>    
        <div class="">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?=$violation["description"]?></textarea>
        </div>
        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-5">Save</button>
                <a class="btn btn-danger px-5" href="viewViolations.php">Cancel</a>
            </div>
        </div>
    </form>

    <?php if ($msg): ?>
    <div class="pt-5">
        <p class="text-success font-weight-bold "><?=$msg?></p>
    </div>
    <?php endif; ?>

</section>

<?php include "template/footer.php"?>