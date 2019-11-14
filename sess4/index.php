<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SQL</title>
</head>
<body>
	<style type="text/css">
		.upload {
			background: black;
			color: white;
			width: 100%;
			outline: none;
			height: 50px;
			font-size: 20px;
			border: none;
		}
		.upload:hover {
			background: white;
			color: black;
			border: 1px solid black;
		}
		h1 {

			margin-left: 90px;
		}
		
		label {
			font-weight: bold;
		}
		form {
			width: 30%;
			margin: 0 auto;
			border: 1px solid brown;
			padding: 10px;
		}
		span {
			text-align: center;
			color: red;
		}
	</style>
	<?php include 'connect.php';?>
	<?php
		$decription = $title = $upload = '';
		$errDec = $errTitle = $errUp = '';
		$check = true;
		if(isset($_POST['upload'])){
			$decription = $_POST['decription'];
			$title = $_POST['title'];
			if($decription == '') {
				# code...
				$errDec = 'Please type product`s decription!';
				$check=false;
			}
			if($title == '') {
				# code...
				$errTitle = 'Please type product`s title!';
				$check=false;
			}
			$up = $_FILES['image'];
			if ($up['error'] > 0){
				$errUp = 'Upload your image!';
				$check=false;
			}
			else if ($up['error']==0){
				$upload = $up['name'];
				$file = $_FILES['image']['name'];
				move_uploaded_file($up['tmp_name'], 'uploads/'.$upload);
			}
			if($check){
				$sqlInsert = "INSERT INTO news(TITLE, DECRIPTION, Image) VALUES ('$title', '$decription', '$file')";
				if ($connect->query($sqlInsert) === TRUE) {
			        $decription = $title = '';		
			        	echo '<script type="text/javascript">alert("Thêm dữ liệu thành công!");</script>';
							// chuyen trang
						header('Location: show.php');
			    } 
			    else {
			        echo "Error: " . $sql . "<br>" . $connect->error;
			    }
			}
		}
	?>
		
	<form method="POST" enctype="multipart/form-data">
	<h1>Upload product</h1>
		<p>
			<label>Title: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<input type="text" name="title" value="<?php echo $title; ?>"><br>
			<span><?php echo $errTitle;?></span>
		</p>
		<p>
			<label>Decription: </label>
			<textarea name="decription"><?php echo $decription; ?></textarea><br>
			<span><?php echo $errDec;?></span>
		</p>
		
		<p>
			<label>Picture : </label>
			<input type="file" name="image" class="img"><br>
			<span><?php echo $errUp;?></span>
		</p>
		<p>
			<input type="submit" value="Upload" class="upload" name="upload">
		</p>
	</form>
</body>
</html>