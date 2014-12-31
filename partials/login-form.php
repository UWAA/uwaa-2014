<?php
wp_enqueue_script('memberChecker'); 
?>

<form action="get" id="loginForm">
    <fieldset>
        <legend>memberchecker</legend>
        <p><input type="text" name="idNumber"><label>Member ID Number</label></p>
        <p><input type="text" name="lastName"><label>Last Name</label></p>
        <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            echo 'Welcome back '.htmlspecialchars($session->get('firstName')).'';
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            echo 'Welcome back '.htmlspecialchars($session->get('firstName')).' Thanks for Being a Member';
        } else {
        echo '<button type="submit">Submit</button>';
        }
        ?>
    </fieldset>
</form>


<form action="logout.php"><button type="submit">Logout</button></form>


