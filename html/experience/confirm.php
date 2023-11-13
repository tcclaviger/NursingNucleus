<?php

$title = "Experience Survey Data";
include("../templates/template_top.php");

            //checks if user selected pre-existing location or new location
            //if a new location is selected it sets $site_attended as the text
            //string they entered into the box. For the table and sql entry
            //this is transparent since it's done before anything else looks
            //at $site_attended
            $site_attended;
            if($_POST["site_attended"]=="new"){
                $site_attended = htmlspecialchars($_POST["new_location"]);
            }else{
                $site_attended = $_POST["site_attended"];
            }

            // confirm all likert scales are checked
            // if not, provide link back to survey page
            if (!validate()) {
                echo invalid();
            } else {
                // otherwise, add confirm button and go to receipt.php
                // pass hidden form field
                echo valid();
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    if(isset($_POST['sbmt-form'])) {
                        sendToDb();
                    }
                }
            }
            

            // validates POST input
        function validate(): bool {
            $problemsStr = "";

            if (is_null($_POST["site_attended"]) || $_POST["site_attended"] === "") {
                $problemsStr .= "The attended site was not filled.<br>";
            }

            foreach (array("clinical_site", "clinical_staff", "learning_objective", "preceptor", "recommend_site") as $slider) {
                // check if there's something there
                if (is_null($_POST[$slider]) || $_POST[$slider] === "") {
                    $problemsStr .= "The {$slider} is not set.<br>";
                } elseif (!check_numeric($_POST[$slider])) {
                    $problemsStr .= "The {$slider} is invalid.<br>";
                }
            }

            // check if any problems were logged.
            return $problemsStr === "";
        }

        // makes sure the input is a valid number
        function check_numeric($str): bool
        {
            return is_numeric($str) && $str >= 1 && $str <= 5;
        }

        // if no data, send users back to the survey page
        function invalid(): string
        {
            return <<<HTML
        <div class="row">
            <p class="col-12">
                <img class="caution" src="../../images/sign-304093.svg" alt="Caution sign">
                Invalid survey results. <a href="survey.php">Click here to go back.</a>
            </p>
HTML;
        }

        // function to use when post inputs validated
        function valid(): string
        {
            $confirm_sbmt = false;
            global $site_attended;

            // gather all required values to display
            $clinical_site = $_POST["clinical_site"];
            $clinical_staff = $_POST["clinical_staff"];
            $learning_objective= $_POST["learning_objective"];
            $preceptor = $_POST["preceptor"];
            $recommend_site = $_POST["recommend_site"];

            // get optionals
            $site_comments= htmlspecialchars(strip_tags($_POST["site_comments"])) ?? "";
            $instructor_comments = htmlspecialchars(strip_tags($_POST["instructor_comments"])) ?? "";

            $clinical_map = array(
                '1' => "Strongly Disagree",
                '2' => "Disagree",
                '3' => "Ambivalent",
                '4' => "Agree",
                '5' => "Strongly Agree");

            // make hidden
            $hidden = 1234;

            return <<<HTML
    <div class="container">
        <div class="row">
        <div class="card mx-auto col-11 col-md-12" id="confirm-div">
            <div class="row">
                <h3 class="card-title text-center">Questionnaire Summary</h3>
                <div class="col-6"><strong>Site Attended:</strong></div><div class="col-6">{$site_attended}</div>
                <hr>
                <div class="col-6"><strong>Clinical Site Score:</strong></div><div class="col-6"> {$clinical_map[$clinical_site]}</div>
                <hr>
                <div class="col-6"><strong>Clinical Staff Score:</strong></div><div class="col-6"> {$clinical_map[$clinical_staff]}</div>
                <hr>
                <div class="col-6"><strong>Learning Objective Score:</strong></div><div class="col-6"> {$clinical_map[$learning_objective]}</div>
                <hr>
                <div class="col-6"><strong>Preceptor Score:</strong></div><div class="col-6"> {$clinical_map[$preceptor]}</div>
                <hr>
                <div class="col-6"><strong>Recommendation Score:</strong></div><div class="col-6"> {$clinical_map[$recommend_site]}</div>
                <hr>
                <div class="col-6"><strong>Comments:</strong></div><div class="col-6"> {$site_comments}</div>
                <hr>
                <div class="col-6"><strong>Instructor Comments:</strong></div><div class="col-6"> {$instructor_comments}</div>
                <hr>
                <br>
                <p class="text-center">If all items are correct, hit Submit.</p>
                <form action="receipt.php" method="POST">
                    <input type="hidden" name="site_attended" value="{$site_attended}">
                    <input type="hidden" name="clinical_site" value="{$clinical_site}">
                    <input type="hidden" name="clinical_staff" value="{$clinical_staff}">
                    <input type="hidden" name="learning_obj" value="{$learning_objective}">
                    <input type="hidden" name="preceptor" value="{$preceptor}">
                    <input type="hidden" name="recommend_site" value="{$recommend_site}">
                    <input type="hidden" name="site_comments" value="{$site_comments}">
                    <input type="hidden" name="instructor_comments" value="{$instructor_comments}">
                    <input type="hidden" name="validator" value="{$hidden}">
                    <input type="hidden" name="sendToDb" value="<?php $confirm_sbmt = true; ?>">
                    <div class="container ">
                        <div class="row justify-content-around g-0 mb-2">
                                <input class="btn" type="button" name="back" id="back" value="Back" onclick="history.back()">
                                <input class="btn" type="submit" id="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-5 p-3"></div> <!--Extra space holder for the narrow mobile view to preclude the chance of bottom menu bar from being atop the buttons.-->
    </div>
HTML;
      }

include("../templates/template_bottom.php"); //leave in place for standard mobile sized bottom menu includes the closing tags
?>