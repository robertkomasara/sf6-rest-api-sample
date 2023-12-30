#!/usr/bin/ruby

class VagrantHost
    attr_reader :address, :service, :srcPort, :dstPort;
    def initialize(address, service, srcPort, dstPort)
      @address = address; @service = service;
      @srcPort = srcPort; @dstPort = dstPort;
    end
end