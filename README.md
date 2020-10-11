# rest_api
Rozpoczęcie działania API

Aby API działało poprawnie, po sklonowaniu repozytorium nalezy wykonac nastepujace czynnosci:
  - za pomoca composera, zainstalowac zasoby ktore znajduja sie w pliku composer.json
  - skonfigurowac plik .env tak aby zgadzal sie z naszymi lokalnymi ustawieniami
  - uruchomic skrypt dbseed.php
  - aby przetestowac dzialanie API np w Postmanie, tam gdzie znajduja sie pliki naszego API wpisujemy komende <br />
    <b>php -S 127.0.0.1:8000 -t public</b><br /><br />


---------- OBSŁUGA TABELI GIER ------------
  
  
  Aby dodac nowa gre, nalezy uzyc zadania<br />
  <b>POST /games</b><br />
  body requesta musi zawierac atrybuty: name, price np. ({"price": 9.99, "name": "Fable II"})<br /><br />
  
  
  Aby usunac gre, nalezy uzyc zadania <br />
  <b>DELETE /games/{id}</b><br /><br />
  
  
  Aby zaktualizowac nazwe i/lub cene gry, nalezy uzyc zadania
  
  <b>PUT /games/{id}</b><br />
  body request musi zawierac atrybut/y ktore chcemy aktualizowac np.({"name": "Fable 2"})<br /><br />
  
  
  Aby pobrac cala tabele gier, razem z podzialem na strony, nalezy uzyc zadania<br />
  
  <b>GET  /games</b><br /><br />
  
  
  Aby pobrac pojedyncza gre, nalezy uzyc zadania<br />
  
  <b>GET /games/{id}</b><br /><br />
  
  
---------- OBSŁUGA CARTA ------------<br /><br />

  Przy stworzeniu carta, autmatycznie zostaja narzucone zasady tzn.
    -max 3 rozne przedmioty
    -max ilosc kazdego przedmiotu to 10<br /><br />
  
  Aby stworzyc carta, nalezy uzyc zadania<br />
  POST /cart
  
  Aby dodac gre do carta, nalezy uzyc zadania
  PUT /cart/{id}
  
  Aby usunac gre z carta, nalezy uzyc zadania
  DELETE /cart/{id}
  
  Aby wyswietlic zawartosc carta razem z cena calkowita, nalezy uzyc zadania
  GET /cart
  
    
