<?php
session_start();

$PARAMETERS = [];
$MESSAGES = [];

# Inizializzo funzioni necessarie
require_once(dirname(__FILE__) . '/../core/functions.php');

# Carico le constanti principali
require_once(dirname(__FILE__) . '/../core/constant_values.php');

# Carico i dati di configurazione del db
require_once(dirname(__FILE__)).'/../core/db_config.php';

# Se esiste un file di overrides di connessione del db, caricalo
if(file_exists(dirname(__FILE__).'/../core/db_overrides.php')){
    include_once dirname(__FILE__).'/../core/db_overrides.php';
}

# Inizializzo le classi fondamentali
require_once(dirname(__FILE__) . '/../classes/Libraries/Base.class.php');
require_once(dirname(__FILE__) . '/../classes/Libraries/Routing.class.php');
require_once(dirname(__FILE__) . '/../classes/Libraries/DB.class.php');

# Creo la connessione
$handleDBConnection = DB::connect();

# Inclusione file classe tramite routing
GDRCDRouter::startClasses();

# Inserisco il resto delle configurazioni
#require_once(dirname(__FILE__) . '/../config.inc.php');

