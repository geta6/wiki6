Wiki6
=====

Powered by PHP and jQuery wiki
------------------------------

### Homepage

* [http://geta6.net/wiki6](http://geta6.net/wiki6)

### Source & Download

* [GitHub](https://github.com/geta6/wiki6)

Versions
--------

*	3.0.1
	*	Fix Short-Tags
	*	Detect outer link
	*	Change `file_get_contents` to `curl`

Documentation
-------------

Wiki6 is WYSIWYG wiki.

### Prepare

1.	Change Password.  
	Default Password is **wiki6**, please change.  
	`echo hash("sha512","yourpassword")`  
	write in `etc/setting.json`  
	Will be fixed.

2.	Setting Permissions.  
	Need R/W permissions to `etc` and `var`  

3.	Enabling Rewrite Module.  

