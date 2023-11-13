<?php
    // set important variables
    $error = "<strong class='text-danger'>error</strong>";

    $uid = $uid ?? uniqid();
    $title = $title ?? $error;
    $requirement_one = $requirement_one ?? $error;
    $requirement_two = $requirement_two ?? $error;
?>

<div class="accordion-item">
    <h2 id="heading-<?php echo "$uid"; ?>" class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-<?php echo $uid; ?>" aria-expanded="true" aria-controls="collapse-<?php echo "$uid"; ?>">
            <?php echo "$title"; ?>
        </button>
    </h2>
    <div id="collapse-<?php echo "$uid"; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo "$uid"; ?>"
         data-bs-parent="#immunizationReqs">
        <div class="accordion-body">
            <div class="p-2 pb-0 reqs_border"><?php echo"$requirement_one"?></div>
      
            <?php
            if($requirement_two!="<strong class='text-danger'>error</strong>"){
                echo '
                <p class="text-center pt-3"><strong>~OR~</strong></p>      
                <div class="p-2 pb-0 reqs_border">'.$requirement_two.'</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php unset($uid, $title,$requirement_one,$requirement_two); ?>
