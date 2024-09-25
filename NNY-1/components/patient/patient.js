// DOM Elements
const quotes = document.querySelectorAll(".affirmation-slider .quote");
const dots = document.querySelectorAll(".dots .dot");
let currentQuote = 0;
let currentMonth = 8;
let currentYear = 2024;

document.addEventListener("DOMContentLoaded", () => {
    initializeGoalSetting();
    initializeQuoteSlider();
    initializeGoalModal();
    loadDailyAffirmation();
    initializeCalendar();
    initializeLineChart();
});

function initializeGoalSetting() {
    const setGoalButton = document.getElementById("setGoalButton");
    const newGoalModal = document.getElementById("newGoalModal");
    const goalInput = document.getElementById("goalInput");
    const closeButtons = document.querySelectorAll(".close");

    setGoalButton.addEventListener("click", () => {
        newGoalModal.style.display = "block";
        goalInput.value = "";
    });

    closeButtons.forEach(button => {
        button.addEventListener("click", () => {
            newGoalModal.style.display = "none";
        });
    });

    document.getElementById("goalForm").onsubmit = (event) => {
        event.preventDefault();
        const goal = goalInput.value;
        console.log("New Goal:", goal);
        document.getElementById("weeklyGoalText").textContent = goal;
        newGoalModal.style.display = "none";
    };
}

function initializeQuoteSlider() {
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => showQuote(index));
    });

    setInterval(() => {
        const nextQuote = (currentQuote + 1) % quotes.length;
        showQuote(nextQuote);
    }, 3000);
}

function showQuote(index) {
    quotes[currentQuote].classList.remove("active");
    dots[currentQuote].classList.remove("active");
    currentQuote = index;
    quotes[currentQuote].classList.add("active");
    dots[currentQuote].classList.add("active");
}

function initializeGoalModal() {
    const goalLink = document.getElementById("goalLink");
    const goalModal = document.getElementById("goalModal");
    const closeModal = document.querySelector(".modal .close");
    const completeGoalButton = document.getElementById("completeGoal");
    const congratsMessage = document.getElementById("congratsMessage");

    goalLink.addEventListener("click", (event) => {
        event.preventDefault();
        goalModal.style.display = "block";
    });

    closeModal.addEventListener("click", () => {
        goalModal.style.display = "none";
    });

    completeGoalButton.addEventListener("click", () => {
        goalModal.style.display = "none";
        showCongratulations();
    });
}

function showCongratulations() {
    const congratsMessage = document.getElementById("congratsMessage");
    congratsMessage.style.display = "flex";
    startConfetti();

    setTimeout(() => {
        congratsMessage.style.display = "none";
    }, 3000);
}

function startConfetti() {
    const confettiContainer = document.getElementById("confetti");
    const colors = ["#FFC700", "#FF0000", "#2E3192", "#00A651", "#FF6600"];
    const confettiCount = 100;

    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement("div");
        confetti.className = "confetti";
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = `${Math.random() * 100}vw`;
        confetti.style.animationDelay = `${Math.random() * 2}s`;
        confettiContainer.appendChild(confetti);

        setTimeout(() => confetti.remove(), 4000);
    }
}

function loadDailyAffirmation() {
    const dailyAffirmation = localStorage.getItem("dailyAffirmation");
    if (dailyAffirmation) {
        document.querySelectorAll(".affirmation-slider .quote")[0].textContent = `“${dailyAffirmation}”`;
    }
}

// Calendar
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

function initializeLineChart() {
    const canvas = document.getElementById('lineChart');
    const ctx = canvas.getContext('2d');
    const dataPoints = [65, 59, 80, 81, 56, 55, 40, 34, 72, 67, 82, 90];
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    canvas.width = 450;
    canvas.height = 270;

    drawChart(ctx, canvas, dataPoints, labels);
}


