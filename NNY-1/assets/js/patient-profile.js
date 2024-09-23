
let details = "Lorem ipsum dolor sit amet consectetur adipisicing elit.   Commodi numquam vero sed beatae nam, ipsam itaque cumque quisquam. Saepe reiciendis quasi aperiam quidem voluptatum similique id ad beatae ut fugit?";
let details2 = "Lorem ipsum dolor sit amet consectetur adipisicing elit.   Commodi numquam vero sed beatae nam, ipsam itaqu";
// Arrays of box sets

const boxSets = [
    [details, details, details],
    [details, details, details2],
    [details, details2, details],
];

let currentSet = 0;
let isTransitioning = false; // Flag to prevent overlapping transitions

// Function to display boxes based on the current set index
function displayBoxes() {
    const container = document.getElementById('boxContainer');
    container.innerHTML = ''; // Clear previous boxes

    boxSets[currentSet].forEach(boxText => {
        const box = document.createElement('div');
        box.classList.add('patient-box');
        box.textContent = boxText;
        container.appendChild(box);
    });

    // Disable Previous button if on the first set
    document.getElementById('prevBtn').disabled = currentSet === 0;

    // Disable Next button if on the last set
    document.getElementById('nextBtn').disabled = currentSet === boxSets.length - 1;
}

// Function to show the next set of boxes
function showNext() {
    if (currentSet < boxSets.length - 1) {
        currentSet++;
        displayBoxes();
    }
}

// Function to show the previous set of boxes
function showPrevious() {
    if (currentSet > 0) {
        currentSet--;
        displayBoxes();
    }
}

// Initial display of boxes
displayBoxes();
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
    { name: "December", days: 31 }
];

let currentMonth = 8; // September (0-based index)
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
    calendarGrid.style.transform = 'translateX(100%)';
    generateCalendar(currentMonth, currentYear);
    calendarGrid.style.transform = 'translateX(-100%)'; // Pre-position
    calendarGrid.style.transform = 'translateX(0)';
}

// Function to handle switching to the previous month
function prevMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }

    // Slide animation effect for previous month
    calendarGrid.style.transform = 'translateX(-100%)';

    generateCalendar(currentMonth, currentYear);
    calendarGrid.style.transform = 'translateX(100%)'; // Pre-position
    calendarGrid.style.transform = 'translateX(0)';

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
    let trimmedText = text_token.map(sentence => sentence.trim());
    let refined_text = trimmedText.join(" ")
    // Pre-fill the form with captured data
    const details = document.getElementById("details");
    details.innerHTML= refined_text;



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
window.addEventListener("click", function(event) {
    if (event.target === popupForm) {
        closePopup();
    }
});