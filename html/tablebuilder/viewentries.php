<?php
$title = "Experience Survey Data";
include("../templates/template_top.php");

//Fetch data from the experience table in the database
require '/home/donkeytw/db/connect_nexus.php'; //get access to the DB
$sql = "SELECT `site_attended` FROM `Experience`;"; //select all rows from the experience table
$result = @mysqli_query($conn, $sql); //create a query result to work with

//build arrays for page construction
$_site_attended = array();

$i = 0;//iterator for array construction purposes
while ($row = mysqli_fetch_assoc($result)) {
    $_site_attended[$i] = $row['site_attended'];
    $i++;
}

//ensures only one entry in the dropdown per site
$unique_site=array_unique($_site_attended);

//build dropdown list based on site_attended entries in the DB
function buildDropdownList(): void
{
    global $unique_site, $i;
    foreach($unique_site as $val){
        echo '<li><button 
            class="dropdown-item dropdown-btns"
            type="submit"
            value ="'.$val.'"
            name ="site"
            hx-post="tables.php"
            hx-swap="outerHTML"
            hx-target="#table_cards"
            >'.$val.'</button></li>';
    }
}

?>

    <!--Page header and controls above the table card-->
    <div class="container">
        <div class="d-md-flex justify-content-md-between mb-2">
            <h1 class="text-center">Experience Survey Data</h1>
            <div class="dropdown align-self-md-center text-center">
                <button class="btn btn-sm dropdown"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        id="viewEntriesDropdown-btn">
                    Site Selection
                </button>
                <ul class="dropdown-menu">
                    <?php buildDropdownList(); ?>
                </ul>
            </div>
        </div>

        <div id="table_cards">
            <!--Mobile Table with the Modals-->
            <div class="card mx-auto d-md-none viewentries_div m-1" hx-boost="true">
                <h4 class="card-title text-center">Select Site From Dropdown</h4>
            </div>
            <!--Desktop Table without the Modals-->
            <div class="card mx-auto col-12 mt-3 d-none d-md-block viewentries_div" hx-boost="true">
                <h4 class="card-title text-center">Select Site From Dropdown</h4>
            </div>
    </div>

<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags
?>