# ACF

ACF configs are automatically saved in this folder as you edit them using the Custom Fields control panel in the WordPress admin. You just need to commit these updates to git to share the updates. Some important things to remember about ACF JSON:

- These config files will override whatever is Custom Fields control panel. So if the control panel is not synced with the JSON file then the JSON file will take precendence.
- The control panel uses the timestamp saved in the JSON file to decide whether a sync is required. If something goes wrong, eg due to a conflict or you simply want to rollback a local change, you can "trick" it by updating the timestamp to "now". This will prompt the control panel to show the sync option.

See the [ACF documention](https://www.advancedcustomfields.com/resources/local-json/) for more info.