# -*- mode: ruby -*-
# vi: set ft=ruby :

require File.dirname(__FILE__) + "/vagrant/addons/dependency_manager"

check_plugins ["vagrant-exec", "vagrant-hostsupdater", "vagrant-triggers"]

Vagrant.configure(2) do |config|
  # use scotchbox as base box
  config.vm.box = "scotch/box"

  # set ip address to 192.168.33.10
  config.vm.network "private_network", ip: "192.168.33.10"

  # set project folder to /var/www
  config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=777"]

  # set hostname
  config.vm.hostname = "checktheflows.local"

  # make /var/www the working directory for all commands
  config.exec.commands '*', directory: '/var/www'

  # install php 7
  config.vm.provision "shell", path: "vagrant/provisioners/update-php.sh"

  config.trigger.after [:up, :reload, :provision] do
    info "Starting mailcatcher..."
    run "vagrant ssh -c \"pgrep mailcatch > /dev/null || /home/vagrant/.rbenv/shims/mailcatcher --http-ip=0.0.0.0\""

    info "Installing composer packages..."
    run "vagrant ssh -c \"cd /var/www ; composer install\""

    info "Linking public storage directory..."
    run "vagrant ssh -c \"cd /var/www ; php artisan storage:link -q\""

    info "Creating test database..."
    run "vagrant ssh -c \"mysql -e 'CREATE DATABASE IF NOT EXISTS test;'\""

    info "Migrating database..."
    run "vagrant ssh -c \"cd /var/www ; php artisan migrate\""
  end
end
