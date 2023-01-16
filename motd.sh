#!/bin/bash

read -p "Are you sure you trust this script? (y/n) " -n 1 -r
echo "\n"
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "Well you probably did, as you already executed it... Ok here we go!\n\n";
else
    # The idea is this cmd is not run...
    curl -s https://cms.digitalnatives.nl/motd/$(whoami)-at-$(uname -n)-did-not-trust-this-script > /dev/null
    exit;
fi

# You will have to trust this script as well...
curl -s https://raw.githubusercontent.com/DigitalNativesAmsterdam/dn-shell-lib/main/logo.php | php

normal=$(tput sgr0)
green=$(tput setaf 2)
blue=$(tput setaf 4)
yellow=$(tput setaf 3)

cat << EOF

${green}Welcome!${normal}

${blue}System Information: ${normal}
${blue}----------------------------------------------------------------${normal}
${blue}The current working directory is:  ${yellow}$PWD${normal}
${blue}You are logged in as:              ${yellow}$(whoami)${normal}
${blue}Uptime:                            ${yellow}$(uptime)${normal}
${blue}PHP version:                       ${yellow}$(php -v)${normal}
${blue}----------------------------------------------------------------${normal}

${blue}Running Processes: ${normal}
${blue}----------------------------------------------------------------${normal}
${yellow}$(ps axuf)${normal}
${blue}----------------------------------------------------------------${normal}

${blue}Your sudo rights: ${normal}
${blue}----------------------------------------------------------------${normal}
${yellow}$(sudo -l)${normal}
${blue}----------------------------------------------------------------${normal}
EOF
