<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:Samolo972/gigaboulet.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('185.22.110.4')
    ->set('remote_user', 'jsxrkwqf')
    ->set('deploy_path', '~/gigaboulet');

// Hooks

after('deploy:failed', 'deploy:unlock');
