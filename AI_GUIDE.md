# AI CRUD Creation Guide

## Purpose
Each CRUD must include:
- Migration
- Permission entry (in `global.php`)
- Controller
- Views 
- Route
- Sidebar entry
- add translation in lang file
---

## 🚀 Steps to Create a New CRUD

### 1. Migration
- Create a new migration file inside `database/migrations/`.

### 2. Permission
- in config\global.php.

### 3. Controller
- Create a new migration file inside `App\Http\Controllers\Dashboard`.
- like this file App\Http\Controllers\Dashboard\UserController.php.

### 4. Views
- Create (create, edit, index, filter) files follow this files from 'resources/views/Dashboard/users'.

### 5. Route
- add crud routes in admin.php.

### 6. - Sidebar entry
-add modul to silde bar in 'resources/views/Dashboard/includes/aside.blade.php'.

Example:
```bash
php artisan make:migration create_users_table
