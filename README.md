[![Discord](https://img.shields.io/discord/915046808009441323.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/AzJ7Uz7wkx)


# CustomSize
A simple plugin that allows you to change your size quickly and simply.

## How to use
Add the plugin to `plugins` and start your server! 

You can customize the command name, aliases, and messages in `config.yml`. 
The permission for this command is `size.cmd`.


## Config
```yaml
command:
  name: "size"
  description: "change size"
  aliases: ["si", "s"]

messages:
  success:
    with_target: "§aYou have successfully changed {target}'s size ({size})"
    without_target: "§aYou have successfully changed size ({size})"
  target_not_exists: "§cThis player does not exist!"
  sender_not_player: "§cYou cannot execute this command in the console!"
  sender_no_permission: "§cYou do not have permission to execute this command!"

```

