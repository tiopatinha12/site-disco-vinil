<?php


Router::get('','StaticPagesController@serveHome');
Router::get('login','StaticPagesController@serveLogin');
Router::get('home','StaticPagesController@serveHome');
