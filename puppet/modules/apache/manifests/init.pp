class apache {
  package { 'apache2':
    ensure => latest
  }

  service { "apache2":
    ensure    => running,
    enable    => true,
    pattern   => "apache2",
    hasrestart => true,
    hasstatus => true,
    require => Package['apache2']
  }

  file { '/etc/apache2/sites-available/default':
    source  => 'puppet:///modules/apache/default.conf',
    owner   => 'root',
    group   => 'root',
    mode    => '644',
    require => Package['apache2'],
    notify  => Service['apache2']
  }
}

