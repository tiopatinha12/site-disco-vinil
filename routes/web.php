<?php


Router::get('',  'StaticPagesController@serveHome');
Router::get('login',  'StaticPagesController@serveLogin');
Router::get('home',  'StaticPagesController@serveHome');
Router::get('sobre',  'StaticPagesController@serveSobre');
Router::get('contato',  'StaticPagesController@serveContato');
Router::get('add',  'StaticPagesController@serveAddProduto');
Router::post('add', 'DinamicPagesController@addProduto');
Router::post('checkout', 'DinamicPagesController@serveCheckout');
Router::post('login', 'LoginController@AdminLogin');
