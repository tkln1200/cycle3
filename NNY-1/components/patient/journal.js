// // Function to populate the journal list
// function populateJournalList(journalsList) {
//   const journalList = document.getElementById("journalList");
//   journalList.innerHTML = "";

//   journalsList.forEach((journal) => {
//     // Create a container for each journal entry
//     const journalItem = document.createElement("div");
//     journalItem.className = "journal-item";

//     // Add the title to container
//     const titleElement = document.createElement("div");
//     journalItem.className = "journal-title";
//     journalItem.textContent = journal.title;
//     journalItem.appendChild(titleElement);

//     // Add the date
//     const dateElement = document.createElement("div");
//     dateElement.className = "journal-date";
//     dateElement.textContent = journal.date;
//     journalItem.appendChild(dateElement);

//     // Add a substring of the content (first 10 words)
//     const contentElement = document.createElement("div");
//     contentElement.className = "journal-content";
//     let content = journal.content;
//     let summary = content.split(" ").slice(0, 10).join(" ") + "...";
//     contentElement.textContent = summary;
//     journalItem.appendChild(contentElement);

//     // Append the journal item to the list
//     journalList.appendChild(journalItem);

//     journalItem.addEventListener("click", () => {
//       showJournalDetails(journal.id);
//     });
//   });
// }

// // Ensure the DOM is fully loaded before running the script
// document.addEventListener("DOMContentLoaded", function () {
//   populateJournalList(journalsList);
// });

// // Function to show journal details
// function showJournalDetails(id) {
//   const journal = journalsList.find((journal) => journal.id === id);
//   if (!journal) return;

//   const detailsPanel = document.querySelector(".journal-details");
//   detailsPanel.innerHTML = `
//       <h2>${journal.title}</h2>
//       <p><strong>Date:</strong> ${journal.date}</p>
//       <p>${journal.content}</></br></br>
//       <img src="${journal.image}"></>
//       <p>Mood: ${journal.moodlevel}</p>
//       `;
// }

// function filterJournals() {
//   const searchInput = document
//     .getElementById("searchInput")
//     .value.toLowerCase();
//   const journalListItems = document.querySelectorAll(
//     "#journalList .journal-title"
//   );

//   journalListItems.forEach((item) => {
//     const title = item.textContent.toLowerCase();
//     if (title.includes(searchInput)) {
//       item.style.display = "";
//     } else {
//       item.style.display = "none";
//     }
//   });
// }

// //Event listener to search entry
// document
//   .getElementById("searchJournal")
//   .addEventListener("click", filterJournals);

// //Event listener to search entry
// document
//   .getElementById("searchInput")
//   .addEventListener("input", filterJournals);

// // Function to handle "Add New Post" button click
// document.addEventListener("DOMContentLoaded", (event) => {
//   var modal = document.getElementById("newJournalModal");
//   var btn = document.getElementById("addNewPostBtn");
//   var span = document.getElementsByClassName("close")[0];

//   btn.onclick = function () {
//     modal.style.display = "block";
//   };

//   span.onclick = function () {
//     modal.style.display = "none";
//   };

//   window.onclick = function (event) {
//     if (event.target == modal) {
//       modal.style.display = "none";
//     }
//   };
// });

// document.getElementById("journalForm").onsubmit = saveJournalEntry;

// // Function to save the new journal entry
// function saveJournalEntry(event) {
//   event.preventDefault();

//   // Prepare the form data
//   const title = document.getElementById("journalTitle").value;
//   const content = document.getElementById("journalContent").value;
//   const moodLevel = document.getElementById("moodLevel").value;

//   // Use form submission to send data to PHP
//   const form = document.getElementById("journalForm");
//   form.submit();
// }

// // Function to get selected mood
// function getSelectedMood() {
//   const moodBtn = document.querySelectorAll(".moodbtn");
//   for (let button of moodBtn) {
//     if (button.classList.contains("selected")) {
//       return button.value;
//     }
//   }
//   return null;
// }

// document.querySelectorAll(".moodbtn").forEach((button) => {
//   button.addEventListener("click", function () {
//     document.querySelectorAll(".moodbtn").forEach((btn) => {
//       btn.classList.remove("selected");
//     });
//     this.classList.add("selected");
//   });
// });

