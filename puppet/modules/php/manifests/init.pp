class php {
  package { 'libapache2-mod-php5':
    ensure => latest,
    notify => Service['apache2']
  }

  package { 'php5-cli':
    ensure => latest,
    notify => Service['apache2']
  }

  package { 'php5-mysql':
    ensure => latest,
    notify => Service['apache2']
  }

  package { 'php5-gd':
    ensure => latest,
    notify => Service['apache2']
  }

  package { 'php5-curl':
    ensure => latest,
    notify => Service['apache2']
  }

  package { 'php-apc':
    ensure => latest,
    notify => Service['apache2']
  }
}

