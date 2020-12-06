Versioni:
- Laravel Framework 8.17.0
- PHP 7.4.1
- Node.js v12.18.0
- Vue 2.6.12
- MySQL 5.7.24

Librerie aggiuntive utilizzate:
- maatwebsite/excel (per installarla è stato necessario attivare extension=gd2 in php)
- phpoffice/phpspreadsheet (richiesto da maatwebsite/excel)

Sequenza comandi per avviare l'app:
1.Clonare la repo
2.Rinominare .env.example in .env ed editare il file con i dati del proprio database
2.Dalla cartella della repo clonata eseguire da CLI in sequenza: "composer install", "npm install", "npm run dev"
3.Eseguire "php artisan key:generate"
4.Eseguire "php artisan migrate"
5.Eseguire "php artisan serve"
