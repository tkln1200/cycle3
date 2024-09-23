function renderTasks() {
    const eatingHabitsList = document.getElementById("eating-habits-list");
    const exerciseHabitsList = document.getElementById(
      "exercise-habits-list"
    );
    const sleepingHabitsList = document.getElementById(
      "sleeping-habits-list"
    );
 
    tasks.eatingHabits.forEach((task) => {
      const taskItem = createTaskItem(task);
      eatingHabitsList.appendChild(taskItem);
    });
 
    tasks.exerciseHabits.forEach((task) => {
      const taskItem = createTaskItem(task);
      exerciseHabitsList.appendChild(taskItem);
    });
 
    tasks.sleepingHabits.forEach((task) => {
      const taskItem = createTaskItem(task);
      sleepingHabitsList.appendChild(taskItem);
    });
  }
 
function createTaskItem(task) {
    const taskItem = document.createElement("li");
    taskItem.className = "task-item";
    if (task.completed) {
      taskItem.classList.add("completed");
    }
 
    const taskDescription = document.createElement("span");
    taskDescription.textContent = task.description;
 
    const completeButton = document.createElement("button");
    completeButton.innerHTML = task.completed ? "&#10003;" : "&#10003;";
    completeButton.className = task.completed ? "completed" : "";
    completeButton.addEventListener("click", () => {
      task.completed = !task.completed;
      taskItem.classList.toggle("completed");
      completeButton.classList.toggle("completed");
    });
 
    taskItem.appendChild(taskDescription);
    taskItem.appendChild(completeButton);
 
    return taskItem;
  }
 
  document.addEventListener('DOMContentLoaded', function() {
    const activityData = JSON.parse(localStorage.getItem('activityData'));

    if (activityData) {
        const eatingHabitsList = document.getElementById('eating-habits-list');
        const exerciseHabitsList = document.getElementById('exercise-habits-list');
        const sleepingHabitsList = document.getElementById('sleeping-habits-list');

        if (activityData.eatingHabits) {
            const eatingTask = createTaskItem(activityData.eatingHabits.description);
            eatingHabitsList.appendChild(eatingTask);
        }

        if (activityData.exercise) {
            const exerciseTask = createTaskItem(activityData.exercise.type);
            exerciseHabitsList.appendChild(exerciseTask);
        }

        if (activityData.sleepingCycles) {
            const sleepingTask = createTaskItem(`Sleep for ${activityData.sleepingCycles.duration} hours`);
            sleepingHabitsList.appendChild(sleepingTask);
        }
    }
});

function createTaskItem(description) {
    const taskItem = document.createElement('li');
    taskItem.className = 'task-item';

    const taskDescription = document.createElement('span');
    taskDescription.textContent = description;

    const completeButton = document.createElement('button');
    completeButton.innerHTML = '&#10003;';
    completeButton.addEventListener('click', () => {
        taskItem.classList.toggle('completed');
        completeButton.classList.toggle('completed');
    });

    taskItem.appendChild(taskDescription);
    taskItem.appendChild(completeButton);

    return taskItem;
}