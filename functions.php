<?php
/**
 * Functions file.
 *
 * @package WordPress
 */

// Register styles and scripts.
require 'functions/enqueue.php';
require 'functions/register.php';
require 'functions/scripts.php';

// Do all the things.
require 'functions/acf.php';
require 'functions/comments.php';
require 'functions/media.php';
require 'functions/misc.php';
require 'functions/navigation.php';
require 'functions/permalinks.php';
require 'functions/rest-api.php';
require 'functions/seo.php';
