// Get the canvas element and set up the context for drawing
const canvas = document.getElementById('lineChart');
const ctx = canvas.getContext('2d');

// Line chart data (You can modify this dataset as needed)
const dataPoints = [65, 59, 80, 81, 56, 55, 40, 34, 72, 67, 82, 90];
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct', 'Nov', 'Dec'];

// Chart configuration
const chartWidth = canvas.width;
const chartHeight = canvas.height;
const margin = 50;
const step = (chartWidth - 2 * margin) / (labels.length - 1); // Distance between each point

// Calculate scaling factor based on maximum data value
const maxDataValue = Math.max(...dataPoints);
const scaleY = (chartHeight - 2 * margin) / maxDataValue;
const numYTicks = 5; // Number of ticks on the Y-axis

let tooltipVisible = false;

// Draw the axes
function drawAxes() {
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

// Draw the labels (X-axis labels)
function drawLabels() {
    ctx.font = '14px Arial';
    ctx.fillStyle = '#333';

    // X-axis labels
    labels.forEach((label, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin + 20;
        ctx.textAlign = 'center';
        ctx.fillText(label, x, y);
    });

    // Y-axis labels (values)
    for (let i = 0; i <= numYTicks; i++) {
        const yValue = Math.floor((maxDataValue / numYTicks) * i);
        const y = chartHeight - margin - (yValue * scaleY);

        ctx.textAlign = 'right';
        ctx.fillText(yValue, margin - 10, y + 5); // Labels on the Y-axis
    }
}

// Draw the line chart
function drawLineChart() {
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

// Draw data points on the line chart
function drawDataPoints() {
    ctx.fillStyle = '#e67e22';
    dataPoints.forEach((dataPoint, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin - dataPoint * scaleY;
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fill();
    });
}

// Function to check if the mouse is near a data point
function isMouseNearPoint(mouseX, mouseY, x, y) {
    const distance = Math.sqrt((mouseX - x) ** 2 + (mouseY - y) ** 2);
    return distance < 10; // Adjust this value based on sensitivity
}

// Function to draw the tooltip
function drawTooltip(x, y, label, value) {
    ctx.fillStyle = 'rgba(255, 255, 255, 0)';
    ctx.fillRect(x, y , 100, 40);
    ctx.fillStyle = 'black';
    ctx.font = '12px Arial';
    ctx.fillText(`Month: ${label}`, x + 15, y - 25);
    ctx.fillText(`Value: ${value}`, x + 15, y - 10);
}

// Function to handle hover and display tooltips
function handleHover(event) {
    const rect = canvas.getBoundingClientRect();
    const mouseX = event.clientX - rect.left;
    const mouseY = event.clientY - rect.top;

    // Clear the canvas and redraw everything
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawAxes();
    drawLabels();
    drawLineChart();
    drawDataPoints();

    tooltipVisible = false;

    // Check if the mouse is near any data point
    dataPoints.forEach((dataPoint, index) => {
        const x = margin + index * step;
        const y = chartHeight - margin - dataPoint * scaleY;
        if (isMouseNearPoint(mouseX, mouseY, x, y)) {
            drawTooltip(x, y, labels[index], dataPoint);
            tooltipVisible = true;
        }
    });
}

// Attach event listener for mouse movement over the canvas
canvas.addEventListener('mousemove', handleHover);

// Render the chart
drawAxes();
drawLabels();
drawLineChart();
drawDataPoints();
