<?php 
/* Template Name: Location Template */
get_header();
?>
<script>
// cache collection of elements so only one dom search needed
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

 
</script>
<style>
.sel {
    color:white;
    /*width: 250px;
    min-height: 40px;*/
    box-sizing: border-box;
    /*background-color: #55E6FA;*/
    overflow: hidden;
}
.txt {
    padding: 10px;
}
.selected {
    background-color: #f9f9f9;
}
.hide {
    display: none;
}
.sel .options {
    /*width: 250px;*/
    /*background-color: #66f7FB;*/
	position: absolute;
}
.sel .options div {
    transition: all 0.2s ease-out;
/*    padding: 10px;*/
}
.sel .options div:hover {
    background-color: #f7f7f7;
}
.show {
  display: block;
}
	.gm-style .gm-style-iw-c{
		     border-radius: 0px; 
     padding: 0px;
		border:1px solid #edeeef
	}
</style>
<?php
 
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
		 
		the_content() ;
		
	 endwhile; // End of the loop.
endif; // End of the if.
 

get_footer();