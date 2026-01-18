# Copilot Instructions - Penggajian Karyawan

## Project Overview
A Laravel 12 payroll management system ("Penggajian Karyawan") for employee salary, allowances, deductions, absences, and payslips. Early-stage project with foundational migrations but minimal controllers/models.

## Architecture & Data Model

### Core Domain Entities (Database)
- **Divisi** (Division) - Organizational units
- **Jabatan** (Position) - Job roles  
- **Karyawan** (Employee) - Master employee data, links to Divisi + Jabatan
- **Tunjangan** (Allowances) - Salary components to add
- **Potongan** (Deductions) - Salary components to subtract
- **Gaji** (Base Salary) - Employee salary records
- **Slip Gaji** (Payslip) - Generated salary slips
- **Absensi** (Attendance) - Daily attendance records
- **Rekap Absensi** (Attendance Summary) - Aggregated absence data

**Key Pattern**: Database-first approach with migrations in `database/migrations/` - all tables exist as schema but models are minimal (only `User.php` populated). When implementing features, create Eloquent Models in `app/Models/` for each entity.

### Relationships to Establish
- Karyawan → Divisi, Jabatan (foreign keys)
- Gaji → Karyawan (employee salary history)
- Slip Gaji → Gaji (salary slip generation)
- Tunjangan/Potongan → Gaji (components included in calculation)
- Rekap Absensi → Absensi (aggregation logic)

## Tech Stack
- **Backend**: Laravel 12.0, PHP 8.2+
- **Frontend**: Blade templates, Bootstrap 5.3.3, TailwindCSS 4.0 (with Vite), Font Awesome 6.5.2
- **Build**: Vite 7.0.7, Laravel Vite Plugin
- **Dev Tools**: PHPUnit 11.5.3, Laravel Pint (formatting), Faker (testing), Mockery (mocking)
- **Services**: Queue (jobs), Cache, Session (file/redis capable)

## Key Files & Conventions

### Routes (`routes/web.php`)
```
GET / → admin.template (master template with sidebar)
GET /dashboard → admin.dashboard (dashboard view)
```
**Convention**: Routes currently minimal; follow RESTful resource routes for CRUD operations. Pattern: `Route::resource('karyawan', KaryawanController);`

### Views (`resources/views/admin/`)
- **template.blade.php** - Master layout with Bootstrap sidebar navigation
  - Fixed left sidebar (250px, blue gradient: #1E3A8A→#1E40AF)
  - Main content via `@yield('konten')` placeholder
  - Navigation includes sidebar menu items (many hardcoded `href="#"`, ready for implementation)
- **dashboard.blade.php** - Dashboard view (child of template)

**Convention**: All admin views should extend template: `@extends('admin.template') @section('konten') ... @endsection`

### Styling Approach
- **CSS Variables**: Bootstrap classes + custom inline styles (avoid Tailwind in Blade templates; use `resources/css/app.css`)
- **Vite Asset Pipeline**: Use `@vite(['resources/css/app.css', 'resources/js/app.js'])`; build with `npm run build`, dev with `npm run dev`
- **Design System**: Blue gradient buttons, rounded corners (10-12px), Poppins font

### Controllers
- Base: `app/Http/Controllers/Controller.php` (abstract, ready for inheritance)
- **Missing**: Domain controllers (KaryawanController, GajiController, etc.) - create as needed following Laravel conventions
- Pattern: Extend `Controller`, use dependency injection, return views or JSON responses

### Models
- Only `User.php` defined; follow its pattern for new models:
  - Use `HasFactory`, `Notifiable` traits
  - Define `$fillable` array for mass assignment
  - Add relationships via methods (`hasMany()`, `belongsTo()`, `hasManyThrough()`)

## Developer Workflows

### Setup & Initialization
```bash
composer setup          # Full setup (install, migrations, key generation, npm install)
composer run dev        # Start local dev server + queue + logs + Vite watcher (concurrently)
npm run build          # Production build with Vite
npm run dev            # Vite development mode
```

### Database
```bash
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Undo migrations
php artisan tinker              # Interactive shell for testing queries
```

### Testing
```bash
composer run test       # Run PHPUnit tests with config clear
php artisan test --filter=TestName  # Run specific test
```

### Development Patterns
- **Migrations**: Always create new migration files dated `2026_01_17_*` format; use reversible schema (up/down)
- **Seeding**: Use `database/seeders/` and Faker for test data; define in `DatabaseSeeder.php`
- **Queue Jobs**: Create in `app/Jobs/`, dispatch via `dispatch(new JobName())`, listen with `php artisan queue:listen`
- **Validation**: Use Form Request classes in `app/Http/Requests/` or inline `validate()` in controllers

## Code Patterns & Conventions

### Model Example Pattern
```php
// app/Models/Karyawan.php
namespace App\Models;

class Karyawan extends Model {
    use HasFactory;
    protected $fillable = ['nama', 'divisi_id', 'jabatan_id'];
    
    public function divisi() { return $this->belongsTo(Divisi::class); }
    public function jabatan() { return $this->belongsTo(Jabatan::class); }
}
```

### Controller Example Pattern
```php
// app/Http/Controllers/KaryawanController.php
public function index() {
    return view('admin.karyawan.index', ['karyawan' => Karyawan::with(['divisi', 'jabatan'])->get()]);
}
```

### Blade Template Pattern
Follow master layout inheritance:
```blade
@extends('admin.template')
@section('konten')
    <!-- content here -->
@endsection
```

## Project-Specific Conventions

1. **Admin-Only Routes**: All routes currently admin-only (sidebar template); implement auth middleware when ready
2. **Table Naming**: Singular in code (Karyawan model, karyawan table), follow Indonesian naming
3. **Soft Deletes**: Consider for employee records (already have timestamps); use `SoftDeletes` trait
4. **Computed Fields**: Payslip totals (gaji + tunjangan - potongan) should be calculated in Model or Query
5. **Localization**: Blade templates use Indonesian labels; prepare for i18n if needed

## Common Commands for Agent Use
```bash
# Check project status
php artisan migrate:status
php artisan config:cache --force  # Pre-cache config for performance

# Generate resources (Artisan shortcuts)
php artisan make:model Divisi -m        # Model + migration
php artisan make:controller DivisiController --resource  # RESTful controller
php artisan make:request StoreDivisiRequest

# Quick development
php artisan tinker
>>> Karyawan::count()
```

## Integration Points & External Dependencies
- **Mail**: Configured (`config/mail.php`); ready for payslip delivery
- **Queue**: Redis/database job processing; use for async payslip generation
- **Auth**: Laravel's default auth system (Users table exists); implement as needed
- **Cache**: Configurable backends; cache salary templates/reports for performance

## Known Gaps & Next Steps for Agents
- [ ] No controllers defined yet; start with CRUD controllers for main entities
- [ ] Models lack relationships; add after schema confirmation
- [ ] Navigation links hardcoded to `#`; wire to actual routes
- [ ] No authentication/authorization; implement Middleware + Policies
- [ ] Frontend currently hardcoded; consider Vue.js components for dynamic tables
- [ ] No API endpoints; add `/api/` routes if needed for reports/dashboards
