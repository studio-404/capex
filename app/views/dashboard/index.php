<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Admin Panel</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?=$data["header"]["public"]?>css/materialize.css" type="text/css" rel="stylesheet" />
	<link href="<?=$data["header"]["public"]?>css/manager-style.css" type="text/css" rel="stylesheet" />
	<script src="<?=$data["header"]["public"]?>js/jquery-3.1.1.min.js"></script>
	<script src="<?=$data["header"]["public"]?>js/materialize.min.js"></script>
	<script src="<?=$data["header"]["public"]?>js/manager-scripts.js"></script>
</head>
<body>
<!-- MOdals START -->
	<div id="modal1" class="modal">
		<div class="modal-content">
		</div>
		<div class="modal-footer">
		</div>
	</div>
<!-- MOdals END-->
	<section class="mainContainer">
		<nav>
			<div class="nav-wrapper">
				<?=$data['nav']?>
			</div>
		</nav>

		<section class="body">
			<a href="javascript:void(0)" onclick="add_page()" class="waves-effect waves-light btn margin-bottom-20"><i class="material-icons left">note_add</i>დამატება</a>
			<ul class="collapsible margin-top-0" data-collapsible="accordion">
				<li>
					<div class="collapsible-header active"><i class="material-icons">subject</i>მთავარი</div>
					<div class="collapsible-body">
						<table class="highlight">
							<thead>
								<tr>
									<th data-field="id">ს.კ</th>
									<th data-field="name">დასახელება</th>
									<th data-field="type">ტიპი</th>
									<th data-field="action">მოქმედება</th>
								</tr>
							</thead>

							<tbody>
							<?=$data['mainNavigation']?>
								<!-- <tr>
									<td>15</td>
									<td><a href="">კითხვა პასუხი</a></td>
									<td class="roboto-font">plugin</td>
									<td>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="გამოჩენა">visibility_off</i></a>

										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="რედაქტირება">mode_edit</i></a>


										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
									</td>
								</tr>
								<tr>
									<td>15</td>
									<td><a href="">ჩვენს შესახებ</a></td>
									<td class="roboto-font">text</td>
									<td>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="დამალვა">visibility</i></a>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="რედაქტირება">mode_edit</i></a>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
									</td>
								</tr>
								<tr>
									<td>15</td>
									<td><a href="">კონტაქტი</a></td>
									<td class="roboto-font">plugin</td>
									<td>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="გამოჩენა">visibility_off</i></a>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="რედაქტირება">mode_edit</i></a>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
									</td>
								</tr> -->
							</tbody>
						</table>

					</div>
				</li>
				<li>
				<div class="collapsible-header"><i class="material-icons">subject</i>დამატებითი</div>
				<div class="collapsible-body">
					
					<table class="highlight">
							<thead>
								<tr>
									<th data-field="id">ს.კ</th>
									<th data-field="name">დასახელება</th>
									<th data-field="type">ტიპი</th>
									<th data-field="action">მოქმედება</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>15</td>
									<td><a href="">სესხის მიღება</a></td>
									<td class="roboto-font">plugin</td>
									<td>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="გამოჩენა">visibility_off</i></a>

										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="რედაქტირება">mode_edit</i></a>


										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
									</td>
								</tr>
								<tr>
									<td>15</td>
									<td><a href="">მომხმარებლის გვერდი</a></td>
									<td class="roboto-font">plugin</td>
									<td>
										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="გამოჩენა">visibility_off</i></a>

										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="რედაქტირება">mode_edit</i></a>


										<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
									</td>
								</tr>
							</tbody>
						</table>


				</div>
				</li>
			</ul>


			
		</section>

		<footer class="page-footer">
          <div class="container width-100-pr-20">
            <div class="row">
              <div class="col l6 s12">
                <h5>ადმინისტრირების პანელი</h5>
                <p class="text-lighten-4">პანელი დამზადებულია სტუდია 404-ის მიერ</p>
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
            <a class="black-text right" href="http://ww.404.ge" target="_blank">სტუდია 404</a>
            </div>
          </div>
        </footer>

	</section>
</body>
</html>