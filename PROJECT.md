# Laravel Boilerplate - Project Overview

## Descrizione

Starter kit per la realizzazione di applicazioni web con Laravel. Fornisce una base completa con autenticazione, gestione utenti con RBAC, API REST, import/export Excel, generazione PDF e pannello di amministrazione.

---

## Stack Tecnologico

| Componente | Tecnologia |
|---|---|
| Framework | Laravel 13 |
| PHP | ^8.2 |
| Database | MySQL |
| Frontend Build | Vite 5 |
| CSS Framework | Bootstrap 5.2.3 |
| Admin Theme | AdminBSB Material Design |
| Frontend Theme | FlexStart |
| Testing | Pest PHP + PHPUnit |
| Autenticazione API | Laravel Sanctum |
| Autorizzazione | Spatie Laravel Permission |

---

## Funzionalità Implementate

### Autenticazione
- Login con sessione (Laravel UI)
- Registrazione utente (disabilitata per default, abilitabile da configurazione)
- Reset password via email
- Verifica email (`MustVerifyEmail`)
- Autenticazione API con token (Laravel Sanctum)
- Reindirizzamento post-login basato sul ruolo dell'utente
- Tracciamento ultimo accesso (`last_login`)

### Autorizzazione (RBAC)
Gestione ruoli tramite **Spatie Laravel Permission**:
- `admin` — Amministratore con accesso al pannello admin
- `user` — Utente con accesso all'area utente

### Gestione Utenti (Pannello Admin)
- Elenco utenti con DataTable AJAX (Yajra DataTables)
- Creazione, modifica ed eliminazione utenti
- Abilitazione/disabilitazione account utente
- Assegnazione ruolo (admin/user)
- **Import da Excel**: importazione massiva utenti da file `.xlsx`
- **Export su Excel**: esportazione lista utenti in formato `.xlsx`
- **Stampa PDF**: generazione scheda utente in PDF (DomPDF)

### Sicurezza
- Cifratura dei campi sensibili nel database (`name`, `email`) tramite `elgibor-solution/laravel-database-encryption`
- Password salvate con hashing bcrypt
- **StatusMiddleware**: logout automatico degli utenti disabilitati ad ogni richiesta
- Form Request validation centralizzata con messaggi in italiano

### API REST
```
GET  /api/user       — Utente autenticato (richiede auth:sanctum)
GET  /api/v1/info    — Informazioni applicazione (nome, ambiente, versione API)
```

### Internazionalizzazione
- Lingua italiana per tutta l'interfaccia e i messaggi di errore
- Timezone: `Europe/Rome`
- Locale: `it`

---

## Architettura

```
app/
├── Console/Commands/       # Comandi artisan custom (pest, larastan, pint)
├── Exports/                # Export Excel (UsersExport)
├── Helpers/                # Helper di vista (ViewHelpers)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # HomeController, UserController
│   │   ├── Auth/           # Login, Register, Password Reset
│   │   └── User/           # HomeController utente
│   ├── Middleware/         # StatusMiddleware
│   └── Requests/           # UserStoreRequest, UserUpdateRequest, UserRegisterRequest, UserResetRequest
├── Imports/                # Import Excel (UserImport)
├── Models/                 # User
├── Providers/              # AppServiceProvider
└── Services/               # UserService, RegisterService
```

### Pattern Architetturali
- **Service Layer**: logica di business separata dai Controller (`UserService`, `RegisterService`)
- **Form Requests**: validazione centralizzata con supporto email cifrata
- **Resource Controller**: routing RESTful per la gestione utenti admin

---

## Modello Utente

Campi nel database:

| Campo | Tipo | Note |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Cifrato nel DB |
| `email` | string | Cifrato nel DB, unique |
| `password` | string | Hashed (bcrypt) |
| `last_login` | datetime | Aggiornato al login |
| `status` | boolean | 1=attivo, 0=disabilitato |
| `remember_token` | string | — |
| `timestamps` | — | created_at, updated_at |

---

## Rotte Principali

