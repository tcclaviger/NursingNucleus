<?php
$title = "Survey";
include("../templates/template_top.php"); ?>

<div class="container col-10" id="survey-form-container">
    <form class="row gy-3" id="survey-form" action="confirm.php" method="POST">
        <h1 class="text-center">Clinical Experience Questionnaire</h1>

        <div>
            <sub class="required">Red stars are required</sub>
            <sub><br>1-Strongly Disagree / 2-Disagree / 3-Ambivalent / 4-Agree / 5-Strongly Agree</sub>
        </div>

        <div class="form-group pt-10">
            <div id="site_attended_selector">
            <label class="required" for="site_attended">What Clinical Site did you attend? </label><br>
            <select id="site_attended" class="form-select" name="site_attended">
                <?php
                require '/home/donkeytw/db/connect_nexus.php';
                // Fetch site_attended data from your database table
                $sql = "SELECT DISTINCT site_attended FROM `Experience`";
                $result = $conn->query($sql);
                $_site_attended=array();

                // Check if any data was retrieved
                if ($result->num_rows > 0) {
                    echo '<option value="">Select a location</option>';

                    // Generate options based on database data
                    while ($row = $result->fetch_assoc()) {
                        $site_attended = $row["site_attended"];
                        $_site_attened = array_push($_site_attended, "$site_attended");
                        $selected = ''; // Default to no selection

                        // Check if this option is selected
                        if (isset($_POST['site_attended']) && $_POST['site_attended'] == $site_attended) {
                            $selected = 'selected';
                        }

                        echo '<option value="' . $site_attended . '" ' . $selected . '>' . $site_attended . '</option>';
                    }

                    // Add an option for "Other"
                    echo '<option value="new">Other</option>';
                } else {
                    // No results found, add the "Other" option directly
                    echo '<option value="new">Other</option>';
                    echo "No results found";
                }
                
                
                // Close the select element
                echo '</select>';

                // Close the database connection
                $conn->close();
                ?>
            </select>
            </div>
        </div>

        <div class="form-group pt-3" id="new_site_attended" style="display: none;">
            <label for="new_site_attended">Enter a new Clinical Site</label>
            <input type="text" class="form-control" list="clinical_sites" id="new_location" name="new_location" placeholder="e.g. UW Medical Center">
        </div>

        <div class="form-group">
            <label for="clinicalSite">
                <div class="d-flex flex-row justify-content-between">
                    <div class="required">
                        I enjoyed my time at this clinical site
                    </div>
                    <div>
                        <output class="rangeValue text-right" id="rangevalueone">1</output>
                    </div>
                </div>
            </label>
            <input type="range" class="form-range slider" value="1" min="1" max="5" id="clinical_site" name="clinical_site"
                   oninput="rangevalueone.value=value">
        </div>

        <div class="form-group">
            <label for="clinicalStaff">
                <div class="d-flex flex-row justify-content-between">
                    <div class="required">
                        The clinical staff was supportive of my role
                    </div>
                    <div>
                        <output class="rangeValue" id="rangevaluetwo">1</output>
                    </div>
                </div>
            </label>
            <input type="range" class="form-range slider" value="1" min="1" max="5" id="clinical_staff" name="clinical_staff"
                   oninput="rangevaluetwo.value=value">
        </div>

        <div class="form-group">
            <label for="learningObj">
                <div class="d-flex flex-row justify-content-between">
                    <div class="required">
                        The site helped facilitate my learning objectives
                    </div>
                    <div>
                        <output class="rangeValue" id="rangevaluethree">1
                        </output>
                    </div>
                </div>
            </label>
            <input type="range" class="form-range slider" value="1" min="1" max="5" id="learning_objective" name="learning_objective"
                   oninput="rangevaluethree.value=value">
        </div>

        <div class="form-group">
            <label for="preceptor">
                <div class="d-flex flex-row justify-content-between">
                    <div class="required">
                        My preceptor helped facilitate my learning objectives
                    </div>
                    <div>
                        <output class="rangeValue" id="rangevaluefour">1</output>
                    </div>
                </div>
            </label>
            <input type="range" class="form-range slider" value="1" min="1" max="5" id="preceptor" name="preceptor"
                   oninput="rangevaluefour.value=value">
        </div>

        <div class="form-group">
            <label for="recommend-site">
                <div class="d-flex flex-row justify-content-between">
                    <div class="required">
                        I would recommend this site to another student
                    </div>
                    <div>
                        <output class="rangeValue" id="rangevaluefive">1</output>
                    </div>
                </div>
            </label>
            <input type="range" class="form-range slider" value="1" min="1" max="5" id="recommend_site-site" name="recommend_site"
                   oninput="rangevaluefive.value=value">
        </div>

        <div class="form-group">
            <label for="site_comments">If you have any comments you would like to leave about the site
                or staff at this facility please add below.</label>
            <textarea class="form-control" rows="4" id="site_comments" name="site_comments"
                      placeholder="The site was..."></textarea>
        </div>

        <div class="form-group">
            <label for="instructor_comments">If you have any feedback you would like to leave about your clinical
                instructor please add below.<b> None of the instructors will see this.</b> We will just be using this
                to gage if an instructor needs to improve in area, or to highlight instructors who go above and
                beyond.</label>
            <textarea class="form-control" rows="4" id="instructor_comments" name="instructor_comments"
                      placeholder="My Instructor was..."></textarea>
        </div>
        <button type="submit" class="btn mx-auto mb-5" id="survey-form-btn" value="Submit"><strong>Submit</strong></button>
        <div></div>
    </form>
</div>

<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags