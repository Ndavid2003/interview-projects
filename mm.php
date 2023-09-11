<?php
// Start a new session or resume an existing one
session_start();

// Check if the user has clicked the "Start Matchmaking" button
if (isset($_POST['start_matchmaking'])) {
    // Set a flag in the session to indicate that matchmaking is in progress
    $_SESSION['matchmaking_in_progress'] = true;

    // Start the matchmaking process
    start_matchmaking();
}

// Check if matchmaking is in progress
if (isset($_SESSION['matchmaking_in_progress']) && $_SESSION['matchmaking_in_progress']) {
    // Display a message indicating that matchmaking is in progress
    echo "Matchmaking is currently in progress. Please wait...<br><br>";

    // Generate a random guest name for the user
    $guest_name = generate_guest_name();

    // Display the user's guest name
    echo "Your guest name is: " . $guest_name;
} else {
    // Display a form that allows the user to start matchmaking
    echo "
        <form method='post'>
            <button type='submit' name='start_matchmaking'>Start Matchmaking</button>
        </form>
    ";
}

// Function to start the matchmaking process
function start_matchmaking() {
    // TODO: Implement actual matchmaking logic here
}

// Function to generate a random guest name
function generate_guest_name() {
    $adjectives = array("happy", "excited", "jolly", "silly", "friendly", "funny", "witty", "clever", "daring", "brave");
    $nouns = array("unicorn", "penguin", "koala", "narwhal", "kangaroo", "panda", "lion", "tiger", "octopus", "elephant");

    $adjective = $adjectives[array_rand($adjectives)];
    $noun = $nouns[array_rand($nouns)];

    return $adjective . "_" . $noun;
}
?>