function drawChart(ctx, canvas, dataPoints, labels) {
    const chartWidth = canvas.width;
    const chartHeight = canvas.height;
    const margin = 50;
    const step = (chartWidth - 2 * margin) / (labels.length - 1);
    const maxDataValue = Math.max(...dataPoints);
    const scaleY = (chartHeight - 2 * margin) / maxDataValue;
    const numYTicks = 5;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawAxes(ctx, chartWidth, chartHeight, margin);
    drawLabels(ctx, labels, margin, step, chartHeight, maxDataValue, numYTicks, scaleY);
    drawLineChart(ctx, dataPoints, margin, step, chartHeight, scaleY);
    drawDataPoints(ctx, dataPoints, margin, step, chartHeight, scaleY);

    canvas.addEventListener('mousemove', (event) => handleHover(event, ctx, canvas, dataPoints, labels, margin, step, chartHeight, scaleY));
}

function drawAxes(ctx, chartWidth, chartHeight, margin) {
    // X-axis
    ctx.beginPath();
    ctx.moveTo(margin, chartHeight - margin);
    ctx.lineTo(chartWidth - margin, chartHeight - margin);
    ctx.stroke();

    // Y-axis
    ctx.beginPath();
    ctx.moveTo(margin, margin);
    ctx.lineTo(margin, chartHeight - margin);
    ctx.stroke();
}

function drawLabels(ctx, labels, margin, step, chartHeight, maxDataValue, numYTicks, scaleY) {
    ctx.font = '14px Arial';
    ctx.fillStyle = '#333';

    labels.forEach((label, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin + 20;
        ctx.textAlign = 'center';
        ctx.fillText(label, x, y);
    });

    for (let i = 0; i <= numYTicks; i++) {
        const yValue = Math.floor((maxDataValue / numYTicks) * i);
        const y = chartHeight - margin - yValue * scaleY;
        ctx.textAlign = 'right';
        ctx.fillText(yValue, margin - 10, y + 5);
    }
}

function drawLineChart(ctx, dataPoints, margin, step, chartHeight, scaleY) {
    ctx.beginPath();
    ctx.moveTo(margin, chartHeight - margin - dataPoints[0] * scaleY);

    dataPoints.forEach((dataPoint, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin - dataPoint * scaleY;
        ctx.lineTo(x, y);
    });

    ctx.strokeStyle = '#3498db';
    ctx.lineWidth = 2;
    ctx.stroke();
}

function drawDataPoints(ctx, dataPoints, margin, step, chartHeight, scaleY) {
    ctx.fillStyle = '#e67e22';
    dataPoints.forEach((dataPoint, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin - dataPoint * scaleY;
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fill();
    });
}

function handleHover(event, ctx, canvas, dataPoints, labels, margin, step, chartHeight, scaleY) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawAxes(ctx, canvas.width, canvas.height, margin);
    drawLabels(ctx, labels, margin, step, canvas.height, Math.max(...dataPoints), 5, scaleY);
    drawLineChart(ctx, dataPoints, margin, step, chartHeight, scaleY);
    drawDataPoints(ctx, dataPoints, margin, step, chartHeight, scaleY);

    dataPoints.forEach((dataPoint, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin - dataPoint * scaleY;
        if (isMouseNearPoint(mouseX, mouseY, x, y)) {
            drawTooltip(ctx, x, y, labels[index], dataPoint);
        }
    });
}

function isMouseNearPoint(mouseX, mouseY, x, y) {
    const distance = Math.sqrt((mouseX - x) ** 2 + (mouseY - y) ** 2);
    return distance < 10;
}

function drawTooltip(ctx, x, y, label, value) {
    ctx.fillStyle = 'rgba(255, 255, 255, 0)';
    ctx.fillRect(x, y, 100, 40);
    ctx.fillStyle = 'black';
    ctx.font = '12px Arial';
    ctx.fillText(`Month: ${label}`, x + 15, y - 25);
    ctx.fillText(`Value: ${value}`, x + 15, y - 10);
}
