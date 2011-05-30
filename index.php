<?php

define('LD_BOUNCER_IGNORE', true);

require_once dirname(__FILE__) . '/dist/prepend.php';

require_once 'limonade.php';

require_once 'Bouncer/Bouncer.php';
require_once 'Bouncer/Stats.php';

function configure()
{
    global $site, $application;
    option('base_uri',      $site->getPath() . '/' . $application->getPath() );
    option('session',       false);
    if (define('LD_DEBUG') && constant('LD_DEBUG')) {
        option('debug',         true);
        option('env',           ENV_DEVELOPMENT);
    }
}

function is_admin()
{
    global $site;
    $role = $site->getAdmin()->getUserRole();
    return $role == 'admin';
}

function not_admin()
{
    set('hasMenu', false);
    return render(sprintf('<h3>Not authorized</h3>'));
}

function before()
{
    global $site, $application, $configuration, $namespace;
    set('site', $site);
    set('application', $application);
    set('configuration', $configuration);
    set('namespace', $namespace);
    set('hasMenu', true);
    set('hasSearch', false);
    layout('layout.html.php');
    if (isset($_GET['agent'])) {
        return bouncer_redirect_to('/agent/' . $_GET['agent']);
    }
    if (isset($_GET['connection'])) {
        return bouncer_redirect_to('/connection/' . $_GET['connection']);
    }
    if (isset($_GET['filter'])) {
        return bouncer_redirect_to('/query', array('q' => $_GET['filter']));
    }
}

function bouncer_url_for($for)
{
    if (constant('LD_REWRITE')) {
        return url_for($for);
    } else {
        return url_for("index.php/$for");
    }
}

function bouncer_redirect_to($for, $params = null)
{
    if (constant('LD_REWRITE')) {
        return redirect_to($for, $params);
    } else {
        return redirect_to("index.php" . $for, $params);
    }
}

dispatch('/', 'index');

function index()
{
    if (!is_admin()) { return not_admin(); }
    return bouncer_redirect_to('/browsers');
}

dispatch('/browsers', 'browsers');

function browsers()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['filter'] = '-type:robot -type:unknown -status:bad -status:suspicious -rss:1';
    set('isBrowsers', true);
    return html("index.html.php");
}

dispatch('/robots', 'robots');

function robots()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['filter'] = '-type:browser -type:unknown -status:bad -status:suspicious -rss:1';
    set('isRobots', true);
    return html("index.html.php");
}

dispatch('/unknown', 'unknown');

function unknown()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['filter'] = '-type:browser -type:robot -status:bad -status:suspicious';
    return html("index.html.php");
}

dispatch('/suspicious', 'suspicious');

function suspicious()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['filter'] = '-status:nice -status:neutral';
    return html("index.html.php");
}

dispatch('/query', 'query');

function query()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['filter'] = $_GET['q'];
    return html("index.html.php");
}

dispatch('/agent/:id', 'agent');

function agent()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['agent'] = params('id');
    return html("agent.html.php");
}

dispatch('/connection/:id', 'connection');

function connection()
{
    if (!is_admin()) { return not_admin(); }
    $_GET['connection'] = params('id');
    return html("connection.html.php");
}

run();
