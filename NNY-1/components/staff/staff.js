document.addEventListener("DOMContentLoaded", (event) => {
  var modal = document.getElementById("createPatientModal");
  var btn = document.getElementById("openModalBtn");
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

document.addEventListener("DOMContentLoaded", () => {
  const itemsPerPage = 10; // Number of rows per page
  let currentPage = 1;
  const tableBody = document.getElementById("patientTableBody");
  const paginationControls = document.getElementById("paginationControls");

  function renderTable(page) {
      tableBody.innerHTML = ""; // Clear existing rows
      const start = (page - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      const patientsToDisplay = patients.slice(start, end);

      patientsToDisplay.forEach(patient => {
          const row = document.createElement("tr");
          row.innerHTML = `
              <td>${patient.fName} ${patient.lName}</td>
              <td>${patient.contactNo}</td>
              <td>${patient.email}</td>
              <td>${calculateAge(patient.dob)}</td>
              <td>${patient.height}</td>
              <td>${patient.weight}</td>
              <td>${patient.status}</td>
          `;
          tableBody.appendChild(row);
      });
  }

  function renderPagination() {
      paginationControls.innerHTML = "";
      const pageCount = Math.ceil(patients.length / itemsPerPage);

      for (let i = 1; i <= pageCount; i++) {
          const button = document.createElement("a");
          button.href = "#";
          button.classList.add("page-link");
          button.textContent = i;
          if (i === currentPage) button.classList.add("active");

          button.addEventListener("click", (event) => {
              event.preventDefault();
              currentPage = i;
              renderTable(currentPage);
              renderPagination();
          });

          paginationControls.appendChild(button);
      }
  }

  function calculateAge(dob) {
      const birthDate = new Date(dob);
      const ageDiff = Date.now() - birthDate.getTime();
      const ageDate = new Date(ageDiff);
      return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  // Initial render
  renderTable(currentPage);
  renderPagination();
});

