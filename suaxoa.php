<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	<?php
	$conn = mysqli_connect("localhost", "root", "", "quan_ly");
	if(!$conn){
		echo("Kết nối không thành công");
	}
	
	$id = $_GET['id'];
	
	$sqlSua = "SELECT * FROM `nhanvien` WHERE manv = '$id'";
	$qrSua = mysqli_query($conn, $sqlSua);
	$row = mysqli_fetch_array($qrSua);
	if(isset($_POST['sua'])){
	
		$manv = $_POST['id'];
		
		$hoten = $_POST['hoten'];
		$anh = $_POST['anh'];
		if(isset($_FILES['upanh'])){
			if($_FILES['upanh']['error'] > 0){
				
			} else {
				move_uploaded_file($_FILES['upanh']['tmp_name'], 'image/' . $_FILES['upanh']['name']);
				$anh = $_FILES['upanh']['name'];
			}
		}
		$xepLoai = $_POST['xeploai'];
		$luongNgay = $_POST['luongngay'];
		$ngayCong = $_POST['ngaycong'];
		$sqlCapNhat = "UPDATE `nhanvien` SET`hoten`='$hoten',`hinhanh`='$anh',`xeploai`='$xepLoai',`luongngay`= $luongNgay,`ngaycong`=$ngayCong WHERE manv = '$manv'";
		mysqli_query($conn, $sqlCapNhat);
		header("Location: hienthi.php");
		
	}
	
	if(isset($_POST['xoa'])){
		$manv = $_POST['id'];
		$sqlXoa = "DELETE FROM `nhanvien` WHERE manv = '$manv'";
		mysqli_query($conn, $sqlXoa);
		
		header("Location: hienthi.php");
	}
	?>
	
	<form action="suaxoa.php" method="post" enctype="multipart/form-data">
		<p>
			Mã NV: <br>
			<input type="text" name="id" value="<?=$row['manv']?>">
		</p>
		<p>
			Họ tên: <br>
			<input type="text" name="hoten" value="<?=$row['hoten']?>">
		</p>
		<p>
			Hình ảnh: <br>
			<img src="image/<?=$row["hinhanh"]?>">
			<input type="file" name="upanh">
			<input type="text" name="anh" value="<?=$row['hinhanh']?>" style="display: none;">
		</p>
		<p>
			Xếp loại: <br>
			<input type="text" name="xeploai" value="<?=$row['xeploai']?>">
		</p>
		<p>
			Lương ngày: <br>
			<input type="text" name="luongngay" value="<?=$row['luongngay']?>">
		</p>
		<p>
			Ngày công: <br>
			<input type="text" name="ngaycong" value="<?=$row['ngaycong']?>">
		</p>
		<p>
			<input type="submit" value="Sửa" name="sua">
			<input type="submit" value="Xóa" name="xoa">
		</p>
	</from>
	
</body>
</html>