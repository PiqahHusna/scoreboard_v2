<h2>Edit Assig Participant</h2>
<form method="post">
    <label>Participant:</label>
    <select name="participantId" required>
        <?php foreach($participants as $participant): ?>
            <option value="<?= $participant['id'] ?>" <?= $participant['id'] == $assignment['participant_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($participant['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Games:</label>
    <select name="gameIds[]" multiple required>
        <?php 
        // Ambil game yang sudah dipilih oleh assignment
        $selectedGames = isset($assignment['game_ids']) ? $assignment['game_ids'] : [];
        foreach($games as $game): 
        ?>
            <option value="<?= $game['id'] ?>" <?= in_array($game['id'], $selectedGames) ? 'selected' : '' ?>>
                <?= htmlspecialchars($game['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <small>Hold Ctrl (Windows) / Cmd (Mac) to select multiple games</small>

    <button type="submit">Update</button>
</form>
<a href="?page=assignment&action=index">Back</a>
