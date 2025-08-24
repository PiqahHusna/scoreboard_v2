<?php $row = $row ?? null; if ($row): ?>
<form method="post" action="index.php?page=assignment&action=delete" style="display:inline;">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit">🗑️ Delete</button>
</form>
<?php endif; ?>
