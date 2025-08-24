<?php if (isset($game) && $game !== null): ?>
    <h2>Delete Game: <?= htmlspecialchars($game['name']) ?></h2>

    <form method="post" action="index.php?page=game&action=delete">
        <input type="hidden" name="id" value="<?= (int)$game['id'] ?>">
        <p>Are you sure you want to delete this game?</p>
        <button type="submit">Yes, Delete</button>
        <a href="/scoreboard_system/index.php?page=game">Cancel</a>
    </form>
<?php else: ?>
    <p>Game not found.</p>
    <a href="/scoreboard_system/index.php?page=game">Back to Games List</a>
<?php endif; ?>
