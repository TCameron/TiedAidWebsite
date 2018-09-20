<!DOCTYPE html>
<html lang="en">
<?php
include_once('../_includes/nav.php');
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../_stylesheets/search.css">
    <title>Search for a Record</title>
</head>
<body>
    <h1>
        Search for an Existing Record by Solicitation Number
    </h1>
    <form action="searchit.php" method="POST">
        <p>
            <label for="solicitation">Solicitation Number:</label>
            <input type="text" name="solicitation" id="solicitation" placeholder="XXX-XXX-XXXXX">
        </p>
        <div class="buttons">
            <input type="submit" name="submit" value="Solicit" class="regular" />
        </div>
    </form>
    <h1>        
	Search for an Existing Record by Award Number
    </h1>
    <form action="searchit.php" method="POST">
        <p>
            <label for="awardno">Award Number:</label>
            <input type="text" name="awardno" id="awardno" placeholder="XXX-XXX-XXXXX">
        </p>
        <div class="buttons">
            <input type="submit" name="submit" value="Award" class="regular" />
        </div>
    </form>
    <h1>
        Search for an Existing Record by Title
    </h1>
    <form action="searchit.php" method="POST">
        <p>
            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title" placeholder="Project Title">
        </p>
        <div class="buttons">
            <input type="submit" name="submit" value="Title" class="regular" />
        </div>
    </form>
</body>
</html>