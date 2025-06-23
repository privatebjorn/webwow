# WebWow

WebWow is a retro-styled, PHP-powered multimedia portal celebrating software nostalgia, creative projects, music, and LAN-party culture.

## ✨ Overview

Originally born as a meme and point-and-click game concept, WebWow evolved into a fun and functional site hosting:

- 🎶 A curated **Music Collection** with embedded streaming and downloads  
- 💾 Original **Software Projects** with screenshots and categorized downloads  
- 🖼️ A retro **Image Gallery** from events, machines, and behind-the-scenes moments  
- 📜 A detailed **About Page** describing the history of the brand  
- 🔥 A **Daily Picks Homepage** featuring a song, image, and app of the day

## 📂 Structure

- `index.php` — Homepage with rotating daily picks  
- `about.php`, `music.php`, `software.php`, `gallery.php` — Main content sections  
- `files/` — Contains all assets (images, music, software) stored by UUID  
- `modules/delivery.php` — Smart file delivery system with support for streaming and downloading based on metadata  
- `filecollections.json` — Unified index of all content (music, images, software, about)

## 🛠️ Tech Stack

- PHP 7+
- HTML4 Transitional (intentionally retro look)
- JSON for metadata
- No external dependencies or databases

## 🔐 Notes

- `old/` and `phpmyadmin/` directories are excluded via `.gitignore`
- File delivery is handled dynamically via `delivery.php` using metadata only (files have no extensions on disk)

## 📡 Live Usage

To embed or stream content:

```html
<img src="modules/delivery.php?id=abc123&stream">
<audio src="modules/delivery.php?id=def456&stream" controls></audio>
<a href="modules/delivery.php?id=ghi789&download">Download</a>
