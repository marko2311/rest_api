# rest_api
Rozpoczęcie działania API

Aby API działało poprawnie, po pobraniu nalezy wykonac nastepujace czynnosci:
  - za pomoca composera, zainstalowac zasoby ktore znajduja sie w pliku composer.json
  - skonfigurowac plik .env tak aby zgadzal sie z naszymi lokalnymi ustawieniami
  - uruchomic skrypt dbseed.php
  - aby przetestowac dzialanie API np w Postmanie, tam gdzie znajduja sie pliki naszego API wpisujemy komende <br />
    <b>php -S 127.0.0.1:8000 -t public</b><br /><br />


---------- OBSŁUGA TABELI GIER ------------
  
  
  Aby dodac nowa gre, nalezy uzyc zadania
  
  <b>POST /games</b><br />
  body requesta musi zawierac atrybuty: name, price np. ({"price": 9.99, "name": "Fable II"})<br /><br />
  
  
  Aby usunac gre, nalezy uzyc zadania
  
  <b>DELETE /games/{id}</b><br /><br />
  
  
  Aby zaktualizowac nazwe i/lub cene gry, nalezy uzyc zadania
  
  <b>PUT /games/{id}</b><br />
  body request musi zawierac atrybut/y ktore chcemy aktualizowac np.({"name": "Fable 2"})<br /><br />
  
  
  Aby pobrac cala tabele gier, razem z podzialem na strony, nalezy uzyc zadania
  
  GET  /games
  
  
  Aby pobrac pojedyncza gre, nalezy uzyc zadania
  
  GET /games/{id}
  
  
---------- OBSŁUGA CARTA ------------

  Przy stworzeniu carta, autmatycznie zostaja narzucone zasady tzn.
    -max 3 rozne przedmioty
    -max ilosc kazdego przedmiotu to 10
  
  Aby stworzyc carta, nalezy uzyc zadania
  POST /cart
  
  Aby dodac gre do carta, nalezy uzyc zadania
  PUT /cart/{id}
  
  Aby usunac gre z carta, nalezy uzyc zadania
  DELETE /cart/{id}
  
  Aby wyswietlic zawartosc carta razem z cena calkowita, nalezy uzyc zadania
  GET /cart
  
    
