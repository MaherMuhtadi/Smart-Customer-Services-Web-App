<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include "layout.php";
include "db/connect.php";

if (isset($_POST["submitted"])) {
    unset($_POST["submitted"]);

    $datetime = date("Y-m-d");
    $insert_review = 
            "INSERT INTO review (user_id, login_id, feedback, date_posted)
                VALUES ('"
                .$_SESSION["user"]["user_id"]."', '"
                .$_SESSION["user"]["login_id"]."', '"
                .$_POST["feedback"]."', '"
                .$datetime."')";
        mysqli_query($connection, $insert_review);
}
?>
    
<html lang='en'>
<?php htmlHead(); ?>

<style>
    form {
        width: 60%;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    table {
        border: none;
    }
    th, td {
        width: 15%;
        padding: 1rem;
        border-width: 1px 0px 1px 0px;
    }
</style>
    
<body>
    
    <?php menuBar(); ?>

    <main>    
        <h1>Reviews</h1>
        <h2>Help us improve by leaving your feedback</h2>

        <form method="post">
            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" maxlength="300"></textarea>

            <div>
                <button name="submitted" type="submit">Post</button>
                <button class="negative-button" type="reset">Clear</button>
            </div>
        </form>

        <h2>Feedback from other people</h2>
        <table>
            <tr>
                <th>User</th>
                <th>Date</th>
                <th style="width:90%">Feedback</th>
            </tr>
            <?php
            $result = mysqli_query($connection, "SELECT login_id, user_id, feedback, date_posted FROM review");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                        "<tr><td>".$row["login_id"]."#".$row["user_id"]."</td>"
                        ."<td>".$row["date_posted"]."</td>"
                        ."<td style='width:70%'>".$row["feedback"]."</td></tr>";
                }
            }
            ?>
        </table>
    </main>

    <?php footer(); ?>
    
</body>
</html>