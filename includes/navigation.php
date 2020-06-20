<?php


class Navigation extends DatabaseObject {
	
	public static function navigation_admin ($subject_array , $page_array){
        $output = "<ul class=\"subjects\">" ;
		$Subjects = Subjects::find_all(false);

        foreach( $Subjects as $Subject ) {
		        $output .= "<li ";
				if ( $subject_array && $Subject->id == $subject_array->id){
				 $output .= "class=\"selected\"";
				}
				 $output .= ">"; 
	             $output .= "<a href=\"manage_content.php?subject=";
				 $output .= urlencode($Subject->id);
				 $output .= "\">";
				 $output .= htmlentities($Subject->menu_name); 
				 $output .= "</a>";
                 $Pages = Pages::find_pages_for_subject($Subject->id , false);
                 $output .= "<ul class=\"pages\">";
                 foreach ( $Pages as $Page ) {
		         $output .= "<li ";
				 if ( $page_array && $Page->id == $page_array->id){
				 $output .= "class=\"selected\"";
				}
			      $output .= ">";
			      $output .= "<a href=\"manage_content.php?page=";
			      $output .= urlencode($Page->id);
				  $output .= "\">";
				  $output .= htmlentities($Page->menu_name); 
				  $output .= "</a></li>";
		       }
             // mysqli_free_result($querypage);
                $output .= "</ul></li>"; 
            
			   }
			   //  mysqli_free_result($querysubject);
            
                $output .= "</ul>";	
				return $output;
	
}
  public static function navigation_public ($subject_array , $page_array){
         $output = "<ul class=\"subjects public\">" ;
		$Subjects = Subjects::find_all(true);
        foreach( $Subjects as $Subject ) {
		        $output .= "<li ";
				if ( $subject_array && $Subject->id == $subject_array->id){
				 $output .= "class=\"selected\"";
				}
				 $output .= ">"; 
	             $output .= "<a href=\"index.php?subject=";
				 $output .= urlencode($Subject->id);
				 $output .= "\">";
				 $output .= htmlentities($Subject->menu_name); 
				 $output .= "</a>";
                 $Pages = Pages::find_pages_for_subject($Subject->id , true);
				 $photo = new photograph();
                 $output .= "<div class=\"pages public\">";
				 $i = 0;
                 foreach ( $Pages as $Page ) {
				 $photo->id = $Page->photo_id;
				 $photos = $photo->find_by_id($photo->id,true,false);
		         $output .= "<article";
				 if ( $page_array && $Page->id == $page_array->id){
				 $output .= "class=\"selected\"";
				}
			      $output .= ">";	 
				  $output .= "<img src=";
				  $output .= $photos->image_path();
				  $output .= " />";
			      $output .= "<a href=\"index.php?page=";
			      $output .= urlencode($Page->id);
				  $output .= "\">";
				  $output .= "<h2>";
				  $output .= htmlentities($Page->menu_name);
				  $output .= "</h2>"; 
				  $output .= "</a></article>";
				  ++$i;
				  if ($i==6){break;}
		       }
                $output .= "</div></li>"; 
            
		}
            
                $output .= "</ul>";
				 	
				return $output;
	
}

}