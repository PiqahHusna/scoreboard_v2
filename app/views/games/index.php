
<!-- Sidebar -->
<div class="sidebar">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
</div>


<h2>Game List</h2>

<a href="index.php?page=game&action=add">Add New Game</a> 



<?php if (!empty($games)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Game Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($games as $game): ?>
            <tr>
                <td><?= $game['id'] ?></td>
                <td><?= htmlspecialchars($game['name']) ?></td>
                <td>
                    <a href="index.php?page=game&action=edit&id=<?= $game['id'] ?>">Edit</a> |
                    <a href="index.php?page=game&action=delete&id=<?= $game['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No games found.</p>
<?php endif; ?>