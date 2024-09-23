document.getElementById('activity-tracker-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Format the date inputs
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        const date = new Date(input.value);
        const formattedDate = `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
        input.value = formattedDate;
    });

    // Collect form data
    const formData = new FormData(this);
    const activityData = {
        sleepingCycles: {
            date: formData.get('sleep-date'),
            duration: formData.get('sleep-duration'),
            quality: formData.get('sleep-quality')
        },
        eatingHabits: {
            date: formData.get('meal-date'),
            type: formData.get('meal-type'),
            description: formData.get('meal-description')
        },
        exercise: {
            date: formData.get('exercise-date'),
            type: formData.get('exercise-type'),
            duration: formData.get('exercise-duration')
        }
    };

    // Save the data to localStorage
    localStorage.setItem('activityData', JSON.stringify(activityData));

    // Redirect to the activity dashboard
    window.location.href = 'activity-dashboard.html';
});