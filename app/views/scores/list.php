<?php
// Handle listing participants, games, and scores
header('Content-Type: application/json');

// Sample data - in a real app this would come from a database
$data = [
    'participants' => ['Alice', 'Bob', 'Charlie', 'Diana'],
    'games' => ['Chess', 'Scrabble', 'Poker'],
    'scores' => [
        'Alice' => ['Chess' => 1200, 'Scrabble' => 450, 'Poker' => 850],
        'Bob' => ['Chess' => 1100, 'Scrabble' => 520, 'Poker' => 920],
        'Charlie' => ['Chess' => 1350, 'Scrabble' => 380, 'Poker' => 780],
        'Diana' => ['Chess' => 1250, 'Scrabble' => 490, 'Poker' => 1050]
    ]
];

echo json_encode($data);
?>