| Metodo | URI | Nome | Middleware | Scopo |
|---|---|---|---|---|
| GET | `/` | `home` | — | Homepage pubblica |
| GET | `/welcome` | — | — | Pagina di benvenuto |
| GET | `/login` | `login` | guest | Form di login |
| POST | `/login` | — | guest | Processo login |
| GET | `/logout` | `logout` | — | Logout |
| GET | `/admin/home` | `admin.home` | auth, admin, status | Dashboard admin |
| GET | `/admin/user` | `admin.user.index` | auth, admin, status | Lista utenti |
| POST | `/admin/user` | `admin.user.store` | auth, admin, status | Crea utente |
| GET | `/admin/user/{id}` | `admin.user.show` | auth, admin, status | Dettaglio utente |
| PUT | `/admin/user/{id}` | `admin.user.update` | auth, admin, status | Aggiorna utente |
| DELETE | `/admin/user/{id}` | `admin.user.destroy` | auth, admin, status | Elimina utente |
| POST | `/admin/user/list` | `admin.user.list` | auth, admin, status | DataTable AJAX |
| GET | `/admin/user/{id}/print` | `admin.user.print` | auth, admin, status | Stampa PDF |
| GET | `/admin/user/import` | `admin.user.showImport` | auth, admin, status | Form import |
| POST | `/admin/user/import` | `admin.user.import` | auth, admin, status | Processa import |
| GET | `/admin/user/exportToExcel` | `admin.user.exportToExcel` | auth, admin, status | Export Excel |
| GET | `/user/home` | `user.home` | auth, user, status | Dashboard utente |

---

## Dipendenze Principali

### Produzione
| Pacchetto | Versione | Scopo |
|---|---|---|
| `laravel/framework` | ^13.0 | Framework core |
| `laravel/sanctum` | ^4.0 | Autenticazione API |
| `laravel/ui` | ^4.6 | Scaffolding UI auth |
| `laravel/tinker` | ^2.9 | REPL interattivo |
| `spatie/laravel-permission` | ^6.16 | RBAC |
| `spatie/laravel-backup` | ^9.2 | Backup DB e file |
| `maatwebsite/excel` | ^3.1 | Import/Export Excel |
| `yajra/laravel-datatables-oracle` | ^12.0 | DataTables AJAX |
| `barryvdh/laravel-dompdf` | ^3.1 | Generazione PDF |
| `elgibor-solution/laravel-database-encryption` | ^1.1 | Cifratura campi DB |
| `opcodesio/log-viewer` | ^3.15 | Viewer log applicazione |

### Sviluppo
| Pacchetto | Versione | Scopo |
|---|---|---|
| `pestphp/pest` | ^3.7 | Framework di test |
| `phpunit/phpunit` | ^11.5 | Test runner |
| `larastan/larastan` | ^3.2 | Analisi statica |
| `laravel/pint` | ^1.21 | Code formatter |
| `barryvdh/laravel-debugbar` | ^3.15 | Debug toolbar |
| `nunomaduro/phpinsights` | ^2.12 | Code quality |

---

## Database e Seeders

### Migrazioni
- `users` — Tabella utenti
- `sessions` — Sessioni (driver database)
- `cache` — Cache (driver database)
- `jobs` — Queue jobs (driver database)
- `permission_tables` — Tabelle Spatie Permission
- `personal_access_tokens` — Token Sanctum
- `password_reset_tokens` — Token reset password

### Seeders
- **UserRolesSeeder**: crea i ruoli `admin` e `user`
- **UsersSeeder**: crea due utenti di default
  - `admin@example.com` / `password` (ruolo: admin)
  - `user@example.com` / `password` (ruolo: user)

---

## Test

Il progetto usa **Pest PHP** con PHPUnit come base.

### Feature Tests (`tests/Feature/`)
- `HomeRouteTest` — Verifica che le pagine pubbliche rispondano correttamente

### Unit Tests (`tests/Unit/`)
- `UserModelTest` — Test metodi statici del modello User
- `UserServiceTest` — Test creazione, aggiornamento ed eliminazione utenti
- `RegisterServiceTest` — Test registrazione utente e assegnazione ruolo
- `StatusMiddlewareTest` — Test middleware blocco utenti disabilitati
- `ViewHelpersTest` — Test funzioni helper di navigazione

---

## Comandi Utili

```bash
# Avvio del progetto
php artisan migrate --seed
npm run dev

# Qualità del codice
php artisan pint          # Formattazione codice
php artisan larastan      # Analisi statica
php artisan pest          # Esecuzione test

# Gestione
php artisan backup:run    # Backup manuale
```

---

## Configurazione Environment

Variabili principali nel file `.env`:

```env
APP_NAME=Boilerplate
APP_ENV=local
APP_TIMEZONE=Europe/Rome
APP_LOCALE=it

DB_CONNECTION=mysql
DB_DATABASE=laravel_boilerplate

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```
