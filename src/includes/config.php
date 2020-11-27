<?php

/* Instructions:
 * 
 * Rename this file "config.php" and fill in the 
 * variables below.
 *
 * Note: This script defaults to your todo.sh default command,
 * set with TODOTXT_DEFAULT_ACTION (added to todo.sh on 2009-03-16) 
 * in your todo config file.  So unless you like seeing the 
 * usage text, upgrade (if necessary) and set this variable.
 * 
 * Example:
 * export TODOTXT_DEFAULT_ACTION=ls
 *
*/

/* URL
 * The root URL for this site, like so:
 * $todoUrl = "http://yourdomain.com/path/to/todo/";
 * Note: you need to use the trailing slash at the end.
*/
$todoUrl = "";

/* Set the command 
 * 1. Use full paths
 * 2. The following options for todo.sh are required for this:
 *      -p (no colors)
 *      -d /path/to/your/todo.cfg
 * 3. Example:
 * $todoCmd = '/home/me/bin/todo.sh -p -a -n -d /home/me/.todo.cfg';
 *
*/
$todoCmd = "todo.sh -p";
