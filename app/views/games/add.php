<h2>Add New Game</h2>

<form method="post" action="index.php?page=game&action=add">
    <input type="hidden" name="action" value="create">

    <label for="name">Game Name:</label>
    <input type="text" id="name" name="name" required>

    <button type="submit">Add Game</button>
</form>
