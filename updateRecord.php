<?php
error_reporting (E_ALL);
require_once "template/header.php";
require_once "classes/DBCon.php";

date_default_timezone_set('Europe/Berlin');

$pdo = new DBCon("mysql", "localhost", "lto-traffic-violation", "root", "root");

$msg= "";

$status = [0, 1];

$stmt = $pdo->prepare('SELECT d.first_name, d.last_name, d.license_no, 
    v.code, v.name, v.penalty, 
    r.record_id, r.created_at, r.ticket_no, r.enforcer_id, r.enforcer_name, r.status 
    FROM records r, drivers d, violations v 
    WHERE
        d.driver_id = r.driver_id
    AND r.violation_id = v.violation_id');

$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the record id exists, for example updateRecord.php?id=1 will get the record with the id of 1
if (isset($_GET['record_id'])) {
    if( !empty( $_POST ) ){

        $record_id = isset($_POST["record_id"]) && !empty($_POST["record_id"]) && $_POST["record_id"] ? $_POST["record_id"] : null;

        $driver_id = isset($_POST["driver_id"]) ? trim($_POST["driver_id"]) : null;
        $violation_id = isset($_POST["violation_id"]) ? trim($_POST["violation_id"]) : null;
        $ticket_no = isset($_POST["ticket_no"]) ? trim($_POST["ticket_no"]) : null;
        $enforcer_id = isset($_POST["enforcer_id"]) ? trim($_POST["enforcer_id"]) : null;
        $enforcer_name = isset($_POST["enforcer_name"]) ? trim($_POST["enforcer_name"]) : null;
        $status = isset($_POST["status"]) ? trim($_POST["status"]) : null;
        $created_at = isset($_POST["created_at"]) ? date("Y-m-d H:i:s", strtotime($_POST["created_at"])) : null;    
        
        $stmt = $pdo->prepare( " UPDATE records SET driver_id=?, violation_id=?, ticket_no=?, enforcer_id=?, enforcer_name=?, status=?, created_at=? WHERE record_id = ?");
        
        $stmt->execute( [ $driver_id, $violation_id, $ticket_no, $enforcer_id, $enforcer_name, $status, $created_at, $_GET["record_id"] ] );
        
        $msg = "Updated successfully!";
    }
    // Get the data from the violations table
    $stmt = $pdo->prepare('SELECT d.first_name, d.last_name, d.license_no, 
    v.code, v.name, v.penalty, 
    r.record_id, r.created_at, r.ticket_no, r.enforcer_id, r.enforcer_name, r.status 
    FROM records r, drivers d, violations v 
    WHERE
        d.driver_id = r.driver_id
    AND r.violation_id = v.violation_id
    AND record_id = ?');
    
    $stmt->execute([$_GET['record_id']]);
    
    // Fetch the records to display the page.
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo $record['code'];

    if (!$record) {
        exit('Record doesn\'t exist with that RECORD ID!');
    }
} else {
    exit('No RECORD ID specified!');
}
// fetch all drivers
$drv = $pdo->prepare('SELECT * FROM drivers');
$drv->execute();
$drivers = $drv->fetchAll(PDO::FETCH_ASSOC);

// fetch all violations
$vio = $pdo->prepare('SELECT * FROM violations');    
$vio->execute();
$violations = $vio->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="container-xl bg-light py-4 px-5 height">
    <h3 class="text-center pb-3">Edit Violation Code: <?=$record['code']?></h3>
    <hr>
    <form action="updateRecord.php?record_id=<?=$record["record_id"]?>" method="post">
        <div class="form-group row">
            <div class="col-6">
                <label for="created_at">Incident Date</label>
                <input type="datetime-local" class="form-control" name="created_at" id="created_at" value="<?=$record['created_at']?>" required>
            </div>
            
            <div class="col-6">
                <label for="enforcer_id">Enforcer ID</label>
                <input type="text" class="form-control" name="enforcer_id" id="enforcer_id" value="<?=$record['enforcer_id']?>" required>
            </div>
        </div>    
        <div class="form-group row">
        <div class="col-6">
                <label for="ticket_no">Ticket Number</label>
                <input type="text" class="form-control" name="ticket_no" id="ticket_no" value="<?=$record['ticket_no']?>" required>
            </div>
            <div class="col-6">
                <label for="enforcer_name">Enforcer Name</label>
                <input type="text" class="form-control" name="enforcer_name" id="enforcer_name" value="<?=$record['enforcer_name']?>" required>
            </div>
        </div>    
        <div class="form-group row pb-4">
            <div class="col-6">
                <label for="driver_id">Driver License and Name</label>
                <select name="driver_id" id="driver_id" class="custom-select" required>
                <?php foreach ($drivers as $driver): ?>
                        <option value = "<?=$driver["driver_id"] ?>"> <?=$record["license_no"] . ": " .$record["first_name"]. " ".$record["last_name"]?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6">
                <label for="status">Status</label>
                <select name="status" id="status" class="custom-select" required>
                <?php foreach ($status as $stat): ?>
                    <option value = "<?=$stat?>"<?=$stat==$record["status"] ?' selected' : ''?> ><?=$stat?></option>
                <?php endforeach; ?>
                </select>
            </div>
        </div>

        <hr>

        <h4>Violation List</h4>
        <div class="form-group row pt-4">
            <div class="col-auto float-left">
                <div class="form-group mt-2">
                    <label class="control-label mb-0" for="violation_id" >Violation </label>
                </div>
            </div>    
            <div class="col-7">
                <div class="form-group">
                    <select name="violation_id" id="violation_id" class="custom-select" required>
                    <?php foreach ($violations as $violation): ?>
                        <option value = "<?=$violation["violation_id"] ?>"> <?=$record["code"]." - ". $record["name"]?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group row pt-5">
            <div class="col-12 ">
                <button type="submit" class="btn btn-success px-5">Save</button>
                <a class="btn btn-danger px-5" href="viewRecords.php">Cancel</a>
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