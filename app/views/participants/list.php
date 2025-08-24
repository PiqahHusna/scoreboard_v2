
<!-- Sidebar -->
<div class="sidebar">
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>
</div>

<!-- Content -->
<main class="content">
    <!-- Controls Section -->
    <div class="list-controls">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search participants..." class="search-input">
            <button class="search-button">🔍</button>
        </div>
        <div class="add-button">
            <a href="index.php?page=participant&action=add" class="btn btn-primary">➕ Add Participant</a>
        </div>
    </div>

    <!-- Status Messages -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (empty($participants)): ?>
        <div class="empty-state">
            <p>No participants found.</p>
            <a href="/scoreboard_system/index.php?page=participant&action=add" class="btn btn-primary">
                Register First Participant
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="participants-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Package</th>
                        <th>Event Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participants as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['id']) ?></td>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['email']) ?></td>
                            <td>
                                <span class="package-tag <?= htmlspecialchars($p['package']) ?>">
                                    <?= htmlspecialchars(ucfirst($p['package'])) ?>
                                </span>
                            </td>
                            <td><?= date('M d, Y', strtotime($p['event_date'])) ?></td>
                            <td class="actions">
                                <a href="index.php?page=participant&action=edit&id=<?= urlencode($p['id']) ?>"
                                    class="btn btn-edit" title="Edit">✏ Edit</a>
                                <a href="index.php?page=participant&action=delete&id=<?= urlencode($p['id']) ?>"
                                    class="btn btn-delete" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this participant?')">🗑 Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="btn-prev">⬅ Previous</button>
            <span class="page-info">Page 1 of 5</span>
            <button class="btn-next">Next ➡</button>
        </div>
    <?php endif; ?>
</main><!-- end .content -->

</div><!-- end .main-layout -->

</body>

</html>