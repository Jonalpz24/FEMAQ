#!/bin/bash
chmod -R 775 /var/app/current/storage
chmod -R 775 /var/app/current/bootstrap/cache
chmod +x .platform/hooks/postdeploy/01_permissions.sh
