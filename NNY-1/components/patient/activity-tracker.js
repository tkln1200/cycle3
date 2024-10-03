// Calendar

document.addEventListener("DOMContentLoaded", () => {
    initializeCalendar();
});

let currentMonth = 8;
let currentYear = 2024;

function initializeCalendar() {
    generateCalendar(currentMonth, currentYear);
    document.getElementById("prevMonth").addEventListener("click", prevMonth);
    document.getElementById("nextMonth").addEventListener("click", nextMonth);
}

const months = [
    { name: "January", days: 31 },
    { name: "February", days: 28 }, 
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

function generateCalendar(monthIndex, year) {
    const calendarGrid = document.getElementById("calendar-grid");
    const monthNameElement = document.getElementById("month-name");
    const month = months[monthIndex];
    
    monthNameElement.textContent = `${month.name} ${year}`;
    calendarGrid.innerHTML = generateDaysGrid(monthIndex, year);
}

function generateDaysGrid(monthIndex, year) {
    const month = months[monthIndex];
    const firstDay = new Date(year, monthIndex, 1).getDay();
    let gridContent = `
        <div class="weekday">Sun</div><div class="weekday">Mon</div>
        <div class="weekday">Tue</div><div class="weekday">Wed</div>
        <div class="weekday">Thu</div><div class="weekday">Fri</div><div class="weekday">Sat</div>
    `;

    gridContent += `<div class="day empty"></div>`.repeat(firstDay);
    for (let day = 1; day <= month.days; day++) {
        gridContent += `<div class="day">${day}</div>`;
    }
    return gridContent;
}

function nextMonth() {
    currentMonth = (currentMonth + 1) % 12;
    if (currentMonth === 0) currentYear++;
    generateCalendar(currentMonth, currentYear);
}

function prevMonth() {
    currentMonth = (currentMonth - 1 + 12) % 12;
    if (currentMonth === 11) currentYear--;
    generateCalendar(currentMonth, currentYear);
}