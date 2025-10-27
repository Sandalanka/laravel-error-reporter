# Laravel Error Reporter

A lightweight Laravel package that **automatically captures exceptions**, logs them, and **sends an email notification** to the admin defined in your `.env` file (`ADMIN_MAIL_ADDRESS`).

---

## 🚀 Features

✅ Automatically listens to all unhandled exceptions  
✅ Logs the error message, file, and line  
✅ Sends a detailed error email to your admin address  
✅ Customizable email Blade view and config file  
✅ Zero manual setup — just install and go!  

---

## 🧱 Installation

### 1️⃣ Require the package

```bash
composer require sandalanka/laravel-error-reporter
```````
# publish file
```bash
config/error-reporter.php
resources/views/vendor/error-reporter/error_mail.blade.php
``````````
