<?php
$site_attended = $_POST["site"];

//Fetch data from the experience table in the database
require '/home/donkeytw/db/connect_nexus.php'; //get access to the DB
$query = 'SELECT * FROM `Experience` WHERE `site_attended`="'.$site_attended.'";';
$result = @mysqli_query($conn, $query); //create a query result to work with

$i = 0;//iterator for array construction purposes and table building
while ($row = mysqli_fetch_assoc($result)) {
    $_site_attended[$i] = $row['site_attended'];
    $_clinical_site[$i] = $row['clinical_site'];
    $_clinical_staff[$i] = $row['clinical_staff'];
    $_learning_objective[$i] = $row['learning_objective'];
    $_preceptor[$i] = $row['preceptor'];
    $_recommend_site[$i] = $row['recommend_site'];
    $_site_comments[$i] = $row['site_comments'];
    $_instructor_comments[$i] = $row['instructor_comments'];
    $i++;
}

function buildAverageTable(): void
{
    global $site_attended,
           $_site_attended,
           $_clinical_site,
           $_clinical_staff,
           $_learning_objective,
           $_preceptor,
           $_recommend_site,
           $i;

    for ($j = 0; $j < $i; $j++) {
        if ($site_attended == $_site_attended[$j]) {
            //count up values for averages
            $site_attended_ratings_count+=1;
            $clinical_site_average += $_clinical_site[$j];
            $clinical_staff_average += $_clinical_staff[$j];
            $learning_objective_average += $_learning_objective[$j];
            $preceptor_average += $_preceptor[$j];
            $recommend_site_average += $_recommend_site[$j];
        }
    }
    
    //avoids divide by zero error when first loading the page before a site is user selected
    (!$site_attended_rating_count==0) ?: $site_attended_rating_count++; 
    
    //display averages in table
    echo '<tr>
            <td>' . $site_attended_ratings_count . '</td>
            <td>' . round($clinical_site_average / $site_attended_ratings_count,1) . '</td>
            <td>' . round($clinical_staff_average / $site_attended_ratings_count,1) . '</td>
            <td>' . round($learning_objective_average / $site_attended_ratings_count,1) . '</td>
            <td>' . round($preceptor_average / $site_attended_ratings_count,1) . '</td>
            <td>' . round($recommend_site_average / $site_attended_ratings_count,1) . '</td>
            </tr>';
}

//build wide table for use on non-mobile view
function buildWideTable(): void
{
  
    global $site_attended,
           $_site_attended,
           $_clinical_site,
           $_clinical_staff,
           $_learning_objective,
           $_preceptor,
           $_recommend_site,
           $_site_comments,
           $_instructor_comments,
           $i;
    for ($j = 0; $j < $i; $j++) {
        if ($site_attended == $_site_attended[$j]) {
            echo '<tr>
                    <td>' . $_clinical_site[$j] . '</td>
                    <td>' . $_clinical_staff[$j] . '</td>
                    <td>' . $_learning_objective[$j] . '</td>
                    <td>' . $_preceptor[$j] . '</td>
                    <td>' . $_recommend_site[$j] . '</td>
                    <td>' . $_site_comments[$j] . '</td>
                    <td>' . $_instructor_comments[$j] . '</td>
                    </tr>';
        }
    }
}

//build narrow table for use on mobile view
function buildNarrowTable(): void
{
    global $site_attended,
           $_site_attended,
           $_clinical_site,
           $_clinical_staff,
           $_learning_objective,
           $_preceptor,
           $_recommend_site,
           $_site_comments,
           $_instructor_comments,
           $i;
    for ($j = 0; $j < $i; $j++) {
        $incrementor = $j+1;//the +1 prevents modal error where incrementor and incrementor2 would both be 0 for first pass through loop
        $incrementor2 = $j*-1;//the *-1 prevents incrementor and incrementor2 from ever being the same number, required for modal to work
        if ($site_attended == $_site_attended[$j]) {
            echo '<tr>
                  <td>' . $_clinical_site[$j] . '</td>
                  <td>' . $_clinical_staff[$j] . '</td>
                  <td>' . $_learning_objective[$j] . '</td>
                  <td>' . $_preceptor[$j] . '</td>
                  <td>' . $_recommend_site[$j] . '</td>';
            echo '<td class="">
                  <button type="button"
                          class="btn modal-btn comment_column_data"
                          data-bs-toggle="modal"
                          data-bs-target="#commentsModalToggle' . $incrementor . '">
                    View
                  </button>
              <div class="modal fade" id="commentsModalToggle' . $incrementor . '" aria-hidden="true"
                   aria-labelledby="commentsModalToggleLabel' . $incrementor . '" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="commentsModalToggleLabel' . $incrementor . '">Site Comments</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ' . $_site_comments[$j] . '
                    </div>
                    <div class="modal-footer">
                      <button class="btn modal-btn" data-bs-target="#commentsModalToggle' . $incrementor2 . '"
                              data-bs-toggle="modal">To Instructor Comments
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="commentsModalToggle' . $incrementor2 . '" aria-hidden="true"
                   aria-labelledby="commentsModalToggleLabel' . $incrementor2 . '" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="commentsModalToggleLabel' . $incrementor2 . '">Instructor
                        Comments</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ' . $_instructor_comments[$j] . '
                    </div>
                    <div class="modal-footer">
                      <button class="btn modal-btn" data-bs-target="#commentsModalToggle' . $incrementor . '"
                              data-bs-toggle="modal">To Site Comments
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </td>';
            echo '</tr>';
        }
    }
}

