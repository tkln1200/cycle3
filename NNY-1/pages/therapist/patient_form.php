<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Create New Patient</h2>
        <form action="patient_database.php" method="POST">
            <label for="fName">First Name:</label>
            <input type="text" id="fName" name="fName" required><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br>

            <label for="contactNo">Contact Number:</label>
            <input type="text" id="contactNo" name="contactNo" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="streetAddress">Street Address:</label>
            <input type="text" id="streetAddress" name="streetAddress" required><br>

            <label for="height">Height:</label>
            <input type="text" id="height" name="height" required><br>

            <label for="password">Password:1234</label>
            <input type="password" id="password" name="password" required><br> <!-- New password field -->

            <button type="submit">Submit</button>
        </form>
    </div>
</div>
