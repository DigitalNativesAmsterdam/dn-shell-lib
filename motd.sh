#!/bin/bash

curl -D - https://raw.githubusercontent.com/DigitalNativesAmsterdam/dn-shell-lib/main/logo.php | php

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
