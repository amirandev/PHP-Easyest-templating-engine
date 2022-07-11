<?php
require_once 'App/core/Render.php';

define('VIEWS_DIR', trim(trim(__DIR__,'/'), '\\').'/App/views');


view('pages.home', ['name' => 'Amiran'])->extends('layouts.default', ['message' => 'Sometimes we can weed to smoke... aaa... aaa...'])->run();