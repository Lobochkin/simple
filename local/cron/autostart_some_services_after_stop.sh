#!/bin/bash
for srv in httpd mysql
do
  systemctl status $srv || systemctl start $srv
done