<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';

$validateFlag = 200;

if(isset($_POST['modalId']) === false){
	$validateFlag = 400;
}
else{
	$modalId = $_POST['modalId'];
}

if(isset($_POST['refererModalId']) === false){
	$validateFlag = 400;
}
else{
	$refererModalId = $_POST['refererModalId'];
}

if($validateFlag == 200){
?>
	<h1>Tilføj mærke</h1>
	<form action="/systemUsers/add/tags/add/modalSubmit.php" enctype="application/x-www-form-urlencoded" method="post" onsubmit="submitForm(this);" target="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>">
		<iframe name="<?php echo md5($_SERVER['SCRIPT_FILENAME']) . purify($modalId); ?>" src="about:blank"></iframe>
		<input name="modalId" type="hidden" value="<?php echo purify($modalId); ?>">
		<input name="refererModalId" type="hidden" value="<?php echo purify($refererModalId); ?>">
		<div>
			Tilføj nedenstående mærke på systembrugeren.<br>
			<br>
			<input id="inputName" name="name" pattern=".{3,}" placeholder="Opfølgning" type="text" required autofocus><label for="inputName">Mærke</label><br>
			<select class="colorPicker" id="inputBorderColor" name="borderColor" onchange="this.style.background = 'linear-gradient(90deg, transparent 90%, ' + this.options[this.selectedIndex].value + ' 10%)';" required>
				<option value="Aquamarine">Aquamarine</option>
				<option value="AliceBlue">Alice Blue</option>
				<option value="AntiqueWhite">Antique White</option>
				<option value="Aqua">Aqua</option>
				<option value="Azure">Azure</option>
				<option value="Beige">Beige</option>
				<option value="Bisque">Bisque</option>
				<option value="Black">Black</option>
				<option value="BlanchedAlmond">Blanched Almond</option>
				<option value="Blue">Blue</option>
				<option value="BlueViolet">Blue Violet</option>
				<option value="Brown">Brown</option>
				<option value="BurlyWood">Burly Wood</option>
				<option value="CadetBlue">Cadet Blue</option>
				<option value="Chartreuse">Chartreuse</option>
				<option value="Coral">Coral</option>
				<option value="CornflowerBlue">Cornflower Blue</option>
				<option value="Cornsilk">Cornsilk</option>
				<option value="Crimson">Crimson</option>
				<option value="Cyan">Cyan</option>
				<option value="DarkBlue">Dark Blue</option>
				<option value="DarkCyan">Dark Cyan</option>
				<option value="DarkGoldenRod">Dark Golden Rod</option>
				<option value="DarkGray">Dark Gray</option>
				<option value="DarkGreen">Dark Green</option>
				<option value="DarkKhaki">Dark Khaki</option>
				<option value="DarkMagenta">Dark Magenta</option>
				<option value="DarkOliveGreen">Dark OliveGreen</option>
				<option value="DarkOrange">Dark Orange</option>
				<option value="DarkOrchid">Dark Orchid</option>
				<option value="DarkRed">Dark Red</option>
				<option value="DarkSalmon">Dark Salmon</option>
				<option value="DarkSeaGreen">Dark SeaGreen</option>
				<option value="DarkSlateBlue">Dark Slate Blue</option>
				<option value="DarkSlateGray">Dark Slate Gray</option>
				<option value="DarkTurquoise ">Dark Turquoise</option>
				<option value="DarkViolet">Dark Violet</option>
				<option value="DeepPink">Deep Pink</option>
				<option value="DeepSkyBlue">Deep Sky Blue</option>
				<option value="DimGray">Dim Gray</option>
				<option value="DodgerBlue">Dodger Blue</option>
				<option value="FireBrick">Fire Brick</option>
				<option value="FloralWhite">Floral White</option>
				<option value="ForestGreen">Forest Green</option>
				<option value="Fuchsia">Fuchsia</option>
				<option value="Gainsboro">Gainsboro</option>
				<option value="GhostWhite">Ghost White</option>
				<option value="Gold">Gold</option>
				<option value="GoldenRod">Golden Rod</option>
				<option value="Gray">Gray</option>
				<option value="Green">Green</option>
				<option value="GreenYellow">Green Yellow</option>
				<option value="HoneyDew">Honey Dew</option>
				<option value="HotPink">Hot Pink</option>
				<option value="IndianRed">Indian Red</option>
				<option value="Indigo">Indigo</option>
				<option value="Ivory">Ivory</option>
				<option value="Khaki">Khaki</option>
				<option value="Lavender">Lavender</option>
				<option value="LavenderBlush">Lavender Blush</option>
				<option value="LawnGreen">Lawn Green</option>
				<option value="LemonChiffon">Lemon Chiffon</option>
				<option value="LightBlue">Light Blue</option>
				<option value="LightCoral">Light Coral</option>
				<option value="LightCyan">Light Cyan</option>
				<option value="LightGoldenRodYellow">Light Golden Rod Yellow</option>
				<option value="LightGray">Light Gray</option>
				<option value="LightGreen">Light Green</option>
				<option value="LightPink">Light Pink</option>
				<option value="LightSalmon">Light Salmon</option>
				<option value="LightSeaGreen">Light Sea Green</option>
				<option value="LightSkyBlue">Light Sky Blue</option>
				<option value="LightSlateGray">Light Slate Gray</option>
				<option value="LightSteelBlue">Light Steel Blue</option>
				<option value="LightYellow">Light Yellow</option>
				<option value="Lime">Lime</option>
				<option value="LimeGreen">Lime Green</option>
				<option value="Linen">Linen</option>
				<option value="Magenta">Magenta</option>
				<option value="Maroon">Maroon</option>
				<option value="MediumAquaMarine">Medium Aqua Marine</option>
				<option value="MediumBlue">Medium Blue</option>
				<option value="MediumOrchid">Medium Orchid</option>
				<option value="MediumPurple">Medium Purple</option>
				<option value="MediumSeaGreen">Medium Sea Green</option>
				<option value="MediumSlateBlue">Medium Slate Blue</option>
				<option value="MediumSpringGreen">Medium Spring Green</option>
				<option value="MediumTurquoise">Medium Turquoise</option>
				<option value="MediumVioletRed">Medium VioletRed</option>
				<option value="MidnightBlue">Midnight Blue</option>
				<option value="MintCream">Mint Cream</option>
				<option value="MistyRose">Misty Rose</option>
				<option value="Moccasin">Moccasin</option>
				<option value="NavajoWhite">Navajo White</option>
				<option value="Navy">Navy</option>
				<option value="OldLace">Old Lace</option>
				<option value="Olive">Olive</option>
				<option value="OliveDrab">Olive Drab</option>
				<option value="Orange">Orange</option>
				<option value="OrangeRed">Orange Red</option>
				<option value="Orchid">Orchid</option>
				<option value="PaleGoldenRod">Pale Golden Rod</option>
				<option value="PaleGreen">Pale Green</option>
				<option value="PaleTurquoise">Pale Turquoise</option>
				<option value="PaleVioletRed">Pale Violet Red</option>
				<option value="PapayaWhip">Papaya Whip</option>
				<option value="PeachPuff">Peach Puff</option>
				<option value="Peru">Peru</option>
				<option value="Pink">Pink</option>
				<option value="Plum">Plum</option>
				<option value="PowderBlue">Powder Blue</option>
				<option value="Purple">Purple</option>
				<option value="RebeccaPurple">Rebecca Purple</option>
				<option value="Red">Red</option>
				<option value="RosyBrown">Rosy Brown</option>
				<option value="RoyalBlue">Royal Blue</option>
				<option value="SaddleBrown">Saddle Brown</option>
				<option value="Salmon">Salmon</option>
				<option value="SandyBrown">Sandy Brown</option>
				<option value="SeaGreen">Sea Green</option>
				<option value="SeaShell">Sea Shell</option>
				<option value="Sienna">Sienna</option>
				<option value="Silver">Silver</option>
				<option value="SkyBlue">Sky Blue</option>
				<option value="SlateBlue">Slate Blue</option>
				<option value="SlateGray">Slate Gray</option>
				<option value="Snow">Snow</option>
				<option value="SpringGreen">Spring Green</option>
				<option value="SteelBlue">Steel Blue</option>
				<option value="Tan">Tan</option>
				<option value="Teal">Teal</option>
				<option value="Thistle">Thistle</option>
				<option value="Tomato">Tomato</option>
				<option value="Transparent">Transparent</option>
				<option value="Turquoise">Turquoise</option>
				<option value="Violet">Violet</option>
				<option value="Wheat">Wheat</option>
				<option value="White">White</option>
				<option value="WhiteSmoke">White Smoke</option>
				<option value="Yellow">Yellow</option>
				<option value="YellowGreen">Yellow Green</option>
			</select><label for="inputBorderColor">Kantfarve</label><br>
			<select class="colorPicker" id="inputBackgroundColor" name="backgroundColor" onchange="this.style.background = 'linear-gradient(90deg, transparent 90%, ' + this.options[this.selectedIndex].value + ' 10%)';" required>
				<option value="Aquamarine">Aquamarine</option>
				<option value="AliceBlue">Alice Blue</option>
				<option value="AntiqueWhite">Antique White</option>
				<option value="Aqua">Aqua</option>
				<option value="Azure">Azure</option>
				<option value="Beige">Beige</option>
				<option value="Bisque">Bisque</option>
				<option value="Black">Black</option>
				<option value="BlanchedAlmond">Blanched Almond</option>
				<option value="Blue">Blue</option>
				<option value="BlueViolet">Blue Violet</option>
				<option value="Brown">Brown</option>
				<option value="BurlyWood">Burly Wood</option>
				<option value="CadetBlue">Cadet Blue</option>
				<option value="Chartreuse">Chartreuse</option>
				<option value="Coral">Coral</option>
				<option value="CornflowerBlue">Cornflower Blue</option>
				<option value="Cornsilk">Cornsilk</option>
				<option value="Crimson">Crimson</option>
				<option value="Cyan">Cyan</option>
				<option value="DarkBlue">Dark Blue</option>
				<option value="DarkCyan">Dark Cyan</option>
				<option value="DarkGoldenRod">Dark Golden Rod</option>
				<option value="DarkGray">Dark Gray</option>
				<option value="DarkGreen">Dark Green</option>
				<option value="DarkKhaki">Dark Khaki</option>
				<option value="DarkMagenta">Dark Magenta</option>
				<option value="DarkOliveGreen">Dark OliveGreen</option>
				<option value="DarkOrange">Dark Orange</option>
				<option value="DarkOrchid">Dark Orchid</option>
				<option value="DarkRed">Dark Red</option>
				<option value="DarkSalmon">Dark Salmon</option>
				<option value="DarkSeaGreen">Dark SeaGreen</option>
				<option value="DarkSlateBlue">Dark Slate Blue</option>
				<option value="DarkSlateGray">Dark Slate Gray</option>
				<option value="DarkTurquoise ">Dark Turquoise</option>
				<option value="DarkViolet">Dark Violet</option>
				<option value="DeepPink">Deep Pink</option>
				<option value="DeepSkyBlue">Deep Sky Blue</option>
				<option value="DimGray">Dim Gray</option>
				<option value="DodgerBlue">Dodger Blue</option>
				<option value="FireBrick">Fire Brick</option>
				<option value="FloralWhite">Floral White</option>
				<option value="ForestGreen">Forest Green</option>
				<option value="Fuchsia">Fuchsia</option>
				<option value="Gainsboro">Gainsboro</option>
				<option value="GhostWhite">Ghost White</option>
				<option value="Gold">Gold</option>
				<option value="GoldenRod">Golden Rod</option>
				<option value="Gray">Gray</option>
				<option value="Green">Green</option>
				<option value="GreenYellow">Green Yellow</option>
				<option value="HoneyDew">Honey Dew</option>
				<option value="HotPink">Hot Pink</option>
				<option value="IndianRed">Indian Red</option>
				<option value="Indigo">Indigo</option>
				<option value="Ivory">Ivory</option>
				<option value="Khaki">Khaki</option>
				<option value="Lavender">Lavender</option>
				<option value="LavenderBlush">Lavender Blush</option>
				<option value="LawnGreen">Lawn Green</option>
				<option value="LemonChiffon">Lemon Chiffon</option>
				<option value="LightBlue">Light Blue</option>
				<option value="LightCoral">Light Coral</option>
				<option value="LightCyan">Light Cyan</option>
				<option value="LightGoldenRodYellow">Light Golden Rod Yellow</option>
				<option value="LightGray">Light Gray</option>
				<option value="LightGreen">Light Green</option>
				<option value="LightPink">Light Pink</option>
				<option value="LightSalmon">Light Salmon</option>
				<option value="LightSeaGreen">Light Sea Green</option>
				<option value="LightSkyBlue">Light Sky Blue</option>
				<option value="LightSlateGray">Light Slate Gray</option>
				<option value="LightSteelBlue">Light Steel Blue</option>
				<option value="LightYellow">Light Yellow</option>
				<option value="Lime">Lime</option>
				<option value="LimeGreen">Lime Green</option>
				<option value="Linen">Linen</option>
				<option value="Magenta">Magenta</option>
				<option value="Maroon">Maroon</option>
				<option value="MediumAquaMarine">Medium Aqua Marine</option>
				<option value="MediumBlue">Medium Blue</option>
				<option value="MediumOrchid">Medium Orchid</option>
				<option value="MediumPurple">Medium Purple</option>
				<option value="MediumSeaGreen">Medium Sea Green</option>
				<option value="MediumSlateBlue">Medium Slate Blue</option>
				<option value="MediumSpringGreen">Medium Spring Green</option>
				<option value="MediumTurquoise">Medium Turquoise</option>
				<option value="MediumVioletRed">Medium VioletRed</option>
				<option value="MidnightBlue">Midnight Blue</option>
				<option value="MintCream">Mint Cream</option>
				<option value="MistyRose">Misty Rose</option>
				<option value="Moccasin">Moccasin</option>
				<option value="NavajoWhite">Navajo White</option>
				<option value="Navy">Navy</option>
				<option value="OldLace">Old Lace</option>
				<option value="Olive">Olive</option>
				<option value="OliveDrab">Olive Drab</option>
				<option value="Orange">Orange</option>
				<option value="OrangeRed">Orange Red</option>
				<option value="Orchid">Orchid</option>
				<option value="PaleGoldenRod">Pale Golden Rod</option>
				<option value="PaleGreen">Pale Green</option>
				<option value="PaleTurquoise">Pale Turquoise</option>
				<option value="PaleVioletRed">Pale Violet Red</option>
				<option value="PapayaWhip">Papaya Whip</option>
				<option value="PeachPuff">Peach Puff</option>
				<option value="Peru">Peru</option>
				<option value="Pink">Pink</option>
				<option value="Plum">Plum</option>
				<option value="PowderBlue">Powder Blue</option>
				<option value="Purple">Purple</option>
				<option value="RebeccaPurple">Rebecca Purple</option>
				<option value="Red">Red</option>
				<option value="RosyBrown">Rosy Brown</option>
				<option value="RoyalBlue">Royal Blue</option>
				<option value="SaddleBrown">Saddle Brown</option>
				<option value="Salmon">Salmon</option>
				<option value="SandyBrown">Sandy Brown</option>
				<option value="SeaGreen">Sea Green</option>
				<option value="SeaShell">Sea Shell</option>
				<option value="Sienna">Sienna</option>
				<option value="Silver">Silver</option>
				<option value="SkyBlue">Sky Blue</option>
				<option value="SlateBlue">Slate Blue</option>
				<option value="SlateGray">Slate Gray</option>
				<option value="Snow">Snow</option>
				<option value="SpringGreen">Spring Green</option>
				<option value="SteelBlue">Steel Blue</option>
				<option value="Tan">Tan</option>
				<option value="Teal">Teal</option>
				<option value="Thistle">Thistle</option>
				<option value="Tomato">Tomato</option>
				<option value="Transparent">Transparent</option>
				<option value="Turquoise">Turquoise</option>
				<option value="Violet">Violet</option>
				<option value="Wheat">Wheat</option>
				<option value="White">White</option>
				<option value="WhiteSmoke">White Smoke</option>
				<option value="Yellow">Yellow</option>
				<option value="YellowGreen">Yellow Green</option>
			</select><label for="inputBackgroundColor">Baggrundsfarve</label><br>
			<select class="colorPicker" id="inputFontColor" name="fontColor" onchange="this.style.background = 'linear-gradient(90deg, transparent 90%, ' + this.options[this.selectedIndex].value + ' 10%)';" required>
				<option value="Aquamarine">Aquamarine</option>
				<option value="AliceBlue">Alice Blue</option>
				<option value="AntiqueWhite">Antique White</option>
				<option value="Aqua">Aqua</option>
				<option value="Azure">Azure</option>
				<option value="Beige">Beige</option>
				<option value="Bisque">Bisque</option>
				<option value="Black">Black</option>
				<option value="BlanchedAlmond">Blanched Almond</option>
				<option value="Blue">Blue</option>
				<option value="BlueViolet">Blue Violet</option>
				<option value="Brown">Brown</option>
				<option value="BurlyWood">Burly Wood</option>
				<option value="CadetBlue">Cadet Blue</option>
				<option value="Chartreuse">Chartreuse</option>
				<option value="Coral">Coral</option>
				<option value="CornflowerBlue">Cornflower Blue</option>
				<option value="Cornsilk">Cornsilk</option>
				<option value="Crimson">Crimson</option>
				<option value="Cyan">Cyan</option>
				<option value="DarkBlue">Dark Blue</option>
				<option value="DarkCyan">Dark Cyan</option>
				<option value="DarkGoldenRod">Dark Golden Rod</option>
				<option value="DarkGray">Dark Gray</option>
				<option value="DarkGreen">Dark Green</option>
				<option value="DarkKhaki">Dark Khaki</option>
				<option value="DarkMagenta">Dark Magenta</option>
				<option value="DarkOliveGreen">Dark OliveGreen</option>
				<option value="DarkOrange">Dark Orange</option>
				<option value="DarkOrchid">Dark Orchid</option>
				<option value="DarkRed">Dark Red</option>
				<option value="DarkSalmon">Dark Salmon</option>
				<option value="DarkSeaGreen">Dark SeaGreen</option>
				<option value="DarkSlateBlue">Dark Slate Blue</option>
				<option value="DarkSlateGray">Dark Slate Gray</option>
				<option value="DarkTurquoise ">Dark Turquoise</option>
				<option value="DarkViolet">Dark Violet</option>
				<option value="DeepPink">Deep Pink</option>
				<option value="DeepSkyBlue">Deep Sky Blue</option>
				<option value="DimGray">Dim Gray</option>
				<option value="DodgerBlue">Dodger Blue</option>
				<option value="FireBrick">Fire Brick</option>
				<option value="FloralWhite">Floral White</option>
				<option value="ForestGreen">Forest Green</option>
				<option value="Fuchsia">Fuchsia</option>
				<option value="Gainsboro">Gainsboro</option>
				<option value="GhostWhite">Ghost White</option>
				<option value="Gold">Gold</option>
				<option value="GoldenRod">Golden Rod</option>
				<option value="Gray">Gray</option>
				<option value="Green">Green</option>
				<option value="GreenYellow">Green Yellow</option>
				<option value="HoneyDew">Honey Dew</option>
				<option value="HotPink">Hot Pink</option>
				<option value="IndianRed">Indian Red</option>
				<option value="Indigo">Indigo</option>
				<option value="Ivory">Ivory</option>
				<option value="Khaki">Khaki</option>
				<option value="Lavender">Lavender</option>
				<option value="LavenderBlush">Lavender Blush</option>
				<option value="LawnGreen">Lawn Green</option>
				<option value="LemonChiffon">Lemon Chiffon</option>
				<option value="LightBlue">Light Blue</option>
				<option value="LightCoral">Light Coral</option>
				<option value="LightCyan">Light Cyan</option>
				<option value="LightGoldenRodYellow">Light Golden Rod Yellow</option>
				<option value="LightGray">Light Gray</option>
				<option value="LightGreen">Light Green</option>
				<option value="LightPink">Light Pink</option>
				<option value="LightSalmon">Light Salmon</option>
				<option value="LightSeaGreen">Light Sea Green</option>
				<option value="LightSkyBlue">Light Sky Blue</option>
				<option value="LightSlateGray">Light Slate Gray</option>
				<option value="LightSteelBlue">Light Steel Blue</option>
				<option value="LightYellow">Light Yellow</option>
				<option value="Lime">Lime</option>
				<option value="LimeGreen">Lime Green</option>
				<option value="Linen">Linen</option>
				<option value="Magenta">Magenta</option>
				<option value="Maroon">Maroon</option>
				<option value="MediumAquaMarine">Medium Aqua Marine</option>
				<option value="MediumBlue">Medium Blue</option>
				<option value="MediumOrchid">Medium Orchid</option>
				<option value="MediumPurple">Medium Purple</option>
				<option value="MediumSeaGreen">Medium Sea Green</option>
				<option value="MediumSlateBlue">Medium Slate Blue</option>
				<option value="MediumSpringGreen">Medium Spring Green</option>
				<option value="MediumTurquoise">Medium Turquoise</option>
				<option value="MediumVioletRed">Medium VioletRed</option>
				<option value="MidnightBlue">Midnight Blue</option>
				<option value="MintCream">Mint Cream</option>
				<option value="MistyRose">Misty Rose</option>
				<option value="Moccasin">Moccasin</option>
				<option value="NavajoWhite">Navajo White</option>
				<option value="Navy">Navy</option>
				<option value="OldLace">Old Lace</option>
				<option value="Olive">Olive</option>
				<option value="OliveDrab">Olive Drab</option>
				<option value="Orange">Orange</option>
				<option value="OrangeRed">Orange Red</option>
				<option value="Orchid">Orchid</option>
				<option value="PaleGoldenRod">Pale Golden Rod</option>
				<option value="PaleGreen">Pale Green</option>
				<option value="PaleTurquoise">Pale Turquoise</option>
				<option value="PaleVioletRed">Pale Violet Red</option>
				<option value="PapayaWhip">Papaya Whip</option>
				<option value="PeachPuff">Peach Puff</option>
				<option value="Peru">Peru</option>
				<option value="Pink">Pink</option>
				<option value="Plum">Plum</option>
				<option value="PowderBlue">Powder Blue</option>
				<option value="Purple">Purple</option>
				<option value="RebeccaPurple">Rebecca Purple</option>
				<option value="Red">Red</option>
				<option value="RosyBrown">Rosy Brown</option>
				<option value="RoyalBlue">Royal Blue</option>
				<option value="SaddleBrown">Saddle Brown</option>
				<option value="Salmon">Salmon</option>
				<option value="SandyBrown">Sandy Brown</option>
				<option value="SeaGreen">Sea Green</option>
				<option value="SeaShell">Sea Shell</option>
				<option value="Sienna">Sienna</option>
				<option value="Silver">Silver</option>
				<option value="SkyBlue">Sky Blue</option>
				<option value="SlateBlue">Slate Blue</option>
				<option value="SlateGray">Slate Gray</option>
				<option value="Snow">Snow</option>
				<option value="SpringGreen">Spring Green</option>
				<option value="SteelBlue">Steel Blue</option>
				<option value="Tan">Tan</option>
				<option value="Teal">Teal</option>
				<option value="Thistle">Thistle</option>
				<option value="Tomato">Tomato</option>
				<option value="Transparent">Transparent</option>
				<option value="Turquoise">Turquoise</option>
				<option value="Violet">Violet</option>
				<option value="Wheat">Wheat</option>
				<option value="White">White</option>
				<option value="WhiteSmoke">White Smoke</option>
				<option value="Yellow">Yellow</option>
				<option value="YellowGreen">Yellow Green</option>
			</select><label for="inputFontColor">Skriftfarve</label><br>
		</div>
		<div class="buttons">
			<input class="close" onclick="document.querySelectorAll('#modal-<?php echo purify($modalId); ?> div.close')[0].click();" type="button" value="Luk"><input type="submit" value="Tilføj">
		</div>
	</form>
	<?php
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$latency = ($endTime - $startTime);
		$finished = 0;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
}
else{
	if(getSystemConfigurations('logSystemStorages') == 1 || getSystemConfigurations('logSystemStorages') == -1){
		$type = 'view';
		$trigger_systemUsers_id = $_SESSION['systemUsers_id'];
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		$startTime = $systemEvents_addEvent_startTime;
		$endTime = microtime(true);
		$latency = ($endTime - $startTime);
		$finished = 0;
		$host = $_SERVER['SERVER_NAME'];
		$httpVersion = $_SERVER['SERVER_PROTOCOL'];
		$instanceId = session_id();
		$method = $_SERVER['REQUEST_METHOD'];
		$status = $validateFlag;
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$version = date('YmdHisu', filemtime(__FILE__));
		$postData = json_encode($_POST);
		$getData = json_encode($_GET);
		$httpsEnabled = $_SERVER['HTTPS'];
		$fileName = $_SERVER['SCRIPT_FILENAME'];
		$devices_id = null;
		$exports_id = null;
		$filesContent_id = null;
		$filesMetaData_id = null;
		$identities_id = null;
		$meetings_id = null;
		$policies_id = null;
		$processingActivities_id = null;
		$processingActivitiesLegalBasises_id = null;
		$progressTime_id = null;
		$pseudoNames_id = null;
		$sessions_id = null;
		$systemConfigurations_id = null;
		$systemEvents_id = null;
		$systemNotifications_id = null;
		$systemStorages_id = null;
		$systemUsers_id = null;
		$systemUsersSystemPreferences_id = null;
		$tableVersions_id = null;
		$tags_id = null;
		$tagsReferences_id = null;
		
		addSystemEvent(
			$trigger_systemUsers_id,
			$type,
			$ipAddress,
			$startTime,
			$endTime,
			$finished,
			$host,
			$httpVersion,
			$instanceId,
			$method,
			$status,
			$userAgent,
			$version,
			$postData,
			$getData,
			$httpsEnabled,
			$fileName,
			$devices_id,
			$exports_id,
			$filesContent_id,
			$filesMetaData_id,
			$identities_id,
			$meetings_id,
			$policies_id,
			$processingActivities_id,
			$processingActivitiesLegalBasises_id,
			$progressTime_id,
			$pseudoNames_id,
			$sessions_id,
			$systemConfigurations_id,
			$systemEvents_id,
			$systemNotifications_id,
			$systemStorages_id,
			$systemUsers_id,
			$systemUsersSystemPreferences_id,
			$tableVersions_id,
			$tags_id,
			$tagsReferences_id
		);
	}
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>