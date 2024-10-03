// Function to populate the journal list
function populateJournalList(journalsList) {
  const journalList = document.getElementById("journalList");
  journalList.innerHTML = "";

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
    let content = journal.content;
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

// Function to show journal details
function showJournalDetails(id) {
  const journal = journalsList.find((journal) => journal.id === id);
  if (!journal) return;

  const detailsPanel = document.querySelector(".journal-details");
  detailsPanel.innerHTML = `
      <h2>${journal.title}</h2>
      <p><strong>Date:</strong> ${journal.date}</p>
      <p>${journal.content}</></br></br>
      <img src="${journal.image}"></>
      <p>Mood: ${journal.moodlevel}</p>
      `;
}

function filterJournals() {
  const searchInput = document
    .getElementById("searchInput")
    .value.toLowerCase();
  const journalListItems = document.querySelectorAll(
    "#journalList .journal-title"
  );

  journalListItems.forEach((item) => {
    const title = item.textContent.toLowerCase();
    if (title.includes(searchInput)) {
      item.style.display = "";
    } else {
      item.style.display = "none";
    }
  });
}

//Event listener to search entry
document
  .getElementById("searchJournal")
  .addEventListener("click", filterJournals);

//Event listener to search entry
document
  .getElementById("searchInput")
  .addEventListener("input", filterJournals);

// Function to handle "Add New Post" button click
document.addEventListener("DOMContentLoaded", (event) => {
  var modal = document.getElementById("newJournalModal");
  var btn = document.getElementById("addNewPostBtn");
  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function () {
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

document.getElementById("journalForm").onsubmit = saveJournalEntry;

// Function to save the new journal entry
function saveJournalEntry(event) {
  event.preventDefault();
  const title = document.getElementById("journalTitle").value;
  const content = document.getElementById("journalContent").value;
  const moodlevel = getSelectedMood();
  const date = new Date().toLocaleDateString();
  // Add new journal to the list
  const newJournal = {
    id: journalsList.length + 1,
    title,
    date,
    moodlevel,
    content,
  };
  journalsList.push(newJournal);
  // Update the journal list and show the new entry
  populateJournalList(journalList); // Ensure this function updates the displayed list
  console.log(journalsList);
  showJournalDetails(newJournal); // Show the new journal entry details
  // Clear modal and close
  document.getElementById("journalForm").reset();
  document.getElementById("newJournalModal").style.display = "none";
}

// Function to get selected mood
function getSelectedMood() {
  const moodBtn = document.querySelectorAll(".moodbtn");
  for (let button of moodBtn) {
    if (button.classList.contains("selected")) {
      return button.value;
    }
  }
  return null;
}

document.querySelectorAll(".moodbtn").forEach((button) => {
  button.addEventListener("click", function () {
    document.querySelectorAll(".moodbtn").forEach((btn) => {
      btn.classList.remove("selected");
    });
    this.classList.add("selected");
  });
});

function displayCurrentDate() {
  const dateElement = document.getElementById("journalDate");
  const currentDate = new Date();
  const options = { year: "numeric", month: "long", day: "numeric" };
  const formattedDate = currentDate.toLocaleDateString(undefined, options);
  dateElement.textContent = formattedDate;
}

function displayCurrentTime() {
  const timeElement = document.getElementById("journalTime");
  const currentDate = new Date();
  const currentTime = currentDate.toLocaleString([], {
    hour: "2-digit",
    minute: "2-digit",
  });
  timeElement.textContent = currentTime;
}

// Call the function to display the date when the page loads
document.addEventListener("DOMContentLoaded", displayCurrentDate);
document.addEventListener("DOMContentLoaded", displayCurrentTime);

document.getElementById("addNewPostBtn").addEventListener("click", addNewPost);
document
  .getElementById("searchInput")
  .addEventListener("input", filterJournals);
