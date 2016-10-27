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
	<section class="mainContainer">

		<nav>
			<div class="nav-wrapper">
				<?=$data['nav']?>
			</div>
		</nav>

		<section class="body">
			<div class="input-field margin-bottom-20">
				<input id="icon_prefix" type="text" class="validate">
				<label for="icon_prefix">პირადი ნომერი</label>
				<a class="waves-effect waves-light btn"><i class="material-icons left">search</i>ძებნა</a>
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
					<tr>
						<td>1</td>
						<td><a href="">27/10/2016 20:22:01</a></td>
						<td><a href="">გიორგი გვაზავა</a></td>
						<td><a href="">01027034324</a></td>
						<td>
							<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="სრულად ნახვა">pageview</i></a>

							<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td><a href="">27/10/2016 20:22:00</a></td>
						<td><a href="">გიორგი გვაზავა</a></td>
						<td><a href="">01027034324</a></td>
						<td>
							<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="სრულად ნახვა">pageview</i></a>

							<a href=""><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="წაშლა">delete</i></a>
						</td>
					</tr>
					
				</tbody>
			</table>

			<ul class="pagination margin-top-40">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
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