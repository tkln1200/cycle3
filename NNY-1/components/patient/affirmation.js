document.addEventListener('DOMContentLoaded', function() {
    const selectBox = document.getElementById('selectAffirmation');
    const dropdown = document.getElementById('affirmationDropdown');
    const selectText = document.querySelector('.dropdown-btn');
    const setBtn = document.getElementById('setAffirmationsBtn');
    const selectedAffirmationsText = document.getElementById('selectedAffirmationsText');

    selectBox.addEventListener('click', function() {
      selectBox.classList.toggle('active');
    });
    document.addEventListener('click', function(event) {
      if (!selectBox.contains(event.target)) {
        selectBox.classList.remove('active');
      }
    });
    setBtn.addEventListener('click', function(event) {
      event.stopPropagation();
      const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]:checked');
      const selectedAffirmations = [];

      checkboxes.forEach(function(checkbox) {
        selectedAffirmations.push(checkbox.value);
      });

      if (selectedAffirmations.length > 0) {
        selectText.textContent = selectedAffirmations.length + " selected";
        selectedAffirmationsText.textContent = selectedAffirmations.join(', ');
      } else {
        selectText.textContent = "Select affirmations";
        selectedAffirmationsText.textContent = "None";
      }
      selectBox.classList.remove('active');
    });
  });