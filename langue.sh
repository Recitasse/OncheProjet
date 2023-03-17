#!/bin/bash

sudo systemctl start mysql
sudo systemctl start apache2
firefox -new-window http://langue.ms
