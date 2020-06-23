<?php
require("connect/connect.php");
$sqlConmentName = "SELECT cateName FROM categories";
$sqlreval = mysqli_query($conn, $sqlConmentName);

// $sqlpugName = "SELECT pugName FROM pugilist p INNER JOIN dkpug dk ON dk.pugID=p.pugID";
// $sqlpugquery = mysqli_query($conn, $sqlpugName);
// $sqlall = mysqli_fetch_all($sqlpugquery);
// $sqlCountXanh = mysqli_num_rows($sqlpugquery);
// $sqlCountDo = $sqlCountXanh / 2;
$dkID = $_GET["dkID"];

$sqlpug = "SELECT p.pugID,p.pugName FROM pugilist p INNER JOIN dkpug dk ON dk.pugID=p.pugID WHERE dk.dkID = '$dkID'";
$sqlpugqueryXanh = mysqli_query($conn, $sqlpug);
$sqlpugqueryDo = mysqli_query($conn, $sqlpug);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="SHORTCUT ICON" href="img/co.png">
	<script type="text/javascript" src="js/JavaScript.js"></script>
	<link rel="stylesheet" type="text/css" href="css/ChamDiem.css" />
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>

	<title>Chấm điểm đối kháng</title>
</head>

<body onkeydown="onKey(event, 'down');" onkeyup="onKey(event, 'up');" onload="onLoad();" onunload="onUnload();">
	<div id="Display" style="display: block;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" border="1">
			<tr align="center" valign="top">
				<td colspan="2">
					<span class="Hiep">Trận </span>
					<span id="TranSo" class="Hiep"></span>
				</td>
				<td colspan="2">
					<span id="GioConLai" class="Hiep">&nbsp;</span>
				</td>
				<td colspan="2">
					<span class="Hiep">Hiệp </span>
					<span id="HiepSo" class="Hiep"></span>
				</td>
			</tr>
			<tr align="center" valign="top">
				<td width="10%" class="Do">
					1<img id="Dm1" src="img/DDot.gif" class="MatBung"><br />
					2<img id="Dm2" src="img/DDot.gif" class="MatBung"><br />
					3<img id="Dm3" src="img/DDot.gif" class="MatBung"><br />
					4<img id="Dm4" src="img/DDot.gif" class="MatBung"><br />
					1<img id="Dk1" src="img/DDot.gif" class="MatBung"><br />
					2<img id="Dk2" src="img/DDot.gif" class="MatBung"><br />
					3<img id="Dk3" src="img/DDot.gif" class="MatBung"><br />
					4<img id="Dk4" src="img/DDot.gif" class="MatBung"><br />
					1<img id="Db1" src="img/DDot.gif" class="MatBung"><br />
					2<img id="Db2" src="img/DDot.gif" class="MatBung"><br />
					3<img id="Db3" src="img/DDot.gif" class="MatBung"><br />
					4<img id="Db4" src="img/DDot.gif" class="MatBung"><br />
				</td>
				<td id="tdLoiD" width="40%" class="Do" colspan="2">
					<span id="DiemDo" class="Diem">0</span>
				</td>
				<td id="tdLoiX" width="40%" class="Xanh" colspan="2">
					<span id="DiemXanh" class="Diem">0</span>
				</td>
				<td width="10%" class="Xanh">
					<img id="Xm1" src="img/XDot.gif" class="MatBung">1<br />
					<img id="Xm2" src="img/XDot.gif" class="MatBung">2<br />
					<img id="Xm3" src="img/XDot.gif" class="MatBung">3<br />
					<img id="Xm4" src="img/XDot.gif" class="MatBung">4<br />
					<img id="Xk1" src="img/XDot.gif" class="MatBung">1<br />
					<img id="Xk2" src="img/XDot.gif" class="MatBung">2<br />
					<img id="Xk3" src="img/XDot.gif" class="MatBung">3<br />
					<img id="Xk4" src="img/XDot.gif" class="MatBung">4<br />
					<img id="Xb1" src="img/XDot.gif" class="MatBung">1<br />
					<img id="Xb2" src="img/XDot.gif" class="MatBung">2<br />
					<img id="Xb3" src="img/XDot.gif" class="MatBung">3<br />
					<img id="Xb4" src="img/XDot.gif" class="MatBung">4<br />
				</td>
			</tr>
			<tr align="center" valign="top">
				<td class="Do" colspan="2" width="30%">
					<span id="TenDo" class="Ten"></span>
				</td>
				<td width="20%">
					<span id="GioiTinh" class="Ten"></span>
				</td>
				<td width="20%">
					<span id="HangCan" class="Ten"></span>
				</td>
				<td class="Xanh" colspan="2" width="30%">
					<span id="TenXanh" class="Ten"></span>
				</td>
			</tr>
			<tr>
				<td width="10%">
				</td>
				<td width="20%">
				</td>
				<td width="20%">
				</td>
				<td width="20%">
				</td>
				<td width="20%">
				</td>
				<td width="10%">
				</td>
			</tr>
		</table>
	</div>
	<br />
	<br />
	<br />
	<br />
	<form name="ChamDiem" id="ChamDiem" action="#" method="post">
		<table border="2">
			<tr>
				<td></td>
				<td>Trận: <select name="TranSo" id="ChonTran" width="70" onchange="showAllInfo();">
						<?php
						for ($i = 1; $i <= 4; $i++) {
							echo "<option>" . $i . "</option>";
						}
						?>
					</select><br />
					Giới tính: <select name="GioiTinh" onchange="showInfo('GioiTinh');">
						<option>Nam</option>
						<option>Nữ</option>
					</select><br />
					Hạng cân: <select name="HangCan" onchange="showInfo('HangCan');">
						<!-- <option>45KG</option>
				<option>55KG</option>
				<option>65kg</option> -->
						<?php
						while ($row = mysqli_fetch_assoc($sqlreval)) {
							echo "<option>" . $row["cateName"] . "</option>";
						}
						?>

					</select></td>
				<td>
					<input type="checkbox" name="HaiManHinh" id="HaiManHinh" checked="true" onclick="showDisplayWindow();" /> Dùng hai màn hình<br />
					<input type="button" class="BigButton" name="BatDau" id="BatDau" value="Bắt đầu" onclick="startFight();" /><br /><br />
					<input type="button" class="BigButton" name="KetThuc" id="KetThuc" value="Kết thúc" onclick="doneFight();" />
				</td>
				<td valign="bottom">
					<input type="checkbox" name="HaiTrongBa" id="HaiTrongBa" /> 2 trong 3 trọng tài<br />
					<input type="button" class="BigButton" name="DungSS" id="DungSS" value="Dừng săn sóc / Tiếp tục" onclick="setPause('ss');" disabled /><br /><br />
					<input type="button" class="BigButton" name="DungXX" id="DungXX" value="Dừng xem xét / Tiếp tục" onclick="setPause('xx');" disabled />
				</td>
				<td>
				</td>
				<td>
					Đặt lại hiệp <select name="DatLaiHiep" id="DatLaiHiep" width="30">
						<!-- <option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option> -->
						<?php
						for ($i = 1; $i <= 4; $i++) {
							echo "<option>" . $i . "</option>";
						}
						?>
					</select>
					phút <select name="DatLaiPhut" id="DatLaiPhut" width="30">
						<?php
						for ($i = 1; $i <= 10; $i++) {
							echo "<option>" . $i . "</option>";
						}
						?>
					</select>
					giây <select name="DatLaiGiay" id="DatLaiGiay" width="30">
						<?php
						for ($i = 0; $i <= 9; $i++) {
							echo "<option>0" . $i . "</option>";
						}
						for ($i = 10; $i <= 59; $i++) {
							echo "<option>" . $i . "</option>";
						}
						?>
					</select><br />
					<input type="button" class="SmallButton" name="BatDauLai" id="BatDauLai" value="Bắt đầu lại" onclick="restartFight();" /><br />
					Điểm dừng hiệp 4: <select name="DiemDungHiep4" id="DiemDungHiep4" width="30">
						<option>1</option>
						<option>3</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<th>Tên
				</th>
				<!--th>Trọng tài 1</th>
				<th>Trọng tài 2</th>
				<th>Trọng tài 3</th>
				<th>Trọng tài 4</th-->
				<th>Điểm</th>
				<th>Lỗi</th>
				<th></th>
				<th>Thời gian</th>
			</tr>
			<tr>
				<th><span class="Xanh">Xanh</div>
				</th>
				<!-- <td><input type="text" name="TenXanh" class="Xanh" size="10" onchange="showInfo('TenXanh');" /></td> -->
				<td><select name="TenXanh" class="Xanh" onchange="showInfo('TenXanh');">
						<option>---</option>
						<?php
						// for ($i = 0; $i < $sqlCountDo; $i++) {
						// 	echo "<option>" . $sqlall[$i][0] . "</option>";
						// }
						while ($row = mysqli_fetch_assoc($sqlpugqueryXanh)) {
							echo "<option>" . $row["pugID"] . " - " . $row["pugName"] . "</option>";
						}
						?>
					</select></td>
				<td><input type="text" name="DiemX" id="DiemX" class="Xanh" size="5" value="0" onfocus="onFocus(this);" onchange="showScore();" />
					<input type="button" name="CongDiemX" id="CongDiemX" value="+" onclick="modify('X', 1);" />
					<input type="button" name="TruDiemX" id="TruDiemX" value="--" onclick="modify('X', -1);" />&nbsp;&nbsp;&nbsp;
					<input type="button" name="TruDiemX" id="TruDiemX" value="----" onclick="modify('X', -2);" />
				</td>
				<td><input type="text" name="TruX" class="Xanh" size="5" value="0" onfocus="onFocus(this);" onchange="showScore();" />
					<input type="button" name="CongLoiX" id="CongLoiX" value="+" onclick="decrease('X', false);" />
					<input type="button" name="TruLoiX" id="TruLoiX" value="--" onclick="decrease('X', true);" />
				</td>
				<td rowspan="2"><input type="button" name="XoaDiem" value="Xóa điểm" onclick="clearScore();" /></td>
				<td>Một hiệp: <select name="TGHiepDau" onfocus="onFocus(this);">
						<!--option value="20">1/3 phút</option-->
						<option value="15">Thử 15 giây</option>
						<option value="30">30 giây</option>
						<option value="45">45 giây</option>
						<option value="60">1 phút</option>
						<option value="90">1 phút 30 giây</option>
						<option value="120" selected="selected">2 phút</option>
						<option value="150">2 phút 30 giây</option>
						<option value="180">3 phút</option>
						<option value="240">4 phút</option>
						<option value="300">5 phút</option>
						<option value="360">6 phút</option>
						<option value="420">7 phút</option>
						<option value="480">8 phút</option>
						<option value="540">9 phút</option>
						<option value="600">10 phút</option>
					</select>
					&nbsp;&nbsp;TG Khớp phím<select name="TGKhopPhim" onfocus="onFocus(this);">
						<option value="1000">1.0 giây</option>
						<option value="1500">1.5 giây</option>
						<option value="2000">2.0 giây</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><span class="Do">Đỏ</div>
				</th>
				<!-- <td><input type="text" name="TenDo" class="Do" size="10" onchange="showInfo('TenDo');" /></td> -->
				<td><select name="TenDo" class="Do" onchange="showInfo('TenDo');">
						<option>---</option>
						<?php

						// for ($i = $sqlCountDo; $i < $sqlCountXanh; $i++) {
						// 	echo "<option>" . $sqlall[$i][0] . "</option>";
						// }

						while ($row = mysqli_fetch_assoc($sqlpugqueryDo)) {
							echo "<option>" . $row["pugID"] . " - " . $row["pugName"] . "</option>";
						}
						?>
					</select></td>

				<td><input type="text" name="DiemD" id="DiemD" class="Do" size="5" value="0" onfocus="onFocus(this);" onchange="showScore();" />
					<input type="button" name="CongDiemD" id="CongDiemD" value="+" onclick="modify('D', 1);" />
					<input type="button" name="TruDiemD" id="TruDiemD" value="--" onclick="modify('D', -1);" />&nbsp;&nbsp;&nbsp;
					<input type="button" name="TruDiemD" id="TruDiemD" value="----" onclick="modify('D', -2);" />
				</td>
				<td><input type="text" name="TruD" class="Do" size="5" value="0" onfocus="onFocus(this);" onchange="showScore();" />
					<input type="button" name="CongLoiD" id="CongLoiD" value="+" onclick="decrease('D', false);" />
					<input type="button" name="TruLoiD" id="TruLoiD" value="--" onclick="decrease('D', true);" />
				</td>
				<td>Nghỉ giữa hiệp: <select name="TGNghiGiuaHiep" onfocus="onFocus(this);">
						<!--option value="20">1/3 phút</option-->
						<option value="15">Thử 15 giây</option>
						<option value="30">30 giây</option>
						<option value="45">45 giây</option>
						<option value="60" selected="selected">1 phút</option>
						<option value="90">1 phút 30 giây</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="7">
					Các trận đấu<br />
					STT;Giới tính;Hạng cân;Tên đỏ;Tên xanh<br />
					<textarea name="DanhSachTran" id="DanhSachTran" cols="60" rows="20" onchange="showList();" onfocus="onFocus(this);"></textarea><br />
					<a href="#" onclick="showHide('divFightInfo');return false;">Thông tin trận đấu</a><br />
					<a href="listfightingDK.php?dkID=<?php echo $dkID; ?>">Lưu kết quả trận đấu</a>
					<div id="divFightInfo" style="display: none;">
						<textarea id="FightInfo" name="FightInfo" cols="120" rows="20" onfocus="onFocus(this);"></textarea><br />
					</div>

					<!--textarea id="Debug" cols="200" rows="10" onfocus="onFocus(this);"> </textarea-->
				</td>
			</tr>
		</table>
		<a href="#" onclick="showHide('VungXacLapPhim', ChamDiem.PhimX1);return false;">Đổi mã phím</a>
		<!--
		http://www.w3schools.com/html/html5_audio.asp
		http://www.w3schools.com/jsref/dom_obj_audio.asp
		-->
		<!--<audio id="wavCountDown" controls style="display: hidden;">
			<source src="file://C:/Windows/Media/chord.wav" type="audio/wav">
			Your browser does not support the audio element.
		</audio>
		<audio id="wavDoneFight" controls style="display: hidden;">
			<source src="file://C:/Windows/Media/tada.wav" type="audio/wav">
			Your browser does not support the audio element.
		</audio>
		<audio id="wavDoneBreak" controls style="display: hidden;">
			<source src="file://C:/Windows/Media/notify.wav" type="audio/wav">
			Your browser does not support the audio element.
		</audio>-->
		<div id="VungXacLapPhim" style="display: none;">
			<table summary="" border="1">
				<tr>
					<th></th>
					<th colspan="3">
						<div class="Do">Đỏ</div>
					</th>
					<th></th>
					<th colspan="3">
						<div class="Xanh">Xanh</div>
					</th>
					<th colspan="2">Điều khiển</th>
				</tr>
				<tr>
					<th></th>
					<th>
						<div class="Do">3</div>
					</th>
					<th>
						<div class="Do">1</div>
					</th>
					<th>
						<div class="Do">2</div>
					</th>
					<th></th>
					<th>
						<div class="Xanh">3</div>
					</th>
					<th>
						<div class="Xanh">1</div>
					</th>
					<th>
						<div class="Xanh">2</div>
					</th>
					<td rowspan="2">Bắt đầu / Tiếp tục<br />
						Dừng săn sóc<br />
						Dừng xem xét
					</td>
					<td rowspan="2"><input type="text" name="PhimBatDau" onfocus="onFocus(this);" size="5" /><br />
						<input type="text" name="PhimDungSS" onfocus="onFocus(this);" size="5" /><br />
						<input type="text" name="PhimDungXX" onfocus="onFocus(this);" size="5" />
					</td>
				</tr>
				<tr>
					<td>Trọng tài 1</td>
					<td><input type="text" name="PhimD1" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD5" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD9" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Trọng tài 1</td>
					<td><input type="text" name="PhimX1" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX5" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX9" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
				</tr>
				<tr>
					<td>Trọng tài 2</td>
					<td><input type="text" name="PhimD2" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD6" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD10" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Trọng tài 2</td>
					<td><input type="text" name="PhimX2" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX6" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX10" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td colspan="2" rowspan="4" valign="bottom">
						<textarea name="aDefKeys" cols="20" rows="5" onfocus="onFocus(this);"></textarea>
					</td>
				</tr>
				<tr>
					<td>Trọng tài 3</td>
					<td><input type="text" name="PhimD3" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD7" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD11" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Trọng tài 3</td>
					<td><input type="text" name="PhimX3" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX7" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX11" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
				</tr>
				<tr>
					<td>Trọng tài 4</td>
					<td><input type="text" name="PhimD4" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD8" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimD12" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Trọng tài 4</td>
					<td><input type="text" name="PhimX4" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX8" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td><input type="text" name="PhimX12" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
				</tr>
				<tr>
					<td>Phạm lỗi</td>
					<td><input type="text" name="PhimDTru" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Hủy lỗi</td>
					<td><input type="text" name="PhimDCong" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Phạm lỗi</td>
					<td><input type="text" name="PhimXTru" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td>Hủy lỗi</td>
					<td><input type="text" name="PhimXCong" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
				</tr>
				<tr>
					<td>Cộng điểm</td>
					<td><input type="text" name="PhimDTruDiem" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Trừ điểm</td>
					<td><input type="text" name="PhimDCongDiem" class="Do" onfocus="onFocus(this);" size="5" /></td>
					<td>Cộng điểm</td>
					<td><input type="text" name="PhimXTruDiem" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
					<td>Trừ điểm</td>
					<td><input type="text" name="PhimXCongDiem" class="Xanh" onfocus="onFocus(this);" size="5" /></td>
				</tr>
			</table>
		</div>

	</form>
</body>

</html>