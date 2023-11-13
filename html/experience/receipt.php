<?php
    require '/home/donkeytw/db/connect_nexus.php';

    $title = "Survey Receipt";
    include("../templates/template_top.php");

    $validator = $_POST["validator"];
    $content = "";
    if(is_null($validator)){
        $content = invalid();
    } else if($validator == 1234) {
        $content = valid();
        $result = @mysqli_query($conn, sendToDb());
    }

    // If all fields are completed properly, returns this text
    function valid() : string {
        $code = generateCode();
        $color = codeColor();

        return <<<HTML
                    <h4 class="card-title pb-3">Thank you for your feedback!</h4>
                    <p class="card-text">The experience survey has been successfully completed
                    and your responses have been saved. Down below is a unique code, screenshot 
                    and send this page to your instructor to receive credit.
                    </p>
                    <p class="{$color} col-4 mx-auto" id="receipt-code">CODE: {$code}</p>
    HTML;
    }

    // If all fields are not completed properly, returns this text
    function invalid() : string {
        return <<<HTML
                    <h4 class="card-title pb-3">Oops, completed experience form missing...</h4>
                    <p class="card-text">Please complete the experience form first!</p>
                    <a class="btn" id="receipt-btn" href="experience.php">Experience Form</a> 
    HTML;
    }
    
    // Returns a color based on date completed
    function codeColor() : string{
        $month = date("m");
        $color = "";
        if($month >=1 && $month <= 3) {             // Jan - Mar
            $color = "blue";
        } else if($month >=4 && $month <= 6) {      // Apr - Jun
            $color = "green";
        } else if($month >=7 && $month <= 9) {      // Jul - Sep
            $color = "red";
        } else {                                    // Oct - Dec
            $color = "orange";
        }
        return $color;
    }


    // Creates the code for the student to screenshot
    function generateCode() : string {
        // Gets the first letter of the month (November = 'N')
        $month = substr(date("M"), 0, 1);

        // Generates a random 4 digit num
        $randNum = rand(1111, 9999);

        // Last 2 digits of year submitted (2023 -> 23)
        $year = date("y");

        // Concatenates all 3 pieces and returns result
        return $month . $randNum . $year;
    }

    // Provides the Insert statement for the db
    function sendToDb(): string {
        // date form was submitted
        $date_submitted = date("Y/m/d");

        // Data being sent to db
        $site_attended = $_POST['site_attended'];
        $clinical_site = $_POST['clinical_site'];
        $clinical_staff = $_POST['clinical_staff'];
        $learning_obj = $_POST['learning_obj'];
        $preceptor = $_POST['preceptor'];
        $recommend_site = $_POST['recommend_site'];
        $site_comments = $_POST['site_comments'] ?? "";
        $instructor_comments = $_POST['instructor_comments'] ?? "";

        //Insert statement, last value is null for the primary key column to preserve auto-incrementing of the column.
        $sql = "INSERT INTO Experience VALUES ('$site_attended', '$clinical_site', '$clinical_staff', '$learning_obj', '$preceptor', '$recommend_site', '$site_comments', '$instructor_comments', '$date_submitted', null);";

       return $sql;
       
    }
?>

<div class="card col-9 mx-auto my-5 text-center" id="receipt-div">
    <div class="card-body p-5">
        <?php
        echo $content;
        ?>
    </div>
</div>

<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags