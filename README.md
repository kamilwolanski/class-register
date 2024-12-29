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

## 5. Stworzenie bazy danych
Stwórz nową bazę danych (http://localhost/phpmyadmin) o nazwie z pliku .env.example z pod `DB_DATABASE`

## 6. Generowanie app key
Skopiuj plik .env.example wklej go do projektu i zmień nazwę na .env. Następnie wygeneruj klucz komendą `php artisan key:generate`

## 7. Uruchomienie migracji bazy danych

Aby utworzyć strukturę bazy danych, uruchom migracje:

- Uruchom komendę: `php artisan migrate`

## 8. Seedowanie bazy danych

Aby zapełnić bazę danych przykładowymi danymi, uruchom poniższą komendę:

- Uruchom komendę: `php artisan db:seed`

## 9. Uruchomienie serwera developerskiego

Na koniec, uruchom serwer developerski:

1. Uruchom serwer frontendowy za pomocą npm:

- Uruchom komendę: `npm run dev`

2. Uruchom serwer PHP:

- Uruchom komendę: `php artisan serve`

