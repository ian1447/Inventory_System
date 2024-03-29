<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<!-- offcanvas -->
<div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
      id="sidebar"
      style="background-color: #041C32; color:#ECB365"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar" style="background-color: #041C32; color:#ECB365">
          <ul class="navbar-nav">
              <a href="./index.php" class="nav-link px-3 text-white active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Homepage</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" />
            <li>
              <div class="text-muted small fw-bold text-white text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
            <li>
                    <a href="./employees.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-people-fill"></i
                      ></span>
                      <span>Employees</span>
                    </a>
                  </li>
            <li>
            <li>
                    <a href="./supplies.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-stack"></i
                      ></span>
                      <span>Supplies Released</span>
                    </a>
                  </li>
                  <!-- <li>
                    <a href="./suppliesAction.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-hand-index-thumb-fill"></i
                      ></span>
                      <span>Manage Actions</span>
                    </a>
                  </li> -->
                  <li>
                    <a href="./categories.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-ui-checks"></i
                      ></span>
                      <span>Categories</span>
                    </a>
                  </li>
            </li>
            <li>
                    <a href="./monthlyreport.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-calendar-event-fill"></i
                      ></span>
                      <span>Monthly Report</span>
                    </a>
                  </li>
                  <li>
                    <a href="./monthlyinventory.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-calendar-check-fill"></i
                      ></span>
                      <span>Monthly Inventory</span>
                    </a>
                  </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3 text-white">
                Others
              </div>
            </li>
            <li>
              <a href="./users.php" class="nav-link px-3 text-white">
                <span class="me-2"><i class="bi bi-person-plus-fill"></i></span>
                <span>Users</span>
              </a>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link text-white"
                data-bs-toggle="collapse"
                href="#about"
              >
                <span class="me-2"><i class="bi bi-person-check-fill"></i></span>
                <span>About</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="about">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="./system.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-code-slash"></i
                      ></span>
                      <span>System</span>
                    </a>
                  </li>
                  <li>
                    <a href="./developer.php" class="nav-link px-3 text-white">
                      <span class="me-2"
                        ><i class="bi bi-person"></i
                      ></span>
                      <span>Developer</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/script.js"></script>
    
</body>
</html>