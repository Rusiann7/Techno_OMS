#!/bin/bash
declare -r ngrokdomain='star-panda-literally.ngrok-free.app'
read -r -p "Enter PHP port: " port

# Launch PHP server in public/ directory inside tilix
tilix --command "bash -c 'cd public/ && php -S localhost:$port; exec bash'" &

# Give PHP a moment to start before ngrok connects
sleep 1

# Launch ngrok in a separate tilix window
tilix --command "bash -c 'ngrok http http://localhost:$port --domain=$ngrokdomain; exec bash'" &