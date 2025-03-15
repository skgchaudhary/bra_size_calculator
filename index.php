<?php
	include("api/bootstrap.php");
	include("api/jquery.php");
	include("api/meta.php");
	include("api/font.php");
	include("css/div.php");
	include("css/modal.php");
	include("css/fields.php");
	include("css/img.php");	
?>
<div class="row formparent">
	<div class="col-lg-3">
	</div>
	<div class="col-lg-6 form">
		<p class="center" id="underbustdiv">
			<span class="input1">My Underbust is </span><br>
			<select id="underbust" class="select1" onchange="updateOverBust()" onblur="updateOverBust()">
			</select>
			<span class="input1">inch</span>
			<span class="small1"> (rounded off)</span>
			<span class="glyphicon glyphicon-question-sign" onclick="showImg('img/underbust.jpg')"></span>
		</p>
		<p class="center" id="overbustdiv">
			<span class="input1">My Overbust is </span><br>
			<select id="overbust" class="select1">
			</select>
			<span class="input1">inch</span>
			<span class="small1"> (rounded off)</span>
			<span class="glyphicon glyphicon-question-sign" onclick="showImg('img/overbust.jpg')"></span>
		</p>
		<p class="center" >
			<span class="input1">My Breast Type is </span><br>
			<select id="breasttype" class="select2">
				<option value="eastwest">East West</option>
				<option value="atheletic">Atheletic</option>
				<option value="relaxed">Relaxed</option>
				<option value="teardrop">Tear Drop</option>
				<option value="wideset">Wide Set</option>
				<option value="asymmetrical">Asymmetrical</option>
			</select>
			<span class="glyphicon glyphicon-question-sign" onclick="showBreastTypeImg()"></span>
		</p>
		<p class="center">
			<button type="button" class="button1" onclick="getBraSize();">Get My Bra</button>
		</p>
	</div>
	<div class="col-lg-3">
	</div>
</div>
<div id="myModal" class="modal">
	<div class="modal-content center" id="modaldisplay">		
	</div>
</div>
<script>
	var modal = document.getElementById('myModal');	
	function openModal() {
		modal.style.display = "block";
	}
	function closeModal() {
		modal.style.display = "none";
		document.getElementById("modaldisplay").innerHTML = "";
	}
	document.onclick = function(event) {
		if (event.target == modal) {
			closeModal();
		}
	}
</script>
<script>
	var remark = "";
	function showImg(imgurl) {
		openModal();
		document.getElementById('modaldisplay').innerHTML = "<img src=\"" + imgurl + "\" class=\"doc\" />";
	}
	function showBreastTypeImg() {
		openModal();
		breasttype = document.getElementById("breasttype").value;
		switch(breasttype) {
			case "eastwest":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/eastwest.jpg\" class=\"doc\" /></p><span class=\"input1\">East West</span>";
				break;
			case "atheletic":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/atheletic.jpg\" class=\"doc\" /></p><span class=\"input1\">Atheletic</span>";
				break;
			case "relaxed":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/relaxed.jpg\" class=\"doc\" /></p><span class=\"input1\">Relaxed</span>";
				break;
			case "teardrop":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/teardrop.jpg\" class=\"doc\" /></p><span class=\"input1\">Tear Drop</span>";
				break;
			case "wideset":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/wideset.jpg\" class=\"doc\" /></p><span class=\"input1\">Wideset</span>";
				break;
			case "asymmetrical":
				document.getElementById("modaldisplay").innerHTML = "<p><img src=\"img/asymmetrical.jpg\" class=\"doc\" /></p><span class=\"input1\">Asymmetrical</span>";
				break;
			default:
				document.getElementById("modaldisplay").innerHTML = "";
		} 
	}
	function hideImg(imgdiv) {
		document.getElementById(imgdiv).innerHTML = "";
	}
	function populateBustList() {
		var select = document.getElementById("underbust");
		for(var i = 26; i <= 44; i++) {
			var option = document.createElement("option");
			option.text = i;
			option.value = i;
			if(i == 30) {
				option.selected = true;
			}
			select.add(option);
		}
		updateOverBust();
	}
	function updateOverBust() {
		var select = document.getElementById("overbust");
		if(select.options.length > 0) {
			var length = select.options.length;
			for(var i = (length - 1); i >= 0; i--) {
				select.options[i] = null;
			}
		}
		var underbustvalue = document.getElementById("underbust").value;
		for(var i = (Number(underbustvalue) + 1); i <= 50; i++) {
			var option = document.createElement("option");
			option.text = i;
			option.value = i;
			select.add(option);
		}
	}
	window.onload = function() {
		populateBustList();
	};
	function getBandSize() {
		var underbust = Number(document.getElementById("underbust").value);
		if(underbust % 2 == 0) {
			return underbust + 4;
		} else {
			return underbust + 5;
		}
	}
	function getCupSize() {
		var overbust = Number(document.getElementById("overbust").value);
		var underbust = Number(document.getElementById("underbust").value);
		var diff = overbust - underbust;
		var cup;
		switch(diff) {
			case 1:
				cup = 'A';
				break;
			case 2:
				cup = 'B';
				break;
			case 3:
				cup = 'C';
				break;
			case 4:
				cup = 'D';
				break;
			case 5:
				cup = 'E';
				break;
			case 6:
				cup = 'F';
				break;
			default:
				cup = 'F';
		}
		return cup;
	}
	function getBraType() {
		remark = "";
		breasttype = document.getElementById("breasttype").value;
		switch(breasttype) {
			case "eastwest":
				return "Balconette";
				break;
			case "atheletic":
				return "Plunge,3/4 Coverage,Push Up,Bralette";
				break;
			case "relaxed":
				return "Balconette,3/4 Coverage,Full Coverage,Push Up";
				break;
			case "teardrop":
				return "Balconette,3/4 Coverage,Full Coverage,Bralette,Push Up";
				break;
			case "wideset":
				return "T-Shirt,Plunge,3/4 Coverage,Full Coverage,Push Up";
				break;
			case "asymmetrical":
				remark = "Bra must have removable padding. Use pad only on the smaller bust.";
				return "Plunge,3/4 Coverage,Full Coverage,Push Up";
				break;
			default:
				return "default";
		}
	}
	function getBraSize() {
		openModal();
		document.getElementById("modaldisplay").innerHTML = "<p class=\"center\"><span class=\"input1\">Your best bra size is </span><span class=\"result\">" + getBandSize() + getCupSize() + "</span></p>"; 
		var bratype = getBraType();
		if(bratype != "") {
			var bratypearr = bratype.split(",");
			if(bratypearr.length > 1) {
				document.getElementById("modaldisplay").innerHTML += "<p class=\"center\"><span class=\"input1\">Following types of bra are suggested for you:</span></p>";
			} else {
				document.getElementById("modaldisplay").innerHTML += "<p class=\"center\"><span class=\"input1\">Following type of bra is suggested for you:</span></p>";
			}			
			for(var i = 0; i < bratypearr.length; i++) {
				document.getElementById("modaldisplay").innerHTML += "<p class=\"center\"><span class=\"result\">" + bratypearr[i] + "</span></p>";
			}
		}		
	}
</script>