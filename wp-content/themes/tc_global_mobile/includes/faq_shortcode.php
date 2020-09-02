<?php

// hook - display faq
function get_faq_display($atts) {

$faq_category = $atts['category_id'];
// Get the taxonomy's terms
$terms = get_terms(
    array(
        'taxonomy'   => 'ufaq-category',
        'hide_empty' => false,
		'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
        'include' => array(6,9,172,173,174),
    )
);

// Check if any term exists
$displayCategoryName = '';
if ( ! empty( $terms ) && is_array( $terms ) ) {
    // Run a loop and print them all term_id slug
	$j = 1;
    foreach ( $terms as $term ) {
		if($j==1){
			$cssheadingvalue = 'active';
		}
		else
		{
			$cssheadingvalue = '';
		}
      $displayCategoryName .= '<div><a class="nav-link '.$cssheadingvalue.'" id="v-pills-'.$term->slug.'-'.$term->term_id.'-tab" data-toggle="pill" href="#v-pills-'.$term->slug.'-'.$term->term_id.'" role="tab" aria-controls="v-pills-global" aria-selected="false">'.$term->name.'</a></div>';
	  $j++;
    }
}

$faqsearch = '';
if($_REQUEST['faqsearch']!='')
{
	$faqsearch = $_REQUEST['faqsearch'];

}

$displayFaqContent ='';
$i = 0;
$cssvalue = '';
 foreach ( $terms as $term ) {
$faq_query = new WP_Query(array(
            'post_type' => 'ufaq',
            'order' => 'DESC',
			's' => $faqsearch,
'tax_query' => array(
array(
'taxonomy' => 'ufaq-category',   // taxonomy name
'terms' => $term->term_id,                  // term id, term slug or term name
)
)
        ));

if($faq_query->have_posts()) :
	$k = 1;
	$searchForm  = '';
	if($i==0){
				$cssvalue = 'show active';
				$i++;
			}
			else
			{
				$cssvalue = '';
			}
	$count = $faq_query->post_count;
	while ($faq_query->have_posts()) :
			$faq_query->the_post();



			if($k==1)
			{

					//$searchForm = '<form role="search" method="get" id="searchform" action="'.home_url( '/' ).'/our-solutions"><div class="input-group"><input type="text" name="faqsearch" class="form-control" placeholder="Search" value="'.$faqsearch.'" /><input type="hidden" name="categoryId" value="'.$term->term_id.'"><div class="input-group-append"><span class="input-group-text" id="basic-addon2"><input type="image" src="'.get_template_directory_uri().'/images/search-icon.png" class="img-fluid" value="Search" /></span></form></div>';
					$searchForm = '</div>';

					$displayFaqContent .= '<div class="tab-pane fade '.$cssvalue.'" id="v-pills-'.$term->slug.'-'.$term->term_id.'" role="tabpanel" aria-labelledby="v-pills-'.$term->slug.'-'.$term->term_id.'-tab"><div class="row justify-content-center"><div class="col-sm-8">'.$searchForm.'</div><div class="accordion" id="accordionExample">';
			}


 			$displayFaqContent .= '<div class="card"><div class="card-header" id="heading-'.$term->slug.'-'.$term->term_id.'-'.get_the_ID().'"><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-'.$term->slug.'-'.$term->term_id.'-'.get_the_ID().'" aria-expanded="false" aria-controls="collapse-'.$term->slug.'-'.$term->term_id.'-'.get_the_ID().'">'.get_the_title().' <img src="'.get_template_directory_uri().'/images/accordion-arrow.png" /></button></div><div id="collapse-'.$term->slug.'-'.$term->term_id.'-'.get_the_ID().'" class="collapse" aria-labelledby="heading-'.$term->slug.'-'.$term->term_id.'-'.get_the_ID().'" data-parent="#accordionExample"><div class="card-body">'.get_the_content().' </div></div>	  </div>';

			if($k==$count){

				$helpcenterlink = get_term_meta( $term->term_id, 'faq_help_centre_link', true );
				$displayFaqContent .= '</div><div class="row"><div class="col-sm-12"><h4><span class="d-block">Didn\'t find the answer?</span>Explore our Help Center</h4> </div><div class="col-sm-12"><button type="button" class="btn btn-theme"><a class="text-white" href="'.$helpcenterlink.'" target="_blank">help center</a><img src="'.get_template_directory_uri().'/images/whiteforward.png" /></button></div></div></div>	 ';
			}

			$k++;

	endwhile;
	else :
		if($i==0){
			$cssvalue = 'show active';
			$i++;
		}
		else
		{
			$cssvalue = '';
		}

		/*$displayFaqContent .= '<div class="tab-pane fade '.$cssvalue.'" id="v-pills-'.$term->slug.'-'.$term->term_id.'" role="tabpanel" aria-labelledby="id="v-pills-'.$term->slug.'-'.$term->term_id.'-tab""><div class="row justify-content-center"><div class="col-sm-8">
<form role="search" method="get" id="searchform" action="'.home_url( '/' ).'/our-solutions"><div class="input-group"><input type="text" name="faqsearch" class="form-control" placeholder="Search" value="'.$faqsearch.'" /><input type="hidden" name="categoryId" value="'.$term->term_id.'">
<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><input type="image" src="'.get_template_directory_uri().'/images/search-icon.png" class="img-fluid" value="Search" /></span></div></div></form><div class="accordion" id="accordionExample">Record not found</div><div class="row"><div class="col-sm-6"><h4><span class="d-block">Didn\'t find the answer?</span>Explore our Help Center</h4> </div>
<div class="col-sm-5"><button type="button" class="btn btn-theme">help center<img src="'.get_template_directory_uri().'/images/whiteforward.png" /></button></div></div></div>	</div></div>'; // no result
	endif; */

	$displayFaqContent .= '<div class="tab-pane fade '.$cssvalue.'" id="v-pills-'.$term->slug.'-'.$term->term_id.'" role="tabpanel" aria-labelledby="id="v-pills-'.$term->slug.'-'.$term->term_id.'-tab""><div class="row justify-content-center"><div class="col-sm-8">
<div class="accordion" id="accordionExample">Record not found</div><div class="row"><div class="col-sm-6"><h4><span class="d-block">Didn\'t find the answer?</span>Explore our Help Center</h4> </div>
<div class="col-sm-5"><button type="button" class="btn btn-theme">help center<img src="'.get_template_directory_uri().'/images/whiteforward.png" /></button></div></div></div>	</div></div>'; // no result
	endif;
}

/*$terms = '<div class="mobile-faq-verticaltab">
<div class="container-fluid">
<div class="row">
  <div class="col-3">
    <h2 class="mobile-main-heading">FAQ</h2>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      '.$displayCategoryName.'
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
       '.$displayFaqContent.'
    </div>
  </div>
</div>
</div>
</div>';*/

$terms = '<div class="mobile-faq-verticaltab">
<div class="container-fluid">
<h2 class="mobile-main-heading">FAQ</h2>
<form role="search" method="get" id="searchform" action="'.home_url( '/' ).'/our-solutions"><div class="input-group"><input type="text" name="faqsearch" class="form-control" placeholder="Search" value="'.$faqsearch.'" /><input type="hidden" name="categoryId" value="'.$term->term_id.'">
<div class="input-group-append"><span class="input-group-text" id="basic-addon2"><input type="image" src="'.get_template_directory_uri().'/images/search-icon.png" class="img-fluid" value="Search" /></span></div></div></form>

<div class="row">
    <div class="col-12 overflow-hidden">
    <div class="carousel-faqtab slider nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      '.$displayCategoryName.'
    </div>
    </div>
  </div>
  <div class="row">
    <div class="tab-content" id="v-pills-tabContent">
       '.$displayFaqContent.'
    </div>
  </div>

</div>
</div>';



  return $terms;
}
add_shortcode('faq_display', 'get_faq_display');
