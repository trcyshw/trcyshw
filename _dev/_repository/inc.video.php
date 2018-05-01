<section id="video"<?php if (function_exists('wpmd_is_device')){  if (wpmd_is_device()) { ?> class="device"<?php }}; ?>>

<img src="<?php bloginfo('template_directory'); ?>/img/banners/video.png" alt="Video Placeholder" />


 <div id="video-content">
 
 <div class="container">
 
 
 <h1 class="home"><?php if (function_exists('goop_seo_title')){ $seotitle = get_post_meta(get_the_ID(), 'the_seotitle', true); $oldseotitle = get_post_meta(get_the_ID(), 'wps_seotitle', true); if (!empty($seotitle)) { echo $seotitle; } elseif (!empty($oldseotitle) && empty($seotitle)) { echo $oldseotitle; } else {	the_title(); }; } else { the_title(); }; ?></h1>
 
<ul>

<li>Professional local plumbers</li><li>Same-day fast friendly service</li><li>Customer satisfaction guaranteed</li><li>Fixed prices with no surprises</li>

</ul> 
 
 
 </div>
 
 </div>
 
 
 

</section>

<script>jQuery.fn.firstWord = function() { var text = this.text().trim().split(" "); var first = text.shift(); this.html((text.length > 0 ? '<span class="firstword">'+ first + '</span> ' : first) + text.join(' ')); }; jQuery("h1.home").firstWord();</script>


<?php if (function_exists('wpmd_is_device')){  if (!wpmd_is_device()) { ?><script>jQuery(function(){ jQuery("#video").okvideo({ source: 'b4DlC5YS51k', volume: 0, loop: false, hd:true, adproof: true, annotations: false }) });</script><?php }}; ?>