# ow migrate plugin

This plugin puts the website's backend in maintenance mode so it can safely be migrated without having to worry about somebody else making a change on the backend.

## How to use
1. Create the wpoverwatch user.
2. Install the plugin.
3. once the plugin is installed, wpoverwatch will be the only user that is able to login to the website. All other users who try to login will get a message about the website being migrated.
4. Backup the website and move it to its new location.
5. Delete the plugin on the new webhost, but keep this plugin activated on the old webhost. Once your DNS changes propagate, people will naturally be able to login to the backend again.