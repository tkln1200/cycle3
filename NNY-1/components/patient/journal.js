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
  initializeLineChart();
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

//
function initializeLineChart() {
  const canvas = document.getElementById("lineChart");
  const ctx = canvas.getContext("2d");
  const dataPoints = [65, 59, 80, 81, 56, 55, 40, 34, 72, 67, 82, 90];
  const labels = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

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
  drawLabels(
    ctx,
    labels,
    margin,
    step,
    chartHeight,
    maxDataValue,
    numYTicks,
    scaleY
  );
  drawLineChart(ctx, dataPoints, margin, step, chartHeight, scaleY);
  drawDataPoints(ctx, dataPoints, margin, step, chartHeight, scaleY);

  canvas.addEventListener("mousemove", (event) =>
    handleHover(
      event,
      ctx,
      canvas,
      dataPoints,
      labels,
      margin,
      step,
      chartHeight,
      scaleY
    )
  );
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

function drawLabels(
  ctx,
  labels,
  margin,
  step,
  chartHeight,
  maxDataValue,
  numYTicks,
  scaleY
) {
  ctx.font = "14px Arial";
  ctx.fillStyle = "#333";

  labels.forEach((label, index) => {
    const x = margin + index * step;
    const y = chartHeight - margin + 20;
    ctx.textAlign = "center";
    ctx.fillText(label, x, y);
  });

  for (let i = 0; i <= numYTicks; i++) {
    const yValue = Math.floor((maxDataValue / numYTicks) * i);
    const y = chartHeight - margin - yValue * scaleY;
    ctx.textAlign = "right";
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

  ctx.strokeStyle = "#3498db";
  ctx.lineWidth = 2;
  ctx.stroke();
}

function drawDataPoints(ctx, dataPoints, margin, step, chartHeight, scaleY) {
  ctx.fillStyle = "#e67e22";
  dataPoints.forEach((dataPoint, index) => {
    const x = margin + index * step;
    const y = chartHeight - margin - dataPoint * scaleY;
    ctx.beginPath();
    ctx.arc(x, y, 5, 0, Math.PI * 2);
    ctx.fill();
  });
}

function handleHover(
  event,
  ctx,
  canvas,
  dataPoints,
  labels,
  margin,
  step,
  chartHeight,
  scaleY
) {
  const rect = canvas.getBoundingClientRect();
  const mouseX = event.clientX - rect.left;
  const mouseY = event.clientY - rect.top;

  ctx.clearRect(0, 0, canvas.width, canvas.height);
  drawAxes(ctx, canvas.width, canvas.height, margin);
  drawLabels(
    ctx,
    labels,
    margin,
    step,
    canvas.height,
    Math.max(...dataPoints),
    5,
    scaleY
  );
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
  ctx.fillStyle = "rgba(255, 255, 255, 0)";
  ctx.fillRect(x, y, 100, 40);
  ctx.fillStyle = "black";
  ctx.font = "12px Arial";
  ctx.fillText(`Month: ${label}`, x + 15, y - 25);
  ctx.fillText(`Value: ${value}`, x + 15, y - 10);
}
