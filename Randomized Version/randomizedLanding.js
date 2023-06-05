const commit_btn = document.getElementById("commit-btn");
const dashboard_btn = document.getElementById("dashboard-btn");

commit_btn.addEventListener("click", randomized_redirect);
dashboard_btn.addEventListener("click", handle_dashboard);

function randomized_redirect() {
  let x = Math.floor(Math.random() * 2);
  if (x) {
    window.location.href = "version1.html";
  } else {
    window.location.href = "version2.html";
  }
}

function handle_dashboard() {
  window.location.href = "dashboard.php";
}