?>

<div id="table_cards">
        
<!--Timy Mobile Table with the Modals-->
    <div class="card mx-auto d-md-none tinydiv m-1" hx-boost="true">
        <h4 class="card-title text-center p-2"><?php echo $site_attended ?></h4>
        <div class="card-body row p-3">
            <table >
                <thead class="mx-auto">
                    <tr>
                        <th class="col-2 text-center text-wrap">Enjoyed Site</th>
                        <th class="col-2 text-center text-wrap">Supportive Site</th>
                        <th class="col-2 text-center text-wrap">Facilitated Learning</th>
                        <th class="col-2 text-center text-wrap">Preceptor Help</th>
                        <th class="col-2 text-center text-wrap">Recommend Site</th>
                        <th class="col-2 text-center text-wrap">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php buildNarrowTable(); ?>
                </tbody>
            </table>
        </div>
    </div>
<!--Averages Table Tiny-->
    <div class="card mx-auto d-md-none tinydiv m-2 p-2" hx-boost="true">
    <h4 class="card-title text-center">Average Ratings</h4>
        <table >
            <thead class="mx-auto">
                <tr>
                    <th class="col-2 text-center">Total Ratings</th>
                    <th class="col-2 text-center">Enjoyed Site</th>
                    <th class="col-2 text-center">Supportive Site</th>
                    <th class="col-2 text-center">Facilitated Learning</th>
                    <th class="col-2 text-center">Preceptor Help</th>
                    <th class="col-2 text-center">Recommend Site</th>
                </tr>
            </thead>
            <tbody>
             <?php buildAverageTable(); ?>
            </tbody>
        </table>
    </div>
    


<!-- THIS SIZE NEEDS A REVISION MODALS ARE NOT BEHAVING PROPERLY HERE SUDDENLY -->
<!--Mobile Table with the Modals
    <div class="card mx-auto d-none d-sm-block d-md-none narrowdiv m-1" hx-boost="true">
    <h4 class="card-title text-center p-2"><?php echo $site_attended ?></h4>
        <div class="card-body row p-3">
            <table >
                <thead class="mx-auto">
                    <tr>
                        <th class="col-2 text-center text-wrap">Enjoyed Site</th>
                        <th class="col-2 text-center text-wrap">Supportive Site</th>
                        <th class="col-2 text-center text-wrap">Facilitated Learning</th>
                        <th class="col-2 text-center text-wrap">Preceptor Helped</th>
                        <th class="col-2 text-center text-wrap">Recommend Site</th>
                        <th class="col-2 text-center text-wrap">Comments</th>
                    </tr>
                </thead>
                <tbody>
                  //<?php buildNarrowTable(); ?>
                </tbody>
            </table>
        </div>
    </div>--> 
<!--Averages Table Narrow
    <div class="card mx-auto d-none d-sm-block d-md-none narrowdiv m-2 p-2" hx-boost="true">
    <h4 class="card-title text-center">Average Ratings</h4>
        <table >
            <thead class="mx-auto">
                <tr>
                    <th class="col-2 text-center">Total Ratings</th>
                    <th class="col-2 text-center">Enjoyed Site</th>
                    <th class="col-2 text-center">Supportive Site</th>
                    <th class="col-2 text-center">Facilitated Learning</th>
                    <th class="col-2 text-center">Preceptor Helped</th>
                    <th class="col-2 text-center">Recommend Site</th>
                </tr>
            </thead>
            <tbody>
                //<?php buildAverageTable(); ?>
            </tbody>
        </table>
    </div>-->

<!--Desktop Table without the Modals-->
    <div class="card mx-auto mt-3 d-none d-md-block widediv" hx-boost="true">
        <h4 class="card-title text-center p-2"><?php echo $site_attended ?></h4>
        <div class="card-body row p-3">
            <table class="mx-auto">
                <thead>
                    <tr>
                        <th class="col-1 text-center">Enjoyed Site</th>
                        <th class="col-1 text-center">Supportive Site</th>
                        <th class="col-1 text-center">Facilitated Learning</th>
                        <th class="col-1 text-center">Preceptor Helped</th>
                        <th class="col-1 text-center">Recommend Site</th>
                        <th class="col-3 text-center">Site/Staff Comments</th>
                        <th class="col-3 text-center">Instructor Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php buildWideTable(); ?>
                </tbody>
            </table>
        </div>
    </div>
<!--Averages Table Wide-->
    <div class="card mx-auto mt-3 d-none d-md-block widediv" hx-boost="true">
        <h4 class="card-title text-center">Average Ratings</h4>
        <div clas="card-body row">
            <table class="mx-auto">
                <thead>
                    <tr>
                        <th class="col-2 text-center">Total Ratings</th>
                        <th class="col-2 text-center">Enjoyed Site</th>
                        <th class="col-2 text-center">Supportive Site</th>
                        <th class="col-2 text-center">Facilitated Learning</th>
                        <th class="col-2 text-center">Preceptor Helped</th>
                        <th class="col-2 text-center">Recommend Site</th>
                    </tr>
                </thead>
                <tbody>
                    <?php buildAverageTable(); ?>
                </tbody>
            </table>
        </div>
        </div>
        <div class="m-4 p-3"></div>
</div>
