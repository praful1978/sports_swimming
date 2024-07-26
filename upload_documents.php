<?php
session_start();

// Check if 'uid' is set in the session
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    // echo "UID on third page: " . htmlspecialchars($uid);
} else {
    echo "No UID found in session on third page.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload with Bootstrap</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .custom-bg {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }
    #modal {
      display: none;
      position: fixed;
      z-index: 1;
      right: 0;
      top: 0;
      width: 300px;
      height: 50px;
      background-color: green;
      color: white;
      border-radius: 10px;
      padding: 10px;
    }
    #modalContent {
      background-color: green;
      color: white;
      text-align: center;
    }
    #closeBtn {
      color: white;
      float: right;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }
    .uploadButton {
      cursor: not-allowed;
    }
    .uploadButton.enabled {
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
      <div class="custom-bg p-4">
        <h3 class="text-center mb-4">Upload Files</h3>
        
        <!-- Form for UID -->
        <div class="form-group">
          <h3><span class="badge badge-primary mt-2 p-2 "><?php echo $_SESSION['uid']; ?></span></h3> 
        </div>
        
        <!-- Form for Upload Aadhaar PDF -->
        <form id="uploadAadharForm" enctype="multipart/form-data" action="upload_adhar.php" method="post">
          <div class="form-group">
            <label for="aadhar"><strong>Upload Aadhaar PDF file</strong></label>
            <div class="custom-file">
              <input type="file" id="aadhar" name="aadhar" class="custom-file-input" accept="application/pdf">
              <label class="custom-file-label" for="aadhar">Choose file</label>
            </div>
          </div>
          <button type="submit" id="uploadAadharBtn" class="btn btn-primary btn-block" disabled>Upload Aadhaar PDF</button>
        </form>
        
        <!-- Form for Upload Fitness Report PDF -->
        <form id="uploadReportForm" enctype="multipart/form-data" action="upload_report.php" method="post">
          <div class="form-group">
            <label for="report"><strong>Upload Fitness Report PDF file</strong></label>
            <div class="custom-file">
              <input type="file" id="report" name="report" class="custom-file-input" accept="application/pdf">
              <label class="custom-file-label" for="report">Choose file</label>
            </div>
          </div>
          <button type="submit" id="uploadReportBtn" class="btn btn-primary btn-block" disabled>Upload Report PDF</button>
        </form>
        
        <!-- Submit Button -->
        <div class="form-group mt-4">
          <a href="batches_timing_details.php" class="btn btn-primary btn-block btn-lg">Click to go Batch Timings</a>
        </div>
        
        <!-- Modal for success message -->
        <div id="modal">
          <div id="modalContent">
            <span id="closeBtn">&times;</span>
            <p id="modalMessage">File uploaded successfully!</p>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>


<script>
  function handleFileInput(fileInputId, buttonId) {
    const fileInput = document.getElementById(fileInputId);
    const submitButton = document.getElementById(buttonId);

    fileInput.addEventListener('change', function() {
      if (fileInput.files.length > 0) {
        submitButton.disabled = false;
        submitButton.classList.add('enabled');
      } else {
        submitButton.disabled = true;
        submitButton.classList.remove('enabled');
      }
    });
  }

  function handleUpload(event, formId, uploadUrl) {
    event.preventDefault();

    var formData = new FormData(document.getElementById(formId));

    fetch(uploadUrl, {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {
        return response.text();
      } else {
        throw new Error('Upload failed. Please try again.');
      }
    })
    .then(data => {
      displayModal(data || 'File uploaded successfully!');
    })
    .catch(error => {
      displayModal('An error occurred: ' + error.message);
    });
  }

  function displayModal(message) {
    const modal = document.getElementById('modal');
    document.getElementById('modalMessage').innerText = message;
    modal.style.display = 'block';
    document.getElementById('closeBtn').onclick = function() {
      modal.style.display = 'none';
    };
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    };
  }

  document.getElementById('uploadAadharForm').addEventListener('submit', function(event) {
    handleUpload(event, 'uploadAadharForm', 'upload_adhar.php');
  });

  document.getElementById('uploadReportForm').addEventListener('submit', function(event) {
    handleUpload(event, 'uploadReportForm', 'upload_report.php');
  });

  handleFileInput('aadhar', 'uploadAadharBtn');
  handleFileInput('report', 'uploadReportBtn');
</script>
</body>
</html>
