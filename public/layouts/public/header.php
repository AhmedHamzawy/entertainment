<html>
  <head>
    <title>Entertainment</title>
    <link href="stylesheets/reset.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/grid.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/rs.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/slide.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/search.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/tabbed-panels.css" media="all" rel="stylesheet" type="text/css" />
    <link href="stylesheets/accordion.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
     <script>
	 $(document).ready(function(e) {
        
    
	  $(document).scroll(function () {
	  if ($(document).scrollTop() >= 150) {
	   $('nav').addClass('fixed-menu');
	   $('.headerlogo').css('display','inline');
	  if ($(document).width() > 1100) { 
       $('.socialsearch').css('display','block');
	   $('.headerlogo').css('display','block');
	   $('.subjects.public').css('text-align','left');
	  }
    	}else{	
	   $('nav').removeClass('fixed-menu');	
	   $('.socialsearch').css('display','none');
	   $('.headerlogo').css('display','none');
	   $('.subjects.public').css('text-align','center');
		}
  		});
		
		});
	  </script>
  </head>
  <body>
    <header id="header">
      <a href="index.php"><h1 class="logo grid-2">Entertainment</h1></a>
      <img src="images/icons/ads/lost.jpg" class="grid-3"/>
      
      <nav class="menu">
      <a href="index.php"><h2 class="headerlogo">Entertainment</h2></a>
      <?php
    	  // A Navigation
		Pages::find_selected_page(true,true);
    	echo Navigation::navigation_public($subjects = '' ,$pages = '') ;
	  ?>
      <div class="socialsearch">
      		
            <!-- search form -->
            <form class="search-form" action="">
                <input type="text" placeholder="placeholder" name="search" class="search-text"/>
            </form>
            
            <!-- social media icons -->
            <a href="#"><img src="images/icons/headerone/facebook-48.png" alt="fb" /></a>
            <a href="#"><img src="images/icons/headerone/youtube-48.png" alt="youtube"  /></a>
            <a href="#"><img src="images/icons/headerone/twitter-48.png" alt="twitter" /></a>
            <a href="#"><img src="images/icons/headerone/instagram-48.png" alt="instgram"  /></a>
            <a href="#"><img src="images/icons/headerone/googleplus-48.png" alt="G+"  /></a>

       </div>
      </nav>
      
      
    </header>
    
	<div class="clear"></div>
