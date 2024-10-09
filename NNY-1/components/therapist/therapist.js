document.addEventListener("DOMContentLoaded", function () {
  const createGroupBtn = document.getElementById("createGroupBtn");
  const groupFormModal = document.getElementById("groupFormModal");
  const closeModalBtn = document.querySelector(".close");
  const groupForm = document.getElementById("groupForm");

  createGroupBtn.addEventListener("click", function () {
    const selectedPatients = Array.from(
      document.querySelectorAll(".select-patient:checked")
    );

    if (selectedPatients.length === 0) {
      alert("Please select at least one patient to create a group.");
      return;
    }

    groupFormModal.style.display = "block";

    // Get and join patient IDs
    const patientIds = selectedPatients.map(checkbox => checkbox.value).join(",");
    document.getElementById("patientIds").value = patientIds;

    // Get and join patient names
    const participants = selectedPatients
      .map(checkbox => {
        const row = checkbox.closest("tr");
        return row.querySelector("td:nth-child(3)").textContent;
      })
      .join(", ");
    document.getElementById("participants").value = participants;
  });

  closeModalBtn.addEventListener("click", function () {
    groupFormModal.style.display = "none";
  });

  // groupForm.addEventListener("submit", function (e) {
  //   e.preventDefault();

  //   // Submit the form data using AJAX or redirect to another page
  //   // Example: Redirect after form submission
  //   window.location.href = "/pages/group-page.html";
  // });

  window.addEventListener("click", function (event) {
    if (event.target === groupFormModal) {
      groupFormModal.style.display = "none";
    }
  });
});


// Close modal if clicking outside of it
window.addEventListener("click", function (event) {
  if (event.target === groupFormModal) {
    groupFormModal.style.display = "none";
  }
});

function changeTableColor(selectElement) {
  // Get the value of the selected option
  const follow = selectElement.value;
  const row = selectElement.closest("tr");

  // Get the table element
  const table = document.getElementById("myTable");

  // If a color is selected, change the background color of the table
  if (follow == "follow") {
    row.style.backgroundColor = "#B79CEB";
  } else {
    // Reset to default color if no color is selected
    row.style.backgroundColor = "white";
  }
}
