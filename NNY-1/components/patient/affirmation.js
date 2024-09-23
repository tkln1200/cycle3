document.addEventListener('DOMContentLoaded', function() {
   const affirmationForm = document.getElementById('affirmationForm');
   const affirmationInput = document.getElementById('affirmationInput');
   const affirmationList = document.getElementById('affirmationList');
   const selectAffirmation = document.getElementById('selectAffirmation');
   const setDailyAffirmationButton = document.getElementById('setDailyAffirmation');

   // Load existing affirmations from local storage or set up defaults
   let affirmations = JSON.parse(localStorage.getItem('affirmations')) || [
       "I am grateful for the life I am living.",
       "I choose to be happy and love myself today.",
       "I am in control of my emotions and thoughts.",
       "I am becoming the best version of myself."
   ];

   // Function to render the list of affirmations
   function renderAffirmations() {
       // Clear existing items
       affirmationList.innerHTML = '';
       selectAffirmation.innerHTML = '';

       affirmations.forEach((affirmation, index) => {
           // Create list item
           const li = document.createElement('li');
           li.textContent = affirmation;
           affirmationList.appendChild(li);

           // Create select option
           const option = document.createElement('option');
           option.value = index;
           option.textContent = affirmation;
           selectAffirmation.appendChild(option);
       });
   }

   // Handle form submission to add a new affirmation
   affirmationForm.addEventListener('submit', function(event) {
       event.preventDefault();
       const newAffirmation = affirmationInput.value.trim();

       if (newAffirmation) {
           affirmations.push(newAffirmation);
           localStorage.setItem('affirmations', JSON.stringify(affirmations));
           renderAffirmations();
           affirmationInput.value = ''; // Clear the input field
       }
   });

   // Set the selected affirmation as the daily affirmation
   setDailyAffirmationButton.addEventListener('click', function() {
       const selectedAffirmationIndex = selectAffirmation.value;
       const selectedAffirmation = affirmations[selectedAffirmationIndex];
       localStorage.setItem('dailyAffirmation', selectedAffirmation);
       alert(`Daily Affirmation set to: "${selectedAffirmation}"`);
   });

   // Initial render
   renderAffirmations();
});
