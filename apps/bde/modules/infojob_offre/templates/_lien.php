<?php
use_helper('CrossLink');
echo '<a href="' . cross_app_link_to('frontend', '@infojob_offre_show', array('id' => '1')) .'" target="_blank">Voir l\'annonce</a>';
