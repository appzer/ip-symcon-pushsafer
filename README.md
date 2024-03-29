![Pushsafer](https://www.pushsafer.com/de/assets/logos/logo.png)
# ip-symcon-pushsafer
Pushsafer plugin for IP-Symcon (Version: 1.1.8)

##How to send push-notification out of IP-Symcon with Pushsafer

[Pushsafer.com](https://www.pushsafer.com) make it easy and safe to send &amp; receive push-notifications to your
- Android devices
- iOS devices (iPhone, iPad, iPod Touch, Watch)
- Windows 10 Phone & Desktop
- Browser (Chrome & Firefox)

## Install
1. with [Module Control](https://www.symcon.de/service/dokumentation/modulreferenz/module-control/) you can add third party modules from a Repository-URL
2. open Module Control
3. press Add Button
4. enter the Respository-URL (git://github.com/appzer/ip-symcon-pushsafer.git)
5. Press OK

### Repository-URL

	git://github.com/appzer/ip-symcon-pushsafer.git

![Pushsafer](https://www.pushsafer.com/de/assets/examples/ip-symcon-01.jpg)

### Configuration

![Pushsafer](https://www.pushsafer.com/de/assets/examples/ip-symcon-02.jpg)

### Pushsafer API values

The following parameters you can modify, further informations you will find on https://www.pushsafer.com/en/pushapi

1. Private or Alias Key (required)
2. Title = Title of notification (optional)
3. Device = Device or Device Group ID(optional)
4. Icon = Icon number 1-98 (optional)
5. Sound = leave empty for device default or a number 0-28 (optional)
6. Vibration = leave empty for device default or a number 0-3 (optional)
7. Time2Live = Integer number 0-43200: Time in minutes, after which message automatically gets purged. (optional)
8. URL = URL/Link or URL scheme (optional)
9. URL Title = Title of URL (optional)
10. Priority = set the priority, -2, -1, 0, 1, 2 (optional)
11. Retry = resend a notification after set time in seconds, 60-10800 (optional)
12. Expire = when the retry/resend should stop, time in seconds, 60-10800 (optional)
13. Confirm = resend a message before it confirmed, time in seconds, 10-10800 (optional)
14. Answer = 1 Answer, 0 or blank no answer possibility (optional)
15. Answer Options = predefined answer options divided by a pipe character e.g. Yes|No|Maybe (optional)
16. Answer Force = 1 or 0 (optional)
17. Image URL 1 = absolute image path (optional)
18. Image URL 2 = absolute image path (optional)
19. Image URL 3 = absolute image path (optional)

### For image URLs use absolute paths.
Example 1: http://username:password@192.168.2.28:8080/snapshot.cgi

Example 2: https://www.pushsafer.com/de/assets/logos/logo.png

### More Pushsafer objects

You can create as many Pushsafer objects as you want. So you have the possibility to use different Pushsafer settings for different scenarios.

![Pushsafer](https://www.pushsafer.com/de/assets/examples/ip-symcon-03.jpg)

### Send notifications by script

	$sendMessage = Pushsafer_SendMessage($ObjectIDofPushsaferModul, "Message");
