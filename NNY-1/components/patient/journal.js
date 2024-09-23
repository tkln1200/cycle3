let journalsList = [
  {
    id: 1,
    title: "Productive day at work",
    date: "24/9/2024",
    time: "11:30 PM",
    moodlevel: 10,
    image: "",
    content:
      "I can hardly believe it—I actually did it. After six grueling months of constant stress, sleepless nights, and endless self-doubt, I finished the project. It was like climbing a mountain, and today, I finally reached the top. The client has been such a nightmare, always demanding more, never satisfied, and making me question every decision I made. But today, when I handed in that final report, and they actually smiled—really smiled—I felt a wave of relief and pride that I haven’t felt in a long time. <br> It’s like all the anxiety I’ve been carrying around suddenly lifted, even if just for a moment. I’ve been so hard on myself, convinced I wasn’t good enough, that I’d somehow mess this up, but I didn’t. I pushed through, despite all the times I wanted to give up, and now I can see that it was worth it. I’m excited, not just because it’s over, but because I proved to myself that I can handle this. I’m stronger than I thought. I still feel the anxiety lurking in the background, but today, it doesn’t seem as powerful. Today, I feel like I won, and that’s a feeling I want to hold onto for as long as I can.",
  },
  {
    id: 2,
    title: "Why me?",
    date: "23/9/2024",
    time: "10:45 PM",
    moodlevel: 3,
    image: "",
    content:
      "I don't know why I even bother anymore. Everything feels so heavy, like I'm carrying the weight of the world on my shoulders. Every day is the same—wake up, fight through the endless thoughts, pretend I'm okay, and then collapse back into bed, only to repeat the cycle. My heart races for no reason, my thoughts spiral out of control, and I can never seem to find a moment of peace. It's exhausting. I try to be strong, to keep going, but what's the point? I'm just so tired of constantly worrying about everything—about things that don't even matter in the grand scheme of things. But I can't stop. It's like I'm trapped in my own mind, suffocating under the pressure of my own thoughts. Everyone else seems to have it together, so why can't I? Why does everything feel like such a struggle? I hate that I can't control this, that it feels like I'll never be free of it. I just want to escape, to find some relief, but I don't even know what that would look like. How do I keep going when it all feels so pointless?",
  },
  {
    id: 3,
    title: "Does my dog know how to talk?",
    date: "22/9/2024",
    time: "8:45 PM",
    image: "/assets/images/dog.jpg",
    moodlevel: 4,
    content:
      "Loneliness has become a constant companion, wrapping itself around me in ways I never imagined. Some days, the emptiness feels overwhelming, like there's no one in the world who truly understands. I see people with their friends, their families, and wonder why I can't feel that connection. It's like I'm on the outside looking in, always yearning for something I can't quite reach. But then there's Max, my sweet, loyal dog. He's the one being who seems to get me without needing any words. When the anxiety becomes too much, and I feel like I'm drowning in my own thoughts, Max is there, quietly lying next to me, offering a kind of comfort no human ever has. His soft fur under my hand, the way he looks at me with those big, trusting eyes—it's like he's saying, \"I'm here, you're not alone.\" I don't know what I'd do without him. He’s my anchor in this storm, reminding me that even in the depths of my loneliness, I’m not truly alone. I’m so grateful for him, for the unconditional love he gives me, for the way he’s always by my side, even when the world feels like it’s falling apart.",
  },
  {
    id: 4,
    title: "Falling in love or is it just alcohol?",
    date: "21/9/2024",
    time: "7:00 PM",
    moodlevel: 6,
    image: "",
    content:
      "I don't usually let myself go like this, but tonight, after a few too many drinks, everything I’ve been holding back is bubbling to the surface. It’s strange how alcohol seems to peel away the layers I’ve carefully built around myself, exposing this raw, aching need for connection. I can’t help but think about how lonely I am, how much I crave the touch, the warmth of another person. I’ve always been so scared to let anyone in, terrified they’ll see the mess I am inside, but right now, all I want is someone to hold me, to tell me it’s going to be okay. It’s like there’s a hole inside me, and no matter how much I try to fill it with distractions or pretend it’s not there, it never goes away. I want to be loved, to be seen, to be someone’s person, but I’m so afraid. I don’t know how to let go of this fear, this anxiety that keeps me trapped in my own mind. The alcohol makes it easier to imagine what it would be like, to dream of a world where I’m not so alone, but I know when I wake up, I’ll be back in my cage, longing for something I’m too scared to reach for.",
  },
];

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
