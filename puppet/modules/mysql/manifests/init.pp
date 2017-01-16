class mysql {
  package { 'mysql-server':
    ensure => latest
  }

  service { "mysql":
    ensure    => running,
    enable    => true,
    pattern   => "apache2",
    hasrestart => true,
    hasstatus => true,
    require => Package['mysql-server']
  }

  package { 'phpmyadmin':
    ensure  => latest,
    require => [ Package['apache2'], Package['mysql-server'] ]
  }

  file { '/etc/apache2/conf.d/phpmyadmin.conf':
    ensure  => 'link',
    target  => '/etc/phpmyadmin/apache.conf',
    notify  => Service['apache2'],
    require => Package['phpmyadmin']
  }
}

