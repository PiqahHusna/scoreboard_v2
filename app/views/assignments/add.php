<h2>Add Assign Participant</h2>
<form method="post">
    <label>Participant:</label>
    <select name="participantId" required>
        <?php foreach($participants as $participant): ?>
            <option value="<?= $participant['id'] ?>"><?= htmlspecialchars($participant['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Games:</label>
    <select name="gameIds[]" multiple required>
        <?php foreach($games as $game): ?>
            <option value="<?= $game['id'] ?>"><?= htmlspecialchars($game['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <small>Hold Ctrl (Windows) / Cmd (Mac) to select multiple games</small>

    <button type="submit">Add</button>
</form>
<a href="?page=assignment&action=index">Back</a>
