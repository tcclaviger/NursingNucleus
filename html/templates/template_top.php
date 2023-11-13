<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- STYLES -->
    <link rel="stylesheet" href="../../styles/styles.css">
    <title>
        <?php echo $title;?>
    </title>
</head>

<body>

<nav id="nav-top" class="navbar sticky-top py-0 mb-4">
    <div class="container-fluid g-0 m-0">
        <a href="../home.php" class="navbar-brand ms-4 position-absolute top-0 start-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-house-fill"
                 viewBox="0 0 16 16">
                <path id="home-btn"
                      d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
            </svg>
        </a>
        <nav class="nav mx-5">
            <a class="nav-link d-none d-md-block" href="../requirements/requirements.php">Requirements</a>
            <a class="nav-link d-none d-md-block" href="../experience/experience.php">Experience</a>
            <a class="nav-link d-none d-md-block" href="../contact/contact_form.php">Questions</a>
            <a class="nav-link d-none d-md-block" href="../tablebuilder/viewentries.php">View Entries</a>
        </nav>
        <div class="navbar-brand justify-content-end me-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" data-bs-toggle="tooltip"
                 data-bs-placement="top" data-bs-title="Tool-tip" class="bi bi-lightbulb-fill off" viewBox="0 0 16 16"
                 id="darkmode-toggler">
                <path id="lightbulb-path"
                      d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </div>
    </div>
</nav>
<section>
