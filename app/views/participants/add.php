<?php
// Start output buffering to prevent header issues
ob_start();
?>

<!-- 🔙 Back to Dashboard Link -->
<div class="navigation-container">
    <a href="/scoreboard_system/index.php?page=dashboard" class="btn-back">
        ⬅ Back to Dashboard
    </a>
</div>


    <h2>Register Participant</h2>

    <form method="POST" action="?page=participant&action=add" enctype="multipart/form-data">

        <!-- Event Date -->
        <div class="form-group">
            <label for="event_date">Event Date <span style="color:red">*</span></label>
            <select name="event_date" id="event_date" required>
                <option value="">-- Choose Event Date --</option>
                <?php foreach ($dates as $d): ?>
                    <option value="<?= $d['id']; ?>">
                        <?= htmlspecialchars($d['date']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Package -->
        <div class="form-group">
            <label for="package">Package <span style="color:red">*</span></label>
            <select name="package" id="package" required>
                <option value="">-- Choose Package --</option>
                <?php foreach ($packages as $p): ?>
                    <option value="<?= $p['id']; ?>">
                        <?= htmlspecialchars($p['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Upload Package Picture -->
        <div class="form-group">
            <label for="package_picture">Upload Package Picture (optional)</label>
            <input type="file" name="package_picture" id="package_picture" accept="image/*">
        </div>

        <!-- Additional Sessions -->
        <div class="form-group">
            <label>Additional Sessions:</label><br>
            <?php foreach ($sessions as $s): ?>
                <div>
                    <input type="checkbox" 
                           name="additional_sessions[]" 
                           value="<?= $s['id']; ?>" 
                           id="session_<?= $s['id']; ?>">
                    <label for="session_<?= $s['id']; ?>">
                        <?= htmlspecialchars($s['name']); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email <span style="color:red">*</span></label>
            <input type="email" name="email" id="email" required>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Full Name <span style="color:red">*</span></label>
            <input type="text" name="name" id="name" required>
        </div>

        <!-- IC Number -->
        <div class="form-group">
            <label for="ic_number">IC Number <span style="color:red">*</span></label>
            <input type="text" name="ic_number" id="ic_number" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="3"></textarea>
        </div>

        <!-- Company -->
        <div class="form-group">
            <label for="company">Company / Agency</label>
            <input type="text" name="company" id="company">
        </div>

        <!-- Position -->
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position">
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone_number">Phone Number <span style="color:red">*</span></label>
            <input type="text" name="phone_number" id="phone_number" required>
        </div>

        <!-- Gun License -->
        <div class="form-group">
            <label for="gun_license">Gun License Ownership</label>
            <select name="gun_license" id="gun_license">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>

        <!-- Shooting Experience -->
        <div class="form-group">
            <label for="shooting_experience">Shooting Experience</label>
            <select name="shooting_experience" id="shooting_experience">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>
</div>

</body>
</html>
