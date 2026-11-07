# Klinik Sari Dharma API

Laravel 13 REST API (Passport authentication) that serves the public website (`fe`) and the admin dashboard (`fe-dashboard`).

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan passport:keys
php artisan passport:client --personal   # needed once, otherwise login returns 500
php artisan serve
```

Supported databases: MySQL (production and dev) and PostgreSQL. Configure `DB_*` in `.env`.

`CRYPTO_KEY` and `CRYPTO_IV` in `.env` are used to obfuscate numeric IDs in API responses (see `app/Helpers/Cryptor.php`).

## Tests

```bash
php artisan test
```

Tests run against the database named in `phpunit.xml` (`api_klinik_testing`).

## Main resources

All collection endpoints live under `/api`. Reading is public; creating, updating and deleting require a Bearer token from `POST /api/login`.

| Endpoint | Model |
| --- | --- |
| `/api/categories` | Category |
| `/api/doctors` | Doctor |
| `/api/doctor-schedules` | DoctorSchedule |
| `/api/specialist-services` | SpecialistService |
| `/api/facility-services` | FacilityService |
| `/api/featured-services` | FeaturedService |
| `/api/health-packages` | HealthPackage |
| `/api/health-articles` | HealthArticle |
| `/api/community-events` | CommunityEvent |
| `/api/quality-indicators` | QualityIndicator |
| `/api/careers` | Career |
| `/api/social-media-contents` | SocialMediaContent |
| `/api/certification-awards` | CertificationAward |

Interactive documentation is available at `/api-documentation`.

## Upgrading an existing database

`2026_11_07_000000_upgrade_passport_tables` recreates the OAuth tables for Passport 13 (everyone has to log in again, then run `passport:client --personal`).

`2026_11_07_000100_rename_tables_and_columns_to_english` renames the Indonesian tables, columns, stored JSON keys and category flags to English. Deploy it together with the new frontends. It can be rolled back with `php artisan migrate:rollback`.
