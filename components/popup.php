  <style>
.modal2 {
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5); /* Dim background */
  display: none;
}

.modal-content2 {
  background-color: #fff;
  margin: 3% auto;
  padding: 30px 40px;
  width: 100%;
  max-width: 800px;
  border-radius: 8px;
  position: relative; font-size:13px;
}

.close-btn {
  position: absolute;
  top: 5px;
  right: 10px;
  font-size: 20px;
  cursor: pointer;
}
@media only screen and (max-width: 600px) {.modal-content2 {
  background-color: #fff;
  margin: 2% auto;
  padding: 30px 40px;
  width: 100%;
  max-width: 800px;
  margin: 20px; /* Adds margin from left and right */
    width: auto; /* Makes sure it doesn't overflow */
  border-radius: 8px;
  position: relative; font-size:13px;
}}
.disclaimer_popup{color: #011bfe; font-size: 12px; text-decoration: underline;}
.disclaimer-list {
  list-style: disc;
  padding-left: 20px;
}

.disclaimer-list li {
  margin-bottom: 10px;
  line-height: 1.2;
}

 .error-message {
    color: red;
    font-size: 13px;
    display: none;
    margin-top: 5px;
  }
</style>
<!-- Enquire Now Popup -->
    <div id="enquirePopup" class="popup-overlay">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('enquirePopup')">&times;</span>
    
        <?php include "form.php"; ?>
      </div>
    </div>

    <!-- Download Brochure Popup -->
    <div id="brochurePopup" class="popup-overlay">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('brochurePopup')">&times;</span>
     <form action="mail.php" method="post" name="form" id="enquiry-form1">
        <h2>Download Brochure</h2>
		 <center> <p>Please enter your details to download the brochure:</p></center>
                    <div>
                        <label>Name<span class="required">*</span></label>
                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Your Name" required>
                    </div>

                    <div>
                        <label>Email ID <span class="required">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" required>
                    </div>

                    <div>
                        <label>Phone <span class="required">*</span></label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter Mobile Number" required>
                    </div>
<br>
                    <div>
                        <label>Course <span class="required">*</span></label>
                      <select name="course" class="form-control" id="courseSelect" required>
                            <option value="" selected disabled>Select Your Course</option>
                             <option value="DBA">General</option>
               	<option value="DBA">Finance</option>
            <option value="DBA">Leadership</option>
            <option value="DBA">Business Analytics</option>
            <option value="DBA">Marketing</option>
           
            <option value="DBA">Generative AI</option>
                   
                        </select>
                    </div>

                    <div>
                        <label>State <span class="required">*</span></label>
                        <select name="state" class="form-control" id="state" required>
                            <option value="" hidden>Select Your State</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                        </select>
                    </div>
<div id="checkboxWrapper" style="display: flex; flex-direction: column; gap: 5px;">
  <div style="display: flex; align-items: center; gap: 8px;">
    <input type="checkbox" id="disclaimer" name="disclaimer" />
    <span style="font-size: 10px; line-height:1;">I consent to receive university updates via email and mobile number. <span class="disclaimer_popup" onclick="disclaimerModal()">Disclaimer</span></span>
  </div>
  <span class="checkbox-error" style="color: red; font-size: 13px; display: none;"></span>
</div>
		 	 <input type="hidden" name="show_brochure" value="yes">
                    <input type="hidden" name="source" id="source" value="GGU LP">
                    <input type="hidden" name="form_name" id="form_name" value="Download Brochure">
                    <input type="hidden" name="sub_source" id="sub_source" value="">
                    <input type="hidden" name="utm_source" id="utm_source" value="">
                    <input type="hidden" name="utm_campaign" id="utm_campaign" value="">
                    <input type="hidden" name="utm_medium" id="utm_medium" value="">
                    <input type="hidden" name="utm_term" id="utm_term" value="">
                    <input type="hidden" name="page_url" id="page_url" value="">
                    <br>
                    <center>
                        <button type="submit" name="submit" value="send" class="sub-btn" id="downloadbrochurebtn">Submit</button>
                    </center>
                </form>
      </div>
    </div>
<div id="disclaimerModal" class="modal2" style="display: none;">
  <div class="modal-content2">
    <span class="close-btn" onClick="closedisclaimerModal()">&times;</span>
    <h2 style="text-align:center;">Disclaimer</h2>
    <hr>
    <p>This information is provided by DistanceEducationSchool.in, under the legal entity of 
      <b>SODE Counselling Services LLP,</b> registered with the 
      <b>Ministry of Corporate Affairs</b>, with the main objective of providing information, guidance, 
      and counselling services about <b>UGC-DEB-approved universities</b>. We do not act as a university 
      or an admission authority.
    </p>

    <br>
    <h5>Essential Points </h5>
    <ul class="disclaimer-list">
      <li>All university names, logos, and trademarks used are for informational purposes only.</li>
      <li>Our role is to provide updates, information, and guidance on universities regarding their distance or online education programs.</li>
      <li>We do not charge students any fees for counselling or guidance on university applications.</li>
      <li>We do not issue degrees, mark sheets, or certificates in the name of any university.</li>
      <li>Our aim is to offer free and unbiased counselling to help students choose the right path.</li>
      <li>We respect the integrity and reputation of all listed universities and do not engage in any activity that damages their credibility.</li>
      <li>Users are encouraged to verify information from official university portals before making decisions.</li>
      <li>Our services are transparent, legal, and purely for student support. 
        <span onClick="closedisclaimerModal()" id="closeButton" style="font-size:13px; color:blue; cursor:pointer;">close</span>
      </li>
    </ul>
  </div>
</div>
  <script>
    function disclaimerModal() {
        document.getElementById('disclaimerModal').style.display = 'block';
    }

    function closedisclaimerModal() {
        document.getElementById('disclaimerModal').style.display = 'none';
    }
    </script>

<!--<script>

    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('downloadbrochurebtn');
        const courseSelect = document.getElementById('courseSelect');
        const courseForm = document.getElementById('enquiry-form');

        submitBtn.addEventListener('click', function (event) {
            const selectedCourse = courseSelect.value;

            // Validate if the course is selected
            if (!selectedCourse) {
                alert('Please select a course before submitting the form.');
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Open the corresponding PDF
            const pdfFileName = `assets/img/Rushford_DBA.pdf`;
            window.open(pdfFileName, '_blank');

            // Form submits to mail.php automatically because there is no `event.preventDefault()` here
        });

        // Ensure the form submits to mail.php
        courseForm.setAttribute('action', 'mail.php');
    });
</script>-->
  