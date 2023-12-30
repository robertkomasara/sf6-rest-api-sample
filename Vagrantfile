require './VagrantHost';

Vagrant.configure("2") do |config|
  
  config.vm.provider "virtualbox" do |vb|
    vb.cpus = 4; vb.memory = 6144;
  end

  config.vm.box = "generic/ubuntu2204";
  config.vm.synced_folder ".", "/home/vagrant/src";
  config.vm.box_check_update = false;

  VagrantHostApp = VagrantHost.new('192.168.56.101','app',8080,8091);
  VagrantHostRedis = VagrantHost.new('192.168.56.102','redis',6379,6389);
  VagrantHostMysql = VagrantHost.new('192.168.56.103','mysql',3306,3317);
  VagrantHostRabbit = VagrantHost.new('192.168.56.104','rabbit',5672,5682);
  
  [VagrantHostApp,VagrantHostRedis,VagrantHostMysql,VagrantHostRabbit].map do |service|

    config.vm.define service.service.to_s do |subconfig|

      subconfig.vm.hostname = service.service + '.local';
      subconfig.vm.post_up_message = 'Host post up message';
  
      subconfig.vm.network "private_network", ip: service.address;
      subconfig.vm.network "forwarded_port", guest: service.srcPort, host: service.dstPort;
  
      subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/" + service.service + "/install.sh", privileged: true;
      
      subconfig.trigger.after :up do |trigger|
        trigger.info = "Starting trigger after up...";
        trigger.run_remote = { path: "vagrant/triggers/hosts/" + service.service + "/after-up.sh", privileged: false };
      end
     
      subconfig.trigger.before :destroy, :halt do |trigger|
        trigger.info = "Starting trigger before down...";
        trigger.run_remote = { path: "vagrant/triggers/hosts/" + service.service + "/before-down.sh", privileged: false };
      end

    end
  end
end

