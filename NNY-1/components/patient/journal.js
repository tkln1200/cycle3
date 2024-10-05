let journalsList = [];

function populateJournalList(journals) {
  console.log("Journals received:", journals);
  journalsList = journals;
  const journalList = document.getElementById("journalList");
  // journalList.innerHTML = "";

  journalsList.forEach((journal) => {
    // Create a container for each journal entry
    const journalItem = document.createElement("div");
    journalItem.className = "journal-item";

    // Add the title to container
    const titleElement = document.createElement("div");
    journalItem.className = "journal-title";
    journalItem.textContent = journal.title;
    journalItem.appendChild(titleElement);

    // Add the date
    const dateElement = document.createElement("div");
    dateElement.className = "journal-date";
    dateElement.textContent = journal.date;
    journalItem.appendChild(dateElement);

    // Add a substring of the content (first 10 words)
    const contentElement = document.createElement("div");
    contentElement.className = "journal-content";
    let content = journal.details;
    let summary = content.split(" ").slice(0, 10).join(" ") + "...";
    contentElement.textContent = summary;
    journalItem.appendChild(contentElement);

    // Append the journal item to the list
    journalList.appendChild(journalItem);

    journalItem.addEventListener("click", () => {
      showJournalDetails(journal.id);
    });
  });
}

// Ensure the DOM is fully loaded before running the script
document.addEventListener("DOMContentLoaded", function () {
  populateJournalList(journalsList);
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////

// Function to handle "Add New Post" button click
document.addEventListener("DOMContentLoaded", (event) => {
  var modal = document.getElementById("newJournalModal");
  var btn = document.getElementById("addNewPostBtn");
  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function () {
    console.log("Button clicked!"); // Add this line
    modal.style.display = "block";
  };

  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});

// document.getElementById("journalForm").onsubmit = saveJournalEntry;
document.getElementById("addNewPostBtn").addEventListener("click", addNewPost);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Function to save journal
// Function to handle mood level selection
document.querySelectorAll(".moodbtn").forEach((button) => {
  button.addEventListener("click", function () {
    // Set the value of the hidden input to the value of the clicked button
    document.getElementById("moodLevel").value = this.value;

    // Remove 'selected' class from all buttons
    document
      .querySelectorAll(".moodbtn")
      .forEach((btn) => btn.classList.remove("selected"));

    // Add 'selected' class to the clicked button
    this.classList.add("selected");
  });
});

// Function to submit journal entry
function submitJournalEntry() {
  const journalTitle = document.getElementById("journal-title").value; // Example for title
  const journalContent = document.getElementById("journal-content").value; // Example for content
  const moodLevelValue = document.getElementById("moodLevel").value;

  // Example AJAX request to send data to the server
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "submit-journal.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Journal entry submitted successfully!");
      // Optionally reset the form or close the modal here
    }
  };

  // Prepare data to send
  const data = `title=${encodeURIComponent(
    journalTitle
  )}&content=${encodeURIComponent(
    journalContent
  )}&moodLevel=${encodeURIComponent(moodLevelValue)}`;
  xhr.send(data);
}

// Call the function on form submission (or button click)
document
  .getElementById("submit-button")
  .addEventListener("click", submitJournalEntry);

//////////////////////////////////////////////////////////////////////////////////////////////////////////
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

// // Call the function to display the date when the page loads

// document
//   .getElementById("searchInput")
//   .addEventListener("input", filterJournals);
