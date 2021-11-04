1. kreirati folder gdje ćemo klonirati aplikaciju

2. otvoriti folder u terminalu

3. git clone https://github.com/mirkomilicic6/smart_sum_parking_zavrsni.git

4. cd smart_sum_parking_zavrsni

5. composer install

6. npm install

7. cp .env.example .env (naredba za napraviti kopiju .env file-a u laravel aplikaciji)

8. code . (otvaranje u visual studio code, ili pokrenuti terminal ili u prethodnom terminalu upisati sljedeće, tj. pod 7.)

9. php artisan key:generate (naredba u terminalu)

10. kreirati novu mysql bazu u phpmyadmin ili po izboru

11. u .env pod DB_DATABASE staviti ime kreirane prazne baze i spremiti

12. php artisan migrate (u terminalu naredba za kreiranje potrebnih tablica u bazi)

13. php artisan db:seed (naredba sa seedanje baze, tj admin korisnika i 50 laznih korisnika)

14. za ispravan rad aplikacije skinuti .zip sa github-a i izdvojiti kopiju sql baze pod nazivom "zavrsni_db.sql", te istu importati na phpmyadmin u našu novu bazu

15. NAPOMENA: pri uvozu baze iz koraka naprijed phpmyadmin izbaci gresku da baza events već postoji, ali to nije problem

16. seedanjem smo napravili super_admin korisnika koji ima sve ovlasti, korisnički MAIL: admin@example.com 
                                                                                   PASSWORD: password





