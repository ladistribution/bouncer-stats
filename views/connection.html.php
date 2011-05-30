
<div class="h6e-page-content">

<?php
$options = array();
$options['namespace'] = $namespace;
// $options['detailed_connections'] = true;
Bouncer_Stats::setOptions($options);
Bouncer_Stats::connection();
?>

</div>
