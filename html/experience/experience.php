<?php
$title = "Experience";
include("../templates/template_top.php"); ?>

        <div class="card container col-9 col-md-6 p-0" id="experience-card">
            <div class="card-body">
                <h5 class="card-title text-center">Experience Questionnaire</h5>
                <p class="card-text text-center">Please fill out the following form to rate your experience on a scale of one to five stars
                    at
                    the clinical attended. Please be honest, we collect this data to be sure we are sending our students to
                    clinicals that will provide good learning environments and opportunities!</p>
            </div>
            <a href="survey.php" class="row justify-content-center" id="experience-form-link">
                <button type="button" class="btn shadow-lg mb-3" id="experience-form-btn">
                    <strong>Start</strong>
                </button>
            </a>
        </div>

<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags