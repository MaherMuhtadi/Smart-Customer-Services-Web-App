<?php
session_start();

include "layout.php";
include "admin/connect.php";

if (isset($_POST["submitted"])) {
    unset($_POST["submitted"]);

    $datetime = date("Y-m-d");
    $insert_review = 
            "INSERT INTO review (user_id, login_id, item_name, feedback, rating, date_posted)
                VALUES ('"
                .$_SESSION["user"]["user_id"]."', '"
                .$_SESSION["user"]["login_id"]."', '"
                .$_POST["item_name"]."', '"
                .$_POST["feedback"]."', '"
                .$_POST["rating"]."', '"
                .$datetime."')";
        mysqli_query($connection, $insert_review);
}
?>
    
<html lang='en'>
<?php htmlHead("Reviews"); ?>

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
        width: 12%;
        padding: 1rem;
        border-width: 1px 0px 1px 0px;
    }
    <?php
        if (!isset($_SESSION["user"])) {
            echo "#submit{background-color:rgb(72, 82, 197); pointer-events:none}";
        }
    ?>
</style>
    
<body>
    
    <?php menuBar(); ?>

    <main>    
        <h1>Reviews</h1>

        <h2><?php
            if (!isset($_SESSION["user"])) {
                echo "Please sign in to leave a feedback";
            }
            else {
                echo "Help us improve by leaving your feedback";
            }
        ?></h2>

        <form method="post">
            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" maxlength="300"></textarea>

            <label for="item_name">Item purchased:</label>
            <select id="item_name" name="item_name">
                <option selected disabled>Pick an item to review</option>
                
                <?php
                    $lists = mysqli_query($connection, "SELECT items, user_id FROM receipt WHERE user_id = '".$_SESSION["user"]["user_id"]."'");
                    $temp = [];
                    if (mysqli_num_rows($lists) > 0) {
                        while ($row = mysqli_fetch_assoc($lists)) {
                            $temp = array_merge($temp, explode("<li>", $row["items"]));
                        }
                    }
                    $items = [];
                    foreach ($temp as $line) {
                        if (strpos($line, "}") > 0) {
                            $offset = strpos($line, "{") + 1;
                            $length = strpos($line, "}") - $offset;
                            array_push($items, substr($line, $offset, $length));
                        }
                    }
                    $items = array_unique($items);
                    foreach ($items as $item) {
                        echo "<option value='$item'>$item</option>";
                    }
                ?>

            </select>

            <label for="rating">Rating:</label>
            <div>
                <input style="width:50%" id="rating" name="rating" type="range" min="1" step="1" max="5" oninput="this.nextElementSibling.innerHTML=this.value">
                <div>3</div>
            </div>

            <div>
                <button id="submit" name="submitted" type="submit">Post</button>
                <button class="negative-button" type="reset">Clear</button>
            </div>
        </form>

        <h2>Feedback from other people</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Item</th>
                <th>Rating</th>
                <th style="width:50%">Feedback</th>
            </tr>
            <?php
            $result = mysqli_query($connection, "SELECT login_id, user_id, item_name, feedback, rating, date_posted FROM review");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                        "<tr><td>".$row["date_posted"]."</td>"
                        ."<td>".$row["login_id"]."#".$row["user_id"]."</td>"
                        ."<td>".$row["item_name"]."</td>"
                        ."<td>".$row["rating"]."</td>"
                        ."<td style='width:50%'>".$row["feedback"]."</td></tr>";
                }
            }
            ?>
        </table>
    </main>

    <?php footer(); ?>
    
</body>
</html>