<div class="h6e-page-content">

<?php if (isset($configuration['query_field']) && $configuration['query_field']) :  ?>
    <form method="get" action="<?php echo $application->getUrl() ?>query">
    <input type="search" name="filter" id="bouncer-filter" class="bouncer-filter" value="<?php
        echo isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : '' ?>"/>
    </form>
<?php endif ?>

<?php
$options = array();
if (isset($isRobots)) {
    $options['keys'] = array('time', 'id', 'host', 'agent', 'hits');
} else {
    $options['keys'] = array('time', 'id', 'host', 'system', 'agent', 'referer', 'hits');
}
$options['namespace'] = $site->getConfig('bouncer_id');
$options['ignore_ips'] = array('127.0.0.1', '::1', $_SERVER['SERVER_ADDR']);
// $options['base_static_url'] = $site->getUrl('shared') . '/bouncer';
Bouncer_Stats::setOptions($options);
Bouncer_Stats::index();
?>

</div>

<p class="see-also">
    See <a href="<?php echo bouncer_url_for('unknown') ?>">unknown</a>
    and <a href="<?php echo bouncer_url_for('suspicious') ?>">suspicious</a> agents.
</p>
