<?php

    include 'partials/header.php';

    session_start();

    $session =  session_id();

?>

    <h2>Chat</h2>

        <div id="chat">
                <form>
                    <label>
                        <input type="text" name="pseudo" placeholder="pseudo" id="recName">
                    </label>

                    <label>
                        <textarea name="text" id="text" cols="26" rows="10"
                                  placeholder="écrivez votre message"></textarea>
                    </label>
                    <input type="submit" id="push">
                </form>
            <div id="zoneChat">
            </div>
        </div>

    <script src="assets/js/ajax.js"></script>

</body>
</html>