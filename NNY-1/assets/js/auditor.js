
function toggleDetails(button) {
  // Find the next sibling element that contains the doctor details
  const details = button.nextElementSibling;
  
  // Toggle the display of the details section
  if (details.style.display === "block") {
      details.style.display = "none";
      button.querySelector('::after').style.transform = "rotate(0deg)";
  } else {
      details.style.display = "block";
      button.querySelector('::after').style.transform = "rotate(180deg)";
  }
}
