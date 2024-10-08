document.addEventListener('DOMContentLoaded', function () {
    // Fetching dynamic data for the stats section based on the current or selected date
    const currentDate = new Date();  // Get today's date
    const formattedDate = currentDate.toISOString().split('T')[0];  // Format date as YYYY-MM-DD
  
    // Simulating data fetched by date
    const dataByDate = {
      "2024-03-25": {
        appointments: 20,
        consult_length: 10,
        patients: 300,
        doctors: 100
      },
      "2024-03-26": {
        appointments: 22,
        consult_length: 12,
        patients: 320,
        doctors: 102
      }
    };
  
    // Fallback in case the current date isn't available in the data
    const stats = dataByDate[formattedDate] || {
      appointments: 0,
      consult_length: 0,
      patients: 0,
      doctors: 0
    };
  
    // Set stats dynamically
    document.getElementById('appointments').innerText = `Appointments: ${stats.appointments}`;
    document.getElementById('consult-length').innerText = `Consult Length: ${stats.consult_length} hrs`;
    document.getElementById('patients').innerText = `Patients: ${stats.patients}`;
    document.getElementById('doctors').innerText = `Doctors: ${stats.doctors}`;
  
    // Doctors and patients data as before
    const doctors = [
      {
        name: "Sagun Thapa",
        patients: []
      },
      {
        name: "Malik Mbaye",
        patients: [
          { id: "1231321", type: "PTSD", duration: "1.5 HRS" },
          { id: "322523", type: "OCD", duration: "2 HRS" },
          { id: "30923", type: "NCD", duration: "1 HRS" },
          { id: "5232314", type: "DEPRESSION", duration: "1 HRS" },
          { id: "12412553", type: "GAD", duration: "2 HRS" }
        ]
      },
      {
        name: "Alexis Martinez",
        patients: []
      },
      {
        name: "Grace Wilkinson",
        patients: []
      }
    ];
  
    const doctorList = document.getElementById('doctor-list');
  
    doctors.forEach((doctor, index) => {
      const doctorButton = document.createElement('button');
      doctorButton.innerText = doctor.name;
      doctorButton.onclick = () => toggleDoctorDetails(index);
      doctorList.appendChild(doctorButton);
  
      const table = document.createElement('table');
      table.className = 'patient-table';
      table.style.display = 'none'; // Initially hide the table
      table.innerHTML = `
        <thead>
          <tr>
            <th>Patient ID</th>
            <th>Type of Case</th>
            <th>Length of Consultation</th>
          </tr>
        </thead>
        <tbody id="table-body-${index}">
        </tbody>
      `;
  
      doctorList.appendChild(table);
  
      // Populate the table with patients
      const tableBody = document.getElementById(`table-body-${index}`);
      doctor.patients.forEach(patient => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${patient.id}</td>
          <td>${patient.type}</td>
          <td>${patient.duration}</td>
        `;
        tableBody.appendChild(row);
      });
  
      // Add total row
      if (doctor.patients.length > 0) {
        const totalRow = document.createElement('tr');
        totalRow.innerHTML = `
          <td colspan="3">Total = ${doctor.patients.length}</td>
        `;
        tableBody.appendChild(totalRow);
      }
    });
  
    function toggleDoctorDetails(index) {
      const tables = document.getElementsByClassName('patient-table');
      for (let i = 0; i < tables.length; i++) {
        if (i === index) {
          tables[i].style.display = tables[i].style.display === 'none' ? 'block' : 'none';
        } else {
          tables[i].style.display = 'none';
        }
      }
    }
  });
  