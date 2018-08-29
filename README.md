# AutoUpdater
[![](https://poggit.pmmp.io/shield.api/AutoUpdater)](https://poggit.pmmp.io/p/AutoUpdater)
[![](https://poggit.pmmp.io/shield.dl.total/AutoUpdater)](https://poggit.pmmp.io/p/AutoUpdater)  

A PocketMine-MP plugin that allow you to automatically update your server when a new version of PocketMine-MP is available with a rich API for developers.  

Basically the plugin is checking the latest version from the channel you choosed in your pocketmine.yml in ``preferred-channel`` when the server startup. If a new update is available and you have setted autoUpdate to true in your config.yml this plugin will stop all your plugins first to avoid any problems then downloading the latest version.phar and then stop/restart your server.

### Config

- **autoUpdate**  
    You can choose in the config to activate autoUpdate or no, if autoUpdate is set to false, you will be notified but the server won't be upgraded.
    
- **restartAfterUpdate**  
    If the server isn't running on Windows and you have pntcl extension compiled with PHP (by default with PHP bin downloaded by PM when you install), you can enable that option that will automatically restart the server once he is updated.  
    If set to false, the server will only shutdown and you will have to restart it manually.
