<?php
    include 'partials/header.php';
?>

    <h2>connection</h2>

    <form action="utils/insert.php" method="post">

        <label>
            <input type="text" name="pseudo" placeholder="pseudo" class="pseudo"/>
        </label>

        <label>
            <input type="password" name="password" placeholder="password" class="pass"/>
        </label>
        <input type="submit">

    </form>

<?php
    include 'partials/footer.php';
?>
