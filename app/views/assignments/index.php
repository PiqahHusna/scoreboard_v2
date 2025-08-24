<!-- Sidebar -->
<div class="sidebar">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
</div>


<h2>Assign Participant </h2>
<a href="?page=assignment&action=add">Add New Assign Participant </a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Participant</th>
        <th>Game</th>
        <th>Actions</th>
    </tr>
    <?php if (!empty($assignments)): ?>
        <?php foreach($assignments as $assignment): ?>
            <tr>
                <td><?= htmlspecialchars($assignment['id']) ?></td>
                <td><?= htmlspecialchars($assignment['participantName']) ?></td>
                <td><?= htmlspecialchars($assignment['gameName']) ?></td>
                <td>
                    <a href="?page=assignment&action=edit&id=<?= $assignment['id'] ?>">Edit</a> |
                    <a href="?page=assignment&action=delete&id=<?= $assignment['id'] ?>" onclick="return confirm('Delete this assign participant?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4" style="text-align:center;">No assignments found.</td></tr>
    <?php endif; ?>
</table>


