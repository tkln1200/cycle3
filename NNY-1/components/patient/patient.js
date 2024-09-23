let quotes = document.querySelectorAll(".affirmation-slider .quote");
let dots = document.querySelectorAll(".dots .dot");
let currentQuote = 0;

document.addEventListener("DOMContentLoaded", function () {
  const setGoalButton = document.getElementById("setGoalButton");
  const newGoalModal = document.getElementById("newGoalModal");
  const goalInput = document.getElementById("goalInput");
  const closeButtons = document.querySelectorAll(".close");

  setGoalButton.addEventListener("click", function () {
    newGoalModal.style.display = "block";
    goalInput.value = ""; // Clear the form input when the modal opens
  });

  closeButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      newGoalModal.style.display = "none";
    });
  });
});

function showQuote(index) {
  quotes[currentQuote].classList.remove("active");
  dots[currentQuote].classList.remove("active");
  currentQuote = index;
  quotes[currentQuote].classList.add("active");
  dots[currentQuote].classList.add("active");
}

setInterval(function () {
  let nextQuote = (currentQuote + 1) % quotes.length;
  showQuote(nextQuote);
}, 3000);

dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    showQuote(index);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const currentMonthElement = document.getElementById("currentMonth");
  const calendarDatesElement = document.getElementById("calendarDates");
  const prevMonthButton = document.getElementById("prevMonth");
  const nextMonthButton = document.getElementById("nextMonth");

  let currentDate = new Date();

  const journals = [
    {
      id: 1,
      title: "Productive day at work",
      date: "24/9/2024",
      moodlevel: 10,
      content:
        "I can hardly believe it—I actually did it. After six grueling months of constant stress, sleepless nights, and endless self-doubt, I finished the project. It was like climbing a mountain, and today, I finally reached the top. The client has been such a nightmare, always demanding more, never satisfied, and making me question every decision I made. But today, when I handed in that final report, and they actually smiled—really smiled—I felt a wave of relief and pride that I haven’t felt in a long time.",
    },
    {
      id: 2,
      title: "Why me?",
      date: "23/9/2024",
      moodlevel: 3,
      content:
        "I don't know why I even bother anymore. Everything feels so heavy, like I'm carrying the weight of the world on my shoulders.",
    },
    {
      id: 3,
      title: "Does my dog know how to talk?",
      date: "22/9/2024",
      moodlevel: 4,
      content:
        "Loneliness has become a constant companion, wrapping itself around me in ways I never imagined. Some days, the emptiness feels overwhelming, like there's no one in the world who truly understands.",
    },
    {
      id: 4,
      title: "Falling in love or is it just alcohol?",
      date: "21/9/2024",
      moodlevel: 6,
      content:
        "I don't usually let myself go like this, but tonight, after a few too many drinks, everything I’ve been holding back is bubbling to the surface.",
    },
  ];

  function findJournalByDate(date) {
    const formattedDate = `${date.getDate()}/${
      date.getMonth() + 1
    }/${date.getFullYear()}`;
    return journals.find((journal) => journal.date === formattedDate);
  }

  function showJournalPopup(journal, targetElement) {
    // Remove any existing popup before showing a new one
    const existingPopup = document.querySelector(".journal-popup");
    if (existingPopup) {
      document.body.removeChild(existingPopup);
    }

    const popup = document.createElement("div");
    popup.classList.add("journal-popup");
    popup.innerHTML = `
            <h2>${journal.title}</h2>
            <p><strong>Date:</strong> ${journal.date}</p>
            <p><strong>Mood Level:</strong> ${journal.moodlevel}</p>
            <p>${journal.content}</p>
            <button id="closePopup">Close</button>
        `;
    document.body.appendChild(popup);

    // Position the popup to the left of the clicked date element
    const rect = targetElement.getBoundingClientRect();
    popup.style.top = `${rect.top + window.scrollY}px`;
    popup.style.left = `${
      rect.left + window.scrollX - popup.offsetWidth - 10
    }px`; // Positioned to the left

    // Add event listener to close the popup
    document
      .getElementById("closePopup")
      .addEventListener("click", function () {
        document.body.removeChild(popup);
      });
  }

  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const today = new Date();

    currentMonthElement.textContent = `${monthNames[month]} ${year}`;

    calendarDatesElement.innerHTML = "";

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const offset = firstDay === 0 ? 6 : firstDay - 1;

    for (let i = 0; i < offset; i++) {
      const emptySpan = document.createElement("span");
      emptySpan.textContent = "";
      calendarDatesElement.appendChild(emptySpan);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const dateElement = document.createElement("span");
      dateElement.textContent = day;
      if (
        year === today.getFullYear() &&
        month === today.getMonth() &&
        day === today.getDate()
      ) {
        dateElement.classList.add("selected");
      }

      dateElement.addEventListener("click", function () {
        const clickedDate = new Date(year, month, day);
        const journal = findJournalByDate(clickedDate);
        if (journal) {
          showJournalPopup(journal, dateElement); // Pass the dateElement for positioning
        }
      });

      calendarDatesElement.appendChild(dateElement);
    }
  }

  prevMonthButton.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
  });

  nextMonthButton.addEventListener("click", function () {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
  });

  renderCalendar(currentDate);
});

