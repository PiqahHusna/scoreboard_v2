//butang delete participant modal (butang pop out)

// Modal Logic
const modal = document.getElementById("deleteModal");
const span = modal.querySelector(".close");
const cancelBtn = document.getElementById("cancelDelete");
const participantName = document.getElementById("participantName");
const participantId = document.getElementById("participantId");

// Open modal when delete button clicked
document.querySelectorAll(".openDeleteModal").forEach(button => {
    button.addEventListener("click", () => {
        participantId.value = button.dataset.id;
        participantName.textContent = button.dataset.name;
        modal.style.display = "block";
    });
});

// Close modal
span.onclick = () => modal.style.display = "none";
cancelBtn.onclick = () => modal.style.display = "none";

// Close if click outside modal
window.onclick = (event) => {
    if (event.target === modal) modal.style.display = "none";
}
