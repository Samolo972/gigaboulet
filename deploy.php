<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:Samolo972/gigaboulet.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('')
    ->set('remote_user', '')
    ->set('deploy_path', '~/gigaboulet');

// Hooks

after('deploy:failed', 'deploy:unlock');
