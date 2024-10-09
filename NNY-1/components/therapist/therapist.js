document.addEventListener("DOMContentLoaded", function () {
  const createGroupBtn = document.getElementById("createGroupBtn");
  const groupFormModal = document.getElementById("groupFormModal");
  const closeModalBtn = document.querySelector(".close");
  const groupForm = document.getElementById("groupForm");

  // Function to handle Create Group button click
  createGroupBtn.addEventListener("click", function () {
    const selectedPatients = Array.from(
      document.querySelectorAll(".select-patient:checked")
    );

    // Check if any patients have been selected
    if (selectedPatients.length === 0) {
      alert("Please select at least one patient to create a group.");
      return;
    }

    // Show the modal if patients are selected
    groupFormModal.style.display = "block";

    // Populate the participants field with the selected patients' names
    const participants = selectedPatients
      .map((checkbox) => {
        const row = checkbox.closest("tr");
        return row.querySelector("td:nth-child(3)").textContent; // Assuming the name is in the 3rd column
      })
      .join(", ");
    document.getElementById("participants").value = participants;
  });

  // Close the modal when the close button is clicked
  closeModalBtn.addEventListener("click", function () {
    groupFormModal.style.display = "none";
  });

  // Handle form submission
  groupForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission behavior

    // After form submission, redirect to the group page
    window.location.href = "/pages/group-page.html";
  });

  // Close the modal if clicking outside of it
  window.addEventListener("click", function (event) {
    if (event.target === groupFormModal) {
      groupFormModal.style.display = "none";
    }
  });
});
const createGroupBtn = document.getElementById("createGroupBtn");
const groupFormModal = document.getElementById("groupFormModal");
const closeBtn = document.querySelector(".close");
const groupForm = document.getElementById("groupForm");
const participantsField = document.getElementById("participants");

// Open modal
createGroupBtn.addEventListener("click", function () {
  const selectedPatients = Array.from(
    document.querySelectorAll(".select-patient:checked")
  )
    .map(
      (checkbox) =>
        checkbox.closest("tr").querySelector("td:nth-child(3)").textContent
    )
    .join(", ");

  if (selectedPatients.length === 0) {
    alert("Please select at least one patient.");
    return;
  }

  participantsField.value = selectedPatients;
  groupFormModal.style.display = "block";
});

// Close modal
closeBtn.addEventListener("click", function () {
  groupFormModal.style.display = "none";
});

// Handle form submission
groupForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // Get form data (you can save or send this data to a server)
  const groupName = document.getElementById("groupName").value;
  const participants = participantsField.value;
  const availableSpace = document.getElementById("availableSpace").value;
  const time = document.getElementById("time").value;
  const date = document.getElementById("date").value;
  const location = document.getElementById("location").value;

  console.log("Group Created:", {
    groupName,
    participants,
    availableSpace,
    time,
    date,
    location,
  });

  // Redirect to the group page (this could be a dynamic URL or a specific page)
  window.location.href = "pages/group-page.html";
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
document.getElementById('groupForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission

  // Collect selected patient IDs
  let selectedPatients = [];
  document.querySelectorAll('input[name="patient_ids[]"]:checked').forEach((checkbox) => {
    selectedPatients.push(checkbox.value);
  });

  // Set the JSON string of selected IDs to the hidden input
  document.getElementById('selectedPatients').value = JSON.stringify(selectedPatients);

  // Submit the form after setting the hidden input
  this.submit();
});
