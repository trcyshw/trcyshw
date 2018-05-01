/*=================================================================================
	JAVASCRIPT
=================================================================================*/

We currently use the following JavaScript files in our themes, in the following ways.
To enable a script not enabled by default, uncomment/add it in package.js, uncomment/add any relevant CSS files in style.scss, and uncomment/add any relevant function calls in main.js. If you can't find a file, check the _repository folder.

Script:						Package
Enabled by default?			Yes
Locations/relevant files:	package.js
Purpose:					Used by Prepros to concatenate theme JavaScript files, and where possible plugin JavaScript as well. Minify to js/min/package.min.js.

Script: 					Modernizr			
Enabled by default? 		Yes							
Locations/relevant files:	package.js				
Purpose:					Adds HTML5 shiv, adds useful CSS classes to the <html> tag of which features are and are not supported.

Script: 					Main		
Enabled by default? 		Yes				
Locations/relevant files:	package.js			
Purpose:					Where we place our custom JavaScript snippets and calls to other scripts. 

Script: 					Google Fonts		
Enabled by default? 		Yes				
Locations/relevant files:	package.js, webfont.js
Purpose:					Calls our theme's fonts. 

Script:						Webfont
Enabled by default?			Yes
Locations/relevant files:	package.js, googlefonts.js
Purpose:					Required for Google Fonts to be loaded via JavaScript.

Script: 					Cycle		
Enabled by default? 		Yes 					
Locations/relevant files:	package.js, parts/slideshow, features/_slideshow.scss					
Purpose:					Slideshows.

Script: 					MatchHeight		
Enabled by default? 		Yes		
Locations:					main.js				
Purpose:					Make elements the height of the tallest item when they are in a row. For example, a row of blocks featuring text about major services.

Script: 					StackTable		
Enabled by default? 		No				
Locations:					main.js, base/_tables.scss				
Purpose:					Collapses and stacks table cells on mobile devices.

Script: 					Swipebox	
Enabled by default? 		Yes		
Locations:					main.js, base/_lightbox.scss; features/_gallery.scss		
Purpose:					Turns WordPress galleries into lightboxes automagically. 

Script: 					Owl Carousel
Enabled by default? 		No
Locations:					main.js, features/_carousel.scss		
Purpose:					Touch-friendly responsive carousels.