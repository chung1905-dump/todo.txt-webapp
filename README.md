todo.txt web interface
======================

A simple, iPhone-friendly web interface for [todo.sh](http://todotxt.com) written in PHP and spiced up with a wee bit of jQuery. 

Designed to work well in Mobile Safari on an iPhone/iPod Touch. Also tested on a Palm Centro, though the jQuery stuff doesn't work in crappy Blazer. If you try it out on other devices, let me know how it works, ok?

A screenshot, `screenshot.png` is included.

Author: Chung     
License: GPL,  http://www.gnu.org/copyleft/gpl.html     
URL: https://github.com/chung1905/todo.txt-web



Installation
-----------

1. First, you need a working installation of [todo.sh](http://todotxt.com). (Presumably variants like todo.py will work, though I haven't tested them.) 

2. Your todo.txt files and your todo.cfg need to be writable by your webserver. There are a variety of ways to make this happen: `chmod 666` on your todo files, set some ACLs, let your web server run todo.sh as sudo... They're all a bit scary, so take your pick.

3. Install the todo.txt-web files where you want them on your web server.

4. Copy or rename the file `includes/config-sample.php` to `includes/config.php` and fill in all the variables. It's well-commented.

5. That should be it. If you have problems, a few things to check:

    * There's an `.htaccess` file in the `includes` directory preventing web access to that directory. If your web server isn't configured to allow this, that can cause problems. 

    * I'm using Google's copy of jQuery instead of a local copy. If this is a problem, just [download jQuery](http://jquery.com/) and change the link in the `<head>` section of `index.php`.

    * If you're keeping your todo.txt files in your home area (such as `/Users/you/Documents/todo` in OS X), then your web server needs to be able to read the directory path to your todo files. So either move your todo folder elsewhere, or do a `chmod o+x` on your Documents folder if you're comfortable with that..



Behavior
--------

- By default, it will display whatever command you have set as `TODOTXT_DEFAULT_ACTION` in your todo config file. 

- Treat the input box as your command line, only you don't have to type `todo.sh` first. So you can type `ls` to list all your items, but you can also type things like `-h` to get help info.

- The task numbers and tags (words starting with "@" or "+") are links that send numbers or tags to the input box, respectively. After using this for awhile, I found this was the most handy way for this to work:

    * When you click on the task number, it sends that number to the input field for you and then positions the cursor _in front of_ the number. This makes it easy to just type `do`, `pri`, `rm`, `replace`, etc. 

    * When you click on a tag, it sends that tag to the input field, prepends `ls ` to the front of it and leaves the cursor at the end of the input field so you can either hit submit or add further `ls ` terms.

- Any regular URLs in your task are also made into links.

- Because I got sick of automatically doing an `ls` again right after any non-listing command: whenever you do any command that isn't an `ls`, the last `ls` command you ran is ran again and displayed right after your command's output. 


Bugs/Todo List
-------------

- Since I added `escapeshellcmd()` to filter input, parentheses now get escaped when you type in a task with the priority inline (i.e. `add "(A) do this now!"`).

- On my phone (a Palm Centro), the javascript doesn't work properly. Is there a good way to detect a handheld device in php and exclude `<script>` tags? (Short of making a big list of acceptable user agents, which sucks.) No point in downloading jQuery every pageload if it doesn't work. Question: why can't `<script>` have a `media` attribute like `<style>`? 

- Any commands that require user confirmation (like a `mv`) won't work. One option is to add `-f` to the command arguments, but it'd be nice if there was a way to actually allow for confirmations through the web UI in some way.


Credit
------

Obviously, this is just a web front-end to [todo.sh](http://todotxt.com), a very cool tool that has received a lot of improvements in the last few months. Follow todo.sh development [here on github](http://github.com/ginatrapani/todo.txt-cli).

I borrowed the idea and some code to get me started from [this thread](http://tech.groups.yahoo.com/group/todotxt/message/1320) on the todotxt mailing list. 

The "move the cursor to the start of the input field" trick found on [Stack Overflow](http://stackoverflow.com/questions/499126/jquery-set-cursor-position-in-text-area).

I modified the simple authentication code [found here](http://www.legend.ws/blog/tips-tricks/php-authentication-login-script/) and [here](http://www.phpnerds.com/article/using-cookies-in-php/2).
