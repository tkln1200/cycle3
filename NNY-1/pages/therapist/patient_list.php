<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Therapist Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/patient-list.css" />
    <link rel="stylesheet" href="../../assets/css/therapist.css" />
    <link rel="stylesheet" href="../../assets/css/shared.css">
  </head>
  <body>
  <header>
    <?php include_once ("../navigation/therapist_nav.php") ?> 
  </header>
  <div class="main-content">
    <h2>Patient List</h2>
    <div class="content">
      <div class="group-search-container">
        <button class="create-group-btn" id="createGroupBtn">Create Group</button>
        <div class="search-container">
          <form action="#" method="post" class="search-form">
            <input type="text" placeholder="Search..." id="search-input" />
            <button type="submit" class="search-btn">Search</button>
          </form>
        </div>
      </div>
      <table id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Diagnosis</th>
            <th>Progress</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // 数据库连接信息
          $host = "localhost";
          $username = "root";
          $password = "";
          $dbname = "healthcare";

          // 创建数据库连接
          $conn = new mysqli($host, $username, $password, $dbname);

          // 检查连接是否成功
          if ($conn->connect_error) {
              die("连接失败: " . $conn->connect_error);
          }

          // 查询患者列表
          $sql = "SELECT id, name, diagnosis, progress, status FROM patients";
          $result = $conn->query($sql);

          // 动态生成患者表格行
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td><a href='patient_profile.php'>" . $row["id"] . "</a></td>";
                  echo "<td>" . $row["name"] . "</td>";
                  echo "<td>" . $row["diagnosis"] . "</td>";
                  echo "<td>" . $row["progress"] . "%</td>";
                  echo "<td>";
                  echo "<select onchange='changeTableColor(this)'>";
                  echo "<option " . ($row["status"] == 'Active' ? 'selected' : '') . ">Active</option>";
                  echo "<option " . ($row["status"] == 'Inactive' ? 'selected' : '') . ">Inactive</option>";
                  echo "<option " . ($row["status"] == 'On Hold' ? 'selected' : '') . ">On Hold</option>";
                  echo "<option value='follow' " . ($row["status"] == 'Follow-up' ? 'selected' : '') . ">Follow-up</option>";
                  echo "</select>";
                  echo "</td>";
                  echo "<td><button class='journal-btn' onclick='location.href=\"./patient_profile.php\"'>View</button></td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6'>没有患者数据</td></tr>";
          }

          // 关闭数据库连接
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
    <footer>
      <?php include_once ("../footer/therapist_footer.php") ?> 
    </footer>
  </div>
  <script src="../../components/therapist/therapist.js"></script>
  </body>
</html>
