// Modal functions
function openCreateModal() {
  document.getElementById("categoryModal").style.display = 'flex';
}

function closeModal() {
  document.getElementById("categoryModal").style.display = 'none';
  document.getElementById("categoryForm").reset();
}

// Optional: Close modal when clicking outside
document.addEventListener("click", function (event) {
  const modal = document.getElementById("categoryModal");

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

  editModal.style.display = 'flex';
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
  deleteModal.style.display = 'flex';
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


// Modal functions for Tags
function openCreateTagModal() {
    document.getElementById("tagModal").style.display = 'flex';
  }
  
  function closeTagModal() {
    document.getElementById("tagModal").style.display = 'none';
    document.getElementById("tagForm").reset();
  }
  
  // Optional: Close modal when clicking outside
  document.addEventListener("click", function (event) {
    const modal = document.getElementById("tagModal");
    const modalContent = modal.querySelector(".relative.bg-white");
  
    if (event.target === modal) {
      closeTagModal();
    }
  });
  
  // Edit Modal for Tags
  const editTagModal = document.getElementById("editTagModal");
  
  function openEditTagModal(id, name) {
    // Set the tag ID and name in the edit modal
    document.getElementById("editTagId").value = id;
    document.getElementById("editTagName").value = name;
  
    // Show modal
    editTagModal.style.display = 'flex';
  }
  
  function closeEditTagModal() {
    // Hide modal
    editTagModal.style.display = 'none';
  }
  
  // Close edit modal when clicking outside
  window.addEventListener("click", (event) => {
    if (event.target === editTagModal) {
      closeEditTagModal();
    }
  });
  
  // Delete Modal for Tags
  const deleteTagModal = document.getElementById("deleteTagModal");
  
  function openDeleteTagModal(id) {
    // Set the tag ID in a hidden input field inside the modal
    document.getElementById("deleteTagId").value = id;
  
    // Show modal
    deleteTagModal.style.display = 'flex';
  }
  
  function closeDeleteTagModal() {
    // Hide modal
    deleteTagModal.style.display = 'none';
  }
  
  // Close delete modal when clicking outside
  window.addEventListener("click", (event) => {
    if (event.target === deleteTagModal) {
      closeDeleteTagModal();
    }
  });
  

    // Delete Modal for Tags
    const deleteCourseModal = document.getElementById("deleteCourseModal");
  
    function openDeleteCourseModal(id) {
      // Set the Course ID in a hidden input field inside the modal
      document.getElementById("deleteCourseId").value = id;
    
      // Show modal
      deleteCourseModal.style.display = 'flex';
    }
    
    function closeDeleteCourseModal() {
      // Hide modal
      deleteCourseModal.style.display = 'none';
    }
    
    // Close delete modal when clicking outside
    window.addEventListener("click", (event) => {
      if (event.target === deleteCourseModal) {
        closeDeleteCourseModal();
      }
    });
    