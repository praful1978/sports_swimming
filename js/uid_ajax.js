 
  var uid = localStorage.getItem("UID");
  // Send the uid value to your PHP script via AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "user_login.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Redirect to table.php after the AJAX request is completed
      window.location = 'table.php';
    }
  };
  xhr.send("uid=" + uid);
 
