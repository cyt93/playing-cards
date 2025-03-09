<?php
header('Content-Type: application/json');

// Function to generate a deck of 52 cards
function generateDeck() {
    $suits = ['S', 'H', 'D', 'C'];
    $values = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13']; 
    $deck = [];

    foreach ($suits as $suit) {
        foreach ($values as $value) {
            $deck[] = "$suit-$value";
        }
    }

    return $deck;
}

// Get the number of people from request
$n = isset($_GET['n']) ? intval($_GET['n']) : 0;

// Validate input
if ($n <= 0) {
    echo json_encode(["error" => "Input value does not exist or value is invalid"]);
    exit;
}

// Generate and shuffle deck
$deck = generateDeck();
shuffle($deck);

// Distribute cards
$result = array_fill(0, $n, []);
for ($i = 0; $i < count($deck); $i++) {
    $result[$i % $n][] = $deck[$i];
}

// Convert each person's cards to a formatted string
$formattedResult = array_map(fn($cards) => implode(',', $cards), $result);

// Output JSON
echo json_encode($formattedResult);
?>
