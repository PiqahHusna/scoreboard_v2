


<?php if (isset($game) && $game !== null): ?>
    <h2>Edit Game: <?= htmlspecialchars($game['name']) ?></h2>

    <form method="post" action="index.php?page=game&action=edit">
        <input type="hidden" name="id" value="<?= (int)$game['id'] ?>">

        <label for="name">Game Name:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($game['name']) ?>" required><br><br>

        <button type="submit">Save Changes</button>
        <a href="/scoreboard_system/index.php?page=game">Cancel</a>
    </form>
<?php else: ?>
    <p>Game not found.</p>
    <a href="/scoreboard_system/index.php?page=game">Back to Games List</a>
<?php endif; ?>








