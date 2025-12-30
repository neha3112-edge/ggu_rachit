<?php
$course = $_GET['course'] ?? '';
?>

<!DOCTYPE html>
<html>
	<head>
 <?php include __DIR__ . '/components/header.php';?>

		<title>Thank you For Submitting Your Details </title>
		<meta name="description" content="#">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Event snippet for GGU LP conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-868968102/ykKICJfNiaIbEKbNrZ4D',
      'value': 1.0,
      'currency': 'INR'
  });
</script>
	</head>
	<body>
		<?php include "navbar.php"; ?>
	
		
		<div class="thanku">
			<br>
			<div class="container">
				<div class="header">

					<br><br><br>
					<center>
						<img src="assets/img/submission-confirm.gif">
					</center>
					<center><h1 style="color:#000;"><strong>THANK YOU !</strong></h1></center>
					<center><h4><strong>Your Submission has been Received!</strong></h4></center>
					<br>
					<div class="button">
						<a href="https://ggu.distanceeducationschool.in/"><center>	<button type="button" style="padding: 10px; border: 1px solid black; background-color:#002B5C; color: #fff; font-weight:bold;">For More Information Kindly Visit Here</button></center></a>
					</div><!--end of card-->
				</div><!--end of container-->
				<br>
			</div>
		</div><!--end of thanku-->
		<?php if (!empty($course)): ?>
		<script>
document.addEventListener('DOMContentLoaded', function () {
    // Course → PDF mapping
    const brochures = {
        "DBA": "assets/img/GGU_brochure.pdf",

    };

    const course = "<?= $course ?>";

    if (brochures[course]) {
        // Redirect in same tab (not blocked by popup blocker)
        window.location.href = brochures[course];
    }
});
</script>
<?php endif; ?>
		 <?php include __DIR__ . '/components/footer.php';?>
	</body>
</html>