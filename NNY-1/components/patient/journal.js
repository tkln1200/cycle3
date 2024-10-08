let journalsList = [];

function populateJournalList(journals) {
  console.log("Journals received:", journals);
  journalsList = journals;
  const journalList = document.getElementById("journalList");
  journalList.innerHTML = "";

  journalsList.forEach((journal) => {
    // Create a container for each journal entry
    const journalItem = document.createElement("div");
    journalItem.className = "journal-item";

    // Add the title to container
    const titleElement = document.createElement("div");
    titleElement.className = "journal-title";
    titleElement.textContent = journal.title;
    journalItem.appendChild(titleElement);

    // Add the date
    const dateElement = document.createElement("div");
    dateElement.className = "journal-date";
    dateElement.textContent = journal.dateCreated;
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

//////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to show journal details
function showJournalDetails(id) {
  const journal = journalsList.find((journal) => journal.id === id);
  if (!journal) return;

  const detailsPanel = document.querySelector(".journal-details");
  detailsPanel.innerHTML = `
      <h2>${journal.title}</h2>
      <p><strong>Date:</strong> ${journal.dateCreated}</p>
      <p><strong>Time:</strong> ${journal.timeCreated}</p>
      <p>${journal.details}</></br></br>
      ${
        journal.file
          ? `<img src="./uploads/${journal.file}" alt="Journal Image" />`
          : ""
      }
      <p>Mood: ${journal.moodLevel}</p>
      `;
}

//////////////////////////////////////////

function filterJournals() {
  const searchInput = document
    .getElementById("searchInput")
    .value.toLowerCase();
  const journalItems = document.querySelectorAll("#journalList .journal-item");

  journalItems.forEach((item) => {
    const titleElement = item.querySelector(".journal-title");

    if (titleElement) {
      const title = titleElement.textContent.toLowerCase();
      if (title.includes(searchInput)) {
        item.style.display = ""; // Show item if it matches
      } else {
        item.style.display = "none"; // Hide item if it doesn't match
      }
    } else {
      console.warn("Journal title element not found for:", item); // Optional: log a warning
    }
  });
}

// Event listener to search entry
document
  .getElementById("searchInput")
  .addEventListener("input", filterJournals);
