<!DOCTYPE html>
<html lang="en" class="HomePageBody">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Capital Express
</title>
<script src="<?=$data["header"]["public"]?>js/web/jquery-3.1.1.min.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/jquery-ui.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/jquery.ui.touch-punch.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/materialize.js"></script>
<script src="<?=$data["header"]["public"]?>js/web/scripts.js"></script>

<link href="http://www.twins.ho.ua/credit/css/jquery-ui.min.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/materialize.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/bootstrap.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/animate.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/style.css" rel="stylesheet" />
<link href="<?=$data["header"]["public"]?>css/web/custom_res.css" rel="stylesheet" />
</head>
<body id="CapexBody">
<?=$data['authModel']?>
<?=$data['recoverModel']?>
<?=$data['loanModel']?>
<?=$data['questionModel']?>
<?=$data['aboutModel']?>
<?=$data['headerModel']?>
<?=$data['homepageModel']?>

<section id="ScrollingPage">
	<div class="ScrollingHeaderDiv">
		<div class="ScrollingHeader">
			<div class="position:relative">
				<div style="max-width:700px; margin:0 auto;">
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
		<a class="ScrollIngButton waves-effect waves-teal OpenModalClick" href="#ApplicationModal">ფულის მიღება</a>
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

</body>
</html>    

