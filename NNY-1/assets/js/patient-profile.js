const boxContainer = document.getElementById("boxContainer");
let currentSet = 0;
const journalsPerPage = 3; // Number of journals to show at a time

function displayJournals() {
  // Clear previous content
  boxContainer.innerHTML = "";

  // Calculate start and end indices for the current set
  const start = currentSet * journalsPerPage;
  const end = start + journalsPerPage;

  // Slice the journals array and create HTML elements for each journal in the current set
  journals.slice(start, end).forEach((journal) => {
    const box = document.createElement("div");
    box.classList.add("patient-box");
    box.textContent = journal;
    boxContainer.appendChild(box);
  });

  // Disable the Previous button if on the first set
  document.getElementById("prevBtn").disabled = currentSet === 0;

  // Disable the Next button if on the last set
  document.getElementById("nextBtn").disabled = end >= journals.length;
}

// Functions to navigate between sets
function showNext() {
  if ((currentSet + 1) * journalsPerPage < journals.length) {
    currentSet++;
    displayJournals();
  }
}

function showPrevious() {
  if (currentSet > 0) {
    currentSet--;
    displayJournals();
  }
}

// Attach event listeners to navigation buttons
document.getElementById("prevBtn").addEventListener("click", showPrevious);
document.getElementById("nextBtn").addEventListener("click", showNext);

// Initial display
displayJournals();
const months = [
  { name: "January", days: 31 },
  { name: "February", days: 28 }, // Leap year handling is optional
  { name: "March", days: 31 },
  { name: "April", days: 30 },
  { name: "May", days: 31 },
  { name: "June", days: 30 },
  { name: "July", days: 31 },
  { name: "August", days: 31 },
  { name: "September", days: 30 },
  { name: "October", days: 31 },
  { name: "November", days: 30 },
  { name: "December", days: 31 },
];

let currentMonth = 9; // September (0-based index)
let currentYear = 2024;

const calendarGrid = document.getElementById("calendar-grid");
const monthNameElement = document.getElementById("month-name");

// Function to generate the days in the calendar
function generateCalendar(monthIndex, year) {
  const month = months[monthIndex];
  monthNameElement.textContent = `${month.name} ${year}`;

  // Clear previous days
  calendarGrid.innerHTML = `
        <div class="weekday">Sun</div>
        <div class="weekday">Mon</div>
        <div class="weekday">Tue</div>
        <div class="weekday">Wed</div>
        <div class="weekday">Thu</div>
        <div class="weekday">Fri</div>
        <div class="weekday">Sat</div>
    `;

  const firstDay = new Date(year, monthIndex, 1).getDay(); // Day of the week the month starts on

  // Add empty slots before the 1st of the month
  for (let i = 0; i < firstDay; i++) {
    calendarGrid.innerHTML += `<div class="day empty"></div>`;
  }

  // Add the days of the month
  for (let day = 1; day <= month.days; day++) {
    calendarGrid.innerHTML += `<div class="day">${day}</div>`;
  }
}

// Function to handle switching to the next month
function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }

  // Slide animation effect for next month
  calendarGrid.style.transform = "translateX(100%)";
  generateCalendar(currentMonth, currentYear);
  calendarGrid.style.transform = "translateX(-100%)"; // Pre-position
  calendarGrid.style.transform = "translateX(0)";
}

// Function to handle switching to the previous month
function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }

  // Slide animation effect for previous month
  calendarGrid.style.transform = "translateX(-100%)";

  generateCalendar(currentMonth, currentYear);
  calendarGrid.style.transform = "translateX(100%)"; // Pre-position
  calendarGrid.style.transform = "translateX(0)";
}

// Initial load of calendar for September 2024
generateCalendar(currentMonth, currentYear);

const popupForm = document.getElementById("popupForm");
const openPopupBtn = document.getElementById("notesBtn");
const closePopupBtn = document.getElementById("closePopup");

// Function to open the popup and pre-fill the form
function openPopup() {
  const notes = document.querySelector(".notes-details");
  let text = notes.textContent;
  let text_token = text.split(/(?<=[.?!])\s+/);
  let trimmedText = text_token.map((sentence) => sentence.trim());
  let refined_text = trimmedText.join(" ");
  // Pre-fill the form with captured data
  const details = document.getElementById("details");
  details.innerHTML = refined_text;

  // Show the popup
  popupForm.style.display = "flex";
}

// Function to close the popup
function closePopup() {
  popupForm.style.display = "none";
}

// Open the popup when the button is clicked
openPopupBtn.addEventListener("click", openPopup);

// Close the popup when the close button is clicked
closePopupBtn.addEventListener("click", closePopup);

// Optional: Close the popup when clicking outside the form
window.addEventListener("click", function (event) {
  if (event.target === popupForm) {
    closePopup();
  }
});
