# README #

## Getting started ##

> Note that these instructions assume that you have your preferred local WordPress environment set up already. This theme is set up for **gulp**.

- Use `cd your/themes/folder/path` in the terminal to navigate to your themes folder.
- Clone this repository to your themes folder within the site you're building.
- Run `mv oldname newname` to rename the folder to the Client Name.
- `cd` into your renamed theme folder.
- Run `npm install` inside your theme directory.
- Amend `gulpfile.js` with the Client URL for browser-sync.
- Run `gulp` from your theme directory.
- Edit `style.css` so it uses the client details, designer's name and your name.

## "It's not working!" ##

If you are getting errors (most likely 'AssertionError: Task function must be specified') when you run `gulp`, check your version of Gulp in Terminal:
`$ gulp -v`

If your Gulp version is less than 4.0.x, you should upgrade. See information about [updating Gulp](https://www.liquidlight.co.uk/blog/article/how-do-i-update-to-gulp-4/) to get started.

## Good to know ##

This theme uses the BEM (Block, Element, Modifier) methodology, though it's debatable how well it uses it. Still a work in progress, feedback always welcome.

The idea behind BEM is that you - a GOOP developer - can view the source of a site built by another GOOP developer, and quickly identify what a class does and how it relates to other classes.

If you're not familiar with BEM, check the links below.

- [Get BEM](http://getbem.com/)
- [MindBEMding – getting your head ’round BEM syntax](https://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/)
- [Battling BEM CSS: 10 Common Problems And How To Avoid Them](https://www.smashingmagazine.com/2016/06/battling-bem-extended-edition-common-problems-and-how-to-avoid-them/)
