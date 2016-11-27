<!DOCTYPE html>
<html lang="en" class="HomePageBody">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Capex</title>
<script src="<?=$data["header"]["public"]?>js/web/jquery-3.1.1.min.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/jquery-ui.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/jquery.ui.touch-punch.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/materialize.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/scripts.js"></script>

<link href="http://www.twins.ho.ua/credit/css/jquery-ui.min.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/materialize.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/bootstrap.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/style.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/custom_res.css" rel="stylesheet" />
</head>
<body id="CapexBody">
<?=$data['updatePassword']?>
<?=$data['loaneModel']?>
<?=$data['questionModel']?>
<?=$data['aboutModel']?>
<?=$data['headerModel']?>

<?php 
if($data["getStatements"][0]["loan_finished"]==2){
	?>
	<section id="ScrollingPage" style="margin-top:100px;">
	<div class="ScrollingHeaderDiv">
		<div class="ScrollingHeader">
			<div class="position:relative">
				<div style="max-width:700px; margin:0 auto; padding: 20px;">
					<div class="circle opacity"></div>	
					<div class="container_range">
						<div class="ScrollingTitle">რამდენის სესხება გსურთ?</div>
						<div id="line1">
							<div class="lineInner1"></div>
						</div>
						<div class="ScrollingTitle">რამდენის სესხება გსურთ?</div>
						<div id="line2">
							<div class="lineInner2"></div>
						</div>
						<div class="result">
							<input type="hidden" name="loanMoney2" id="loanMoney2" value="300" />
							<input type="hidden" name="loanMonth2" id="loanMonth2" value="3" />
							<span class="money"><label>300</label>l</span>
							<span class="month"><label>3</label> თვით</span>
							<span class="procent">თვეში <div><label>9</label><strong>l</strong></div></span>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div> 
	<div class="container ScrollingButtonDiv">
		<a class="ScrollIngButton waves-effect waves-teal" href="javascript:void(0)" onclick="reGetMoney()">ფულის მიღება</a>
	</div>	
</section>

 <section id="ContactPage" class=""><!--height100-->
	<div class="ContactHeaderDiv">
		<div class="ContactHeader">
			<div class="Title1">გაქვთ კითხვები? დაგვიკავშირდით</div>
			<div class="ContactTel"><?=$data['contactNumber']?></div>
			<div class="Title1">ან მოგვწერეთ</div>
			<div class="ContactMail"><?=$data['email']?></div>
		</div>
	</div>
	<div class="container ContactMapDiv">
		<div class="title">ჩვენი მისამართია</div>
		<div id="map"></div>
	</div>
</section>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt9-cvNNqWdw_li7Kn4-3XdFRxicO1S3w&callback=initMap"></script>  
<script type="text/javascript">
function initMap() {
    var uluru = {<?=$data['map']?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: uluru,
    });
    var image = Config.website + 'public/img/map.png';
    var marker = new google.maps.Marker({
      position: uluru,
      map: map,
      icon: image
    });
}
</script>
	<?php
}else{
?>
<section id="ControlRoom">
	<div class="container-fluid">
		<div class="col-sm-4 animated bounceInLeft">
			<div class="RoomSidebar">
				<div class="item UserItem"><?=$data['getStatements'][0]["name"]." ".$data['getStatements'][0]["surname"]?>  <span><?=$data['getStatements'][0]["personal_number"]?></span></div>
				<?php
			    if($data["getStatements"][0]["loan_status"]==2)
			    {
			    ?>
					<div class="item loansitem">სულ სესხი <span>N/A</span></div>
					<div class="item loansitem2">ყოველთვიური გადასახადი <span>N/A</span></div>
					<div class="item dateicon">ბოლო გადახდის თარიღი <span><?=date("d/m/Y")?></span></div>
				<?php 
				}else{
					?>	
					<div class="item loansitem">სულ სესხი <span>N/A</span></div>
					<div class="item loansitem2">ყოველთვიური გადასახადი <span>N/A</span></div>
					<div class="item dateicon">ბოლო გადახდის თარიღი <span>N/A</span></div>
					<?php
				}
				?>
				<div class="item editicon">პროფილის რედაქტირება <a href="#ApplicationModal" class="OpenModalClick">რედაქტირება</a></div>
				<div class="item passicon">პაროლის განახლება <a href="#updatePasswordBox" class="OpenModalClick">განახლება</a></div>
			</div>
			
		</div>
		<div class="col-sm-8  animated bounceInRight">
			<div class="ControlRoomContent">
				<?php
				// echo "<pre>";
				// print_r($data['service']);
				// echo "</pre>";
				?>
				<table class="bordered CapexTable">
			        <thead>
			          <tr>
			              <th>გადახდის თარიღი</th>
			              <th>ძირითადი თანხა</th>
			              <th>პროცენტი</th>
			              <th>სრული თანხა</th>
			          </tr>
			        </thead>

			        <tbody>
			        	<?php
			        	if($data["getStatements"][0]["loan_status"]==2)
			        	{ // get loan GRAFIKI
			        		foreach ($data['service']['Data'] as $value) {

			        			$http = "https://webapi.smartfin.ge/mcl/index.php?userid=".$data['getStatements'][0]["personal_number"]."&userauth=".$data['getStatements'][0]["password"]."&page=loandetails&loanid=".$value['LoanID'];
			        			$file_get_content = trim(file_get_contents($http), "\xEF\xBB\xBF");
								$details = json_decode($file_get_content, true); 

			        			?>

								<tr>
									<td><?=$details["Data"][0]['NextScheduleDateText']?></td>
									<td><?=$details["Data"][0]['OSBalance']?> <span><?=$details["Data"][0]['CCY']?></span></td>
									<td><?=$details["Data"][0]["InterestRateTA"]?></td>
									<td><?=$details["Data"][0]["LoanAmount"]?> <span><?=$value['CCY']?></span></td>
								</tr>

			        			<?php
			        		}
				        	?>
							<!-- <tr class="active">
					            <td>01.04.2016</td>
					            <td>1340 <span>ლარი</span><label>l</label></td>
					            <td>380 <span>ლარი</span><label>l</label></td>
					            <td>700.90 <span>ლარი</span><label>l</label></td>
					        </tr> -->
				        	<?php
			        	}else{
			        		?>
			        		<tr>
					            <td colspan="4">მიმდინარეობს თქვენი განაცხადის განხილვა !</td>
					        </tr>
			        		<?php
			        	}
			        	?>			          
			        </tbody>
			    </table>		
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$("#contactLink").css("display","none");
</script>
<?php 
}
?>


</body>
</html>    

