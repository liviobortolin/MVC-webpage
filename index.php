<?php if (!isset($_SESSION)){session_start();}?>
<?php
$info = "";
if (empty($_SESSION['forminfo'])){
  $info = "";
}else{
  $info = $_SESSION['forminfo'];
  $_SESSION['forminfo'] = "";
}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Livio Bortolin</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="control/js/jquery.min.js"></script>
		<script src="control/js/skel.min.js"></script>
		<script src="control/js/skel-layers.min.js"></script>
		<script src="control/js/init.js"></script>

		<!-- Favicons -->
		<link href="view/images/logo.ico" rel="icon">
  		<link href="view/images/apple-touch-icon.png" rel="apple-touch-icon">
		
			<link rel="stylesheet" href="view/css/skel.css" />
			<link rel="stylesheet" href="view/css/style.css" />
			<link rel="stylesheet" href="view/css/style-xlarge.css" />
			<link rel="stylesheet" href="view/css/anmeldung.css" />

	</head>
	<body id="top">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="#">lbo</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<?php if(isset($_SESSION['email'])): ?>
							<li><a href="control/abmeldung.php">logout</a></li>
						<?php else:?>
							<li><a href="login.php">login</a></li>
						<?php endif; ?>						
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h2>Bortolin Brother</h2>
					<p>a page to get to our personal pages</a></p>
					<ul class="actions">
							<li><a href="http://livio.bortol.in/" class="button big alt">Livio Bortolin</a></li>	
						<li><a href="http://michele.bortol.in/" class="button big alt">Michele Bortolin</a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<header class="major">
					<h2>Wellcome to our Page</h2>
					<p>We Do Not Take Any Credits For Design Aspects</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="4u">
							<section class="special box">
								<i class="icon fa-area-chart major"></i>
								<h3>Hobby</h3>
								<p>Skiing the mountains is a major hobby of mine.</p>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								<i class="icon fa-refresh major"></i>
								<h3>Work</h3>
								<p>Working in the IT buisness is something I very like.</p>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								<i class="icon fa-cog major"></i>
								<h3>Family</h3>
								<p>Family and friends are one of the most important things in life.</p>
							</section>
						</div>
					</div>
				</div>
			</section>
			
		<!-- Two -->
			<section id="two" class="wrapper style2">
				<header class="major">
					<h2>happiness equals reality minus expectations</h2>
					<p>~Elon Musk</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="6u">
							<section class="special">
								<a href="https://trapsoul.com/" class="image fit"><img src="view/images/pic01.jpg" alt="" /></a>
								<h3>we wake up when the sun goes down</h3>
								<p>you cant awaken someone who is pretending to sleep</p>
							</section>
						</div>
						<div class="6u">
							<section class="special">
								<a class="image fit"><img src="view/images/pic02.jpg" alt="" /></a>
								<h3>low life</h3>
								<p>put the work IN until it works OUT</p>
								</section>
						</div>
					</div>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper style1">
				<div class="container">
					<div class="row">
						<div class="8u">
							<section>
								<h2>Mountains</h2>
								<a class="image fit"><img src="view/images/pic03.jpg" alt="" /></a>
								<p>A mountain is an elevated portion of the Earth's crust, generally with steep sides that show significant exposed bedrock. A mountain differs from a plateau in having a limited summit area, and is larger than a hill, typically rising at least 300 metres (1000 feet) above the surrounding land. A few mountains are isolated summits, but most occur in mountain ranges.</p>
							</section>
						</div>
						<div class="4u">
							<section>
								<h3>Definition</h3>
								<p>There is no universally accepted definition of a mountain. Elevation, volume, relief, steepness, spacing and continuity have been used as criteria for defining a mountain.</p>
								</section>
							<hr />
							<section>
								<h3>Best Snowparks In The World</h3>
								<ul class="alt">
									<li><a href="https://www.flimslaax.com/freestyle-ski">Laax, Switzerland</a></li>
									<li><a href="http://snowpark.seiseralm.it/de/snowpark.html#:~:text=Der%20Snowpark%20Seiser%20Alm%20geh%C3%B6rt,Rails%20(%C3%BCber%2070%20Strukturen).">Seiser Alm, Italy</a></li>
									<li><a href="https://www.absolutpark.com/de/">Absolut Park, Austria</a></li>
									<li><a href="https://www.ruka.fi/en/ruka-park">Ruka, Finnland</a></li>
								</ul>
							</section>
						</div>
					</div>
				</div>
			</section>			
			</section><!-- End Shop Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(view/images/contact-overlay-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row">
                  <div class="col-md-6">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        Send Mail
                      </h5>
                    </div>
                    <div>
                      <form action="control/formmail.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Your Firstname" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Your Lastname" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                            <?php printf("<p>$info</p>") ?>
                          </div>
                        </div>
                          <div class="col-md-12 text-center">
                            <button type="submit" name="submit" value="Submit" class="button button-a button-big">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<div class="row double">
						<div class="6u">
							<div class="row collapse-at-2">
								<div class="6u">
									<h3>placeholder</h3>
									<ul class="alt">
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
									</ul>
								</div>
								<div class="6u">
									<h3>placeholder</h3>
									<ul class="alt">
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
										<li><a href="#">-</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="6u">
							<h2>Follow My Socials Down Below:</h2>
							<ul class="icons">
								<li><a href="https://www.instagram.com/the.livio" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
								<li><a href="https://www.linkedin.com/in/livio-bortolin-b62b8518a/" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
							</ul>
						</div>
					</div>
					<ul class="copyright">
						<li>&copy; All rights reserved.</li>
						<li>Main page: <a href="http://bortol.in">Bortol.in</a></li>
						<li>contact us: <a href="http://bortol.in/login.php">Bortolin group</a></li>
					</ul>
				</div>
			</footer>

	</body>
</html>