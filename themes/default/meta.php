<meta name="description" content="<?php if (!empty($meta->description)) {  echo $meta->description; }; ?>"/>
<meta name="keywords" content="<?php if (!empty($meta->keywords)) { echo $meta->keywords; }; ?> "/>
<meta name="author" content="<?php if (!empty($meta->author)) { echo $meta->author; }; ?>">
<meta name="title" content="<?php if (!empty($meta->title)) { echo $meta->title; }; ?>">
<meta name="author" content="<?php if (!empty($meta->author)) { echo $meta->author; }; ?>">
<meta name="url" content="<?php if(empty($meta->link_url)){ echo base_url(uri_string()); }else{  echo $meta->link_url; } ?>">
<meta name="rating" content="General">

<meta property="og:title" content="<?php if (!empty($meta->title)) { echo $meta->title; }; ?>"/>
<meta property="og:publisher" content="<?php if (!empty($meta->author)) { echo $meta->author; }; ?>"/>
<meta property="og:site_name" content="<?= base_url() ?>"/>
<meta property="og:description" content="<?php if (!empty($meta->description)) { echo $meta->description; }; ?>"/>
<meta property="og:image" content="<?php if (!empty($meta->img)) { echo $meta->img; }; ?>"/>
<meta name="url" content="<?php if(empty($meta->link_url)){ echo base_url(uri_string()); }else{  echo $meta->link_url; } ?>">

<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="<?= base_url() ?>"/>
<meta name="twitter:creator" content="<?php if (!empty($meta->author)) { echo $meta->author; }; ?>"/>
<meta name="url" content="<?php if(empty($meta->link_url)){ echo base_url(uri_string()); }else{  echo $meta->link_url; } ?>">
<meta property="og:title" content="<?php if (!empty($meta->title)) { echo $meta->title; }; ?>"/>
<meta property="og:description" content="<?php if (!empty($meta->description)) { echo $meta->description; }; ?>"/>
<meta property="og:image" content="<?php if (!empty($meta->img)) { echo $meta->img; }; ?>"/>
