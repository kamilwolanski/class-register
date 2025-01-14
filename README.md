# Instrukcja uruchomienia projektu

## 1. Pobranie i instalacja XAMPP

Aby rozpocząć, pobierz i zainstaluj XAMPP z oficjalnej strony:

- [Pobierz XAMPP](https://www.apachefriends.org/pl/index.html)

## 2. Uruchomienie Apache i MySQL w XAMPP

Po zainstalowaniu XAMPP, uruchom program i włącz serwery **Apache** oraz **MySQL**. Kliknij "Start" obok obu serwerów, aby je uruchomić.

## 3. Instalacja paczek npm

Zainstaluj Node.js, który zawiera menedżera paczek npm. Pobierz go z poniższego linku:

- [Pobierz Node.js](https://nodejs.org/)

Po zainstalowaniu Node.js, przejdź do katalogu projektu w terminalu i zainstaluj zależności:

- Uruchom komendę: `npm install`

## 4. Instalacja zależności Composera

Aby zainstalować zależności PHP, musisz mieć zainstalowanego Composera. Pobierz go z poniższego linku:

- [Pobierz Composer](https://getcomposer.org/)

Po zainstalowaniu Composera, uruchom poniższą komendę w terminalu w katalogu projektu:

- Uruchom komendę: `composer install`

## 5. Uruchomienie migracji bazy danych

Aby utworzyć strukturę bazy danych, uruchom migracje:

- Uruchom komendę: `php artisan migrate` i wpisz 'yes' by utowrzyc baze danych 

## 6. Seedowanie bazy danych

Aby zapełnić bazę danych przykładowymi danymi, uruchom poniższą komendę:

- Uruchom komendę: `php artisan db:seed`

## 7. Uruchomienie serwera developerskiego

Na koniec, uruchom serwer developerski:

1. Uruchom serwer frontendowy za pomocą npm:

- Uruchom komendę: `npm run dev`

2. Uruchom serwer PHP:

- Uruchom komendę: `php artisan serve`

