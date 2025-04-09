#!/bin/bash

number=""
read -p "choose the laboratory number: x = " number
source="lab$number/"
destination="/opt/lampp/htdocs/$source"

if [ ! -d "$source" ]; then
    echo "error: source directory does not exist."
    exit 1
fi

echo $source $destination
sudo rm -rf $destination
sudo mkdir $destination
sudo cp -a "$source/." $destination

sudo echo "<?php
	if (!empty(\$_SERVER['HTTPS']) && ('on' == \$_SERVER['HTTPS'])) {
		\$uri = 'https://';
	} else {
		\$uri = 'http://';
	}
	\$uri .= \$_SERVER['HTTP_HOST'];
	header('Location: '.\$uri.'/$source');
	exit;" > index.php

sudo rm /opt/lampp/htdocs/index.php
sudo mv index.php /opt/lampp/htdocs/
