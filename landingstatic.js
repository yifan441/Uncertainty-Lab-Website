const commit_btn = document.getElementById("commit-btn");
const dashboard_btn = document.getElementById("dashboard-btn");

commit_btn.addEventListener("click", handle_commit);
dashboard_btn.addEventListener("click", handle_dashboard);

function handle_commit() {
  window.location.href = "signuppagestatic.php";
}

function handle_dashboard() {
  // replace page with dashboard
  window.location.href = "dashboard.php";
}
