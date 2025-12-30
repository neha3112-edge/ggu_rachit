<html>
  <head>
    <title>Popup Example</title>
    <style>
      .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
      }

      .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 50%;
        max-width: 500px;
        text-align: center;
        position: relative;
      }

      .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <!-- Buttons -->
    <button id="enquireNowBtn">Enquire Now</button>
    <button class="downloadBrochureBtn">Download Brochure <i class="fa fa-download"></i></button>
    <button class="downloadBrochureBtn">Download Brochure <i class="fa fa-download"></i></button>

    <!-- Popups -->
    <!-- Enquire Now Popup -->
    <div id="enquirePopup" class="popup-overlay">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('enquirePopup')">&times;</span>
        <h2>Enquire Now</h2>
        <p>Fill out the form below to enquire:</p>
        <?php include "form.php"; ?>
      </div>
    </div>

    <!-- Download Brochure Popup -->
    <div id="brochurePopup" class="popup-overlay">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('brochurePopup')">&times;</span>
        <form action="mail.php" method="post" name="form" id="enquiry-form">
          <h2>Download Brochure</h2>
          <p>Please enter your details to download the brochure:</p>
          <!-- Add your input fields here -->
          <center>
            <button type="submit" name="submit" value="send" class="sub-btn" id="downloadbrochurebtn">Submit</button>
          </center>
        </form>
      </div>
    </div>

    <script>
      // Function to open a popup
      function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
      }

      // Function to close a popup
      function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
      }

      // Add event listener for "Enquire Now" button
      const enquireNowBtn = document.getElementById('enquireNowBtn');
      enquireNowBtn.addEventListener('click', function () {
        openPopup('enquirePopup');
      });

      // Add event listeners for all "Download Brochure" buttons
      const brochureButtons = document.querySelectorAll('.downloadBrochureBtn');
      brochureButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          openPopup('brochurePopup');
        });
      });
    </script>
  </body>
</html>
