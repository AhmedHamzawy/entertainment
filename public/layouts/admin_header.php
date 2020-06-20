<html>
  <head>
    <title>Entertainment Admin Panel</title>
    <link href="../stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/reset.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
	  <script>
      tinymce.init({
        selector: '#mytextarea',
		theme: 'modern',
		width: 450,
		height: 200,
		plugins: [
		  'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor code'
		],
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | 		        bullist numlist outdent indent | link image | print preview media fullpage | code |forecolor backcolor emoticons'
      });
      </script>
  </head>
  <body class="adminpanel">
    <div id="header">
      <h1 style="text-align:center; font-size:3.5em;">Entertainment Admin Panel</h1>
    </div>
    <div id="main">
