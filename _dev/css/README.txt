/*=================================================================================
	WELCOME TO SASS(SYNTACTICALLY AWESOME STYLE SHEETS)!
=================================================================================*/

To get started with SASS, download the Prepros app from http://alphapixels.com/prepros/
You do not need to install Ruby, Grunt, or any other command line, scary-sounding/scary-looking bunch of tools, contrary to what a lot of online documentation says.
Prepros takes care of all of this! 

In our CSS folder, we have a bunch of files called _something.scss (known as partials) and then one without an underscore, such as style.scss.
style.scss imports all the other files. The underscores tell the compiler to ignore the partial files. Otherwise we'd end up with a whole bunch of CSS files instead of them all being compiled into one, unless we manually changed the settings in Prepros. 

When you launch Prepros, add your project by clicking "Add Project" and navigating to your CSS folder.
You may need to edit the output file location so that the final, compiled style.css is in the WordPress theme root, not in the /css folder. You can do this simply by clicking on the current path - a browse dialogue will pop up, allowing you to select a new location.

In Prepros, there are a few compiler options you might find useful:
- Auto compile: Detects when your SASS files (including the partials) are changed, and recompiles your style.css
- Line numbers: Adds comments to your output file telling you which SASS file and line you'll find that declaration.
- Auto prefix CSS: Adds vendor prefixes where needed, so you no longer have to add 5 different lines for a border radius, for example.
- Output style: How would you like your file?
	- Expanded: Fully expanded CSS file with each selector and declaration on a new line, with the declarations indented, etc. Great for development.
	- Nested: Like Expanded, but indents declaration blocks below their parents. For example, #header #details would be indented below #header.
	- Compressed: Strips out all comments and whitespace, turning the file into one really long line.
	- Compact: Compresses everything down into one line per declaration block. Keeps comments.

/*=================================================================================
	SASS SYNTAXES
=================================================================================*/	

SASS has two syntaxes, the original SASS and the newer SCSS.
SCSS syntax is more like vanilla CSS, so I have used SCSS in these files. 

/*=================================================================================
	VARIABLES
=================================================================================*/	

Variables are where the fun begins!

SASS variables can be used to define values that are used repeatedly.
We can then easily change the colour scheme and typography of a site simply by changing the relevant values here.

We can use variables to define the values of other variables. For example, if we want menu links to be the primary brand colour,
we can declare this using $nav-link: $color-3.
Note that the one being used as a value must be declared before the one it's being applied to. So in that example, $color-3 must be declared before $nav-link, otherwise you'll get an undeclared variable error because the compiler doesn't know what $color-3 is yet. 

We can assign any value to a variable and then use it in CSS in exactly the same way as you would if you were putting the value in every time.
For example, if our h1 is the primary brand colour, instead of writing h1 { color: #0C61AC } we write h1 { color: $color-3 }. 

/*=================================================================================
	MIXINS
=================================================================================*/  

Mixins give us the ability to package up existing code into reusable chunks of code. 
We can put a bunch of CSS declarations into a mixin and then include the mixin in the CSS for the element we want to apply it to. 

For example:

@mixin my-mixin {
  font-family: $font-body;
  color: $color-3;
}

Would then be used as follows:

.element p {
  @include my-mixin;
}

/*=================================================================================
	FUNCTIONS
=================================================================================*/

Functions allow you to do stuff to values using a formula. 
A common use is colour functions, which allow you to perform operations such as darkening/lightening colours, adjusting hues, and adjusting saturation. 

- Darken a colour, based on either its value or a variable: 	darken($color-2, 10%);
- Lighten a colour:												lighten($color-3, 20%);

You can even nest functions, e.g:								adjust_hue(lighten(#572952, 9), 293)

The colour functions above are built-in. We can also create our own functions or add snippets from elsewhere.

The rem-calc() function found in _functions.scss is derived from Zurb Foundation.
This allows us to think in pixels, and then the preprocessor will convert that number into rems. The syntax is rem-calc(value), e.g. rem-calc(12). 
rem means "root em" and is a relative sizing unit. It differs from ems in that it sizes things relative to the html element's value, rather than the element's parent. 

/*=================================================================================
	MORE INFO
=================================================================================*/

Why you scared of SASS? A great intro article					http://web-design-weekly.com/2013/04/10/why-you-scared-of-sass/
Official SASS Documentation										http://sass-lang.com/documentation
The SASS Way -A bunch of tutorials and code snippets			http://thesassway.com/
SASSMe - Visualise colour functions								http://sassme.arc90.com/
Transparent colours - includes using RGBA with existing colour variables, even if they are hex colours! 	http://thesassway.com/intermediate/mixins-for-semi-transparent-colors 

Zurb Foundation													http://foundation.zurb.com
Twitter Bootstrap												http://www.getbootstrap.com 