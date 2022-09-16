<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg= "";
// Check if POST data is not empty
if( !empty( $_POST ) ){
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $violation_id = isset($_POST["violation_id"]) && !empty($_POST["violation_id"]) && $_POST["violation_id"] ? $_POST["violation_id"] : null;

    $code = isset($_POST["code"]) ? trim($_POST["code"]) : null;
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : null;
    $description = isset($_POST["description"]) ? trim($_POST["description"]) : null;
    $penalty = isset($_POST["penalty"]) ? trim($_POST["penalty"]) : null;
    
    $stmt = $pdo->prepare( " INSERT INTO violations (code, name, description, penalty) VALUES (?, ?, ?, ?) " );
    
    $stmt->execute( [ $code, $name, $description, $penalty ] );
    
    // $msg = "Created successfully!";
    header('Location: viewViolationDetails.php?violation_id=' . $pdo->lastInsertID());
}
?>

<section class="container-xl bg-light py-4 px-5 height">
    <h5 class=" text-center">Create new violation</h5>
    <hr>
    <form action="addViolation.php" method="post">
        <div class="form-group row ">
            <div class="col-4">
                <label for="code">Traffic Violation Code</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="TVC-0000" required>
            </div>
            <div class="col-8">
                <label for="name">Traffic Violation Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Sample Violation Name" required>
            </div>
        </div>    
        <div class="form-group row">
            <div class="col-4">
                <label for="name">Penalty</label>
                <input type="number" class="form-control" name="penalty" id="penalty" placeholder="0.00" required>
            </div>
        </div>    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" cols="50" placeholder="Enter the description here..."></textarea>
        </div>
        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-4">Add violation</button>
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