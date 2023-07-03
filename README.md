<p align="center">
  <img align="center" src="https://github.com/HakanBabus/EasyAnnouncement/assets/90573332/986e3c5c-a117-47a1-9f7f-d1e418841ebf"  width="80" height="80">

<p align="center">
    <b>EasyAnnouncement plugin for PocketMine-MP</b>
  
  <p align="center">
Created by: https://github.com/HakanBabus


  <p align="center">
    <img alt="GitHubrelease" src="https://img.shields.io/github/v/release/HakanBabus/EasyAnnouncement?label=release&sort=semver">
</p>


# Features

- Easy config
- Include auto announcement
- Prefix, time invertal settings
- Include manuel announcement (/announcement)
- Announcement with sound (custom, random)
- Fully customizable

# Requirements

- PocketMine-MP API 4-5

# Add your server

- Go to [this](https://github.com/HakanBabus/EasyAnnouncement/releases) page.
- Download lastest release.
- Move the file to the plugins folder


# Config Management

```
#sound management
#multiple or single sound
#distribute if there is more than one sound
sound:
  - mob.ghast.fireball


#auto announcement settings
auto-announcement:
  enabled: true       # Enable setting for auto announcement
  prefix: "§e§l> §f"  # Message prefix
  time: 180           # Repeat time (seconds) (default 3 min = 180 seconds)
  sound:
    enabled: false    # if is true -> when send auto announcement, play random sound
  messages:
    - Message 1
    - Message 2
    - Message 3

#player announcement settings
player-announcement:
  enabled: true      # if is false, don't register the command
  prefix: "§e[ANNOUNCEMENT] §f{player} §e>§f "
  command-settings:
    name: announcement
    description: Send announcement to server players
    usage: "§cUsage: §f/announcement (message: string)"
    aliases: []
  sound:
    enabled: true     #if is true -> when send announcement, play random sound

# COMMAND PERMISSIONS

# permission: announcement.command
# default setting is op
```
