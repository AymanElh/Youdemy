// Modal functions
function openCreateModal() {
  document.getElementById("categoryModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("categoryModal").classList.add("hidden");
  document.getElementById("categoryForm").reset();
}

// Optional: Close modal when clicking outside
document.addEventListener("click", function (event) {
  const modal = document.getElementById("categoryModal");
  const modalContent = modal.querySelector(".relative.bg-white");

  if (event.target === modal) {
    closeModal();
  }
});

// edit modal
const editModal = document.getElementById("editCategoryModal");
console.log(editModal);

function openEditModal(id, name) {
  document.getElementById("editCategoryId").value = id;
  document.getElementById("editCategoryName").value = name;

  editModal.classList.remove("hidden");
}

function closeEditModal() {
  editModal.classList.add("hidden");
}

window.addEventListener("click", (event) => {
  if (event.target === editModal) {
    closeEditModal();
  }
});

// delete modal
const deleteModal = document.getElementById("deleteCategoryModal");

function openDeleteModal(id) {
  // Set the category ID in a hidden input field inside the modal
  document.getElementById("deleteCategoryId").value = id;

  // Show modal
  deleteModal.classList.remove("hidden");
}

function closeDeleteModal() {
  // Hide modal
  deleteModal.classList.add("hidden");
}

// Close modal when clicking outside the modal content
window.addEventListener("click", (event) => {
  if (event.target === deleteModal) {
    closeDeleteModal();
  }
});
