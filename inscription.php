<?php
    include 'partials/header.php';
?>

    <h2>inscription</h2>

    <form action="utils/insert.php" method="post">

        <label>
            <input type="text" name="pseudo" placeholder="pseudo" class="pseudo"/>
        </label>
        <label>
            <input type="email" name="email" placeholder="email" class="email">
        </label>
        <label>
            <input type="password" name="password" placeholder="password" class="pass"/>
        </label>
        <input type="submit">

<?php
    include 'partials/footer.php';
?>