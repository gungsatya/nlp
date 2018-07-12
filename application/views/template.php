<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'head.php';?>
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<?php require 'sidebar.php'; ?>
		<?php
			if ($act_page=='dashboard') {
				require 'content/dashboard.php';
			}
			elseif ($act_page=='task1') {
				require 'content/task1.php';
			}
			elseif ($act_page=='task2') {
				require 'content/task2.php';
			}
			elseif ($act_page=='task3') {
				require 'content/task3.php';
			}
			elseif ($act_page=='task4') {
				require 'content/task4.php';
			}
			elseif ($act_page=='task5') {
				require 'content/task5.php';
			}
		?>
	</div>
	<?require 'foot.php';?>
</body>
</html>
