
<div class="h6e-page-content">

<?php
$options = array();
$options['namespace'] = $site->getConfig('bouncer_id');
// $options['detailed_connections'] = true;
Bouncer_Stats::setOptions($options);
Bouncer_Stats::agent();
?>

</div>
