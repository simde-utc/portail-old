<?php use_helper('CrossLink');
echo '<a href="' . cross_app_link_to('frontend', '@infojob_offre_show', array('id' => $info_job_signalement->getId())) .'" target="_blank">Voir l\'annonce</a>';
