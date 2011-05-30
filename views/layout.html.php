<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8"/>
  <title><?php echo $application->getName() ?></title>
<?php if (defined('LD_COMPRESS_CSS') && constant('LD_COMPRESS_CSS')) : ?>
  <link href="<?php echo Ld_Ui::getCssUrl('/h6e-minimal/h6e-minimal.compressed.css', 'h6e-minimal') ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo Ld_Ui::getCssUrl('/ld-ui/ld-ui.compressed.css', 'ld-ui') ?>" rel="stylesheet" type="text/css"/>
<?php else : ?>
  <link href="<?php echo Ld_Ui::getCssUrl('/h6e-minimal/h6e-minimal.css', 'h6e-minimal') ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo Ld_Ui::getCssUrl('/ld-ui/ld-ui.css', 'ld-ui') ?>" rel="stylesheet" type="text/css"/>
<?php endif ?>
<?php if (defined('LD_APPEARANCE') && constant('LD_APPEARANCE')) : ?>
  <link href="<?php echo Ld_Ui::getApplicationStyleUrl() ?>" rel="stylesheet" type="text/css"/>
<?php endif ?>
  <?php Bouncer_Stats::css(); ?>
  <style type="text/css">
  <?php $colors = Ld_Ui::getApplicationColors(); ?>
  .h6e-tabs { font-size:11px; top:0; }
  .h6e-tabs li.active a { padding-bottom:5px; }
  .h6e-page-content p.see-also { font-size:12px; }
  .bouncer-table { background:#<?php echo $colors['ld-colors-background-3'] ?>; }
  .bouncer-table td, .bouncer-table th, .bouncer-filter { border:1px solid #<?php echo $colors['ld-colors-border-3'] ?>; }
  .bouncer-table th { color:#<?php echo $colors['ld-colors-text-3'] ?>; }
  .bouncer-table td, .h6e-main-content .bouncer-table td a { color:#333; }
  .bouncer-table-agent td { background:#eee; }
  .bouncer-filter { margin:0; border-bottom:0; padding:2px 3px; width:952px; color:#999; background:transparent; }
  .bouncer-filter:focus { color: #<?php echo $colors['ld-colors-text'] ?>}
  .bouncer-table-connections { position:relative; top:-1px; }
  </style>
  <script type="text/javascript" src="<?php echo Ld_Ui::getJsUrl('/jquery/jquery.js', 'js-jquery') ?>"></script>
<?php if (defined('LD_COMPRESS_JS') && constant('LD_COMPRESS_JS')) : ?>
  <script type="text/javascript" src="<?php echo Ld_Ui::getJsUrl('/ld/ld.c.js', 'lib-admin') ?>"></script>
<?php else : ?>
  <script type="text/javascript" src="<?php echo Ld_Ui::getJsUrl('/ld/ld.js', 'lib-admin') ?>"></script>
<?php endif ?>
</head>
<body class="ld-layout h6e-layout">

    <?php Ld_Ui::topBar(); ?>

    <div class="ld-main-content h6e-main-content">

        <h1 class="h6e-page-title"><?php echo $application->getName() ?></h1>

        <?php Ld_Ui::topNav(); ?>

        <?php if ($hasMenu) : ?>
        <ul class="h6e-tabs">
            <li<?php if (isset($isBrowsers)) echo ' class="active"' ?>><a href="<?php echo bouncer_url_for('browsers') ?>">Browsers</a></li>
            <li<?php if (isset($isRobots)) echo ' class="active"' ?>><a href="<?php echo bouncer_url_for('robots') ?>">Robots</a></li>
        </ul>
        <?php endif ?>

        <?php echo $content ?>

        <div class="h6e-simple-footer">
            Powered by <strong>Bouncer Statistics</strong>
            with the help of <a href="http://www.limonade-php.net/">Limonade</a>
            via <a href="http://www.ladistribution.net/">La Distribution</a>
        </div>

    </div>

    <?php Ld_Ui::superBar(); ?>

</body>
</html>