<?php 
require_once "template/header.php";
require_once "classes/DBCon.php";
date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg= "";

// Get the driver from the drivers table
$stmt = $pdo->query('SELECT * FROM drivers');
// Fetch the drivers to display them in the page.
$drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the violation from the violations table
$vio = $pdo->query('SELECT * FROM violations');   
// Fetch the violations to display them in the page.
$violations = $vio->fetchAll(PDO::FETCH_ASSOC); 

// Check if POST data is not empty
if( !empty( $_POST ) ){
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $record_id = isset($_POST["record_id"]) && !empty($_POST["record_id"]) && $_POST["record_id"] ? $_POST["record_id"] : null;
    $driver_id= isset($_POST["driver_id"]) ? $_POST["driver_id"] : null;
    $violation_id= isset($_POST["violation_id"]) ? $_POST["violation_id"] : null;
    $created_at = isset($_POST["created_at"]) ? date("Y-m-d H:i:s", strtotime($_POST["created_at"])) : null;
    $ticket_no = isset($_POST["ticket_no"]) ? trim($_POST["ticket_no"]) : null;
    $enforcer_id = isset($_POST["enforcer_id"]) ? trim($_POST["enforcer_id"]) : null;
    $enforcer_name = isset($_POST["enforcer_name"]) ? trim($_POST["enforcer_name"]) : null;
    $status = isset($_POST["status"]) ? ($_POST["status"]) : null;
    
    $stmt = $pdo->prepare( " INSERT INTO records (driver_id, violation_id, ticket_no, enforcer_id, enforcer_name, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?) " );
    
    $stmt->execute( [ $driver_id, $violation_id, $ticket_no, $enforcer_id, $enforcer_name, $status, $created_at ] );
    
    // $msg = "Created record successfully!";
    header('Location: viewRecordDetails.php?record_id=' . $pdo->lastInsertID());
}
?>

<section class="container-xl bg-light py-4 px-5 height">
    <h5 class=" text-center">Create new record</h5>
    <hr>
    <form action="addRecord.php" method="post">
        <div class="form-group row">
            <div class="col-6">
                <label for="created_at">Incident Date</label>
                <input type="datetime-local" class="form-control" name="created_at" id="created_at" required>
            </div>
            
            <div class="col-6">
                <label for="enforcer_id">Enforcer ID</label>
                <input type="text" class="form-control" name="enforcer_id" id="enforcer_id" placeholder="OFC-123456" required>
            </div>
        </div>    
        <div class="form-group row">
        <div class="col-6">
                <label for="ticket_no">Ticket Number</label>
                <input type="text" class="form-control" name="ticket_no" id="ticket_no" placeholder="TIC-123456" required>
            </div>
            <div class="col-6">
                <label for="enforcer_name">Enforcer Name</label>
                <input type="text" class="form-control" name="enforcer_name" id="enforcer_name" placeholder="Guillermo Eleazar" required>
            </div>
        </div>    
        <div class="form-group row pb-4">
            <div class="col-6">
                <label for="driver_id">Driver License and Name</label>
                <select name="driver_id" id="driver_id" class="custom-select" required>
                    <option selected> Select driver here </option>
                <?php foreach ($drivers as $driver): ?>
                    <option value = "<?=$driver["driver_id"] ?>"> <?=$driver["license_no"] . " - " .$driver["first_name"]. " ".$driver["last_name"]?> </option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="col-6">
                <label for="status">Status</label>
                <select name="status" id="status" class="custom-select" required>
                    <option selected value = 0> Pending </option>
                    <option value = 1> Paid </option>
                </select>
            </div>
        </div>
        
        <hr>

        <h4>Violation List</h4>
        <div class="form-group row pt-4">
            <div class="col-auto float-left">
                <div class="form-group mt-2">
                    <label class="control-label mb-0" for="violation_id" >Violation</label>
                </div>
            </div>    
            <div class="col-7">
                <div class="form-group">
                    <select name="violation_id" id="violation_id" class="custom-select" required>
                        <option selected> Select violation here </option>
                    <?php foreach ($violations as $violation): ?>
                        <option value = "<?=$violation["violation_id"] ?>"><?=$violation["code"] . " - " .$violation["name"]?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-5">Add record</button>
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