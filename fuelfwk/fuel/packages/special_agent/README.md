# Special Agent

Special Agent is a [FuelPHP](http://fuelphp.com/) package which uses [php-mobile-detect](https://github.com/serbanghita/Mobile-Detect) to determine whether a device is mobile or not - this is largely to negate the use of Browscap, which has proven to be entirely unreliable as of late.

# What it does

This package does three things.

* Firstly, it overwrites the default `Agent::is_mobiledevice()` method to use php-mobile-detect.
* Secondly, it overrides the is_mobiledevice method:
	* `Agent::is_mobile()` - merely shorthand for `Agent::is_mobiledevice()`
* Thirdly, added all the remaining methods from the class
	* `Agent::is_tablet()`
	* `Agent::is_mobiledevice()`
	* `Agent::is_mobile()`
	* `Agent::is_tablet()`
	* `Agent::is_ios()`
	* `Agent::is_android_os()`
	* `Agent::is($value)`
	* `Agent::component_version($value)`

# Usage
Clone it into fuel/packages:
```sh
git clone --recursive git://github.com/rob-bar/special_agent fuel/packages/special_agent
```
After doing that, ensure you're always loading it in your config.php file, like so:
```php
'always_load' => array(
	'packages' => array(
		'special_agent'
	)
)
```
And you're done. Easy as cheese.