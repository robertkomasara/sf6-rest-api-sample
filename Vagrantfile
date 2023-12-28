Vagrant.configure("2") do |config|
  
  config.vm.provider "virtualbox" do |vb|
    vb.cpus = 4; vb.memory = 6144
  end

  config.vm.box = "generic/ubuntu2204"
  config.vm.synced_folder ".", "/home/vagrant/src"
  # config.vm.box_check_update = false

  config.vm.define "app" do |subconfig|

    subconfig.vm.hostname = 'cf-rk-app-php.local'
    subconfig.vm.post_up_message = 'App php host'

    subconfig.vm.network "private_network", ip: '192.168.56.101'
    subconfig.vm.network "forwarded_port", guest: 8080, host: 8091

    subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/app/install.sh", privileged: true

    subconfig.trigger.after :up do |trigger|
      trigger.info = "Starting trigger after up..."
      trigger.run_remote = { path: "vagrant/triggers/hosts/app/after-up.sh", privileged: false }
    end
   
    subconfig.trigger.before :destroy, :halt do |trigger|
      trigger.info = "Starting trigger before down..."
      trigger.run_remote = { path: "vagrant/triggers/hosts/app/before-down.sh", privileged: false }
    end

  end

  config.vm.define "mysql" do |subconfig|

    subconfig.vm.hostname = 'cf-rk-app-mysql.local'
    subconfig.vm.post_up_message = 'App mysql host'

    subconfig.vm.network "private_network", ip: '192.168.56.103'
    subconfig.vm.network "forwarded_port", guest: 3306, host: 3307

    subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/mysql/install.sh", privileged: true

    subconfig.trigger.after :up do |trigger|
      trigger.info = "Starting trigger after up..."
      trigger.run_remote = { path: "vagrant/triggers/hosts/mysql/after-up.sh", privileged: true }
    end

  end

  config.vm.define "redis" do |subconfig|

    subconfig.vm.hostname = 'cf-rk-app-redis.local'
    subconfig.vm.post_up_message = 'App redis host'

    subconfig.vm.network "private_network", ip: '192.168.56.102'
    subconfig.vm.network "forwarded_port", guest: 6379, host: 6380

    subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/redis/install.sh", privileged: true

  end

  config.vm.define "rabbit" do |subconfig|

    subconfig.vm.hostname = 'cf-rk-app-rabbit.local'
    subconfig.vm.post_up_message = 'App rabbit host0'

    subconfig.vm.network "private_network", ip: '192.168.56.104'
    subconfig.vm.network "forwarded_port", guest: 5672, host: 5673

    subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/rabbit/install.sh", privileged: true

  end

end

