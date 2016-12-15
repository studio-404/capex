<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin Panel</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?=$data["header"]["public"]?>css/materialize.css" type="text/css" rel="stylesheet" />
	<link href="<?=$data["header"]["public"]?>css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
	<link href="<?=$data["header"]["public"]?>css/manager-style.css" type="text/css" rel="stylesheet" />
	<script src="<?=$data["header"]["public"]?>js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=$data["header"]["public"]?>js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=$data["header"]["public"]?>js/materialize.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=$data["header"]["public"]?>js/tinymce/tinymce.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=$data["header"]["public"]?>js/manager-scripts.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<!-- MOdals START -->
	<div id="modal1" class="materialize modal">
		<div class="modal-content">
		</div>
		<div class="modal-footer">
		</div>
	</div>
<!-- MOdals END-->

	<section class="materialize mainContainer">

		<nav>
			<div class="nav-wrapper">
				<?=$data['nav']?>
			</div>
		</nav>

		<section class="body">
			<div class="input-field margin-bottom-20">
				<input id="personalID" type="text" class="validate">
				<label for="personalID">პირადი ნომერი</label>
				<a class="waves-effect waves-light btn" onclick="searchStatement($('#personalID').val())"><i class="material-icons left">search</i>ძებნა</a>
			</div>

			<table class="highlight">
				<thead>
					<tr>
						<th data-field="id">ს.კ</th>
						<th data-field="date">თარღი</th>
						<th data-field="name">სახელი გვარი</th>
						<th data-field="pid">პირადი ნომერი</th>
						<th data-field="action">მოქმედება</th>
					</tr>
				</thead>

				<tbody>
					<?=$data['theStatements']?>					
				</tbody>
			</table>

			<?php 
			if(count($data['statements'])) : 
					$total = $data['statements'][0]['counted']; 
					$itemPerPage = $data['itemPerPage']; 
					$pagination = $data['pagination'];
					echo $pagination->index($total, $itemPerPage);
			endif;
			?>
			
		</section>

		<footer class="page-footer">
          <div class="container width-100-pr-20">
            <div class="row">
              <div class="col l6 s12">
                <h5>ადმინისტრირების პანელი</h5>
                <p class="text-lighten-4">v1.0.1</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5>ბმულები</h5>
               	<?=$data['footerNav']?>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container width-100-pr-20">
            <span class="black-text">© 2016 ყველა უფლება დაცულია !</span>
            <!-- <a class="black-text right" href="http://ww.404.ge" target="_blank">სტუდია 404</a> -->
            </div>
          </div>
        </footer>


	</section>
</body>
</html>