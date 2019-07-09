<?php
    opanel('CHECK IN');
        table('tickets', ['CÓDIGO CHECK IN', 'URL','VOO', 'data',],['token','url','idvoo','data'], $tokens, []);
    cpanel();