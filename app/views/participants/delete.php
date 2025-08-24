<!-- Trigger Delete Button -->
<button class="btn btn-danger" id="openDeleteModal">
    🗑️ Delete Participant
</button> 

<!-- Delete Participant Modal -->

<h2>Hapus Participant</h2>
<p>Apakah anda yakin ingin menghapus participant: <strong><?= htmlspecialchars($participant['name']) ?></strong>?</p>

<form method="POST" action="?page=participant&action=delete&id=<?= $participant['id'] ?>">
    <button type="submit">Hapus</button>
    <a href="?page=participant&action=list">Batal</a>
</form>
