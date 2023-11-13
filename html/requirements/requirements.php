<?php
$title = "Requirements";
include("../templates/template_top.php");

    //establish db connection
    include( '/home/donkeytw/db/connect_nexus.php' );
    $conn = $conn ?? false;

    if ($conn) {

        // draw header
        echo <<<HTML
    <div class="container col-10 col-md-8" id="requirement-container">
        <div class="row">
            <div class="d-flex justify-content-center"><h1 class="text-center" id="PageTitleText">Green River College Nursing Program Clinical
                    Requirements</h1></div>
            <div class="d-flex justify-content-center text-center"><p>2660*All vaccination proof must include full name, date of birth,
                    and date of vaccine, titer(blood draw), or test</p></div>

            <div class="accordion p-4" id="immunizationReqs">
HTML;


        // draw dropdown items
        $sql = "SELECT Title, Description, Requirement_One, Requirement_Two FROM Requirements;";
        $result = @mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            // $description = $row['Description'];
            $title = $row['Title'];
            $requirement_one = $row['Requirement_One'];
            $requirement_two = $row['Requirement_Two'];

            include("requirements_accordion_item.php");
        }

        // footer of dropdown
        echo <<<HTML
                        
                        <div class="d-flex p-2 justify-content-center" id="contact_footer"><p>- If you have any questions about the requirements, you
                        can email me at <b>csavage@greenriver.edu</b></p></div>
                </div>
            </div>
        </div>
HTML;
    }

    // OR display an error
    else {
        echo '<p>Fatal error: no database connection.</p>';
    }

include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags
?>