// function displayCurrentDate() {
//   const dateElement = document.getElementById("journalDate");
//   const currentDate = new Date();
//   const options = { year: "numeric", month: "long", day: "numeric" };
//   const formattedDate = currentDate.toLocaleDateString(undefined, options);
//   dateElement.textContent = formattedDate;
// }

// function displayCurrentTime() {
//   const timeElement = document.getElementById("journalTime");
//   const currentDate = new Date();
//   const currentTime = currentDate.toLocaleString([], {
//     hour: "2-digit",
//     minute: "2-digit",
//   });
//   timeElement.textContent = currentTime;
// }

// // Call the function to display the date when the page loads
// document.addEventListener("DOMContentLoaded", displayCurrentDate);
// document.addEventListener("DOMContentLoaded", displayCurrentTime);

// document.getElementById("addNewPostBtn").addEventListener("click", addNewPost);
// document
//   .getElementById("searchInput")
//   .addEventListener("input", filterJournals);

document.addEventListener("DOMContentLoaded", () => {
  // Event listeners for form submission and journal filtering
  const newJournalForm = document.getElementById("new-journal-form");
  if (newJournalForm) {
    newJournalForm.addEventListener("submit", addNewJournal);
  }

  const filterInput = document.getElementById("filter-input");
  if (filterInput) {
    filterInput.addEventListener("keyup", filterJournals);
  }
});

function selectMood(moodValue) {
  document.getElementById("moodLevel").value = moodValue; // Set the selected mood level
  const moodButtons = document.querySelectorAll(".moodbtn");

  // Optional: Visual feedback to indicate the selected mood
  moodButtons.forEach((button) => {
    button.style.backgroundColor = ""; // Reset background
  });
  document.getElementById("btn" + moodValue).style.backgroundColor = "#cce5ff"; // Highlight selected
}

// Function to add a new journal entry
function addNewJournal(event) {
  event.preventDefault(); // Prevent the default form submission

  const formData = new FormData(event.target);

  fetch("add_journal.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      // Handle the response (update the journal list or show a message)
      alert("Journal entry added successfully!");
      loadJournals(); // Refresh the journal list
      event.target.reset(); // Reset the form
    })
    .catch((error) => {
      console.error("Error adding journal entry:", error);
    });
}

// Function to load and display past journals
function loadJournals() {
  const patientId = sessionStorage.getItem("patientId"); // Assuming you store patient_id in session storage

  fetch(`fetch_journals.php?patientId=${patientId}`)
    .then((response) => response.json())
    .then((journals) => {
      const journalList = document
        .getElementById("journal-list")
        .getElementsByTagName("ul")[0];
      journalList.innerHTML = ""; // Clear existing entries

      journals.forEach((journal) => {
        const li = document.createElement("li");
        li.textContent = `${journal.title} - ${journal.date}`;
        li.onclick = () => showJournalDetails(journal.id);
        journalList.appendChild(li);
      });
    })
    .catch((error) => {
      console.error("Error fetching journals:", error);
    });
}

// Function to filter journals by title
function filterJournals() {
  const input = document.getElementById("filter-input");
  const filter = input.value.toLowerCase();
  const journalList = document
    .getElementById("journal-list")
    .getElementsByTagName("li");

  for (let i = 0; i < journalList.length; i++) {
    const title = journalList[i].textContent || journalList[i].innerText;
    journalList[i].style.display = title.toLowerCase().includes(filter)
      ? ""
      : "none";
  }
}

function showJournalDetails(journalId) {
  fetch(`get_journal_details.php?id=${journalId}`)
    .then((response) => response.json())
    .then((data) => {
      // Clear the details content area
      const detailsContent = document.getElementById("details-content");
      detailsContent.innerHTML = `
              <h3>${data.title}</h3>
              <p><strong>Date:</strong> ${data.dateCreated}</p>
              <p><strong>Details:</strong> ${data.details}</p>
              <p><strong>Mood Level:</strong> ${data.moodLevel}</p>
          `;

      // Display the file if it exists
      if (data.file) {
        detailsContent.innerHTML += `<p><strong>Attached File:</strong> <a href="data:application/octet-stream;base64,${btoa(
          data.file
        )}" download="${data.title}.bin">Download</a></p>`;
      }
    })
    .catch((error) => {
      console.error("Error fetching journal details:", error);
    });
}

// Load journals on page load
loadJournals();