document.addEventListener("DOMContentLoaded", function () {
  const goalLink = document.getElementById("goalLink");
  const goalModal = document.getElementById("goalModal");
  const closeModal = document.querySelector(".modal .close");
  const completeGoalButton = document.getElementById("completeGoal");
  const congratsMessage = document.getElementById("congratsMessage");

  goalLink.addEventListener("click", function (event) {
    event.preventDefault();
    goalModal.style.display = "block";
  });

  closeModal.addEventListener("click", function () {
    goalModal.style.display = "none";
  });

  completeGoalButton.addEventListener("click", function () {
    goalModal.style.display = "none";
    showCongratulations();
  });

  function showCongratulations() {
    congratsMessage.style.display = "flex";
    startConfetti();

    setTimeout(function () {
      congratsMessage.style.display = "none";
    }, 3000);
  }

  function startConfetti() {
    const confettiContainer = document.getElementById("confetti");
    const colors = ["#FFC700", "#FF0000", "#2E3192", "#00A651", "#FF6600"];
    const confettiCount = 100;

    for (let i = 0; i < confettiCount; i++) {
      let confetti = document.createElement("div");
      confetti.className = "confetti";
      confetti.style.backgroundColor =
        colors[Math.floor(Math.random() * colors.length)];
      confetti.style.left = Math.random() * 100 + "vw";
      confetti.style.animationDelay = Math.random() * 2 + "s";
      confettiContainer.appendChild(confetti);

      setTimeout(function () {
        confetti.remove();
      }, 4000);
    }
  }
});

document.addEventListener("DOMContentLoaded", (event) => {
  var modal = document.getElementById("newGoalModal");
  var btn = document.getElementById("setGoalButton");
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
  document.getElementById("goalForm").onsubmit = function (event) {
    event.preventDefault();
    var goal = document.getElementById("goalInput").value;
    console.log("New Goal:", goal);
    document.getElementById("weeklyGoalText").textContent = goal;
    modal.style.display = "none";
  };
});

document.addEventListener("DOMContentLoaded", function () {
  const dailyAffirmation = localStorage.getItem("dailyAffirmation");

  if (dailyAffirmation) {
    const sliderQuotes = document.querySelectorAll(
      ".affirmation-slider .quote"
    );
    sliderQuotes.forEach((quote, index) => {
      if (index === 0) {
        quote.textContent = `“${dailyAffirmation}”`;
      }
    });
  }
});

const journals = [
  { id: 1, title: "Productive day at work", date: "21/9/2024", moodlevel: 10 },
  { id: 2, title: "Why me?", date: "22/9/2024", moodlevel: 3 },
  {
    id: 3,
    title: "Does my dog know how to talk?",
    date: "23/9/2024",
    moodlevel: 4,
  },
  {
    id: 4,
    title: "Falling in love or is it just alcohol?",
    date: "24/9/2024",
    moodlevel: 6,
  },
  {
    id: 5,
    title: "Falling in love or is it just alcohol?",
    date: "25/9/2024",
    moodlevel: 9,
  },
];

const calendar = document.querySelector(".calendar");
const canvas = document.getElementById("moodChart");
const ctx = canvas.getContext("2d");

// Dynamically set canvas width to match the calendar
canvas.width = calendar.offsetWidth;

// Set chart properties
const chartWidth = canvas.width;
const chartHeight = canvas.height;

// Function to map mood level to y-axis value (invert mood level since higher is better)
function getY(moodlevel) {
  const maxMood = 10;
  const minY = 30;
  const maxY = chartHeight - 30;
  return maxY - (moodlevel / maxMood) * (maxY - minY);
}

// Function to map the date index to x-axis value
function getX(index, total) {
  const minX = 40;
  const maxX = chartWidth - 40;
  return minX + (index * (maxX - minX)) / (total - 1);
}

// Function to draw smooth lines between points
function drawSmoothLine(ctx, points) {
  ctx.beginPath();
  ctx.moveTo(points[0].x, points[0].y);

  for (let i = 1; i < points.length - 2; i++) {
    const xc = (points[i].x + points[i + 1].x) / 2;
    const yc = (points[i].y + points[i + 1].y) / 2;
    ctx.quadraticCurveTo(points[i].x, points[i].y, xc, yc);
  }

  ctx.quadraticCurveTo(
    points[points.length - 2].x,
    points[points.length - 2].y,
    points[points.length - 1].x,
    points[points.length - 1].y
  );

  ctx.strokeStyle = "#A685E2";
  ctx.lineWidth = 2;
  ctx.stroke();
}

// Function to draw the mood chart with a gradient fill, date labels, and mood score
function drawMoodChart(journals) {
  const points = journals.map((journal, index) => ({
    x: getX(index, journals.length),
    y: getY(journal.moodlevel),
    date: journal.date,
    moodlevel: journal.moodlevel,
  }));

  // Draw gradient fill under the curve
  const gradient = ctx.createLinearGradient(0, 0, 0, chartHeight);
  gradient.addColorStop(0, "rgba(166, 133, 226, 0.5)");
  gradient.addColorStop(1, "rgba(166, 133, 226, 0)");

  ctx.beginPath();
  ctx.moveTo(points[0].x, chartHeight); // Start from the bottom
  points.forEach((point) => {
    ctx.lineTo(point.x, point.y);
  });
  ctx.lineTo(points[points.length - 1].x, chartHeight); // Go back to the bottom
  ctx.closePath();
  ctx.fillStyle = gradient;
  ctx.fill();

  // Draw the smooth line connecting the mood points
  drawSmoothLine(ctx, points);

  // Draw circles on each mood point and add the mood score above it
  points.forEach((point) => {
    // Draw the mood point (circle)
    ctx.beginPath();
    ctx.arc(point.x, point.y, 4, 0, Math.PI * 2);
    ctx.fillStyle = "#A685E2";
    ctx.fill();

    // Draw the mood score above the point
    ctx.font = "12px Arial";
    ctx.fillStyle = "#555";
    ctx.textAlign = "center";
    ctx.fillText(point.moodlevel, point.x, point.y - 10); // Mood score above the point

    // Draw date below the mood point
    ctx.fillText(point.date, point.x, chartHeight - 10); // Date label below the point
  });
}

// Call the function to draw the chart
drawMoodChart(journals);
