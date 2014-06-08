class vagrant {
  user {'vagrant':
    shell  => '/bin/bash',
    groups => 'www-data'
  }

  package {'vim':
    ensure => latest
  }

  package {'git':
    ensure => latest
  }
}
