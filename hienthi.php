<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
	<style>
		table, tr, th, td{
			border: 1px solid black;
			border-collapse: collapse;
}
		td, th {
			padding: 10px;
}
		img {
			width: 100px;
			height: 100px;
		}
	</style>

<body>
	
	<?php
		$conn = mysqli_connect("localhost", "root", "", "quan_ly");
	if(!$conn){
		echo("Kết nối không thành công");
	}
	
	$sqlHienThi = "SELECT * FROM `nhanvien` WHERE 1";
	$qrHienThi = mysqli_query($conn, $sqlHienThi);
	?>
	
	
	<h1>Quản lý nhân viên</h1>
	
	<div class="tim-kiem">
		<form action="suaxoa.php" method="get">
			<input type="text" name="id">
			<input type="submit" name="timkiem" value="Tìm kiếm"/>
		</form>
	</div>
	
	<table>
		<tr>
			<th>MaNV</th>
			<th>HoTen</th>
			<th>HinhAnh</th>
			<th>XepLoai</th>
			<th>LuongNgay</th>
			<th>NgayCong</th>
			<th>TongLuong</th>
		</tr>
		<?php while($row = mysqli_fetch_array($qrHienThi)) { ?>
		<tr>
			<td><?=$row["manv"]?></th>
			<td><?=$row["hoten"]?></th>
			<td><img src="image/<?=$row["hinhanh"]?>"></th>
			<td><?=$row["xeploai"]?></th>
			<td><?=$row["luongngay"]?></th>
			<td><?=$row["ngaycong"]?></th>
		<?php 
			$xepLoai = $row["xeploai"];
			$thuong = 0;												
			if($xepLoai == 'A') {
				$thuong = 500000;
			} else if($xepLoai == 'B') {
				$thuong = 300000;
			}
			$tongLuong = $row["luongngay"] * $row["ngaycong"] + $thuong;
		?>
			<td><?=$tongLuong?></th>
		</tr>

		<?php } ?>
	</table>
</body>
</html>