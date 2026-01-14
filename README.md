# Motosheet

Motosheet is a modern platform for creating, managing, and sharing clean vehicle listing pages. It helps car owners, dealers, and sellers present vehicle details professionally, track page performance, and receive buyer offers — all from a single dashboard.

---

## 🚗 What Motosheet Does

Motosheet turns vehicle information into structured, shareable pages ("vehicle sheets") that can be sent to buyers, posted online, or used internally. Each vehicle page supports rich details, images, offers, and analytics.

Key goals of the platform:

* Make vehicle listings clean, consistent, and professional
* Give sellers insight into interest through page views
* Allow buyers to submit offers directly
* Keep management simple and fast

---

## ✨ Core Features

* **Vehicle Management**
  Create, edit, soft-delete, and organize vehicle records.

* **Draft & Active States**
  Vehicles start as *Draft* and can be activated when ready. Activation can be gated behind payment.

* **Image Management**
  Upload multiple images per vehicle, reorder them, and set a cover image.

* **Public Vehicle Pages**
  Each active vehicle has a clean, shareable public page.

* **Offers System**
  Buyers can submit offers directly from a vehicle page.

* **Analytics**
  Track page views and engagement per vehicle.

* **Payments (Paystack)**
  Secure payment flow for activating vehicle listings.

---

## 🛠 Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade templates, Bootstrap
* **Database:** MySQL
* **Payments:** Paystack
* **Auth:** Laravel Authentication

---

## 📊 Dashboard Overview

From the dashboard, users can:

* View total vehicles
* Track total page views
* See active vs inactive listings
* Monitor offers received

Everything is designed to stay minimal, fast, and focused.

---

## 🔐 Status Logic

* **Draft** — Vehicle is private and inaccessible publicly
* **Active** — Vehicle page is live and publicly accessible

> Moving a vehicle from *Draft* to *Active* may require payment.

---

## 🚀 Getting Started

### Prerequisites

* PHP 8+
* Composer
* MySQL
* Node.js & npm (optional, for asset building)

### Installation

```bash
git clone https://github.com/your-username/motosheet.git
cd motosheet
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Configure your database and Paystack keys in the `.env` file before running the application.

---

## 📁 Environment Variables (Example)

```env
PAYSTACK_SECRET_KEY=your_secret_key
PAYSTACK_PUBLIC_KEY=your_public_key
```

---

## 📌 Project Status

This project is currently an **MVP** and actively evolving. Core functionality is stable, with room for enhancements such as:

* Advanced analytics
* Messaging between buyers and sellers
* Multiple pricing tiers
* Dealer accounts

---

## 📄 License

This project is proprietary and not licensed for redistribution without permission.

---

## ✍️ Author

Built by **Lloyd Mensah**

---

If you’re building vehicle-first products or marketplaces, Motosheet is designed to be a strong, extensible foundation.
