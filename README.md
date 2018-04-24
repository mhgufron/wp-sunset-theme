# Wordpress Theme Development

## A. Catatan Tutorial

### 1. Custom Font Icon and Folder Structure
Untuk membuat custom font icon kita membutuhkan file svg download file svg dari github yang sudah disediakan
buka [icomon.io](https://icomoon.io/app/) klik 3 strip menu bar pilih `Manage Project` tulis nama Project
pilih `Import Icon` di menu klik `Generate Font` klik `Prefences` custom sesuai keinginan
contoh:  
- Font Name : sunset-icon
- Class Prefix : sunset
- CSS Selector : use a class = .sunset-icon

Aktifkan WP_Debug di `config.php` di root wordpress Untuk mengecek apakah ada code yang error caranya
- Buka file `config.php`
- Search `WP_Debug` ubah value menjadi true dan save file

Folder Structure
saya mengambil folder structure sama seperti tema bawaan wp yang terakhir saat ini yaitu `twenty seventeen`
- `sunsettheme` folder
  - `assets` folder
    - `css` folder
    - `js` folder
    - `font` folder
    - `sass` folder
  - `inc` folder function
  - `template-parts` folder
  - `footer.php` file
  - `header.php` file
  - `index.php` file
  - `screenshot.png` file
  - `style.css` file  
  
Make Blank Theme  
`header.php` `<?php get_header(); ?>`  
`footer.php` `<?php get_footer(); ?>`  
`index.php` `<?php the_header(); ?><?php the_footer(); ?>`  


### 2. How to create a Custom Admin Page



















###
